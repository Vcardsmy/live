<div class="modal fade" tabindex="-1" role="dialog" id="editCountryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.country.edit_country') }}</h2>
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
            {{ Form::open(['id' => 'editCountryForm']) }}
            <div class="modal-body mx-7">
                {{ Form::hidden('countryId',null,['id'=>'countryId']) }}
                <div class="row mb-5">
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('name',__('messages.common.name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'required', 'id'=>'editName']) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('short_code',__('messages.country.short_code').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('short_code', null, ['class' => 'form-control form-control-solid','maxlength' => '2' , 'required', 'onkeypress' => 'return (event.charCode > 64 && event.charCode < 91 ) || (event.charCode > 96 && event.charCode < 123)', 'id' => 'editShortCode']) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('phone_code',__('messages.country.phone_code').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('phone_code', null, ['class' => 'form-control form-control-solid', 'maxlength' => '4', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id'=>'editPhoneCode']) }}
                    </div>
                </div>
                <div class="text-start d-flex">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3']) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
