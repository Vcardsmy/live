@extends('settings.edit')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('section')
    <div class="card border-0">
        <div class="card-body">
            {{ Form::open(['route' => ['setting.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            <div class="row">
                <!-- App Name Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('app_name', __('messages.setting.app_name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('app_name', $setting['app_name'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'settingAppName']) }}
                </div>
                <!-- Email Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::email('email', $setting['email'], ['class' => 'form-control form-control-solid', 'required', 'id' => 'settingEmail']) }}
                </div>
                <!-- Phone Field -->
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <br>
                    {{ Form::tel('phone', '+'.$setting['prefix_code'].$setting['phone'], ['class' => 'form-control form-control-lg form-control-solid', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                    {{ Form::hidden('prefix_code','+'.$setting['prefix_code'] ,['id'=>'prefix_code']) }}
                    <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-5 text-nowrap">
                        {{ Form::label('plan_expire_notification', __('messages.plan_expire_notification').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="required"></span>
                            {{ Form::number('plan_expire_notification', $setting['plan_expire_notification'], ['class' => 'form-control form-control-solid','min'=>0, "onKeyPress"=>"if(this.value.length==2) return false;",'required', 'id' => 'settingPlanExpireNotification' ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-5">
                        {{ Form::label('address', __('messages.setting.address').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="required"></span>
                        {{ Form::text('address', $setting['address'], ['class' => 'form-control form-control-solid','min'=>0, 'id' => 'settingAddress', 'required'  ]) }}
                    </div>
                </div>
                <div class="form-group col-lg-3 col-md-3 mb-7">
                    <div class="d-block">
                        {{ Form::label('app_logo', __('messages.setting.app_logo').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-5']) }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-bs-toggle="tooltip"
                           data-placement="top" data-bs-original-title="{{__('messages.tooltip.app_logo')}}"></i>
                    </div>
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <img class="image-input-wrapper w-100 h-100 app-logo-image bgi-position-center" id="appLogo"
                             src="{{ isset($setting['app_logo']) ? $setting['app_logo'] : asset('assets/images/infyom-logo.png') }}">
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                data-bs-original-title="{{__('messages.tooltip.change_app_logo')}}">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('app_logo',['id'=>'appLogo','class' => 'd-none', 'accept' => '.png, .jpg, .jpeg']) }}
                            <input type="hidden" name="app_logo">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow cancel-app-logo"
                              data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                              data-bs-original-title="{{__('messages.tooltip.cancel_app_logo')}}">
                                                                <i class="bi bi-x fs-2"></i></span>
                    </div>
                </div>
                <div class="form-group col-lg-3 col-md-3 mb-3">
                    <div class="d-block">
                        {{ Form::label('app_logo', __('messages.setting.favicon').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-5']) }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-bs-toggle="tooltip"
                           data-placement="top"
                           data-bs-original-title="{{__('messages.tooltip.favicon_logo')}}"></i>
                    </div>
                    <div class="image-input image-input-outline" data-kt-image-input="true">
                        <img class="image-input-wrapper w-55px h-55px bgi-position-center" id="favicon"
                             src="{{ isset($setting['favicon']) ? $setting['favicon'] : asset('web/media/logos/favicon-infyom.png') }}">
                        <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                data-bs-original-title="{{__('messages.tooltip.change_favicon_logo')}}">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            {{ Form::file('favicon',['id'=>'favicon','class' => 'd-none', 'accept' => '.png, .jpg, .jpeg, .ico']) }}
                            <input type="hidden" name="favicon">
                        </label>
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow cancel-favicon"
                              data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                              data-bs-original-title="{{__('messages.tooltip.cancel_favicon_logo')}}">
                                                                <i class="bi bi-x fs-2"></i></span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="card-header border-0 px-0" data-bs-toggle="collapse" aria-expanded="true"
                 aria-controls="kt_account_profile_details">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="fw-bolder m-0">{{__('messages.plan.seo')}}
                    </h3>
                </div>
            </div>
            <div class="row border-top p-4">
                <div class="col-lg-6 mb-7">
                    {{ Form::label('Site title', __('messages.vcard.site_title').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('site_title', isset($metas) ? $metas['site_title'] : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.site_title')]) }}
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('Home title', __('messages.vcard.home_title').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('home_title', isset($metas) ? $metas['home_title'] : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.home_title')]) }}
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('Meta keyword', __('messages.vcard.meta_keyword').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('meta_keyword', isset($metas) ? $metas['meta_keyword'] : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.meta_keyword')]) }}
                </div>
                <div class="col-lg-6 mb-7">
                    {{ Form::label('Meta Description', __('messages.vcard.meta_description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('meta_description', isset($metas) ? $metas['meta_description'] : null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.meta_description')]) }}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="card-header border-0 px-0" data-bs-toggle="collapse" aria-expanded="true"
                 aria-controls="kt_account_profile_details">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="fw-bolder m-0">{{__('messages.payment_method')}}
                    </h3>
                </div>
            </div>
            <div class="card-body border-top p-3">
                <div class="row mb-6">
                    <div class="table-responsive px-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tbody class="text-gray-600 fw-bold d-flex flex-wrap">
                            @foreach(\App\Models\Plan::PAYMENT_METHOD as $key => $paymentGateway)
                                <tr class="w-md-50 w-100 d-flex justify-content-between border-0">
                                    <td class="p-2">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="{{$key}}"
                                                   name="payment_gateway[]"
                                                   id="{{$key}}" {{in_array($paymentGateway, $selectedPaymentGateways) ?'checked':''}} />
                                            <label class="form-check-label" for="{{$key}}">
                                                {{$paymentGateway}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Submit Field -->
                <div class="form-group col-sm-12 d-flex text-start">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    {{ Form::reset(__('messages.common.discard'), ['class' => 'btn btn-light btn-active-light-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
