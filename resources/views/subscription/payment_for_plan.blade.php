@extends('layouts.app')
@section('title')
    {{__('messages.subscription.payment')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{url()->previous()}}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post flex-column-fluid mt-lg-15">
        @include('flash::message')
        <div class="card">
            @php
                $cpData = getCurrentPlanDetails();
                $planText = ($cpData['isExpired']) ? __('messages.subscription.current_expire') : __('messages.subscription.current_plan');
                $currentPlan = $cpData['currentPlan'];
            @endphp
            <div class="card-body p-lg-10">
                <div class="row">
                    @if($planText != 'Current Expired Plan')
                        <div class="col-md-6 col-12 mb-md-0 mb-10">
                            <div class="card plan-card-shadow h-100 card-xxl-stretch p-5 me-md-2">
                                <div class="card-header border-0 px-0 custom-plan-card">
                                    <h3 class="card-title align-items-start flex-column p-sm-5 p-0">
                                        <span
                                                class="card-label fw-bolder text-primary fs-1 mb-1 me-0">{{$planText}}</span>
                                    </h3>
                                </div>
                                <div class="card-body py-sm-3 py-0 px-0">
                                    <div class="flex-stack">
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.plan_name')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['name']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-3 text-gray-800 fw-bolder">{{__('messages.subscription.plan_price')}}</h4>
                                            <span class="fs-5 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ $currentPlan->currency->currency_icon }}
                                        </span>
                                        {{ number_format($currentPlan->price) }}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.start_date')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['startAt']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.end_date')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['endsAt']}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.used_days')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['usedDays']}} Days</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.remaining_days')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$cpData['remainingDays']}} {{__('messages.plan.days')}}</span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.used_balance')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ $currentPlan->currency->currency_icon }}
                                        </span>
                                        {{$cpData['usedBalance']}}
                                    </span>
                                        </div>
                                        <div class="d-flex align-items-center plan-border-bottom py-2">
                                            <h4 class="fs-5 w-50 mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.remaining_balance')}}</h4>
                                            <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        <span class="mb-2">{{ $currentPlan->currency->currency_icon }}</span>
                                        {{$cpData['remainingBalance']}}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $newPlan = getProratedPlanData($subscriptionsPricingPlan->id);
                    @endphp

                    {{ Form::hidden('amount_to_pay', $newPlan['amountToPay'], ['id' => 'amountToPay']) }}
                    {{ Form::hidden('plan_end_date', $newPlan['endDate'], ['id' => 'planEndDate']) }}
                    <div class="col-md-6 col-12 @if($planText == 'Current Expired Plan') mx-auto @endif">
                        <div class="card plan-card-shadow h-100 card-xxl-stretch p-5 ms-md-2">
                            <div class="card-header border-0 px-0 custom-plan-card">
                                <h3 class="card-title align-items-start flex-column p-sm-5 p-0">
                                    <span
                                            class="card-label fw-bolder text-primary fs-1 mb-1 me-0">{{__('messages.plan.new_plan')}}</span>
                                </h3>
                            </div>
                            <div class="card-body py-3 px-0">
                                <div class="flex-stack">
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.plan_name')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$newPlan['name']}}</span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.plan_price')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        <span class="mb-2">
                                            {{ $subscriptionsPricingPlan->currency->currency_icon }}
                                        </span>
                                        {{ ($subscriptionsPricingPlan->price) }}
                                    </span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.start_date')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$newPlan['startDate']}}</span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.end_date')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">{{$newPlan['endDate']}}</span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.total_days')}}</h4>
                                        <span
                                                class="fs-5 w-50 text-muted fw-bold mt-1">{{$newPlan['totalDays']}} {{__('messages.plan.days')}}</span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.plan.remaining_balance')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                        {{ $subscriptionsPricingPlan->currency->currency_icon }}
                                            {{$newPlan['remainingBalance']}}
                                    </span>
                                    </div>
                                    <div class="d-flex align-items-center plan-border-bottom py-2">
                                        <h4 class="fs-5 plan-data mb-0 me-5 text-gray-800 fw-bolder">{{__('messages.subscription.payable_amount')}}</h4>
                                        <span class="fs-5 w-50 text-muted fw-bold mt-1">
                                    {{ $subscriptionsPricingPlan->currency->currency_icon }}
                                            {{($newPlan['amountToPay'])}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center mt-5 plan-controls">
                        <div class="mt-5 me-3 border border-gray-400 w-50 {{ $newPlan['amountToPay'] <= 0 ? 'd-none' : '' }}">
                            {{ Form::select('payment_type', $paymentTypes ,null , ['class' => 'form-select form-select-solid','required', 'id' => 'paymentType', 'data-control' => 'select2', 'placeholder'=>__("messages.select_payment_type")]) }}
                        </div>
                        <div class="mt-5 stripePayment proceed-to-payment {{ $newPlan['amountToPay'] > 0 ? 'd-none' : '' }}">
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto d-block makePayment"
                                    data-id="{{ $subscriptionsPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                {{ __('messages.subscription.pay_or_switch_plan') }}</button>
                        </div>
                        <div class="mt-5 paypalPayment proceed-to-payment d-none">
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto d-block paymentByPaypal"
                                    data-id="{{ $subscriptionsPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                {{ __('messages.subscription.pay_or_switch_plan') }}</button>
                        </div>
                        <div class="mt-5 RazorPayPayment proceed-to-payment d-none">
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto d-block paymentByRazorPay"
                                    data-id="{{ $subscriptionsPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                {{ __('messages.subscription.pay_or_switch_plan') }}</button>
                        </div>
                        <div class="mt-5 ManuallyPayment proceed-to-payment d-none">
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto d-block manuallyPay"
                                    data-id="{{ $subscriptionsPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                                Cash Pay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
