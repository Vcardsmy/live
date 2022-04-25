@extends('front.layouts.app')
@section('title')
    {{ getAppName() }}
@endsection

@section('content')
    <!-- End Navbar -->

    <!-- Start Home -->
    <section class="section home home-page" id="home">
        <div class="container">
            <div class="row align-items-center mt-5 mt-lg-0">
                <div class="col-lg-5">
                    <div class="home-heading">
                        <h1 class="lh-sm">{{ $setting['home_page_title'] }} </h1>
                    </div>
                    <div class="home-btn d-grid d-sm-block gap-3">
                        @if(empty(getLogInUser()))
                            <a class="btn btn-outline-primary rounded-pill me-sm-3" href="{{ route('register') }}">
                                {{ __('auth.get_started') }}
                                <span class="avatar-xs">
                                    <span class="avatar-title rounded-circle btn-icon">
                                        <i class="mdi mdi-chevron-double-right"></i>
                                    </span>
                                </span>
                            </a>
                    @endif
                    <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg watchvideomodal" data-keyboard="false"
                             tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                <div class="modal-content home-modal">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <video id="VisaChipCardVideo" class="video-box" controls>
                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4"
                                                type="video/mp4">
                                        <!--Browser does not support <video> tag -->
                                    </video>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->
                    </div>
                </div><!-- end col-->
                <div class="col-lg-7">
                    <div class="ms-md-4">
                        <img class="home-img home-banner-img "
                             src=" {{ isset($setting['home_page_banner']) ? $setting['home_page_banner'] : asset('front/images/home.png') }} "
                             alt="">
                    </div>
                </div><!-- end col-->

            </div><!-- end row-->
        </div><!--end container-->
        <div class="container-fluid">
            <div class="row">
                <div class="home-shape-arrow">
                    <a href="#features" class="mouse-down"><i
                            class="mdi mdi-arrow-down arrow-icon text-dark h5"></i></a>
                </div>
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- End Home -->

    <!-- Start features -->
    <section class="section features features-bg" id="features">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-5">
                        <h3 class="heading">{{__('messages.plan.features')}}</h3>
                        {{--                        <p class="text-muted fs-17">Ut enim ad minima veniam quis nostrum exercitationem ullam corporis--}}
                        {{--                            suscipit laboriosam nisi commodi consequatur.</p>--}}
                    </div>
                </div><!-- end col-->
            </div><!-- end row-->
            <div class="row">
                @foreach($features as $feature)
                    <div class="col-lg-4 col-md-6">
                        <div class="card features-card">
                            <div class="card-body">
                                <div class="avatar-md mb-4">
                                    <div class="bg-light rounded-circle">
                                        {{--                                        <i class="mdi mdi-trophy-variant-outline"></i>--}}
                                        <img src="{{ $feature->profile_image }}" alt="" class="feature-image">
                                    </div>
                                </div>
                                <h5>{{ $feature->name }}</h5>
                                <p class="text-muted">{!! $feature->description !!}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                @endforeach
            </div>
        </div><!-- end container -->
    </section>
    <!-- end Features -->

    <!-- start about -->
    <section class="section" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-lg-5">
                        <h3 class="heading">{{__('auth.modern_&_powerful_interface')}}</h3>
                        {{--                        <p class="text-muted fs-17 mb-0">In an ideal world this website wouldn’t exist, a client would--}}
                        {{--                            acknowledge the importance design starts.</p>--}}
                    </div>
                </div><!--  end col  -->
            </div><!--  end row  -->
            <div class="row align-items-center justify-content-between mt-lg-0 mt-3">
                <div class="col-lg-6">
                    <div class="card border-0">
                        <img src=" {{ isset($aboutUS[0]['about_url']) ? $aboutUS[0]['about_url'] : asset('front/images/about.png') }}  "
                             alt="">
                    </div>
                </div><!--  end col  -->
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="about-title">
                                <span></span>
                            </div>
                            <h4>{{$aboutUS[0]['title']}}</h4>
                            <p class="text-muted lh-base">{!! $aboutUS[0]['description'] !!}</p>
                        </div>
                    </div>
                </div><!--  end col  -->
            </div><!--  end row  -->
            <div class="row my-4 align-items-center justify-content-between">
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="me-lg-5">
                                <div class="about-title">
                                    <span></span>
                                </div>
                                <h4>{{ $aboutUS[1]['title'] }}</h4>
                                <p class="text-muted">{!! $aboutUS[1]['description'] !!}</p>
                            </div>
                        </div><!-- End card-body -->
                    </div><!-- End card -->
                </div><!--  end col  -->
                <div class="col-lg-6">
                    <img src=" {{ isset($aboutUS[1]['about_url']) ? $aboutUS[1]['about_url'] : asset('front/images/about-2.png') }} "
                         class="img-fluid" alt="">
                </div><!--  end col  -->
            </div><!--  end row  -->
            <div class="row align-items-center justify-content-between pt-lg-5">
                <div class="col-lg-6">
                    <div class="buy-about-img p-0">
                        <img src=" {{ isset($aboutUS[2]['about_url']) ? $aboutUS[2]['about_url'] : asset('front/images/about-3.png') }} "
                             class="img-fluid" alt="">
                    </div>
                </div><!-- End col -->
                <div class="col-lg-5">
                    <div class="ms-lg-5">
                        <div class="about-title">
                            <span></span>
                        </div>
                        <h4>{{ $aboutUS[2]['title'] }}</h4>
                        <p class="text-muted">{!! $aboutUS[2]['description'] !!}</p>
                    </div>
                </div><!-- End col -->
            </div><!-- End row -->
        </div><!--  end container  -->
    </section>
    <!--  end about  -->

    <!-- START pricing -->

    {{--    <section class="section pricing" id="pricing">--}}
    {{--        <div class="bg-shape"></div>--}}
    <section class="section pricing" id="pricing">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="heading">{{__("auth.choose_a_plan_that's_right_for_you")}}</h3>
                        {{--                        <p class="text-muted"> 30 - day money back guarantee</p>--}}
                    </div>
                </div><!-- End col -->
                <div class="plan-slider">
                    @foreach($plans as $plan)
                        <div class="col-lg-4 col-md-6">
                            <span class="pricing-bg"></span>
                            <div class="card pricing-box border-light h-100 py-4 mx-2">
                                <div class="pb-2 text-center border-bottom">
                                    <h6 class="text-info">{{ $plan->name }}</h6>
                                    <h1 class="mb-0 pt-2 fw-bold">{{ $plan->currency->currency_icon }}{{ $plan->price }}
                                    </h1>
                                </div>
                                <div class="p-3 pb-0 pt-1">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-2">
                                                    @if($plan->frequency === 1)
                                                        <sub
                                                            class="fs-14 fw-normal text-muted">{{__('messages.plan.duration_months')}}</sub>

                                                    @elseif($plan->frequency === 2)
                                                        <sub
                                                            class="fs-14 fw-normal text-muted">{{__('messages.plan.duration_years')}}</sub>
                                                @elseif($plan->frequency === 2)
                                                    <sub
                                                        class="fs-14 fw-normal text-muted">{{__('messages.plan.duration_years')}}</sub>

                                                    @else
                                                        <sub
                                                            class="fs-14 fw-normal text-muted">{{__('messages.plan.duration_months')}}</sub>
                                                    @endif
                                                    <br>
                                                    <sub class="fs-14 fw-normal text-muted"> {{__('messages.plan.no_of_vcards')}}
                                                        : {{$plan->no_of_vcards }}</sub>
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="p-4 pb-0 pt-0">
                                    <ul class="list-unstyled">
                                        <li>
                                            @foreach(getPlanFeature($plan) as $feature => $value)
                                                <div class="d-flex justify-content-between mb-1">
                                                    <p class="fs-14 fw-normal text-muted">{{ __('messages.plan.feature.'.$feature) }}</p>
                                                    @if($value)
                                                        <span class="svg-icon svg-icon-1 svg-icon-success icon-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20"
                                                                              height="20"
                                                                              rx="10" fill="black"></rect>
                                                                        <path
                                                                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                            fill="black"></path>
                                                                    </svg>
                                                    </span>
                                                    @else
                                                        <span class="svg-icon svg-icon-1 icon-danger">
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
                                    </li>
                                </ul>
                            </div>
                            @if(getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                <div class="mx-auto">
                                    @if(!empty(getCurrentSubscription()) && $plan->id == getCurrentSubscription()->plan_id && !getCurrentSubscription()->isExpired())
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
                                                <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
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
                                                <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
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
                            @endif
                        </div><!-- End card -->
                    </div>
            @endforeach
            <!-- end col -->
            </div><!-- End row -->
        </div>
        </div><!-- End container -->
    </section>
    <!-- END pricing -->

    <!-- testimonial -->
    @if(!$testimonials->isEmpty())
    <section class="section testimonial" id="testimonial">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center mb-5">
                        <h3 class="heading">{{__('auth.stories_from_our_customers')}}</h3>
                        {{--                        <p class="text-muted fs-17">Though lorem ipsum is sometimes referred to as greek copy or--}}
                        {{--                            greeking, lorem ipsum text is a garbled form of Latin text.</p>--}}
                    </div>
                </div><!-- End col -->
            </div><!-- End row -->
            <div class="row justify-content-between">
                                <div class="col-lg-3">
                                    <h4>{{__("auth.let's_hear_what_they_say")}}</h4>
                                    <button class="carousel-control-prev d-none d-lg-block custom-btn" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <i class="mdi mdi-arrow-left"></i>
                                    </button>
                                    <button class="carousel-control-next d-none d-lg-block custom-btn" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <i class="mdi mdi-arrow-right"></i>
                                    </button>
                                </div>
                <div class="col-lg-8">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators mb-0">
                            @foreach($testimonials as $key => $testimonial)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}"
                                    aria-label="Slide {{$key + 1}}" class="{{$key == 0 ? 'active' : ''}}" aria-current="true"></button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach($testimonials as $testimonial)
                                <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                                    <div class="card testimonial-box h-100">
                                        <div class="card-body">
                                            <img class="mb-4" src=" {{ asset('front/images/quote.png') }}" alt="">
                                            <p class="text-muted">{!! $testimonial->description !!}</p>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img class="avatar-sm rounded-circle img-fluid"
                                                         src="{{ $testimonial->testimonial_url }}" alt="">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">{{ $testimonial->name }}</h6>
                                                    <p class="text-muted mb-0 fs-14">Product Developer</p>
                                                </div>
                                            </div>
                                        </div><!-- End card-body -->
                                    </div><!-- End card -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- End container -->
    </section>

    <!-- testimonial -->
    @endif
    <!-- Start contact -->
    <section class="section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center mb-5">
                        <h3 class="heading">{{__('messages.contact_us.contact')}}</h3>
                        {{--                        <p class="text-muted mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed--}}
                        {{--                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
                    </div>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-lg-6">
                    <form class="contact-form" id="myForm">
                        @csrf
                        <div id="contactError" class="alert alert-danger d-none"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                    <input name="name" id="name" type="text" class="form-control front-input"
                                           placeholder="{{ __('messages.front.enter_your_name') }}*">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <input name="email" id="email" type="email" class="form-control front-input"
                                           placeholder="{{ __('messages.front.enter_your_email') }}*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text"><i class="mdi mdi-file-document-outline"></i></span>
                                    <input name="subject" id="subject" type="text" class="form-control front-input"
                                           placeholder="{{ __('messages.common.subject') }}*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative mb-3">
                                    <span class="input-group-text align-items-start"><i
                                            class="mdi mdi-comment-text-outline"></i></span>
                                    <textarea name="message" id="message" rows="4" class="form-control"
                                              placeholder="{{ __('messages.front.enter_your_message') }}*"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                       value="{{ __('messages.contact_us.send_message') }}">
                            </div>
                        </div>
                    </form>
                    <!--end form-->
                </div>
                <!--end col-->
                <div class="col-lg-4 mt-lg-0 mt-5">
                    <div class="contact-details mb-4 mb-lg-0">
                        <p class="mb-3"><i class="mdi mdi-email-outline align-middle text-muted fs-20 me-2"></i> <a
                                href="mailto:{{ $setting['email'] }}" class="text-muted"
                                class="event-name text-center pt-3 mb-0">{{ $setting['email'] }}</a></p>
                        <p class="mb-3"><i class="mdi mdi-phone align-middle text-muted fs-20 me-2"></i><a
                                href="tel:{{ $setting['phone'] }}"
                                class="event-name text-muted text-center pt-3 mb-0">{{"+".$setting['prefix_code']." ".$setting['phone'] }}</a>
                        </p>
                        <p class="mb-3"><i class="mdi mdi-map-marker-outline text-muted fs-20 me-2"></i> <span
                                class="text-muted">{{ $setting['address'] }}</span></p>
                    </div>
                    <!--end contact-details-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- End contect -->


@endsection
@section('page_js')
    <script src="{{ mix('assets/js/home/contact.js') }}"></script>
    <script>
        function normalizeSlideHeights() {
            $('.carousel').each(function () {
                var items = $('.carousel-item', this);
                // reset the height
                items.css('height', 'auto');
                // set the height
                var maxHeight = Math.max.apply(null,
                    items.map(function () {
                        return $(this).outerHeight();
                    }).get());
                items.css('height', maxHeight + 'px');
            });
        }

        $(window).on(
            'load resize orientationchange',
            normalizeSlideHeights,
        );


        $('.plan-slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 992,
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
@endsection
