<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold">
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 ms-4 {{(isset($partName) && $partName == 'basic') ? 'active' : ''}}"
           href="{{route('vcards.edit',$vcard->id).'?part=basic'}}">
            {{ __('messages.vcard.basic_details') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'template') ? 'active' : ''}}"
           href="{{route('vcards.edit',$vcard->id).'?part=template'}}">
            {{ __('messages.vcard.template') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'business_hours') ? 'active' : ''}}"
           href="{{route('vcards.edit',$vcard->id).'?part=business_hours'}}">
            {{ __('messages.business.business_hours') }}
        </a>
    </li>
    @if(checkFeature('services'))
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'services') ? 'active' : ''}}"
           href="{{route('vcards.edit',$vcard->id).'?part=services'}}">
            {{ __('messages.vcard.services') }}
        </a>
    </li>
    @endif
    @if(checkFeature('products'))
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'products') ? 'active' : ''}}"
               href="{{route('vcards.edit',$vcard->id).'?part=products'}}">
                {{ __('messages.vcard.products') }}
            </a>
        </li>
    @endif
    @if(checkFeature('testimonials'))
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'testimonials') ? 'active' : ''}}"
           href="{{route('vcards.edit',$vcard->id).'?part=testimonials'}}">
            {{ __('messages.vcard.testimonials') }}
        </a>
    </li>
    @endif
    @if(checkFeature('appointments'))
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'appointments') ? 'active' : ''}}"
               href="{{route('vcards.edit',$vcard->id).'?part=appointments'}}">
                {{ __('messages.vcard.appointments') }}
            </a>
        </li>
    @endif
    @if(checkFeature('social_links'))
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 {{(isset($partName) && $partName == 'social_links') ? 'active' : ''}}"
               href="{{route('vcards.edit',$vcard->id).'?part=social_links'}}">
                {{ __('messages.social.social_links') }}
            </a>
        </li>
    @endif
    @if(planfeaturecount() >= 7)
        <li class="nav-item pt-2">
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <div class="cursor-pointer"
                     data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                     data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <i class="fas fa-ellipsis-v" style="font-size: 16px"></i>
                </div>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                     data-kt-menu="true">
                    <div class="menu-item px-3">
                        <div class="menu-item">
                            @if(checkFeature('advanced'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'advanced') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=advanced'}}" style="font-size: 15px">
                                    {{ __('messages.vcard.advanced') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('custom_fonts'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'custom_fonts') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=custom_fonts'}}" style="font-size: 15px">
                                    {{ __('messages.font.fonts') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('gallery'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'gallery') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=gallery'}}" style="font-size: 15px">
                                    {{ __('messages.gallery.gallery_name') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('seo'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'seo') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=seo'}}" style="font-size: 15px">
                                    {{ __('messages.plan.seo') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @elseif(planfeaturecount() >=6)
        <li class="nav-item pt-2">
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <div class="cursor-pointer"
                     data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                     data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <i class="fas fa-ellipsis-v" style="font-size: 16px"></i>
                </div>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                     data-kt-menu="true">
                    <div class="menu-item px-3">
                        <div class="menu-item">
                            @if(checkFeature('advanced'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'advanced') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=advanced'}}" style="font-size: 15px">
                                    {{ __('messages.vcard.advanced') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('custom_fonts'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'custom_fonts') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=custom_fonts'}}" style="font-size: 15px">
                                    {{ __('messages.font.fonts') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('gallery'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'gallery') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=gallery'}}" style="font-size: 15px">
                                    {{ __('messages.gallery.gallery_name') }}
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if(checkFeature('seo'))
                                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'seo') ? 'active' : ''}}"
                                   href="{{route('vcards.edit',$vcard->id).'?part=seo'}}" style="font-size: 15px">
                                    {{ __('messages.plan.seo') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @else
        @if(checkFeature('advanced'))
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'advanced') ? 'active' : ''}}"
                   href="{{route('vcards.edit',$vcard->id).'?part=advanced'}}" style="font-size: 15px">
                    {{ __('messages.vcard.advanced') }}
                </a>
            </li>
        @endif
        @if(checkFeature('custom_fonts'))
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'custom_fonts') ? 'active' : ''}}"
                   href="{{route('vcards.edit',$vcard->id).'?part=custom_fonts'}}" style="font-size: 15px">
                    {{ __('messages.font.fonts') }}
                </a>
            </li>
        @endif
        @if(checkFeature('gallery'))
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'gallery') ? 'active' : ''}}"
                   href="{{route('vcards.edit',$vcard->id).'?part=gallery'}}" style="font-size: 15px">
                    {{ __('messages.gallery.gallery_name') }}
                </a>
            </li>
        @endif
            @if(checkFeature('seo'))
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 border-0 {{(isset($partName) && $partName == 'seo') ? 'active' : ''}}"
                       href="{{route('vcards.edit',$vcard->id).'?part=seo'}}" style="font-size: 15px">
                        {{ __('messages.plan.seo') }}
                    </a>
                </li>
            @endif
    @endif
</ul>
