<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                <i class="bi bi-list fs-1"></i>
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="javascript:void(0)" class="d-lg-none">
                <img alt="Logo" src="{{ getLogoUrl() }}" class="h-15px"/>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true"
                     data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                     data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                     data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                     data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    @include('layouts.sub_menu')
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Topbar-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center">
                    @if((is_impersonating() === false))
                        <div class="topbar-item position-relative d-flex align-items-center">
                            @if(getLogInUser()->theme_mode)
                                <a data-turbo="false" href="{{ route('mode.theme') }}" class="user-icon p-3 ms-2 rounded-1"
                                   title="{{__('messages.tooltip.light_mode')}}">
                                    <i class="fas user-check-icon fa-sun fs-3"></i>
                                </a>
                            @else
                                <a data-turbo="false" href="{{ route('mode.theme') }}" class="user-icon p-3 ms-2 rounded-1"
                                   title="{{__('messages.tooltip.dark_mode')}}">
                                    <i class="fas user-check-icon fa-moon fs-3"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="d-flex align-items-stretch">
                    {{--                    @role(\App\Models\Role::ROLE_ADMIN)--}}
                    {{--                        @if(getCurrentSubscription()->plan->is_trial)--}}
                    {{--                        <div class="topbar-item position-relative d-flex align-items-center">--}}
                    {{--                            <span class="badge badge-warning fs-7 m-1">{{ __('messages.subscription.trial_plan') }}</span>--}}
                    {{--                        </div>--}}
                    {{--                        @endif--}}
                    {{--                    @endrole--}}
                    @impersonating
                    <div class="topbar-item position-relative d-flex align-items-center"
                         title="{{__('messages.user.return_to_admin')}}">
                        <a data-turbo="false" data-turbo-eval="false" href="{{ route('impersonate.leave') }}" class="user-icon p-3 ms-2 rounded-1">
                            <i class="fas fa-user-check user-check-icon fs-4"></i> </a>
                    </div>
                    @endImpersonating
                    <!--begin::Notifications-->
{{--                    <div class="topbar-item position-relative p-8 d-flex align-items-center hoverable"--}}
{{--                         data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"--}}
{{--                         data-kt-menu-flip="bottom" title="{{__('messages.notification.notifications')}}">--}}
{{--                        <i class="far fa-bell fs-3"></i>--}}
{{--                    </div>--}}
{{--                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px overflow-auto h-400px"--}}
{{--                         data-kt-menu="true">--}}
{{--                        <div class="d-flex justify-content-between bgi-no-repeat rounded-top"--}}
{{--                             style="background-color:#009ef7">--}}
{{--                            <h3 class="text-white fw-bold px-9 mt-7 mb-5">{{__('messages.notification.notifications')}}--}}
{{--                                <span class="fs-8 opacity-75 ps-3 text-right" style="margin-left: 90px;">--}}
{{--                                <a href="#" class="read-all-notification text-white" id="readAllNotification">--}}
{{--                                    {{ __('messages.notification.mark_all_as_read') }}</a>--}}
{{--                            </span>--}}
{{--                            </h3>--}}
{{--                        </div>--}}
{{--                        <div class="empty-state empty-notification d-none fs-6 text-gray-800 fw-bold text-center mt-5"--}}
{{--                             data-height="400">--}}
{{--                            <p>{{ __('messages.notification.you_don`t_have_any_new_notification') }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!--end::Notifications-->
                </div>
                <!--begin::User-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                        <img src="{{ getLogInUser()->profile_image }}" alt="metronic"/>
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                         data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ getLogInUser()->profile_image }}"/>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">{{getLogInUser()->full_name}}
                                    </div>
                                    <a href="#"
                                       class="fw-bold text-muted text-hover-primary fs-7">{{getLogInUser()->email}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('profile.setting') }}"
                               class="menu-link px-5">{{ __('messages.user.account_setting') }}</a>
                        </div>
                        @role(\App\Models\Role::ROLE_ADMIN)
                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('subscription.index') }}"
                               class="menu-link px-5">{{ __('messages.subscription.manage_subscription') }}</a>
                        </div>
                        @endrole
                        @if((is_impersonating() === false))
                        <div class="menu-item px-5 my-1">
                            <a class="menu-link px-5 "
                               id="changePassword">{{ __('messages.user.change_password') }}</a>
                        </div>
                        @endif
                        <div class="menu-item px-5 my-1">
                            <a class="menu-link px-5 "
                               id="changeLanguage">{{ __('messages.user.change_language') }}</a>
                        </div>
                        <div class="separator my-2"></div>
{{--                        <div class="menu-item px-5" data-kt-menu-trigger="hover"--}}
{{--                             data-kt-menu-placement="left-start" data-kt-menu-flip="bottom">--}}
{{--                            <a href="#" class="menu-link px-5">--}}
{{--                                <span class="menu-title position-relative">{{__('messages.language')}}</span>--}}
{{--                            </a>--}}
{{--                            <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
{{--                                <div class="menu-item px-3">--}}
{{--                                    <a href="account/settings.html" class="menu-link d-flex px-5 active">--}}
{{--                                            <span class="symbol symbol-20px me-4">--}}
{{--                                                <img class="rounded-1"--}}
{{--                                                     src="{{ asset('web/media/flags/united-states.svg') }}"--}}
{{--                                                     alt="metronic"/>--}}
{{--                                            </span>English</a>--}}
{{--                                </div>--}}
{{--                                <div class="menu-item px-3">--}}
{{--                                    <a href="account/settings.html" class="menu-link d-flex px-5">--}}
{{--                                            <span class="symbol symbol-20px me-4">--}}
{{--                                                <img class="rounded-1"--}}
{{--                                                     src="{{ asset('web/media/flags/spain.svg') }}" alt="metronic"/>--}}
{{--                                            </span>Spanish</a>--}}
{{--                                </div>--}}
{{--                                <div class="menu-item px-3">--}}
{{--                                    <a href="account/settings.html" class="menu-link d-flex px-5">--}}
{{--                                            <span class="symbol symbol-20px me-4">--}}
{{--                                                <img class="rounded-1"--}}
{{--                                                     src="{{ asset('web/media/flags/germany.svg') }}"--}}
{{--                                                     alt="metronic"/>--}}
{{--                                            </span>German</a>--}}
{{--                                </div>--}}
{{--                                <div class="menu-item px-3">--}}
{{--                                    <a href="account/settings.html" class="menu-link d-flex px-5">--}}
{{--                                            <span class="symbol symbol-20px me-4">--}}
{{--                                                <img class="rounded-1"--}}
{{--                                                     src="{{ asset('web/media/flags/japan.svg') }}" alt="metronic"/>--}}
{{--                                            </span>Japanese</a>--}}
{{--                                </div>--}}
{{--                                <div class="menu-item px-3">--}}
{{--                                    <a href="account/settings.html" class="menu-link d-flex px-5">--}}
{{--                                            <span class="symbol symbol-20px me-4">--}}
{{--                                                <img class="rounded-1"--}}
{{--                                                     src="{{ asset('web/media/flags/france.svg') }}"--}}
{{--                                                     alt="metronic"/>--}}
{{--                                            </span>French</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="menu-item px-5">
                            <form id="logout-form" action="{{ route('logout')}}" method="post">
                                @csrf
                            </form>
                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();"
                               class="menu-link px-5"> {{__('messages.sign_out')}}</a>
                        </div>
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User -->
                <!--begin::Heaeder menu toggle-->
                <div class="d-flex align-items-center d-lg-none px-3 me-n3" title="Show header menu">
                    <div class="topbar-item" id="kt_header_menu_mobile_toggle">
                        <i class="bi bi-text-left fs-1"></i>
                    </div>
                </div>
                <!--end::Heaeder menu toggle-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
