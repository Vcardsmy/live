<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriptionDataTable;
use App\Models\Plan;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SubscriptionController extends AppBaseController
{

    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepo;

    /**
     * @param SubscriptionRepository $subscriptionRepo
     */
    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $currentPlan = getCurrentSubscription();

        $days = $remainingDay = '';
        if ($currentPlan->ends_at > Carbon::now()) {
            $days = Carbon::parse($currentPlan->ends_at)->diffInDays();
            $remainingDay = $days.' Days';
        }

        if ($days >= 30 && $days <= 365) {
            $remainingDay = '';
            $months = floor($days / 30);
            $extraDays = $days % 30;
            if ($extraDays > 0) {
                $remainingDay .= $months.' Month '.$extraDays.' Days';
            } else {
                $remainingDay .= $months.' Month ';
            }
        }

        if ($days >= 365) {
            $remainingDay = '';
            $years = floor($days / 365);
            $extraMonths = floor($days % 365 / 30);
            $extraDays = floor($days % 365 % 30);
            if ($extraMonths > 0 && $extraDays < 1) {
                $remainingDay .= $years.' Years '.$extraMonths.' Month ';
            } elseif ($extraDays > 0 && $extraMonths < 1) {
                $remainingDay .= $years.' Years '.$extraDays.' Days';
            } elseif ($years > 0 && $extraDays > 0 && $extraMonths > 0) {
                $remainingDay .= $years.' Years '.$extraMonths.' Month '.$extraDays.' Days';
            }else {
                $remainingDay .= $years.' Years ';
            }
        }

        return view('subscription.index', compact('currentPlan', 'remainingDay'));
    }

    public function choosePaymentType($planId, $context = null, $fromScreen = null)
    {
        // code for checking the current plan is active or not, if active then it should not allow to choose that plan
        $subscriptionsPricingPlan = Plan::findOrFail($planId);
        $paymentTypes = getPaymentGateway();
        return view('subscription.payment_for_plan', compact('subscriptionsPricingPlan','paymentTypes'));
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function upgrade()
    {
        $plans = Plan::with(['currency', 'planFeature'])
            ->get();

        $monthlyPlans = $plans->where('frequency', Plan::MONTHLY);
        $yearlyPlans = $plans->where('frequency', Plan::YEARLY);

        return view('subscription.upgrade',
            compact('monthlyPlans', 'yearlyPlans'));
    }

    /**
     * @param Plan $plan
     *
     * @return JsonResponse
     */
    public function setPlanZero(Plan $plan): JsonResponse
    {
        try {
            DB::beginTransaction();

            Subscription::whereTenantId(getLogInTenantId())
                ->whereIsActive(true)->update(['is_active' => false]);

            $expiryDate = setExpiryDate($plan);
            Subscription::create([
                'plan_id' => $plan->id,
                'ends_at' => $expiryDate,
                'status'  => true,
            ]);

            DB::commit();

            return $this->sendSuccess('You subscribed this plan successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param Request $request
     *
     *
     * @return JsonResponse
     */
    public function manualPay(Request $request): JsonResponse
    {
        
        $this->subscriptionRepo->manageSubscription($request->get('planId'));
        $data = Subscription::whereTenantId(getLogInTenantId())->orderBy('created_at', 'desc')->first();
        Subscription::whereId($data->id)->update(['payment_type' => 'Cash']);
        return $this->sendSuccess('You subscribed this plan successfully but wait for confirmation from Admin');
    }

    /**
     * @param Request $request
     *
     *
     * @return Application|Factory|View
     */
    public function cashPlan()
    {

        return view('sadmin.planPyment.index');
        
    }

    /**
     * @param Request $request
     *
     *
     * @return JsonResponse
     */
    public function planStatus(Request $request)
    {
        Subscription::whereTenantId($request->tenant_id)
            ->where('id', '!=', $request->id)
            ->update(['status' => 0]);
      
        Subscription::where('id', $request->id)->update(['status' => 1,
                               'payment_type' => 'paid']);

        return $this->sendSuccess('Payment received successfully');
       
    }

    public function purchaseSubscription(Request $request)
    {
        $subscriptionPlanId = $request->get('plan_id');
        $result = $this->subscriptionRepo->purchaseSubscriptionForStripe($subscriptionPlanId);
        // returning from here if the plan is free.
        if (isset($result['status']) && $result['status'] == true) {
            return $this->sendSuccess($result['subscriptionPlan']->name.' '.__('messages.subscription.has_been_subscribed'));
        } else {
            if (isset($result['status']) && $result['status'] == false) {
                return $this->sendError('Cannot switch to zero plan if trial is available / having a paid plan which is currently active');
            }
        }

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param Request $request
     *
     * @throws ApiErrorException
     *
     * @return Application|Factory|View
     */
    public function paymentSuccess(Request $request)
    {
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscription = $subscriptionRepo->paymentUpdate($request);
        Flash::success($subscription->plan->name.' '.__('messages.subscription.has_been_subscribed'));

        return view('sadmin.plans.payment.paymentSuccess');
    }

    /**
     * @return Application
     */
    public function handleFailedPayment()
    {
        $subscriptionPlanId = session('subscription_plan_id');
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->paymentFailed($subscriptionPlanId);
        Flash::error('Unable to process the payment at the moment. Try again later.');

        return view('sadmin.plans.payment.paymentcancel');
    }

    /**
     * @param Request $request
     *
     *
     * @return Application|Factory|View
     */
    public function userSubscribedPlan(Request $request)
    {

        if ($request->ajax()) {
            return Datatables::of(Subscription::with(['tenant.user', 'plan.currency'])->where('status',
                Subscription::ACTIVE)->get())->make(true);
        }

        return view('sadmin.subscriptionPlan.index');
    }

    /**
     * @param Request $request
     *
     *
     * @return JsonResponse
     */
    public function userSubscribedPlanEdit(Request $request)
    {
        $subscription = Subscription::whereId($request->id)->first();

        return $this->sendResponse($subscription, 'Subscription successfully retrieved.');
    }

    /**
     * @param Request $request
     *
     *
     * @return JsonResponse
     */
    public function userSubscribedPlanUpdate(Request $request)
    {
        $subscription = Subscription::where('id', $request->id)->update([
            'ends_at' => $request->end_date,
            'status' => Subscription::ACTIVE,
        ]);

        return $this->sendResponse($subscription, 'Subscription date successfully updated.');
    }
}
