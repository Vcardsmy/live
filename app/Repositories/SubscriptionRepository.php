<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\Plan;
use App\Models\TempSubscription;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SubscriptionRepository
 */
class SubscriptionRepository extends BaseRepository
{

    protected $fieldSearchable = [
        'user_id',
        'stripe_id',
        'stripe_status',
        'stripe_plan',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Subscription::class;
    }

    /**
     * @param int $planId
     *
     *
     * @return array
     */
    public function purchaseSubscriptionForStripe($planId)
    {
        $data = $this->manageSubscription($planId);

        if (!isset($data['plan'])) { // 0 amount plan or try to switch the plan if it is in trial mode
            return $data;
        }

        $result = $this->manageStripeData(
            $data['plan'],
            ['amountToPay' => $data['amountToPay'], 'sub_id' => $data['subscription']->id]
        );

        return $result;
    }

    /**
     * @param int $planId
     *
     * @return array
     */
    public function manageSubscription($planId)
    {
        /** @var Plan $subscriptionPlan */
        $subscriptionPlan = Plan::findOrFail($planId);
        $newPlanDays = $subscriptionPlan->frequency == Plan::MONTHLY ? 30 : 365;
        $startsAt = Carbon::now();
        $endsAt = $startsAt->copy()->addDays($newPlanDays);

        $usedTrialBefore = Subscription::whereTenantId(getLogInUser()->tenant_id)->whereNotNull('trial_ends_at')->exists();

        // if the user did not have any trial plan then give them a trial
        if (!$usedTrialBefore && $subscriptionPlan->trial_days > 0) {
            $endsAt = $startsAt->copy()->addDays($subscriptionPlan->trial_days);
        }

        $amountToPay = $subscriptionPlan->price;

        /** @var Subscription $currentSubscription */
        $currentSubscription = getCurrentSubscription();

        $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
        $planIsInTrial = checkIfPlanIsInTrial($currentSubscription);
        // switching the plan -- Manage the pro-rating
        if (!$currentSubscription->isExpired() && $amountToPay != 0 && !$planIsInTrial) {
            $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);

            $currentPlan = $currentSubscription->plan; // TODO: take fields from subscription

            // checking if the current active subscription plan has the same price and frequency in order to process the calculation for the proration
            $planPrice = $currentPlan->price;
            $planFrequency = $currentPlan->frequency;
            if ($planPrice != $currentSubscription->plan_amount || $planFrequency != $currentSubscription->plan_frequency) {
                $planPrice = $currentSubscription->plan_amount;
                $planFrequency = $currentSubscription->plan_frequency;
            }

            $frequencyDays = $planFrequency == Plan::MONTHLY ? 30 : 365;
            $perDayPrice = round($planPrice / $frequencyDays, 2);

            $remainingBalance = $planPrice - ($perDayPrice * $usedDays);

            if ($remainingBalance < $subscriptionPlan->price) { // adjust the amount in plan i.e. you have to pay for it
                $amountToPay = round($subscriptionPlan->price - $remainingBalance, 2);
            } else {
                $perDayPriceOfNewPlan = round($subscriptionPlan->price / $newPlanDays, 2);

                $totalDays = round($remainingBalance / $perDayPriceOfNewPlan);
                $endsAt = Carbon::now()->addDays($totalDays);
                $amountToPay = 0;
            }
        }

        // check that if try to switch the plan
        if (!$currentSubscription->isExpired()) {
            if ((checkIfPlanIsInTrial($currentSubscription) || !checkIfPlanIsInTrial($currentSubscription)) && $subscriptionPlan->price <= 0) {
                return ['status' => false, 'subscriptionPlan' => $subscriptionPlan];
            }
        }

        if ($usedDays <= 0) {
            $startsAt = $currentSubscription->starts_at;
        }

        $input = [
            'user_id'        => getLogInUser()->id,
            'plan_id'        => $subscriptionPlan->id,
            'plan_amount'    => $subscriptionPlan->price,
            'plan_frequency' => $subscriptionPlan->frequency,
            'starts_at'      => $startsAt,
            'ends_at'        => $endsAt,
            'status'         => Subscription::INACTIVE,
            'no_of_vcards'   => $subscriptionPlan->no_of_vcards,
        ];

        $subscription = Subscription::create($input);

        if ($subscriptionPlan->price <= 0 || $amountToPay == 0) {
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscription->id)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);
            Subscription::findOrFail($subscription->id)->update(['status' => Subscription::ACTIVE]);

            return ['status' => true, 'subscriptionPlan' => $subscriptionPlan];
        }

        session(['subscription_plan_id' => $subscription->id]);
        session(['from_pricing' => request()->get('from_pricing')]);

        return [
            'plan'         => $subscriptionPlan,
            'amountToPay'  => $amountToPay,
            'subscription' => $subscription,
        ];
    }


    public function manageStripeData($subscriptionPlan, $data): array
    {
        $amountToPay = $data['amountToPay'];
        $subscriptionID = $data['sub_id'];
        if (!empty($subscriptionPlan->currency) && in_array($subscriptionPlan->currency->currency_code,
                zeroDecimalCurrencies())) {
            $planAmount = $amountToPay;
        } else {
            $planAmount = $amountToPay * 100;
        }

        setStripeApiKey();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => Auth::user()->email,
            'line_items'           => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => $subscriptionPlan->name,
                        ],
                        'unit_amount'  => $planAmount,
                        'currency'     => $subscriptionPlan->currency->currency_code,
                    ],
                    'quantity'    => 1,
                    'description' => 'Subscribing for the plan named '.$subscriptionPlan->name,
                ],
            ],
            'client_reference_id'  => $subscriptionID,
            'metadata'             => [
                'payment_type'  => Transaction::STRIPE,
                'amount'        => $planAmount,
                'plan_currency' => $subscriptionPlan->currency->currency_code,
            ],
            'mode'                 => 'payment',
            'success_url'          => url('payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('failed-payment?error=payment_cancelled'),
        ]);

        $result = [
            'sessionId' => $session['id'],
        ];

        return $result;
    }

    /**
     * @throws ApiErrorException
     */
    public function paymentUpdate($request)
    {
        try {
            setStripeApiKey();
            // Current User Subscription

            // New Plan Subscribe
            $stripe = new \Stripe\StripeClient(
                config('services.stripe.secret_key')
            );
            $sessionData = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );

            // where, $sessionData->client_reference_id = the subscription id
            Subscription::findOrFail($sessionData->client_reference_id)->update(['status' => Subscription::ACTIVE]);
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $sessionData->client_reference_id)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $paymentAmount = null;
            if ($sessionData->metadata->plan_currency != null && in_array($sessionData->metadata->plan_currency,
                    zeroDecimalCurrencies())) {
                $paymentAmount = $sessionData->amount_total;
            } else {
                $paymentAmount = $sessionData->amount_total / 100;
            }

            $transaction = Transaction::create([
                'transaction_id' => $request->session_id,
                'type'           => $sessionData->metadata->payment_type,
                'amount'         => $paymentAmount,
                'tenant_id'      => getLogInTenantId(),
                'status'         => Transaction::SUCCESS,
                'meta'           => json_encode($sessionData),
            ]);

            $subscription = Subscription::findOrFail($sessionData->client_reference_id);
            $subscription->update(['transaction_id' => $transaction->id]);

            DB::commit();
            $subscription->load('plan');

            return $subscription;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $planId
     */
    public function paymentFailed($planId)
    {
        $subscriptionPlan = Subscription::findOrFail($planId);
        $subscriptionPlan->delete();

    }
}
