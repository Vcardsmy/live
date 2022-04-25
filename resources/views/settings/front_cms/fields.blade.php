<div class="row gx-10 mb-5">
    <div class="col-lg-6 mb-7">
        <div class="justify-content-center">
            <label class="form-label fs-6 fw-bolder text-gray-700 mr-3"><span class="required">{{__('messages.front_cms.banner')}}:</span>
                <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                   title="{{__('messages.tooltip.home_image')}}"></i></label>
        </div>
        @php
            $inStyle = 'style';
            $backGround = 'background-image';
        @endphp
        <div class="image-input image-input-outline" data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px image-object-fit"
            {{$inStyle}}="{{$backGround}}: url('{{  isset($setting['home_page_banner']) ? $setting['home_page_banner'] : asset('assets/images/infyom-logo.png') }}')">
        </div>
        <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                data-bs-original-title="{{__('messages.tooltip.profile')}}">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="home_page_banner" accept=".png, .jpg, .jpeg">
            </i>
            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="avatar_remove">
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
              data-bs-original-title="{{__('messages.tooltip.cancel_profile')}}">
                        <i class="bi bi-x fs-2"></i>
            </span>
        @if(!isset($setting))
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
                  data-bs-original-title="Remove profile">
                        <i class="bi bi-x fs-2"></i>
            </span>
        @endif

        </div>
        <div class="form-text">{{__('messages.allowed_file_types')}}</div>
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('title', __('messages.front_cms.title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="{{__('messages.tooltip.banner_title')}}"></i>
            {{ Form::text('home_page_title', $setting['home_page_title'], ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.front_cms.title'), 'required', 'maxlength'=>'34']) }}
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
        <a href="" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>


