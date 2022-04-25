@extends('layouts.auth')
@section('title')
    {{__('messages.common.login')}}
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="{{ route('home') }}" class="mb-12">
            <img alt="Logo" src="{{ getLogoUrl() }}" class="h-45px"/>
        </a>
        <div class="w-lg-500px">
            @include('flash::message')
            @include('layouts.errors')
        </div>
        <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">{{__('auth.sign_in')}}</h1>
                    <div class="text-gray-400 fw-bold fs-4">{{__('messages.common.new_here').'?'}}
                        <a href="{{ route('register') }}" class="link-primary fw-bolder">{{__('messages.common.create_an_account')}}</a>
                    </div>
                </div>
                <!-- Email Address -->
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark required" for="email">{{ __('messages.user.email').':' }}</label>
                    <input id="email" class="form-control form-control-lg form-control-solid" value="{{ old('email') }}"
                           type="email" name="email" required autocomplete="off" autofocus placeholder="Enter Email"/>
                </div>
                <!-- Password -->
                <div class="mb-5 fv-row" data-kt-password-meter="true">
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0 required" for="password">{{ __('messages.user.password').':' }}</label>

                        @if (Route::has('password.request'))
                            <a class="link-primary fs-6 fw-bolder"
                               href="{{ route('password.request') }}">
                                {{ __('messages.common.forgot_your_password').'?' }}
                            </a>
                        @endif
                    </div>
                    <div class="position-relative">
                        <input id="password" class="form-control form-control-lg form-control-solid"
                               type="password"
                               name="password"
                               required autocomplete="current-password" placeholder="Enter Password"/>
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                              data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                        <div class="d-flex align-items-center mb-3"
                             data-kt-password-meter-control="highlight"></div>
                    </div>

                </div>
                </div>
                <!-- Remember Me -->
                <div class="fv-row mb-10">
                    <label class="form-check form-check-custom form-check-solid form-check-inline" for="remember_me">
                        <input class="form-check-input" id="remember_me" type="checkbox" name="remember"/>
                        <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('messages.common.remember_me') }}</span>
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">{{ __('messages.common.login') }}</span>
                        <span class="indicator-progress">{{ __('messages.common.please_wait') }}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <div class="d-flex justify-content-center d-flex-row align-items-center fg-login-btn">
                        <a class="btn btn-lg btn-danger w-50 mb-5 me-2 custom-font"
                           href="{{route('social.login','google')}}"> <i class="fab fa-google"></i> Log In via Google
                        </a>
                        <a class="btn btn-lg btn-primary w-50 mb-5 custom-font"
                           href="{{route('social.login','facebook')}}"> <i class="fab fa-facebook"></i> Log In via
                            Facebook </a>
                    </div>


                </div>
            </form>
        </div>
    </div>
    <!--end::Main-->
@endsection

