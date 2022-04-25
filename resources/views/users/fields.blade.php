<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('first_name', isset($user) ? $user->first_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.first_name'), 'required', 'id' => 'userFirstName']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('last_name', isset($user) ? $user->last_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.last_name'), 'required', 'id' => 'userLastName']) }}
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::email('email', isset($user) ? $user->email : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.mail'), 'required']) }}
    </div>
    <div class="col-lg-6">
        {{ Form::label('contact', __('messages.user.contact_no').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::tel('contact', isset($user) && $user->contact ? '+'.$user->region_code.$user->contact : null, ['class' => 'form-control form-control-lg form-control-solid', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',isset($user) ? $user->region_code : null,['id'=>'prefix_code']) }}
        <br>
        <p id="valid-msg" class="hide">✓ &nbsp; Valid</p>
        <p id="error-msg" class="hide mb-2"></p>
    </div>
    @if(!isset($user))
        <div class="col-lg-6 mb-5" data-kt-password-meter="true">
            <label class="form-label fw-bold fs-6 fw-bolder text-gray-700 mb-2 required">{{ __('messages.user.password').':' }}</label>
            <div class="position-relative mb-3">
                <input class="form-control form-control-lg form-control-solid"
                       type="password" placeholder="{{__('messages.form.password')}}" name="password"
                       autocomplete="off" required/>
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                      data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                <div class="d-flex align-items-center mb-3"
                     data-kt-password-meter-control="highlight"></div>
            </div>
        </div>

        <div class="col-lg-6 mb-5" data-kt-password-meter="true">
            <label class="form-label fw-bold fs-6 fw-bolder text-gray-700 mb-2 required">{{ __('messages.user.confirm_password').':' }}</label>
            <div class="position-relative mb-3">
                <input class="form-control form-control-lg form-control-solid"
                       type="password" placeholder="{{__('messages.form.c_password')}}" name="password_confirmation"
                       autocomplete="off" required/>
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                      data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                <div class="d-flex align-items-center mb-3"
                     data-kt-password-meter-control="highlight"></div>
            </div>
        </div>
    @endif
    <div class="col-lg-3 mb-7">
        <div class="justify-content-center">
            <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{ __('messages.user.profile') }}:</label>
            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-bs-toggle="tooltip"
               data-bs-placement="top" data-bs-original-title="{{__('messages.tooltip.allowed_image')}}"></i>
        </div>
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
                  data-bs-original-title="{{__('messages.tooltip.profile')}}">
                        <i class="bi bi-x fs-2"></i>
            </span>
        </div>
        <div class="form-text text-danger" id="profileValidationErrors"></div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
        <a href="{{ route('users.index') }}"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>

