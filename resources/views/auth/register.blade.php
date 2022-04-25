@extends('layouts.auth')
@section('title')
    {{__('messages.common.register')}}
@endsection
@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="{{ route('home') }}" class="mb-12">
            <img alt="Logo" src="{{ getLogoUrl() }}" class="h-45px"/>
        </a>
        <div class="w-lg-600px">
            @include('layouts.errors')
        </div>
        <div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

            <form class="form w-100" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-10 text-center">
                    <h1 class="text-dark mb-3">{{__('messages.common.create_an_account')}}</h1>

                    <div class="text-gray-400 fw-bold fs-4">{{__('messages.common.already_have_an_account').'?'}}
                        <a href="{{ route('login') }}" class="link-primary fw-bolder">{{__('messages.common.sign_in_here')}}</a></div>

                </div>
                <div class="row fv-row">
                    <!-- Name -->
                    <div class="col-xl-6 mb-5">
                        <label class="form-label fw-bolder text-dark fs-6 required" for="first_name">
                            {{ __('messages.user.first_name').':' }}</label>
                        <input class="form-control form-control-lg form-control-solid" id="first_name"
                               value="{{ old('first_name') }}" type="text" name="first_name" autocomplete="off" required
                               autofocus placeholder="Enter First Name"/>
                    </div>

                    <!-- Last Name -->
                    <div class="col-xl-6 mb-5">
                        <label class="form-label fw-bolder text-dark fs-6 required" for="last_name">
                            {{ __('messages.user.last_name').':' }}</label>
                        <input class="form-control form-control-lg form-control-solid" id="last_name" type="text"
                               value="{{ old('last_name') }}" name="last_name" autocomplete="off" required autofocus placeholder="Enter Last Name"/>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-dark fs-6 required" for="email">
                        {{ __('messages.user.email').':' }}</label>
                    <input class="form-control form-control-lg form-control-solid" id="email" value="{{ old('email') }}"
                           type="email" name="email" required autocomplete="off" placeholder="Enter Email"/>
                </div>

                <!-- Password -->
                <div class="mb-5 fv-row" data-kt-password-meter="true">

                    <div class="mb-1">

                        <label class="form-label fw-bolder text-dark fs-6 required" for="password">
                            {{ __('messages.user.password').':' }}</label>

                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid" id="password" type="password"
                                   name="password" required autocomplete="new-password" placeholder="Password"/>
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

                <!-- Confirm Password -->
                <div class="mb-5 fv-row" data-kt-password-meter="true">
                    <div class="fv-row mb-5">
                        <label class="form-label fw-bolder text-dark fs-6 required" for="password_confirmation">
                            {{ __('messages.user.confirm_password').':' }} </label>
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                   id="password_confirmation" name="password_confirmation" required autocomplete="off"
                                   placeholder="Confirm Password"/>
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                  data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            <div class="d-flex align-items-center mb-3"
                                 data-kt-password-meter-control="highlight"></div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label"> {{ __('messages.common.register') }}</span>
                                <span class="indicator-progress">{{ __('messages.common.please_wait') }}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>

            </form>

        </div>

    </div>

    <!--end::Main-->
@endsection
