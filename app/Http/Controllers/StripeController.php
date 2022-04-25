<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StripeController extends AppBaseController
{
    /**
     * @param  Request  $request
     *
     * @throws ApiErrorException
     *
     * @return JsonResponse
     */
    public function purchase(Request $request): JsonResponse
    {
        $plan = Plan::with('currency')->findOrFail($request->plan_id);

        setStripeApiKey();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => getLogInUser()->email,
            'line_items'           => [
                [
                    'name'     => $plan->name,
                    'amount' => ! in_array($plan->currency->currency_code,
                        zeroDecimalCurrencies()) ? removeCommaFromNumbers($plan->price) * 100 : removeCommaFromNumbers($plan->price),
                    'currency' => $plan->currency->currency_code,
                    'quantity' => 1,
                ],
            ],
            'success_url'          => route('stripe.success', $plan->id).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('stripe.failed').'?error=payment_cancelled',
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @param  Request  $request
     * @param  Plan  $plan
     *
     * @throws Exception
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request, Plan $plan)
    {
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        try {
            setStripeApiKey();
            $sessionData = Session::retrieve($sessionId);

            DB::beginTransaction();

            Transaction::create([
                'transaction_id' => $sessionData->payment_intent,
                'amount'         => $sessionData->amount_total / 100,
                'type'           => Transaction::STRIPE,
            ]);

            Subscription::whereTenantId(getLogInTenantId())
                ->whereIsActive(true)->update(['is_active' => false]);

            $expiryDate = setExpiryDate($plan);

            Subscription::create([
                'plan_id'   => $plan->id,
                'expiry_at' => $expiryDate,
                'is_active' => true,
            ]);

            DB::commit();

            Flash::success('You purchase this plan successfully');

            return view('sadmin.plans.payment.paymentSuccess');
        } catch (ApiErrorException $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function paymentFailed(Request $request)
    {
        return view('sadmin.plans.payment.paymentcancel');
    }
}
