@extends('layouts.app')
@section('title')
    {{ __('messages.user.profile_details') }}
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <form id="userProfileEditForm" method="POST"
              action="{{ route('update.profile.setting') }}"
              class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <div class="col-lg-4 mb-3">
                        {!! Form::label('Avatar', __('messages.user.avatar').':',  ['class'=> 'form-label fs-6 fw-bolder text-gray-700']) !!}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"
                           data-bs-toggle="tooltip"
                           data-bs-placement="right"
                           data-bs-original-title="{{__('messages.tooltip.allowed_image')}}"></i>
                    </div>
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <img class="image-input-wrapper w-125px h-125px" id="profilePreview"
                                 src="{{ !empty($user->profile_image) ? $user->profile_image : asset('web/media/avatars/150-26.jpg') }}">
                            <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    data-bs-original-title="{{__('messages.tooltip.profile')}}">
                                <i class="bi bi-pencil-fill fs-7">
                                    <input type="file" id="profile" name="profile">
                                </i>
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow cancel-profile"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                  data-bs-original-title="{{__('messages.tooltip.cancel_profile')}}">
                                    <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="form-text text-danger" id="profileValidationErrors"></div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 form-label fs-6 fw-bolder required text-gray-700 mb-3">{{ __('messages.user.full_name').':' }}</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                {!! Form::text('first_name', $user->first_name, ['class'=> 'form-control form-control-lg form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.form.first_name'), 'required', 'id' => 'editProfileFirstName']) !!}
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                {!! Form::text('last_name', $user->last_name, ['class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => __('messages.form.last_name'), 'required', 'id' => 'editProfileLastName']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.user.email').':' }}</label>
                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                        {!! Form::email('email', $user->email, ['class'=> 'form-control form-control-lg form-control-solid', 'placeholder' => __('messages.user.email'), 'required', 'id' => 'isEmailEditProfile']) !!}
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.user.contact_number').':' }}</label>
                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                        {{ Form::tel('contact', isset($user)?  (isset($user->region_code) ? '+'.$user->region_code.''.$user->contact : $user->contact) :null, ['class' => 'form-control form-control-lg form-control-solid', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                        {{ Form::hidden('region_code',isset($user) ? $user->region_code : null,['id'=>'prefix_code']) }}
                        <br>
                        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                        <span id="error-msg" class="hide"></span>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex py-6 px-9">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                @role(\App\Models\Role::ROLE_ADMIN)
                <a href="{{route('admin.dashboard')}}"
                   class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
                @endrole
                @role(\App\Models\Role::ROLE_SUPER_ADMIN)
                <a href="{{route('sadmin.dashboard')}}"
                   class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
                @endrole
            </div>
        </form>
    </div>
@endsection
