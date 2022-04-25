<?php ?>
@if($partName == 'basic')
    <div class="row gx-10 mb-7" id="basic">
        <div class="col-lg-12 mb-7">
            {{ Form::label('url_alias', __('messages.vcard.url_alias').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-bs-toggle="tooltip"
               data-bs-placement="right"
               data-bs-original-title="{{__('messages.tooltip.the_main_url')}}"></i>

            <div class="d-sm-flex">
                <div class="input-group-prepend mb-sm-0 mb-4">
                    <div
                        class="input-group-text form-control form-control-solid bg-secondary custom-group-text">{{ route('vcard.defaultIndex') }}
                        /
                    </div>
                </div>
                {{ Form::text('url_alias', isset($vcard) ? $vcard->url_alias : null, ['class' => 'ms-1 form-control form-control-solid', 'placeholder' => __('messages.form.my_vcard_url'), 'onkeypress' => 'return (event.charCode > 64 && event.charCode < 91 ) || (event.charCode >= 47 && event.charCode <= 57 ) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 45)']) }}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('name', __('messages.vcard.vcard_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('name', isset($vcard) ? $vcard->name : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.vcard_name'),'required']) }}
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('occupation', __('messages.vcard.occupation').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('occupation', isset($vcard) ? $vcard->occupation : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.occupation'),'required']) }}
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('description', __('messages.vcard.description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {!! Form::textarea('description', isset($vcard) ? $vcard->description : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.description'),'required', 'rows' => '5' ]) !!}
        </div>
        <div class="col-lg-3 col-sm-6 mb-7">
            <div class="justify-content-center">
                <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{ __('messages.vcard.profile_image').':' }}</label>
            </div>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <img class="image-input-wrapper w-125px h-125px" id="profilePreview"
                     src="{{ !empty($vcard->profile_url) ? $vcard->profile_url : asset('web/media/avatars/150-26.jpg') }}">
                <label
                        class="btn btn-icon btn-circle text-hover-primary w-25px h-25px bg-white shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                        data-bs-original-title="{{__('messages.tooltip.profile')}}">
                    <i class="bi bi-pencil-fill fs-7">
                        <input type="file" id="profileImg" name="profile_img">
                    </i>
                </label>
                <span class="btn btn-icon btn-circle text-hover-primary w-25px h-25px bg-white shadow cancel-profile"
                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                      data-bs-original-title="{{__('messages.tooltip.cancel_profile')}}">
                        <i class="bi bi-x fs-2"></i>
            </span>
            </div>
            <div class="form-text text-danger" id="profileImageValidationErrors"></div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-7">
            <div class="justify-content-center">
                <label class="form-label fs-6 fw-bolder text-gray-700 mr-3">{{ __('messages.vcard.cover_image').':' }}</label>
            </div>
            <div class="image-input image-input-outline" data-kt-image-input="true">
                <img class="image-input-wrapper w-125px h-125px" id="coverPreview"
                     src="{{ !empty($vcard->cover_url) ? $vcard->cover_url : asset('assets/images/default_cover_image.jpg') }}">
                <label
                        class="btn btn-icon btn-circle text-hover-primary w-25px h-25px bg-white shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                        data-bs-original-title="{{__('messages.tooltip.cover')}}">
                    <i class="bi bi-pencil-fill fs-7">
                        <input type="file" id="coverImg" name="cover_img">
                    </i>
                </label>
                <span class="btn btn-icon btn-circle text-hover-primary w-25px h-25px bg-white shadow cancel-cover"
                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                      data-bs-original-title="{{__('messages.tooltip.cancel_cover')}}">
                        <i class="bi bi-x fs-2"></i>
            </span>
            </div>
            <div class="form-text text-danger" id="coverImageValidationErrors"></div>
        </div>
        @if(isset($vcard))
            <div class="mt-5 row">
                <h4 class="fw-bolder text-gray-800 mb-5"> {{ __('messages.vcard.vcard_details') }} </h4>
                <div class="col-md-6">
                    <div class="form-group mb-7">
                        {{ Form::label('first_name',__('messages.vcard.first_name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('first_name', isset($vcard) ? $vcard->first_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.f_name'),'required']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-7">
                        {{ Form::label('last_name',__('messages.vcard.last_name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('last_name', isset($vcard) ? $vcard->last_name : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.l_name'),'required']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-7">
                        {{ Form::label('email',__('messages.user.email').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('email', isset($vcard) ? $vcard->email : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.email')]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('phone', __('messages.user.phone').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('phone', isset($vcard) ? (isset($vcard->region_code) ? '+'.$vcard->region_code.''.$vcard->phone : $vcard->phone) : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.phone'), 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                        {{ Form::hidden('region_code',isset($vcard) ? $vcard->region_code : null,['id'=>'prefix_code']) }}
                        <div class="mt-2">
                            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-7">
                        {{ Form::label('location',__('messages.user.location').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('location', isset($vcard) ? $vcard->location : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.location')]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-7">
                        {{ Form::label('location_url',__('messages.setting.location_url').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('location_url', isset($vcard) ? $vcard->location_url : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.location_url')]) }}
                    </div>
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('dob', __('messages.vcard.date_of_birth').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('dob', isset($vcard) ? $vcard->dob : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.DOB')]) }}
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('company', __('messages.vcard.company').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('company', isset($vcard) ? $vcard->company : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.company')]) }}
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('job_title', __('messages.vcard.job_title').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('job_title', isset($vcard) ? $vcard->job_title : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.job')]) }}
                </div>
            </div>
        @endif
        <div class="d-flex">
            {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'template')
    <div class="row gx-10 mb-5 navbar-collapse" id="template">
        <div class="col-lg-12 mb-3">
            <input type="hidden" name="part" value="{{$partName}}">
            <label class="form-label required fs-6 fw-bolder text-gray-700">{{ __('messages.vcard.select_template') }}
                :</label>
        </div>
        <div class="form-group mb-7 vcard-template">
            <div class="row">
                <input type="hidden" name="template_id" id="templateId" value="{{ $vcard->template_id }}">
                @foreach($templates as $id => $url)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="img-radio img-thumbnail {{ $vcard->template_id == $id ? 'img-border' : '' }}"
                             data-id="{{ $id }}">
                            <img src="{{ $url }}" alt="Template">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--        <div class="col-lg-12 mt-5">--}}
{{--            <div class="form-check form-switch">--}}
{{--                <input class="form-check-input" type="checkbox" id="displayShareBtn"--}}
{{--                       name="share_btn" {{ ($vcard->share_btn) ? 'checked'  : '' }}>--}}
{{--                <label class="form-check-label fs-6 fw-bolder text-gray-700" for="displayShareBtn">--}}
{{--                    {{__('messages.vcard.display_share_button')}}--}}
{{--                </label>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-lg-12 mt-5 mb-5">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="vcardTemplateStatus"
                       name="status" {{ ($vcard->status) ? 'checked' : '' }}>
                <label class="form-check-label fs-6 fw-bolder text-gray-700" for="vcardTemplateStatus">
                    {{__('messages.common.active')}}
                </label>
            </div>
        </div>
        <div class="col-lg-12 mt-2 d-flex">
            <button class="btn btn-primary me-3 template-save">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'business_hours')
    <div class="row gx-10 mb-5">
        <input type="hidden" name="part" value="{{$partName}}">
        @foreach(\App\Models\BusinessHour::DAY_OF_WEEK as $key => $day)
            <div class="col-xxl-6 mb-7 d-sm-flex align-items-center mb-3">
                <div class="col-lg-3 col-md-2 col-4">
                    <label
                        class="text-nowrap form-check form-check-sm form-check-custom form-check-solid text-left me-5 fw-bolder text-gray-700 mb-sm-0 mb-4">
                        <input class="form-check-input feature mx-2" type="checkbox" value="{{ $key }}"
                               name="days[]" {{!empty($hours[$key]) ? 'checked' : '' }}/>
                        {{ strtoupper(__('messages.business.'.$day)) }}
                    </label>
                </div>
                <div class="col-xl-4 col-lg-3 col-3 d-flex align-items-center buisness_end">
                    <div class="d-inline-block">
                        {{ Form::select('startTime['.$key.']', getSchedulesTimingSlot(), isset($hours[$key]) ? $hours[$key]['start_time'] : null ,['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
                    </div>
                    <span class="small-border">-</span>
                    <div class="d-inline-block">
                        {{ Form::select('endTime['.$key.']', getSchedulesTimingSlot(), isset($hours[$key]) ? $hours[$key]['end_time'] : null,['class' => 'form-control form-control-solid form-select', 'data-control'=>'select2']) }}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-lg-12 mt-2 d-flex">
            <button class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'appointments')
    <div class="row gx-10 mb-5 px-sm-7 px-3">
        <input type="hidden" name="part" value="{{$partName}}">
            @foreach(App\Models\BusinessHour::WEEKDAY_NAME as $day => $shortWeekDay)
            <div class="weekly-content" data-day="{{$day}}">
                <div class="d-flex w-100 align-items-center position-relative">
                    <div class="d-flex flex-md-row flex-column w-100 weekly-row">
                        <div class="form-check form-check-custom form-check-solid mb-0 checkbox-content d-flex align-items-center">
                            <input id="chkShortWeekDay_{{$shortWeekDay}}" class="form-check-input" type="checkbox"
                                   value="{{$day}}" name="checked_week_days[]"
                                {{!empty($time[$day]) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="chkShortWeekDay_{{$shortWeekDay}}">
                                <span class="text-nowrap fs-5 fw-bold d-md-block">{{ strtoupper(__('messages.business.'.strtolower($shortWeekDay))) }}</span>
                            </label>
                        </div>
                        <div class="ms-lg-10 ms-md-5 session-times">
                            @include('vcards.appointment.slot',['day' => $day])
                        </div>
                    </div>
                    <div class="weekly-icon position-absolute end-0 d-flex">
                        <a href="javascript:void(0)" class="add-session-time" id="add-session-{{ $day }}"
                           data-day="{{ $day }}" data-bs-toggle="tooltip"
                           title="{{__('messages.common.add')}}">
                            <i class="fa fa-plus text-primary me-5 fs-2 mb-3" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-lg-12 mt-4 d-flex">
            <button class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'social_links')
    <div class="row gx-10 mb-5">
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fa fa-globe-africa fa-3x text-dark mt-1 ms-1"></i>
                </label>
                {!! Form::text('website', isset($socialLink) ? $socialLink->website : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.website')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-twitter fa-3x text-primary mt-1 ms-1"></i>
                </label>
                {!! Form::text('twitter', isset($socialLink) ? $socialLink->twitter : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.twitter')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-facebook-square fa-3x text-primary mt-1 ms-1"></i>
                </label>
                {!! Form::text('facebook', isset($socialLink) ? $socialLink->facebook : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.facebook')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-instagram fa-3x text-danger mt-1 ms-1"></i>
                </label>
                {!! Form::text('instagram', isset($socialLink) ? $socialLink->instagram : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.instagram')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-reddit-alien fa-3x text-danger mt-1 ms-1"></i>
                </label>
                {!! Form::text('reddit', isset($socialLink) ? $socialLink->reddit : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.reddit')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-tumblr-square fa-3x text-dark mt-1 ms-1"></i>
                </label>
                {!! Form::text('tumblr', isset($socialLink) ? $socialLink->tumblr : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.tumblr')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-youtube fa-3x text-danger mt-1 ms-1"></i>
                </label>
                {!! Form::text('youtube', isset($socialLink) ? $socialLink->youtube : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.youtube')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-linkedin fa-3x text-primary mt-1 ms-1"></i>
                </label>
                {!! Form::text('linkedin', isset($socialLink->linkedin) ? $socialLink->linkedin : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.linkedin')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-whatsapp fa-3x text-success mt-1 ms-1"></i>
                </label>
                {!! Form::text('whatsapp', isset($socialLink) ? $socialLink->whatsapp : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.whatsapp')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-pinterest fa-3x text-danger mt-1 ms-1"></i>
                </label>
                {!! Form::text('pinterest', isset($socialLink) ? $socialLink->pinterest : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.pinterest')]) !!}
            </div>
        </div>
        <div class="col-lg-6 mb-7">
            <div class="input-group input-group-solid">
                <label class="input-group-append">
                    <i class="fab fa-tiktok fa-3x text-danger mt-1 ms-1"></i>
                </label>
                {!! Form::text('tiktok', isset($socialLink) ? $socialLink->tiktok : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.tiktok')]) !!}
            </div>
        </div>
        <div class="col-lg-12 d-flex">
            <button type="submit" class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'advanced')
    <div class="row gx-10 mb-5">
        <input type="hidden" name="part" value="{{$partName}}">
        @if(checkFeature('advanced')->password)
            <div class="col-lg-6 mb-7" data-kt-password-meter="true">
                <label class="form-label fw-bold fs-6 fw-bolder text-gray-700 mb-2">{{ __('messages.user.password').':' }}</label>
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid"
                           type="password" placeholder="{{__('messages.form.password')}}" name="password"
                           value="{{ !empty($vcard->password) ? Crypt::decrypt($vcard->password) : '' }}"
                           autocomplete="off"/>
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

        @if(checkFeature('advanced')->custom_css)
            <div class="col-lg-12 mb-7">
                {{ Form::label('custom_css', __('messages.vcard.custom_css').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('custom_css', isset($vcard) ? $vcard->custom_css : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.css'), 'rows' => '5']) }}
            </div>
        @endif

        @if(checkFeature('advanced')->custom_js)
            <div class="col-lg-12 mb-7">
                {{ Form::label('custom_js', __('messages.vcard.custom_js').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('custom_js', isset($vcard) ? $vcard->custom_js : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.js'), 'rows' => '5']) }}
            </div>
        @endif

        @if(checkFeature('advanced')->hide_branding)
            <div class="col-lg-6 mb-7">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="branding"
                           name="branding" {{ ($vcard->branding) ? 'checked'  : '' }}>
                    <label class="form-check-label fs-6 fw-bolder text-gray-700" for="branding">
                        {{__('messages.vcard.remove_branding')}}
                    </label>
                    <i class="fas fa-question-circle general-question-mark" data-bs-toggle="tooltip"
                       data-bs-placement="right"
                       data-bs-original-title="{{__('messages.tooltip.remove_branding')}}"></i>
                </div>
            </div>
        @endif

        <div class="col-lg-12 d-flex">
            <button type="submit" class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'custom_fonts')
    <div class="row gx-10 mb-5">
        <div class="col-lg-6 mb-7">
            {{ Form::label('font_family',__('messages.font.font_family').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('font_family', \App\Models\Vcard::FONT_FAMILY, \App\Models\Vcard::FONT_FAMILY[$vcard->font_family] ,
                ['class' => 'form-select form-select-solid fw-bold', 'data-control' => 'select2']) }}
        </div>
        <div class="col-lg-6 mb-7">
            {!! Form::label('font_size', __('messages.font.font_size').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) !!}
            <div class="input-group input-group-solid">
                {!! Form::number('font_size', $vcard->font_size , ['class' => 'form-control form-control-solid', 'min'=>'14', 'max' => '40']) !!}
                <div class="input-group-append">
                    <span class="input-group-text fs-6 fw-bolder text-gray-700">{{ __('messages.font.px') }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex">
            <button type="submit" class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif

@if($partName == 'seo')
    <div class="row gx-10 mb-5">
        <div class="col-lg-6 mb-7">
            {{ Form::label('Site title', __('messages.vcard.site_title').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('site_title', isset($vcard) ? $vcard->site_title : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.site_title')]) }}
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('Home title', __('messages.vcard.home_title').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('home_title', isset($vcard) ? $vcard->home_title : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.home_title')]) }}
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('Meta keyword', __('messages.vcard.meta_keyword').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('meta_keyword', isset($vcard) ? $vcard->meta_keyword : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.meta_keyword')]) }}
        </div>
        <div class="col-lg-6 mb-7">
            {{ Form::label('Meta Description', __('messages.vcard.meta_description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('meta_description', isset($vcard) ? $vcard->meta_description : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.meta_description')]) }}
        </div>
        <div class="col-lg-12 mb-7">
            {{ Form::label('Google Analytics', __('messages.vcard.google_analytics').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('google_analytics', isset($vcard) ? $vcard->google_analytics : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.google_analytics')]) }}
        </div>
        <div class="col-lg-12 d-flex">
            <button type="submit" class="btn btn-primary me-3">
                {{ __('messages.common.save') }}
            </button>
            <a href="{{ route('vcards.index') }}"
               class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
@endif
