<!-- START FOOTER -->
<footer class="section bg-footer">
    <div class="container">
        <div class="row g-sm-4 justify-content-center">
            {{--            <div class="col-lg-12">--}}
            {{--                <div class="mb-3 mb-sm-0">--}}
            {{--                    <img src=" {{ asset('front/images/logo-dark.png') }} " class="logo-dark" alt="" height="22">--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            <div class="col-lg-9 col-md-4 col-6">--}}
            {{--                <h6 class="text-uppercase fw-semibold">About</h6>--}}
            {{--                <p class="mt-md-3 pt-3 pt-md-2 fs-14">Semper nibh a dignissim Integer cursus tempsed. Lorem ipsum dolor--}}
            {{--                    sit amet, consectetur adipisicing elit. Ea eos error explicabo facere harum, impedit itaque numquam--}}
            {{--                    quae quisquam, rem veniam voluptas, voluptatem voluptatibus. Explicabo nam neque nihil quis--}}
            {{--                    reprehenderit?</p>--}}
            {{--            </div><!-- End col -->--}}

            {{--            <div class="col-lg-3 col-md-4 col-6">--}}
            {{--                <h6 class="text-uppercase fw-semibold">Gatting Started</h6>--}}
            {{--                <ul class="list-unstyled footer-link mt-3 mb-0 fs-14">--}}
            {{--                    <li><a href="javascript:void(0)">introduction</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Usage</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Globls</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Elements</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Collection</a></li>--}}
            {{--                </ul>--}}
            {{--            </div><!-- End col -->--}}

            {{--            <div class="col-lg-3 col-md-4 col-6 d-none d-sm-block">--}}
            {{--                <h6 class="text-uppercase fw-semibold">Resources</h6>--}}
            {{--                <ul class="list-unstyled footer-link mt-3 mb-0 fs-14">--}}
            {{--                    <li><a href="javascript:void(0)">Monitoring Grader </a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Video Tutorial</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Term &amp; Service</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Tulsy API</a></li>--}}
            {{--                    <li><a href="javascript:void(0)">Marketplace</a></li>--}}
            {{--                </ul>--}}
            {{--            </div><!-- End col -->--}}
            <div class="col-lg-3 col-10 mx-auto">
                <h6 class="text-uppercase fw-semibold">{{__('auth.subscribe_here')}}</h6>
                <div class="footer-subcribe text-center shadow-sm d-inline-block">
                    <form action="{{route('email.sub')}}" method="post" id="addEmail">
                        @csrf()
                        <input placeholder="{{ __('messages.front.your_email_address') }}" type="email" name="email" class="emailStyle">
                        <button type="submit" class="btn btn-primary front-input"><i class="mdi mdi-bell-ring"></i></button>
                    </form>
                </div>
                {{--                <div class="mt-md-4 mt-3">--}}
                {{--                    <ul class="list-inline footer-social mb-0">--}}
                {{--                        <li class="list-inline-item">--}}
                {{--                            <a href="javascript:void(0)" class="rounded">--}}
                {{--                                <i class="mdi mdi-facebook text-dark"></i>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                        <li class="list-inline-item">--}}
                {{--                            <a href="javascript:void(0)" class="rounded">--}}
                {{--                                <i class="mdi mdi-linkedin text-dark"></i>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                        <li class="list-inline-item">--}}
                {{--                            <a href="javascript:void(0)" class="rounded">--}}
                {{--                                <i class="mdi mdi-pinterest text-dark"></i>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                        <li class="list-inline-item">--}}
                {{--                            <a href="javascript:void(0)" class="rounded">--}}
                {{--                                <i class="mdi mdi-twitter text-dark"></i>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
<!-- END FOOTER -->

<!-- FOOTER-ALT -->
<div class="footer-alt pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <p class="mb-0 text-white">©
                        <script>document.write(new Date().getFullYear())</script>
                        {{__('auth.copyright_by')." "}} {{ $setting['app_name'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END FOOTER-ALT -->
