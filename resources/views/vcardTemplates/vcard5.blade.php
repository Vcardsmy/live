<!doctype html>
<html lang="en">
<head>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{--css link--}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard5.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>

    {{--font-awesome Cdn--}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    {{--slick slider--}}
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick-theme.css') }}">

    {{--google font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&family=PT+Sans:wght@700&family=Poppins:wght@600&family=Roboto&display=swap" rel="stylesheet">
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
<div class="container main-section">
    @include('vcards.password')
    <div class="row d-flex justify-content-center content-blur">
        <div class="main-bg p-0">
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
            <div class="head-img">
                <img src="{{ $vcard->cover_url }}" height="400px" class="img-fluid"/>
            </div>
            <div class="profile-img">
                <img src="{{ $vcard->profile_url }}" width="150px"
                     class="pro-img me-sm-4 rounded-circle mb-4"/>
                <div>
                    <h4 class="big-title">{{ ucwords($vcard->first_name.' '.$vcard->last_name) }}</h4>
                    <p class="small-title">{{ ucwords($vcard->occupation) }}</p>
                </div>
            </div>
            {{--social-icon--}}
            <div class="container">
                @if(getSocialLink($vcard))
                    <div class="social-section pb-4 px-sm-5">
                        <div class="social-icon">
                            @foreach(getSocialLink($vcard) as $value)
                                {!! $value !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{--about-section--}}
            <div class="container">
                <div class="about-section mb-4">
                    <div class="row">
                        @if($vcard->email)
                            <div class="col-sm-6 pb-4">
                                <div class="about-details">
                                    <img src="{{asset('assets/img/aboutemail.png')}}" class="mb-2"/>
                                    <p><a href="mailto:{{ $vcard->email }}"
                                          class="about-title mb-0">{{ $vcard->email }}</a></p>
                                </div>
                            </div>
                        @endif
                        @if($vcard->dob)
                            <div class="col-sm-6 pb-4">
                                <div class="about-details">
                                    <img src="{{asset('assets/img/aboutcake.png')}}" class="mb-2"/>
                                    <p class="about-title mb-0">{{ \Carbon\Carbon::parse($vcard->dob)->format('dS F, Y') }}</p>
                                </div>
                            </div>
                        @endif
                        @if($vcard->phone)
                            <div class="col-sm-6 pb-4">
                                <div class="about-details">
                                    <img src="{{asset('assets/img/aboutcall.png')}}" class="mb-2"/>
                                    <p><a href="tel:{{ $vcard->phone }}"
                                          class="about-title mb-0">+{{ $vcard->region_code }} {{ $vcard->phone }}</a>
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if($vcard->location)
                            <div class="col-sm-6 pb-4">
                                <div class="about-details">
                                    <img src="{{asset('assets/img/aboutlocation.png')}}" class="mb-2"/>
                                    <p class="about-title mb-0">{{ $vcard->location }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{--Our service--}}
            @if($vcard->services->count())
                <div class="container">
                    <div class="main-our-service mb-4">
                        <div class="service-header-title">
                            <h4 class="mb-4">{{ __('messages.vcard.our_service') }}</h4>
                        </div>
                        <div class="row">
                            @foreach($vcard->services as $service)
                                <div class="col-12 mb-4">
                                    <div class="service-info d-flex align-items-center">
                                        <div class="service-img me-3 rounded-circle">
                                            <img src="{{ $service->service_icon }}" class="rounded-circle"/>
                                        </div>
                                        <div>
                                            <span class="service-heading">{{ ucwords($service->name) }}</span>
                                            <p class="mb-0 service-title">{!! $service->description !!}  </p>
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
            <div class="container">
                <div class="main-gallery pb-4">
                    <div class="gallery-header-title">
                        <h2 class="mb-4">{{ __('messages.plan.gallery') }}</h2>
                    </div>
                    <div class="row gallery-vcard d-flex justify-content-center g-3">
                        @foreach($vcard->gallery as $file)
                        <div class="col-6">
                            <div class="card gallery-shadow w-100">
                                <div class="gallery-profile">

                                        @if($file->link == null)
                                            <img src="{{$file->gallery_image}}" alt="profile" class="w-100"/>
                                        @else
                                            <div>
                                                <a id="video_url" data-id="https://www.youtube.com/embed/{{YoutubeID($file->link)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                   class="gallery-link">
                                                    <div class="gallery-item"
                                                         style="background-image: url(&quot;https://vcard.waptechy.com/assets/img/video-thumbnail.png&quot;)">
                                                    </div>
                                                </a>
                                            </div>
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

            {{--Product--}}
            @if($vcard->products->count())
                <div class="container">
                    <div class="main-product pb-4">
                        <div class="product-header-title">
                            <h4 class="mb-4">{{ __('messages.plan.products') }}</h4>
                        </div>
                        <div class="row product-vcard d-flex justify-content-center g-3">
                            @foreach($vcard->products as $product)
                                <div class="col-6">
                                    <div class="card product-shadow w-100">
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
                <div class="container">
                    <div class="main-testimonial pb-4">
                        <div class="testimonial-header-title">
                            <h4 class="mb-4">{{ __('messages.plan.testimonials') }}</h4>
                        </div>
                        <div class="row testimonial-vcard d-flex justify-content-center g-3">
                            @foreach($vcard->testimonials as $testimonial)
                                <div class="col-12">
                                    <div class="card text-center testi-shadow w-100">
                                        <div>
                                            <p class="mb-3 testi-description">“{!! $testimonial->description !!}”</p>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row d-flex justify-content-between align-items-end">
                                                <div class="col-lg-6">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $testimonial->image_url }}"
                                                             class="me-3 testi-logo rounded-circle"/>
                                                        <div>
                                                            <h6 class="testi-card-title mb-0">{{ ucwords($testimonial->name) }}</h6>
                                                            <p class="mb-0 testi-card-text"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{--Qr code--}}
            <div class="main-Qr-section mb-5">
                <div class="qr-header-title">
                    <h4 class="mb-5 text-center">{{ __('messages.vcard.qr_code') }}</h4>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-center mb-4">
                            {!! QrCode::size(130)->format('svg')->generate(Request::url()); !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center">
                            <img src="{{$vcard->profile_url}}" width="125px"
                                 class="qr-logo rounded-circle"/>
                            <div class="mt-4">
                                <a class="btn btn-lg Qr-btn"
                                   href="data:image/svg;base64,{{ base64_encode(QrCode::size(150)->format('svg')->generate(Request::url())) }}"
                                   download="qr_code.svg">{{ __('messages.vcard.download_my_qr_code') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--business-hour--}}
            @if($vcard->businessHours->count())
                <div class="container">
                    <div class="main-business mb-4">
                        <div class="business-heading">
                            <h4 class="mb-4">{{ __('messages.business.business_hours') }}</h4>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                            @foreach($vcard->businessHours as $day)
                                <div class="col-lg-6 mb-3">
                                    <div class="card business-days flex-row justify-content-center">
                                <span class="me-2 business-title">
                                    {{ strtoupper(__('messages.business.'.\App\Models\BusinessHour::DAY_OF_WEEK[$day->day_of_week])).':' }}
                                </span>
                                        <span class="business-title">{{ $day->start_time.' - '.$day->end_time }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif


            {{--Appointment--}}
            @if($vcard->appointmentHours->count())
                <div class="container py-3 mb-4">
                    <h2 class="appointment-heading mb-4 position-relative">{{__('messages.make_appointments')}}</h2>
                    <div class="appointment">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="appoint-date mb-2">{{__('messages.date')}}</label>
                            </div>
                            <div class="col-md-10">
                                {{ Form::text('date', null, ['class' => 'date appoint-input', 'placeholder' => 'Pick a Date','id'=>'pickUpDate']) }}
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center mb-md-3">
                            <div class="col-md-2">
                                <label for="text" class="appoint-date mb-2">{{__('messages.hour')}}</label>
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
            @endif

            {{--contact us--}}
            @php $currentSubs = $vcard->subscriptions()->where('status', \App\Models\Subscription::ACTIVE)->latest()->first() @endphp
            @if($currentSubs && $currentSubs->plan->planFeature->enquiry_form)
                <div class="container py-4">
                    <h4 class="contact-heading mb-4 text-center">{{ __('messages.contact_us.contact_us') }}</h4>
                    <div class="main-contact">
                        <form id="enquiryForm">
                            @csrf
                            <div class="row">
                                <div id="enquiryError" class="alert alert-danger d-none"></div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <label for="basic-url"
                                               class="form-label mb-0">{{ __('messages.user.your_name') }}</label>
                                        <div class="col-12 mb-3 input-group">
                                    <span class="input-group-text bg-white contact-input border-end-0"
                                          id="basic-addon1"><i
                                                class="far fa-user"></i></span>
                                            <input type="text" name="name"
                                                   class="form-control contact-input border-start-0"
                                                   id="name" placeholder="{{__('messages.form.your_name')}}">
                                        </div>

                                        <label for="basic-url"
                                               class="form-label mb-0">{{ __('messages.user.email') }}</label>
                                        <div class="col-12 mb-3 input-group">
                                    <span class="input-group-text bg-white contact-input border-end-0"
                                          id="basic-addon1"><i
                                                class="far fa-envelope"></i></span>
                                            <input type="email" name="email"
                                                   class="form-control contact-input border-start-0"
                                                   id="email" placeholder="{{__('messages.form.your_email')}}">
                                        </div>

                                        <label for="inputAddress"
                                               class="form-label mb-0">{{ __('messages.user.phone') }}</label>
                                        <div class="col-12 mb-3 input-group">
                                    <span class="input-group-text bg-white contact-input border-end-0"
                                          id="basic-addon1"><i
                                                class="fas fa-phone"></i></span>
                                            <input type="tel" name="phone"
                                                   class="form-control contact-input border-start-0"
                                                   id="phone" placeholder="{{__('messages.form.phone')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                   class="form-label">{{ __('messages.user.your_message') }}</label>
                                            <textarea class="form-control contact-input" name="message" id="message"
                                                      rows="7"
                                                      placeholder="{{__('messages.form.type_message')}}"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit"
                                            class="btn contact-btn px-4">{{ __('messages.contact_us.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-sm-flex justify-content-center mt-5">
                        <button type="submit" class="vcard-five-btn mt-4 btn d-block btn text-white"
                                onclick="downloadVcard('{{ $vcard->name }}.vcf',{{ $vcard->id }})"><i
                                    class="fas fa-download me-2"></i>{{ __('messages.vcard.download_vcard') }}
                        </button>
                        {{--share btn--}}
                        <button type="button" class="vcard5-share share-btn text-white d-block btn mt-4 ms-sm-3">
                            <a class="text-white text-decoration-none">
                                <i class="fas fa-share-alt me-2"></i>{{ __('messages.vcard.share') }}</a>
                        </button>
                    </div>
                </div>
            @endif
            @if($vcard->branding == 0)
                <div class="text-center">
                    <small>Made By {{ $setting['app_name'] }}</small>
                </div>
            @endif
        </div>
    </div>
    {{-- share modal code--}}
    <div id="vcard5-shareModel" class="modal fade" role="dialog">
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
                               target="_blank" class="mx-2 share5" title="Facebook">
                                <i class="fab fa-facebook fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="http://twitter.com/share?url={{$shareUrl}}&text={{$vcard->name}}&hashtags=sharebuttons"
                               target="_blank" class="mx-2 share5" title="Twitter">
                                <i class="fab fa-twitter fa-3x" style="color: #1DA1F3"></i>
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                               target="_blank" class="mx-2 share5" title="Linkedin">
                                <i class="fab fa-linkedin fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="mailto:?Subject=&Body={{$shareUrl}}" target="_blank"
                               class="mx-2 share5" title="Email">
                                <i class="fas fa-envelope fa-3x" style="color: #191a19  "></i>
                            </a>
                            <a href="http://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                               target="_blank" class="mx-2 share5" title="Pinterest">
                                <i class="fab fa-pinterest fa-3x" style="color: #bd081c"></i>
                            </a>
                            <a href="http://reddit.com/submit?url={{$shareUrl}}&title={{$vcard->name}}"
                               target="_blank" class="mx-2 share5" title="Reddit">
                                <i class="fab fa-reddit fa-3x" style="color: #ff4500"></i>
                            </a>
                            <a href="https://wa.me/?text={{$shareUrl}}" target="_blank" class="mx-2 share5" title="Whatsapp">
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

</div>
@include('vcardTemplates.template.templates')

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
    $('.testimonial-vcard').slick({
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
    });
</script>
<script>
    $('.product-vcard').slick({
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
    $('.gallery-vcard').slick({
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
    let isEdit = false;
    let password = "{{!empty($vcard->password) }}";
    let passwordUrl = "{{ route('vcard.password', $vcard->id) }}";
    let enquiryUrl = "{{ route('enquiry.store', $vcard->id) }}";
    let appointmentUrl = "{{ route('appointment.store', $vcard->id) }}";
    let slotUrl = "{{route('appointment-session-time')}}";
    let appUrl = "{{ config('app.url') }}";
    let vcardId = {{$vcard->id}};
    let languageChange = "{{ url('language') }}";
    let lang = "{{checkLanguageSession()}}";
</script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>

</body>
</html>
