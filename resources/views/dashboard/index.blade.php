@extends('layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            @include('flash::message')
            @role('super_admin')
            <div class="row g-6 g-xl-9 pt-lg-0 pt-7">
                <a href="{{ route('users.index') }}" class="col-lg-6 col-xxl-6 ">
                    <div class="col bg-light-warning px-6 p-8 shadow-sm rounded-2 mb-7 h-100">
                        <div class="card-body d-flex justify-content-between p-0 ">
                            <div>
                                <div class="fs-2hx fw-bolder text-gray-800 ">{{ $users->count() }}</div>
                                <div class="fs-4 fw-bold mb-5 text-warning">{{__('messages.common.total_users')}}</div>
                            </div>
                            <span class="svg-icon svg-icon-warning svg-icon-5x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/General/User.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </div>
                        <div class="d-flex flex-wrap mt-10">
                            <div class="d-flex flex-column justify-content-center flex-row-fluid">
                                <div class="d-sm-flex fs-6 fw-bold align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center mb-sm-0 mb-3">
                                        <div class="badge badge-success fs-6">{{__('messages.common.active')}}</div>
                                        <div
                                            class=" ms-8 fw-bolder text-gray-700 fs-4">{{ $users->where('is_active',1)->count() }}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="badge badge-danger fs-6">{{__('messages.common.inactive')}}</div>
                                        <div
                                            class="ms-8  fw-bolder text-gray-700 fs-4">{{ $users->where('is_active',0)->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('sadmin.vcards.index') }}" class="col-lg-6 col-xxl-6 ">
                    <div class="col bg-light-danger px-6 p-8 shadow-sm rounded-2 mb-7 h-100">
                        <div class="card-body d-flex justify-content-between p-0">
                            <div>
                                <div class="fs-2hx fw-bolder text-gray-800">{{ $vcards->count() }}</div>
                                <div class="fs-4 fw-bold mb-5 text-danger">{{__('messages.common.total_vcards')}}</div>
                            </div>
                            <span class="svg-icon svg-icon-danger svg-icon-5x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Address-card.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </div>
                        <div class="d-flex flex-wrap mt-10">
                            <div class="d-flex flex-column justify-content-center flex-row-fluid">
                                <div class="d-sm-flex fs-6 fw-bold align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center mb-sm-0 mb-3">
                                        <div class="badge badge-success fs-6">{{__('messages.common.active')}}</div>
                                        <div
                                            class="ms-8 fw-bolder text-gray-700 fs-4">{{ $vcards->where('status',1)->count() }}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="badge badge-danger fs-6 ms-sm-5">{{__('messages.common.inactive')}}</div>
                                        <div
                                            class="ms-8 fw-bolder text-gray-700 fs-4">{{ $vcards->where('status',0)->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>


            </div>
            <div class="card g-6 g-xl-9 mt-3">
                <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label fw-bolder fs-3 mb-1 ">{{__('messages.sadmin_dashboard.recent_users_registration')}}</span>
                        </h3>
                        <div class="card-toolbar  ms-auto">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 active"
                                       data-bs-toggle="tab" href=""
                                       id="dayData">{{__('messages.sadmin_dashboard.day')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1"
                                       data-bs-toggle="tab" href=""
                                       id="weekData">{{__('messages.sadmin_dashboard.week')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 "
                                       data-bs-toggle="tab" href=""
                                       id="monthData">{{__('messages.sadmin_dashboard.month')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="month">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.sadmin_dashboard.name')}}</th>
                                            <th>{{__('messages.sadmin_dashboard.email')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.contact')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.registered_on')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="monthlyReport" class="text-gray-600 fw-bold">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="week">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.sadmin_dashboard.name')}}</th>
                                            <th>{{__('messages.sadmin_dashboard.email')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.contact')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.registered_on')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="weeklyReport" class="text-gray-600 fw-bold">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="day">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.sadmin_dashboard.name')}}</th>
                                            <th>{{__('messages.sadmin_dashboard.email')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.contact')}}</th>
                                            <th class="text-nowrap">{{__('messages.sadmin_dashboard.registered_on')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="dailyReport" class="text-gray-600 fw-bold">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('admin')
            <div class="row g-6 g-xl-9">
                <a class="col-xl-6 col-xxl-4 pt-lg-0 pt-7" href="{{ route('vcards.index') }}">
                    <div class="col bg-light-warning px-6 p-8 shadow-sm rounded-2 mb-7 h-100">
                        <div class="card-body d-flex justify-content-between p-0">
                            <div>
                                <div class="fs-2hx fw-bolder text-gray-800 ">{{ $vcardCount->count() }}</div>
                                <div class="fs-4 fw-bold mb-5 text-warning">{{__('messages.common.total_vcards')}}</div>
                            </div>
                            <span class="svg-icon svg-icon-warning svg-icon-5x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Address-card.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </div>
                        <div class="d-flex flex-wrap mt-10">
                            <div class="d-flex flex-column justify-content-center flex-row-fluid">
                                <div class="d-sm-flex fs-6 fw-bold align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center mb-sm-0 mb-3">
                                        <div class="badge badge-success fs-6">{{__('messages.common.active')}}</div>
                                        <div
                                            class="ms-8 fw-bolder text-gray-700 fs-4">{{ $vcardCount->where('status',1)->count() }}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="badge badge-danger fs-6 ms-sm-5">{{__('messages.common.inactive')}}</div>
                                        <div
                                            class="ms-8 fw-bolder text-gray-700 fs-4">{{ $vcardCount->where('status',0)->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="col-xl-6 col-xxl-4 ">
                    <div class="col bg-light-success px-6 p-8 shadow-sm rounded-2 mb-7 h-100">
                        <div class="card-body d-flex justify-content-between p-0">
                            <div>
                                <div class="fs-2hx fw-bolder">{{$enquiry}}</div>
                                <div class="fs-4 fw-bold mb-5 text-success">{{__('messages.common.today_enquiry')}}</div>
                            </div>

                            <span class="svg-icon svg-icon-success svg-icon-5x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Code/Question-circle.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path
            d="M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-4 ">
                    <div class="col bg-light-danger px-6 p-8 shadow-sm rounded-2 mb-7 h-100">
                        <div class="card-body d-flex justify-content-between p-0">
                            <div>
                                <div class="fs-2hx fw-bolder">{{$appointment}}</div>
                                <div class="fs-4 fw-bold mb-5 text-success">{{__('messages.common.today_appointments')}}</div>
                            </div>

                            <span class="svg-icon svg-icon-danger svg-icon-5x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/General/Clipboard.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body p-5">
                    <div class="card-header border-0 pt-5">
                        <span class="card-label fw-bolder align-self-center fs-3 mb-1 ">{{ __('messages.analytic.vcard_analytic') }}</span>
                        <div class="ms-auto">
                            <a href="javascript:void(0)" class="btn btn-light fw-bolder me-5 ps-3 pe-2"
                               title="Switch Chart">
                            <span class="svg-icon svg-icon-1 m-0 text-center" id="dashboardChangeChart">
                                <i class="fas fa-chart-bar fs-1 fw-boldest chart"></i>
                            </span>
                            </a>
                        </div>
                        <div id="dashboardTimeRange"
                             class="time_range d-flex time_range_width w-30 h-40px border p-2 justify-content-center align-items-center rounded-2">
                            <i class="far fa-calendar-alt"
                               aria-hidden="true"></i>&nbsp;&nbsp<span></span> <b
                                    class="caret"></b>
                        </div>
                    </div>
                    <div class="card-body p-lg-6 p-0">
                        <div class="chart-container">
                            <div id="dashboardWeeklyUserBarChartContainer">
                                <canvas id="dashboardWeeklyUserBarChart" height="200" width="905"
                                        style="display: block; width: 905px; height: 200px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card g-6 g-xl-9 mt-3">
                <div class="card card-xxl-stretch">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label fw-bolder fs-3 mb-1 text-nowrap">{{__('messages.common.today_appointments')}}</span>
                        </h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="month">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 mb-0">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="text-nowrap">{{__('messages.vcard.vcard_name')}}</th>
                                            <th>{{__('messages.common.name')}}</th>
                                            <th>{{__('messages.common.phone')}}</th>
                                            <th>{{__('messages.common.email')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="appointmentReport" class="text-gray-600 fw-bold">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
    @include('dashboard.templates.templates')
    @include('dashboard.templates.userTemplate')
@endsection

