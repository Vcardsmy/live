<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">
    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223"
                                                                      width="8.15546" height="2" rx="1"
                                                                      transform="rotate(45 17.0365 15.1223)"
                                                                      fill="black"></rect>
                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                      fill="black"></path>
                                                            </svg>
                                                        </span>
    <input type="text" class="form-control form-control-lg form-control-solid ps-15" id="menuSearch" name="search"
           value="" placeholder="{{__('auth.app.search')}}"
           autocomplete="off">
</div>
<div class="no-record text-white text-center d-none">{{__('messages.no_matching_records_found')}}</div>
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('sadmin/dashboard*') ? 'active' : '' }}"
       href="{{ route('sadmin.dashboard') }}">
            <span class="menu-icon">
                <i class="fas fa-chart-pie fs-3"></i>
            </span>
        <span class="menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</div>
@endrole
@role(App\Models\Role::ROLE_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">
                <i class="fas fa-chart-pie fs-3"></i>
            </span>
        <span class="menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</div>
@endrole
@can('manage_users')
    <div class="menu-item">
        <a class="menu-link {{ Request::is('sadmin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <span class="menu-icon">
                <i class="fas fa-users fs-3"></i>
            </span>
            <span class="menu-title">{{__('messages.users')}}</span>
        </a>
    </div>
@endcan
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('sadmin/vcards*') ? 'active' : '' }}" href="{{ route('sadmin.vcards.index') }}">
            <span class="menu-icon">
                <i class="fas fa-id-card fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.vcards')}}</span>
    </a>
</div>
@endrole
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('sadmin/templates*') ? 'active' : '' }}"
       href="{{ route('sadmin.templates.index') }}">
            <span class="menu-icon">
                <i class="fa fa-address-card fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.vcard.template')}}</span>
    </a>
</div>
@endrole
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('sadmin/planSubscription*') ? 'active' : '' }}" 
       href="{{ route('subscription.cash') }}">
            <span class="menu-icon">
                <i class="fa fa-money-bill fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.cash_payment')}}</span>
    </a>
</div>
@endrole
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('sadmin/subscribedPlan') ? 'active' : '' }}"
       href="{{ route('subscription.user.plan') }}">
            <span class="menu-icon">
                <i class="fa fa-paper-plane fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.subscribed_user')}}</span>
    </a>
</div>
@endrole
@role(App\Models\Role::ROLE_ADMIN)
<div class="menu-item">
    <a class="menu-link {{ Request::is('admin/vcards*') ? 'active' : '' }}" href="{{ route('vcards.index') }}">
            <span class="menu-icon">
                <i class="fas fa-id-card fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.vcards')}}</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Request::is('admin/enquiries*') ? 'active' : '' }}" href="{{ route('enquiries.index') }}">
            <span class="menu-icon">
                <i class="fas fa-info-circle fs-3"></i>
            </span>
        <span class="menu-title">{{__('messages.contact_us.contact_us')}}</span>
    </a>
</div>
<div class="menu-item">
    <a class="menu-link {{ Request::is('admin/appointments*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">
            <span class="menu-icon">
                <i class="fa fa-calendar fs-3" aria-hidden="true"></i>
            </span>
        <span class="menu-title">{{__('messages.vcard.appointments')}}</span>
    </a>
</div>
@endrole
@can('manage_plans')
    <div class="menu-item">
        <a class="menu-link {{ Request::is('sadmin/plans*') ? 'active' : '' }}" href="{{ route('plans.index') }}">
            <span class="menu-icon">
                <i class="fas fa-columns fs-3"></i>
            </span>
            <span class="menu-title">{{__('messages.plans')}}</span>
        </a>
    </div>
    <div class="menu-item">
        <a class="menu-link {{ Request::is('sadmin/currencies*') ? 'active' : '' }}" href="{{ route('currencies.index') }}">
            <span class="menu-icon">
                <i class="fas fa-dollar-sign fs-3"></i>
            </span>
            <span class="menu-title">{{__('messages.currency.currencies')}}</span>
        </a>
    </div>
@endcan
@can('manage_countries')
    <div data-kt-menu-trigger="click"
         class="menu-item menu-accordion {{ Request::is(['sadmin/countries*', 'sadmin/states*', 'sadmin/cities*']) ? 'show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-globe fs-3"></i>
            </span>
            <span class="menu-title">{{ __('messages.country.countries') }}</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion" kt-hidden-height="115">
            <div class="menu-item">
                <a class="menu-link {{ Request::is('sadmin/countries*') ? 'active' : '' }}"
                   href="{{ route('countries.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-globe-americas fs-3"></i>
                    </span>
                    <span class="menu-title">{{__('messages.country.countries')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ Request::is('sadmin/states*') ? 'active' : '' }}"
                   href="{{ route('states.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-flag fs-3"></i>
                    </span>
                    <span class="menu-title">{{__('messages.state.states')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ Request::is('sadmin/cities*') ? 'active' : '' }}"
                   href="{{ route('cities.index') }}">
                    <span class="menu-icon">
                        <i class="fas fa-city fs-3"></i>
                    </span>
                    <span class="menu-title">{{__('messages.city.cities')}}</span>
                </a>
            </div>
        </div>
    </div>
@endcan
{{--@can('manage_roles')--}}
{{--    <div class="menu-item">--}}
{{--        <a class="menu-link {{ Request::is('sadmin/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">--}}
{{--            <span class="menu-icon">--}}
{{--                <i class="fas fa-user fs-3"></i>--}}
{{--            </span>--}}
{{--            <span class="menu-title">{{__('messages.roles')}}</span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--@endcan--}}

@can('manage_settings')
    <div class="menu-item">
        <a class="menu-link {{ Request::is('sadmin/settings*') ? 'active' : '' }}"
           href="{{ route('setting.index') }} ">
            <span class="menu-icon">
               <i class="fas fa-cogs fs-3"></i>
            </span>
            <span class="menu-title">{{ __('messages.settings') }}</span>
        </a>
    </div>
@endcan
@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div data-kt-menu-trigger="click"
     class="menu-item menu-accordion {{ Request::is(['sadmin/email-subscription*','sadmin/features*', 'sadmin/front-cms*','sadmin/about-us*','sadmin/frontTestimonial*', 'sadmin/contactUs*']) ? 'show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fa fa-home fs-3"></i>
            </span>
            <span class="menu-title">{{__('messages.front_cms.front_cms')}}</span>
            <span class="menu-arrow"></span>
        </span>
    <div class="menu-sub menu-sub-accordion" kt-hidden-height="115">
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/email-subscription*') ? 'active' : '' }}"
               href="{{ route('email.sub.index') }}">
                    <span class="menu-icon">
                        <i class="fa fa-envelope fs-3"></i>
                    </span>
                <span class="menu-title">{{__('messages.subscriptions')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/features*') ? 'active' : '' }}"
               href="{{ route('features.index') }}">
            <span class="menu-icon">
                <i class="fa fa-plus fs-3"></i>
            </span>
                <span class="menu-title">{{__('messages.features')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/front-cms*') ? 'active' : '' }}"
               href="{{ route('setting.front.cms') }}">
                    <span class="menu-icon">
                        <i class="fa fa-home fs-3"></i>
                    </span>
                <span class="menu-title">{{__('messages.front_cms.front_cms')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/about-us*') ? 'active' : '' }}"
               href="{{ route('aboutUs.index') }}">
                    <span class="menu-icon">
                        <i class="fa fa-info-circle fs-3"></i>
                    </span>
                <span class="menu-title">{{__('messages.about_us.about_us')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/frontTestimonial*') ? 'active' : '' }}"
               href="{{ route('frontTestimonial.index') }}">
                    <span class="menu-icon">
                        <i class="fa fa-envelope fs-3"></i>
                    </span>
                <span class="menu-title">{{__('messages.testimonial')}}</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link {{ Request::is('sadmin/contactUs*') ? 'active' : '' }}"
               href="{{ route('contact.contactus') }}">
                    <span class="menu-icon">
                        <i class="fas fa-info-circle fs-3"></i>
                    </span>
                <span class="menu-title">{{__('messages.contact_us.contact_us')}}</span>
            </a>
        </div>
    </div>
</div>
@endrole




