@extends('layouts.app')
@section('title')
    {{__('messages.subscription.manage_subscription')}}
@endsection
@section('content')
    <?php  ?>
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body p-12">
            <div class="row shadow-sm p-5 py-8 mb-12 bg-body rounded">
                <div class="col-lg-7">
                    <h2>{{ $currentPlan->plan->name }}</h2>
                    <h5 class="mb-12">

                        @if( \Carbon\Carbon::now() > $currentPlan->ends_at)
                            <span class="text-danger">
                                {{ __('messages.subscription.expired').' '.\Carbon\Carbon::parse($currentPlan->ends_at)->format('dS M, Y') }}
                            </span>
                        @else
                            <span class="text-success">
                                 {{ __('messages.subscription.active_until').' '.\Carbon\Carbon::parse($currentPlan->ends_at)->format('dS M, Y') }}
                            </span>
                        @endif
                    </h5>
                    <div class="fs-5 mb-2">
                        <div class="text-gray-800 fw-bolder me-1">
                            {{ $currentPlan->plan->currency->currency_icon.' '.$currentPlan->plan_amount.'/ '.\App\Models\Plan::DURATION[$currentPlan->plan_frequency] }}
                        </div>
{{--                        <div class="text-gray-600 fw-bold">--}}
{{--                           <small>--}}
{{--                               {{ $currentPlan->status ? $remainingDay.' '.__('messages.subscription.remaining') : '' }}--}}
{{--                           </small>--}}
{{--                        </div>--}}
                        @if(!empty($currentPlan->trial_ends_at))
                        @php
                            $startsAt = \Carbon\Carbon::now();
                            $totalDays = \Carbon\Carbon::parse($currentPlan->starts_at)->diffInDays($currentPlan->ends_at);
                            $usedDays = \Carbon\Carbon::parse($currentPlan->starts_at)->diffInDays($startsAt);
                            $remainingDays = $totalDays - $usedDays;
                        @endphp
                            <div class="text-gray-600 fw-bold">
                               <small>
                                   @if($remainingDays > 0)
                                       Trial Days : {{ $remainingDays.' '.__('messages.plan.days').' '.__('messages.subscription.remaining') }}
                                   @endif
                               </small>
                            </div>
                        @endif
                    </div>
                    <div class="fs-6 text-gray-600 fw-bold mb-2">
                        {{ __('messages.subscription.subscribed_date').': '.\Carbon\Carbon::parse($currentPlan->starts_at)->format('dS M, Y') }}
                    </div>
                    <div>
                        @foreach(getPlanFeature($currentPlan->plan) as $feature => $value)
                            @if($value)
                                <span class="badge {{ getRandomColor($loop->index) }}  fs-7 m-1">{{ __('messages.plan.feature.'.$feature) }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 mt-lg-0 mt-5">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{ route('subscription.upgrade') }}">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12.5936684,18.0752333 L12.5936684,14.4063316 L18.5936684,14.4063316 L18.5936684,8.40633161 L12.5936684,8.40633161 L12.5936684,4.73208782 L5.92209543,11.3984411 L12.5936684,18.0752333 Z M14.5936684,6.40633161 L19.5936684,6.40633161 C20.1459531,6.40633161 20.5936684,6.85404686 20.5936684,7.40633161 L20.5936684,15.4063316 C20.5936684,15.9586164 20.1459531,16.4063316 19.5936684,16.4063316 L14.5936684,16.4063316 L14.5936684,21.0946697 C14.5936684,21.2936837 14.5145702,21.484538 14.3737911,21.6252071 C14.0807833,21.9179858 13.6059096,21.9178001 13.313131,21.6247924 L3.62379074,11.9278722 C3.33101216,11.6348644 3.33119799,11.1599907 3.6242058,10.8672121 L13.3135459,1.18545264 C13.4541812,1.04492729 13.6448577,0.965990217 13.8436684,0.965990217 C14.257882,0.965990217 14.5936684,1.30177665 14.5936684,1.71599022 L14.5936684,6.40633161 Z"
                                              fill="#000000" fill-rule="nonzero"
                                              transform="translate(11.998998, 11.405330) scale(-1, 1) rotate(-270.000000) translate(-11.998998, -11.405330) "/>
                                    </g> </svg></span>
                            {{ __('messages.subscription.upgrade_plan') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container p-0">
                    <div class="card">
                        <div class="card-body  livewire-table p-0">
                            <livewire:usersubscription-table/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
