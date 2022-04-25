@extends('layouts.app')
@section('title')
    Analytics
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
                @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                    <a href="{{ route('vcards.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @else
                    <a href="{{ route('sadmin.vcards.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @endif
            </div>
        </div>
    </div><br><br>
@endsection
@section('content')
    @include('layouts.errors')
    @if(!empty($data['noRecord']))
        <div class="d-flex justify-content-center">
            <span>{{$data['noRecord']}}</span>
        </div>
    @else
        {{ Form::hidden('analytic_vcard_id', $vcard->id, ['id' => 'analyticVcardId']) }}
        {{ Form::hidden('visitors', __('messages.analytics.visitors'), ['id' => 'analyticVisitors']) }}
        <div class="card card-bordered">
            <div class="card-body p-5">
                <div class="card-header border-0 pt-5">
                    <span class="card-label fw-bolder align-self-center fs-3 mb-1 ">{{ __('messages.analytic.vcard_analytic') }}</span>
                    <div class="ms-auto">
                        <a href="javascript:void(0)" class="btn btn-light fw-bolder me-5 ps-3 pe-2"
                           title="Switch Chart">
                            <span class="svg-icon svg-icon-1 m-0 text-center" id="changeChart">
                                <i class="fas fa-chart-bar fs-1 fw-boldest chart"></i>
                            </span>
                        </a>
                    </div>
                    <div id="timeRange"
                         class="time_range d-flex time_range_width w-30 h-40px border p-2 justify-content-center align-items-center rounded-2">
                        <i class="far fa-calendar-alt"
                           aria-hidden="true"></i>&nbsp;&nbsp<span></span> <b
                                class="caret"></b>
                    </div>
                </div>
                <div class="card-body p-lg-6 p-0">
                    <div class="chart-container">
                        <div id="weeklyUserBarChartContainer">
                            <canvas id="weeklyUserBarChart" height="200" width="905"
                                    style="display: block; width: 905px; height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5 p-3">
            @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                @include('vcards.sub_analytics')
            @else
                @include('sadmin.vcards.sub_analytics')
            @endif
        </div>

        <div class="card card-bordered">
            <div class="card-body">
                @if($partName == 'overview')
                    <div class="row">
                        <div class="col-12 col-lg-6 my-3">
                            <div class="card h-100 border">
                                <div class="card-body">
                                    <h3 class="h5">{{__('messages.analytics.countries')}}</h3>
                                    <p></p>
                                    @foreach($data['country'] as $name => $country)
                                        @if($loop->index < 5)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span class="me-2">{{get_country_flag($name)}}</span>
                                                        <a class="align-middle">{{$name}}</a>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">{{round($country['per'])}}%</small>
                                                        <span class="ml-3">{{$country['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$country['per']}}%;"
                                                         aria-valuenow="{{$country['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="px-9 pt-2 pb-5">
                                    @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                        <a href="{{config('app.url')}}/admin/vcard/{{$data['vcardID']}}/analytics?part=country"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @else
                                        <a href="{{config('app.url')}}/sadmin/vcard/{{$data['vcardID']}}/analytics?part=country"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-3">
                            <div class="card h-100 border">
                                <div class="card-body">
                                    <h3 class="h5">{{__('messages.analytics.devices')}}</h3>
                                    <p></p>

                                    @foreach($data['device'] as $name => $device)
                                        @if($loop->index < 5)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{(ucfirst($name))}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($device['per'])}}%</small>
                                                        <span class="ml-3">{{$device['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$device['per']}}%;"
                                                         aria-valuenow="{{$device['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <div class="px-9 pt-2 pb-5">
                                    @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                        <a href="{{config('app.url')}}/admin/vcard/{{$data['vcardID']}}/analytics?part=device"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @else
                                        <a href="{{config('app.url')}}/sadmin/vcard/{{$data['vcardID']}}/analytics?part=device"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-3">
                            <div class="card h-100 border">
                                <div class="card-body">
                                    <h3 class="h5">{{__('messages.analytics.os')}}</h3>
                                    <p></p>

                                    @foreach($data['operating_system'] as $name => $os)
                                        @if($loop->index < 5)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{$name}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($os['per'])}}%</small>
                                                        <span class="ml-3">{{$os['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$os['per']}}%;" aria-valuenow="{{$os['per']}}"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <div class="px-9 pt-2 pb-5">
                                    @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                        <a href="{{config('app.url')}}/admin/vcard/{{$data['vcardID']}}/analytics?part=os"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @else
                                        <a href="{{config('app.url')}}/sadmin/vcard/{{$data['vcardID']}}/analytics?part=os"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-3">
                            <div class="card h-100 border">
                                <div class="card-body">
                                    <h3 class="h5">{{__('messages.analytics.browsers')}}</h3>
                                    <p></p>

                                    @foreach($data['browser'] as $name => $browser)
                                        @if($loop->index < 5)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{$name}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($browser['per'])}}%</small>
                                                        <span class="ml-3">{{$browser['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$browser['per']}}%;"
                                                         aria-valuenow="{{$browser['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <div class="px-9 pt-2 pb-5">
                                    @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                        <a href="{{config('app.url')}}/admin/vcard/{{$data['vcardID']}}/analytics?part=browser"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @else
                                        <a href="{{config('app.url')}}/sadmin/vcard/{{$data['vcardID']}}/analytics?part=browser"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-3">
                            <div class="card h-100 border">
                                <div class="card-body">
                                    <h3 class="h5">{{__('messages.analytics.languages')}}</h3>
                                    <p></p>
                                    @foreach($data['language'] as $name => $language)
                                        @if($loop->index < 5)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{\App\Models\User::ALL_LANGUAGES[$name]}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($language['per'])}}%</small>
                                                        <span class="ml-3">{{$language['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$language['per']}}%;"
                                                         aria-valuenow="{{$language['per']}}"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <div class="px-9 pt-2 pb-5">
                                    @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                        <a href="{{config('app.url')}}/admin/vcard/{{$data['vcardID']}}/analytics?part=language"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @else
                                        <a href="{{config('app.url')}}/sadmin/vcard/{{$data['vcardID']}}/analytics?part=language"
                                           class="text-muted">{{__('messages.analytics.view_more')}}</a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        @endif
                        @if($partName == 'country')
                            <div class="col-12 my-3">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h3 class="h5">{{__('messages.analytics.countries')}}</h3>
                                        <p></p>
                                        @foreach($data['country'] as $name => $country)

                                            <div class="d-flex justify-content-between mb-1 mt-4">
                                                <div class="text-truncate">
                                                    <span class="me-2">{{get_country_flag($name)}}</span>
                                                    <a class="align-middle">{{$name}}</a>
                                                </div>
                                                <div>
                                                    <small class="text-muted">{{round($country['per'])}}%</small>
                                                    <span class="ml-3">{{$country['count']}}</span>
                                                </div>
                                            </div>

                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                     style="width: {{$country['per']}}%;"
                                                     aria-valuenow="{{$country['per']}}" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($partName == 'device')
                            <div class="col-12 my-3">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h3 class="h5">{{__('messages.analytics.devices')}}</h3>
                                        <p></p>

                                        @foreach($data['device'] as $name => $device)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{(ucfirst($name))}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($device['per'])}}%</small>
                                                        <span class="ml-3">{{$device['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$device['per']}}%;"
                                                         aria-valuenow="{{$device['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        @endif
                        @if($partName == 'os')
                            <div class="col-12 my-3">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h3 class="h5">{{__('messages.analytics.os')}}</h3>
                                        <p></p>

                                        @foreach($data['operating_system'] as $name => $os)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{$name}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($os['per'])}}%</small>
                                                        <span class="ml-3">{{$os['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$os['per']}}%;" aria-valuenow="{{$os['per']}}"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        @endif
                        @if($partName == 'browser')
                            <div class="col-12 my-3">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h3 class="h5">{{__('messages.analytics.browsers')}}</h3>
                                        <p></p>

                                        @foreach($data['browser'] as $name => $browser)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{$name}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($browser['per'])}}%</small>
                                                        <span class="ml-3">{{$browser['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$browser['per']}}%;"
                                                         aria-valuenow="{{$browser['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        @endif
                        @if($partName == 'language')
                            <div class="col-12  my-3">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h3 class="h5">{{__('messages.analytics.languages')}}</h3>
                                        <p></p>
                                        @foreach($data['language'] as $name => $language)
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <div class="text-truncate">
                                                        <span>{{\App\Models\User::LANGUAGES[$name]}}</span>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted">{{round($language['per'])}}%</small>
                                                        <span class="ml-3">{{$language['count']}}</span>
                                                    </div>
                                                </div>

                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{getRandColor()}}" role="progressbar"
                                                         style="width: {{$language['per']}}%;"
                                                         aria-valuenow="{{$language['per']}}" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    @endif
@endsection
