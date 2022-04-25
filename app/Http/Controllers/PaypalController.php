<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class PaypalController extends AppBaseController
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \PayPalHttp\IOException
     *
     * @throws HttpException
     */
    public function onBoard(Request $request)
    {
        $plan = Plan::with('currency')->findOrFail($request->planId);

        if ($plan->currency->currency_code != null && !in_array(strtoupper($plan->currency->currency_code),
                getPayPalSupportedCurrencies())) {
            return $this->sendError('This currency is not supported by PayPal for making payments.');
        }

        $data = $this->subscriptionRepository->manageSubscription($request->get('planId'));


        if (!isset($data['plan'])) { // 0 amount plan or try to switch the plan if it is in trial mode
            // returning from here if the plan is free.
            if (isset($data['status']) && $data['status'] == true) {
                return $this->sendSuccess($data['subscriptionPlan']->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
            } else {
                if (isset($data['status']) && $data['status'] == false) {
                    return $this->sendError('Cannot switch to zero plan if trial is available / having a paid plan which is currently active');
                }
            }
        }

        $subscriptionsPricingPlan = $data['plan'];
        $subscription = $data['subscription'];

        $clientId = config('paypal.paypal.client_id');
        $clientSecret = config('paypal.paypal.client_secret');
        $mode = config('paypal.mode');

        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }

        $client = new PayPalHttpClient($environment);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent"              => "CAPTURE",
            "purchase_units"      => [
                [
                    "reference_id" => $subscription->id,
                    "amount"       => [
                        "value"         => $data['amountToPay'],
                        "currency_code" => $subscription->plan->currency->currency_code,
                    ],
                ],
            ],
            "application_context" => [
                "cancel_url" => route('paypal.failed'),
                "return_url" => route('paypal.success'),
            ],
        ];

        $order = $client->execute($request);

        session(['payment_type' => request()->get('payment_type')]);

        return response()->json($order);
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     * @throws \PayPalHttp\IOException
     *
     */
    public function success(Request $request)
    {
        $clientId = config('paypal.paypal.client_id');
        $clientSecret = config('paypal.paypal.client_secret');
        $mode = config('paypal.paypal.mode');

        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        $request = new OrdersCaptureRequest($request->get('token'));
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            $subscriptionId = $response->result->purchase_units[0]->reference_id;
            $subscriptionAmount = $response->result->purchase_units[0]->amount->value;
            $transactionID = $response->result->id;     // $response->result->id gives the orderId of the order created above

            Subscription::findOrFail($subscriptionId)->update(['status' => Subscription::ACTIVE]);
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscriptionId)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $transaction = Transaction::create([
                'transaction_id' => $transactionID,
                'type'           => session('payment_type'),
                'amount'         => $subscriptionAmount,
                'status'         => Subscription::ACTIVE,
                'meta'           => json_encode($response),
            ]);

            // updating the transaction id on the subscription table
            $subscription = Subscription::findOrFail($subscriptionId);
            $subscription->update(['transaction_id' => $transaction->id]);

            return view('sadmin.plans.payment.paymentSuccess');

        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function failed()
    {
        return view('sadmin.plans.payment.paymentcancel');

    }

}
