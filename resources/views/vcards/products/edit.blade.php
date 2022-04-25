<div class="modal fade" id="editProductModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.vcard.edit_product') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
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
            <div class="modal-body mx-7">
                {!! Form::open(['id'=>'editProductForm', 'files' => 'true']) !!}
                <div class="row mb-5">
                    <div class="col-sm-12 mb-5">
                        {{ Form::hidden('product_id', null,['id' => 'productId']) }}
                        {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'id' => 'editName', 'required', 'placeholder' => __('messages.form.product')]) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('currency_id',__('messages.plan.currency').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('currency_id', getCurrencies(), null, ['class' => 'form-select form-select-solid fw-bold select2Selector', 'data-placeholder'=>__('messages.form.select_currency'), 'id' => 'editCurrencyId', 'data-control' => 'select2', 'data-dropdown-parent' => '#editProductModal']) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('price',__('messages.common.price').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('price', null, ['class' => 'form-control form-control-solid', 'id' => 'editPrice', 'placeholder' => __('messages.form.price')]) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'id' => 'editDescription', 'placeholder' => __('messages.form.short_description'), 'rows' => '5' , 'required']) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        <div class="mb-3">
                            <label
                                class="form-label required fs-6 fw-bolder text-gray-700">{{ __('messages.vcard.product_icon').':' }}</label>
                            <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"
                               title="{{__('messages.tooltip.product_image')}}"></i>
                        </div>
                        <div class="image-input image-input-outline" data-kt-image-input="true">
                            <img class="image-input-wrapper w-125px h-125px rounded-circle" id="editProductPreview"
                                 src="{{ asset('assets/images/default_service.png') }}">
                            <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                data-bs-original-title="{{__('messages.tooltip.image')}}">
                                <i class="bi bi-pencil-fill fs-7">
                                    <input type="file" id="editProductIcon" name="product_icon">
                                </i>
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow cancel-edit-service"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                  data-bs-original-title="{{__('messages.tooltip.cancel_image')}}">
                                    <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="form-text text-danger" id="editProductIconValidation"></div>
                    </div>
                    <div class="d-flex">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'serviceUpdate']) }}
                        <button type="button" class="btn btn-light btn-active-light-primary me-2"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
