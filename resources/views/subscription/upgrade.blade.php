@extends('layouts.app')
@section('title')
    {{__('messages.subscription.upgrade_plan')}}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/subscription.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card subscription">
        <div class="card-body p-sm-12 p-5 pb-0">
            <div class="d-flex flex-column">
                <div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
                    <ul class="nav nav-tabs">

                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#monthly"
                               class="nav-link btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active">
                                {{ __('messages.plan.monthly') }}</a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#yearly"
                               class="nav-link btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2">
                                {{ __('messages.plan.yearly') }}</a>
                        </li>

                    </ul>
                </div>
                <div class="col-12 text-gray-700 h5 text-center py-10">
                    <div class="tab-content">

                        <div class="tab-pane show active" id="monthly">
                            <div class="row justify-content-center">
                                @forelse($monthlyPlans as $plan)
                                    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                        <div class="card pricing-card bg-light">
                                            <h1>{{ $plan->name }}</h1>
                                            <h1 class="pricing-amount">
                                                {{$plan->currency->currency_icon.$plan->price }}
                                            </h1>
                                            <div class="card-body p-0">
                                                <div class="pricing-description text-start">
                                                    <div class="mb-6">
                                                        <h3 class="mb-1">What's in Startup plan?</h3>
                                                        <small class="text-muted">
                                                            {{ __('messages.plan.duration').' '.$plan->valid_upto.' '. __('messages.plan.months')}}</small>
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ __('messages.plan.no_of_vcards').' : '.$plan->no_of_vcards }}</small>
                                                    </div>
                                                    @foreach(getPlanFeature($plan) as $feature => $value)
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <p class="fw-normal">{{ __('messages.plan.feature.'.$feature) }}</p>
                                                            @if($value)
                                                                <span class="svg-icon svg-icon-1 svg-icon-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20"
                                                                              height="20"
                                                                              rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                              fill="black"></path>
                                                                    </svg>
                                                                </span>
                                                            @else
                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         width="24" height="24"
                                                                         viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2"
                                                                              width="20" height="20" rx="10"
                                                                              fill="black"></rect>
                                                                        <rect x="7" y="15.3137" width="12"
                                                                              height="2" rx="1"
                                                                              transform="rotate(-45 7 15.3137)"
                                                                              fill="black"></rect>
                                                                        <rect x="8.41422" y="7" width="12"
                                                                              height="2" rx="1"
                                                                              transform="rotate(45 8.41422 7)"
                                                                              fill="black"></rect>
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="flex-center flex-row-fluid pt-5">
                                                @if(!empty(getCurrentSubscription()) &&  $plan->id == getCurrentSubscription()->plan_id && !getCurrentSubscription()->isExpired())
                                                   @if($plan->price != 0)
                                                       <button type="button"
                                                               class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                               data-id="{{ $plan->id }}">
                                                           {{ __('messages.subscription.currently_active') }}</button>
                                                    @else
                                                        <button type="button"
                                                                class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                            {{ __('messages.subscription.renew_free_plan') }}
                                                        </button>
                                                    @endif
                                                @else
                                                    @if(!empty(getCurrentSubscription()) && !getCurrentSubscription()->isExpired() && ($plan->price == 0 || $plan->price != 0))
                                                        @if($plan->hasZeroPlan->count() == 0)
                                                            <a data-turbo="false" href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                               class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : ''}}"
                                                               data-id="{{ $plan->id }}"
                                                               data-plan-price="{{ $plan->price }}">
                                                                {{ __('messages.subscription.switch_plan') }}</a>
                                                        @else
                                                            <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if($plan->hasZeroPlan->count() == 0)
                                                           <a data-turbo="false" href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                              class="btn btn-primary rounded-pill mx-auto  {{ $plan->price == 0 ? 'freePayment' : ''}}"
                                                              data-id="{{ $plan->id }}"
                                                              data-plan-price="{{ $plan->price }}">
                                                               {{ __('messages.subscription.choose_plan') }}</a>
                                                       @else
                                                           <button type="button" class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                               {{ __('messages.subscription.renew_free_plan') }}
                                                           </button>
                                                       @endif
                                                   @endif
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="not-plan">
                                        <span class="text-muted h1">{{ __('messages.subscription.no_plan_available') }}</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane" id="yearly">
                            <div class="row justify-content-center">
                                @forelse($yearlyPlans as $plan)
                                    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                        <div class="card pricing-card bg-light">
                                            <h1>{{ $plan->name }}</h1>
                                            <h1 class="pricing-amount">
                                                {{$plan->currency->currency_icon.$plan->price }}
                                            </h1>
                                            <div class="card-body p-0">
                                                <div class="pricing-description text-start">
                                                    <div class="mb-6">
                                                        <h3 class="mb-1">What's in Startup plan?</h3>
                                                        <small class="text-muted">
                                                            {{ __('messages.plan.duration').' '.$plan->valid_upto.' '. __('messages.plan.years')}}</small>
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ __('messages.plan.no_of_vcards').' : '.$plan->no_of_vcards }}</small>
                                                    </div>
                                                    @foreach(getPlanFeature($plan) as $feature => $value)
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <p class="fw-normal">{{ __('messages.plan.feature.'.$feature) }}</p>
                                                            @if($value)
                                                                <span class="svg-icon svg-icon-1 svg-icon-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20"
                                                                              height="20"
                                                                              rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                              fill="black"></path>
                                                                    </svg>
                                                                </span>
                                                            @else
                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         width="24" height="24"
                                                                         viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2"
                                                                              width="20" height="20" rx="10"
                                                                              fill="black"></rect>
                                                                        <rect x="7" y="15.3137" width="12"
                                                                              height="2" rx="1"
                                                                              transform="rotate(-45 7 15.3137)"
                                                                              fill="black"></rect>
                                                                        <rect x="8.41422" y="7" width="12"
                                                                              height="2" rx="1"
                                                                              transform="rotate(45 8.41422 7)"
                                                                              fill="black"></rect>
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="flex-center flex-row-fluid pt-5">
                                                @if(!empty(getCurrentSubscription()) && $plan->id == getCurrentSubscription()->plan_id && !getCurrentSubscription()->isExpired())
                                                    @if($plan->price != 0)
                                                        <button type="button"
                                                                class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                                data-id="{{ $plan->id }}">
                                                            {{ __('messages.subscription.currently_active') }}</button>
                                                    @else
                                                        <button type="button" class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                            {{ __('messages.subscription.renew_free_plan') }}
                                                        </button>
                                                    @endif
                                                @else
                                                    @if(!empty(getCurrentSubscription()) && !getCurrentSubscription()->isExpired() && ($plan->price == 0 || $plan->price != 0))
                                                        @if($plan->hasZeroPlan->count() == 0)
                                                            <a data-turbo="false" href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                               class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : ''}}"
                                                               data-id="{{ $plan->id }}"
                                                               data-plan-price="{{ $plan->price }}">
                                                                {{ __('messages.subscription.switch_plan') }}</a>
                                                        @else
                                                            <button type="button" class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if($plan->hasZeroPlan->count() == 0)
                                                            <a data-turbo="false" href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                               class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : ''}}"
                                                               data-id="{{ $plan->id }}"
                                                               data-plan-price="{{ $plan->price }}">
                                                                {{ __('messages.subscription.choose_plan') }}</a>
                                                        @else
                                                            <button type="button" class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="not-plan">
                                        <span class="text-muted h1">{{ __('messages.subscription.no_plan_available') }}</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
