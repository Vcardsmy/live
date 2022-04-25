<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    @if($vcard->meta_description)
        <meta name="description" content="{{$vcard->meta_description}}">
    @endif
    @if($vcard->meta_keyword)
        <meta name="keywords" content="{{$vcard->meta_keyword}}">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    @endif

<!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vcard1.css')}}">
    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick-theme.css') }}">

    {{--google font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    @if($vcard->font_family)
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$vcard->font_family}}">
    @endif
    @if($vcard->font_family || $vcard->font_size || $vcard->custom_css)
        <style>
            @if($vcard->font_family)
        body {
                font-family: {{$vcard->font_family}};
            }

            @endif
         @if($vcard->font_size)
        div > h4 {
                font-size: {{$vcard->font_size}}px !important;
            }
            @endif
            {!! $vcard->custom_css !!}
        </style>
    @endif
</head>
<body>
<div class="container">
    @include('vcards.password')
    <div class="vcard-one main-content w-100 mx-auto content-blur">
{{--        banner--}}
        <div class="d-flex justify-content-end">
            <div class="language pt-4 me-2">
                <ul class="text-decoration-none">
                    <li class="dropdown1 dropdown lang-list">
                        <a href="#" class="dropdown-toggle lang-head" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-language me-2"></i>{{getSelectedLanguageName()}}</a>
                        <ul class="dropdown-menu start-0 lang-hover-list">
                            @foreach(\App\Models\User::LANGUAGES as $key => $language)
                                <li class="{{ getSelectedLanguageName() == $language ? 'active' : '' }}">
                                    <img src="{{asset(\App\Models\User::FLAG[$key])}}" width="25px" height="20px"
                                         class="me-3"><a href="javascript:void(0)" id="languageName"
                                                         data-name="{{ $key }}">{{ $language }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="vcard-one__banner w-100">
            <img src="{{ $vcard->cover_url }}"
                 class="img-fluid" alt="background image"/>
        </div>
        {{--profile--}}
        <div class="vcard-one__profile position-relative">
            <div class="avatar position-absolute top-0 start-50 translate-middle">
                <img src="{{ $vcard->profile_url }}"
                     alt="profile-img" class="rounded-circle"/>
            </div>
        </div>
        {{--profile details--}}
        <div class="vcard-one__profile-details py-3 d-flex flex-column align-items-center justify-content-center px-3">
            <h4 class="profile-name pt-2 mb-0">
                {{ ucwords($vcard->first_name.' '.$vcard->last_name) }}
            </h4>
            <span class="profile-designation pt-2 fw-light"> {{ ucwords($vcard->occupation) }}</span>
            @if(getSocialLink($vcard))
                <div class="social-icons d-flex flex-wrap justify-content-center pt-4 w-100">
                    @foreach(getSocialLink($vcard) as $value)
                        {!! $value !!}
                    @endforeach
                </div>
            @endif
        </div>
        {{--event--}}
        <div class="vcard-one__event py-3 px-3">
            <div class="container">
                <div class="row g-3">
                    @if($vcard->email)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                                 <span class="event-icon d-flex justify-content-center">
                                    <img src="{{asset('assets/img/vcard1/vcard1-email.png')}}" alt="email"/>
                                 </span>
                                <a href="mailto:{{ $vcard->email }}"
                                   class="event-name text-center pt-3 mb-0">{{ $vcard->email }}</a>
                            </div>
                        </div>
                    @endif
                    @if($vcard->dob)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                             <span class="event-icon d-flex justify-content-center">
                                <img src="{{asset('assets/img/vcard1/vcard1-birthday.png')}}" alt="email"/>
                             </span>
                                <h6 class="event-name text-center pt-3 mb-0">{{ \Carbon\Carbon::parse($vcard->dob)->format('dS F, Y') }}</h6>
                            </div>
                        </div>
                    @endif
                    @if($vcard->phone)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                             <span class="event-icon d-flex justify-content-center">
                                <img src="{{asset('assets/img/vcard1/vcard1-phone.png')}}" alt="email"/>
                             </span>
                                <a href="tel:{{ $vcard->phone }}"
                                   class="event-name text-center pt-3 mb-0">+{{ $vcard->region_code }} {{ $vcard->phone }}</a>
                            </div>
                        </div>
                    @endif
                    @if($vcard->location)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                             <span class="event-icon d-flex justify-content-center">
                                <img src="{{asset('assets/img/vcard1/vcard1-location.png')}}" alt="email"/>
                             </span>
                                <h6 class="event-name text-center pt-3 mb-0">{{ ucwords($vcard->location) }}</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{--our services--}}
        @if($vcard->services->count())
            <div class="vcard-one__service my-3 py-5">
                <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.vcard.our_service') }}</h4>
                <div class="container">
                    <div class="row g-3 justify-content-center">
                        @foreach($vcard->services as $service)
                            <div class="col-sm-6 col-12">
                                <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                    <img src="{{$service->service_icon}}"
                                         class="service-image d-flex justify-content-center align-items-center rounded-circle"
                                         alt="{{$service->name}}"/>
                                    <div class="service-details ms-3">
                                        <h4 class="service-title">{{ ucwords($service->name) }}</h4>
                                        <p class="service-paragraph mb-0">
                                            {!! $service->description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{--gallery--}}
        @if($vcard->gallery->count())
        <div class="vcard-one__gallery py-3">
            <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.plan.gallery') }}</h4>
            <div class="container">
                <div class="row g-4 gallery-slider overflow-hidden">
                    @foreach($vcard->gallery as $file)
                    <div class="col-6 mb-2">
                        <div class="card gallery-card p-2 border-0 w-100 h-100">
                            <div class="gallery-profile">
                                @if($file->type == App\Models\Gallery::TYPE_IMAGE)
                                <img src="{{$file->gallery_image}}" alt="profile" class="w-100"/>
                                    @else
                                    <a id="video_url" data-id="https://www.youtube.com/embed/{{YoutubeID($file->link)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                       class="gallery-link">
                                        <div class="gallery-item"
                                             style="background-image: url(&quot;https://vcard.waptechy.com/assets/img/video-thumbnail.png&quot;)">
                                        </div>
                                    </a>
                                    @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <iframe id="video" src="//www.youtube.com/embed/Q1NKMPhP8PY"
                                    class="w-100" height="315">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{--Product slider--}}
        @if($vcard->products->count())
            <div class="vcard-one__product py-3">
                <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.vcard.products') }}</h4>
                <div class="container">
                    <div class="row g-4 product-slider overflow-hidden">

                        @foreach($vcard->products as $product)
                            <div class="col-6 mb-2">
                                <div class="card product-card p-2 border-0 w-100 h-100">
                                    <div class="product-profile">
                                        <img src="{{ $product->product_icon }}" alt="profile" class="w-100"
                                             height="208px"/>
                                    </div>
                                    <div class="product-details mt-3">
                                        <h4>{{$product->name}}</h4>
                                        <p class="mb-2">
                                            {{$product->discription}}
                                        </p>
                                        @if($product->currency_id && $product->price)
                                            <span
                                                class="text-black">{{$product->currency->currency_icon}}{{$product->price}}</span>
                                        @elseif($product->price)
                                            <span class="text-black">{{$product->price}}</span>
                                        @else
                                            <span class="text-black">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--testimonial--}}
        @if($vcard->testimonials->count())
            <div class="vcard-one__testimonial py-3">
                <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.plan.testimonials') }}</h4>
                <div class="container">
                    <div class="row g-4 pt-5 testimonial-slider overflow-hidden">
                        @foreach($vcard->testimonials as $testimonial)
                            <div class="col-6">
                                <div class="card testimonial-card position-relative p-2 border-0 w-100">
                                    <div class="testimonial-profile position-absolute top-0 start-50 translate-middle">
                                        <img src="{{ $testimonial->image_url }}" alt="profile"
                                             class="rounded-circle"/>
                                    </div>
                                    <div class="testimonial-details mt-5">
                                        <h4 class="text-center">{{ ucwords($testimonial->name) }}</h4>
                                        <p class="text-center text-muted">{!! $testimonial->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--Qr code--}}
        <div class="vcard-one__qr-code my-3 py-5 px-3">
            <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.vcard.qr_code') }}</h4>
            <div class="qr-code p-3 card d-block mx-auto border-0">
                <div class="qr-code-profile d-flex justify-content-center">
                    <img src="{{$vcard->profile_url}}" alt="qr profile"
                         class="rounded-circle"/>
                </div>
                <div class="qr-code-image mt-4 d-flex justify-content-center">
                    {!! QrCode::size(130)->format('svg')->generate(Request::url()); !!}
                </div>
            </div>
            <a class="qr-code-btn text-white mt-4 d-block mx-auto text-decoration-none"
               href="data:image/svg;base64,{{ base64_encode(QrCode::size(150)->format('svg')->generate(Request::url())) }}"
               download="qr_code.svg">{{ __('messages.vcard.download_my_qr_code') }}</a>
        </div>
        {{--business hour--}}
        @if($vcard->businessHours->count())
            <div class="vcard-one__timing py-3 px-1">
                <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.business.business_hours') }}</h4>
                <div class="container pb-4">
                    <div class="row g-3">
                        @foreach($vcard->businessHours as $day)
                            <div class="col-sm-6 col-12">
                                <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">
                                    {{ strtoupper(__('messages.business.'.\App\Models\BusinessHour::DAY_OF_WEEK[$day->day_of_week])).':' }}
                                </span>
                                    <span>{{ $day->start_time.' - '.$day->end_time }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{--Appointment--}}
        @if($vcard->appointmentHours->count())
            <div class="vcard-one__appointment py-3">
                <h4 class="vcard-one-heading text-center pb-4">{{__('messages.make_appointments')}}</h4>
                <div class="container px-4">
                    <div class="appointment-one">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="appoint-date mb-2">{{__('messages.date')}}</label>
                            </div>
                            <div class="col-md-10">
                                {{ Form::text('date', null, ['class' => 'date appoint-input mb-2 form-control form-control-solid', 'placeholder' => __('messages.form.pick_date'),'id'=>'pickUpDate']) }}
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center mb-md-3">
                            <div class="col-md-2">
                                <label for="hour" class="appoint-date mb-2 text-left">{{__('messages.hour')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div id="slotData" class="row">
                                </div>
                            </div>
                        </div>
                        <button type="button"
                                class="appointmentAdd appoint-btn text-white mt-4 d-block mx-auto ">{{__('messages.make_appointments')}}
                        </button>
                        @include('vcardTemplates.appointment')
                    </div>
            </div>
        </div>
        @endif
        @php $currentSubs = $vcard->subscriptions()->where('status', \App\Models\Subscription::ACTIVE)->latest()->first() @endphp
        @if($currentSubs && $currentSubs->plan->planFeature->enquiry_form)
            <div class="vcard-one__contact py-5">
                <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.contact_us.contact_us') }}</h4>
                <form id="enquiryForm">
                    @csrf
                    <div class="contact-form px-3">
                        <div id="enquiryError" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('messages.common.name') }}<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="far fa-user"></i></span>
                                <input type="text" name="name" class="form-control border-start-0"
                                       placeholder="{{__('messages.form.your_name')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('messages.user.email') }}<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="far fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control border-start-0"
                                       placeholder="{{__('messages.form.your_email')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.user.phone') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="fas fa-phone"></i></span>
                                <input type="tel" name="phone" class="form-control border-start-0"
                                       placeholder="{{__('messages.form.phone')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('messages.contact_us.message') }}<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message"
                                      placeholder="{{__('messages.form.type_message')}}"
                                      id="message"
                                      rows="5"></textarea>
                        </div>
                        <button type="submit"
                                class="contact-btn text-white mt-4 d-block ms-auto">{{ __('messages.contact_us.send_message') }}</button>
                    </div>
                </form>
            </div>
            <div class="d-sm-flex justify-content-center mt-5 pb-5">
                <button class="vcard-one-btn text-white d-block mb-sm-0 mb-3"
                   onclick="downloadVcard('{{ $vcard->name }}.vcf',{{ $vcard->id }})">
                    <i class="fas fa-download me-2"></i>{{ __('messages.vcard.download_vcard') }}
                </button>
{{--                share btn--}}
                <button type="button" class="vcard1-share share-btn text-white d-block btn">
                    <a class="text-white text-decoration-none">
                        <i class="text-white fas fa-share-alt me-2"></i>{{ __('messages.vcard.share') }}</a>
                </button>
            </div>
        @endif
        @if($vcard->branding == 0)
            <div class="text-center">
                <small>{{ __('messages.made_by') }} {{ $setting['app_name'] }}</small>
            </div>
        @endif
    </div>

{{-- share modal code--}}
    <div id="vcard1-shareModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.vcard.share_my_vcard') }}</h5>
                    <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-danger"
                            data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                    </button>
                </div>
                    @php
                        $shareUrl = route('vcard.defaultIndex')."/".$vcard->url_alias;
                    @endphp
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <a href="http://www.facebook.com/sharer.php?u={{$shareUrl}}"
                               target="_blank" class="mx-2 share" title="Facebook">
                                <i class="fab fa-facebook fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="http://twitter.com/share?url={{$shareUrl}}&text={{$vcard->name}}&hashtags=sharebuttons"
                               target="_blank" class="mx-2 share" title="Twitter">
                                <i class="fab fa-twitter fa-3x" style="color: #1DA1F3"></i>
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                               target="_blank" class="mx-2 share" title="Linkedin">
                                <i class="fab fa-linkedin fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="mailto:?Subject=&Body={{$shareUrl}}" target="_blank"
                               class="mx-2 share" title="Email">
                                <i class="fas fa-envelope fa-3x" style="color: #191a19  "></i>
                            </a>
                            <a href="http://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                               target="_blank" class="mx-2 share" title="Pinterest">
                                <i class="fab fa-pinterest fa-3x" style="color: #bd081c"></i>
                            </a>
                            <a href="http://reddit.com/submit?url={{$shareUrl}}&title={{$vcard->name}}"
                               target="_blank" class="mx-2 share" title="Reddit">
                                <i class="fab fa-reddit fa-3x" style="color: #ff4500"></i>
                            </a>
                            <a href="https://wa.me/?text={{$shareUrl}}" target="_blank" class="mx-2 share" title="Whatsapp">
                                <i class="fab fa-whatsapp fa-3x" style="color: limegreen"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('vcardTemplates.template.templates')

</div>
<script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/slick.min.js') }}" type="text/javascript"></script>
@if($vcard->google_analytics)
    {!! $vcard->google_analytics !!}
@endif
@if($vcard->custom_js)
    {!! $vcard->custom_js !!}
@endif
<script>
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                },
            },
        ],
    })
</script>
<script>
    $('.product-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });
</script>
<script>
    $('.gallery-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });
</script>
<script>
    let isEdit = false
    let password = "{{!empty($vcard->password) }}"
    let passwordUrl = "{{ route('vcard.password', $vcard->id) }}"
    let enquiryUrl = "{{ route('enquiry.store', $vcard->id) }}";
    let appointmentUrl = "{{ route('appointment.store', $vcard->id) }}";
    let slotUrl = "{{route('appointment-session-time')}}";
    let appUrl = "{{ config('app.url') }}";
    let vcardId = {{$vcard->id}};
    let languageChange = "{{ url('language') }}";
    let lang = "{{checkLanguageSession()}}";
    {{--    let imageUrl = "{{base64_encode($vcard->profile_url)}}"--}}

</script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
</body>
</html>
