@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/dashboard*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('sadmin.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/frontTestimonial*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/frontTestimonial*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('frontTestimonial.index') }}">
            <span class="menu-title">{{ __('messages.vcard.testimonials') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/contactUs*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/contactUs*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('contact.contactus') }}">
            <span class="menu-title">{{ __('messages.contact_us.contact_us') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/about-us*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/about-us*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('aboutUs.index') }}">
            <span class="menu-title">{{ __('messages.about_us.about_us') }}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_ADMIN)
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/dashboard*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('admin.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </div>
    </div>
@endrole

@can('manage_users')
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/users*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/users*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('users.index') }}">
                <span class="menu-title">{{ __('messages.users') }}</span>
            </a>
        </div>
    </div>
@endcan

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/vcards*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/vcards*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('sadmin.vcards.index') }}">
            <span class="menu-title">{{ __('messages.vcards') }}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/planSubscription*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/planSubscription*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('subscription.cash') }}">
            <span class="menu-title">{{__('messages.cash_payment')}}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/subscribedPlan*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/subscribedPlan*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('subscription.user.plan') }}">
            <span class="menu-title">{{__('messages.subscribed_user')}}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/email-subscription*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/email-subscription*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('email.sub.index') }}">
            <span class="menu-title">{{ __('messages.subscriptions') }}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_SUPER_ADMIN)
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/templates*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('sadmin/templates*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('sadmin.templates.index') }}">
            <span class="menu-title">{{ __('messages.vcard.template') }}</span>
        </a>
    </div>
</div>
@endrole

@role(App\Models\Role::ROLE_ADMIN)
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/manage-subscription*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/manage-subscription*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('subscription.index') }}">
            <span class="menu-title">{{ __('messages.subscription.manage_subscription') }}</span>
        </a>
    </div>
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/enquiries*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/enquiries*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('enquiries.index') }}">
            <span class="menu-title">{{ __('messages.enquiry') }}</span>
        </a>
    </div>
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/appointments*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/appointments*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('appointments.index') }}">
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/vcards*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/vcards*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('vcards.index') }}">
            <span class="menu-title">{{ __('messages.vcards') }}</span>
        </a>
    </div>
</div>
@endrole

@can('manage_plans')
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/plans*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/plans*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('plans.index') }}">
                <span class="menu-title">{{ __('messages.plans') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/currencies*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/currencies*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('currencies.index') }}">
                <span class="menu-title">{{ __('messages.currency.currencies') }}</span>
            </a>
        </div>
    </div>
@endcan

@can('manage_countries')
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/countries*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/countries*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('countries.index') }}">
                <span class="menu-title">{{ __('messages.country.countries') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/states*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/states*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('states.index') }}">
                <span class="menu-title">{{ __('messages.state.states') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/cities*')) ? 'd-none' : '' }}"
         id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/cities*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('cities.index') }}">
                <span class="menu-title">{{ __('messages.city.cities') }}</span>
            </a>
        </div>
    </div>
@endcan

{{--@can('manage_roles')--}}
{{--    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/roles*')) ? 'd-none' : '' }}"--}}
{{--         id="#kt_header_menu" data-kt-menu="true">--}}
{{--        <div class="menu-item me-lg-1 {{ Request::is('sadmin/roles*') ? 'show' : ''  }}">--}}
{{--            <a class="menu-link py-3 "--}}
{{--               href="{{ route('roles.index') }}">--}}
{{--                <span class="menu-title">{{ __('messages.roles') }}</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}

@can('manage_settings')
    <div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/settings*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/settings*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('setting.index') }}">
                <span class="menu-title">{{ __('messages.settings') }}</span>
            </a>
        </div>
    </div>
    <div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/features*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/features*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('features.index') }}">
                <span class="menu-title">{{ __('messages.features') }}</span>
            </a>
        </div>
    </div>
    <div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sadmin/front-cms*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('sadmin/front-cms*') ? 'show' : ''  }}">
            <a class="menu-link py-3 "
               href="{{ route('setting.front.cms') }}">
                <span class="menu-title">{{ __('messages.front_cms.front_cms') }}</span>
            </a>
        </div>
    </div>
@endcan

<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('profile*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('profile*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('profile.setting') }}">
            <span class="menu-title">{{ __('messages.user.profile_details') }}</span>
        </a>
    </div>
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('admin/choose-payment-type*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('admin/choose-payment-type*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('subscription.upgrade') }}">
            <span class="menu-title">{{ __('messages.plans')  }}</span>
        </a>
    </div>
</div>
