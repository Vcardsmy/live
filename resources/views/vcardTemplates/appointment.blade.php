<div class="modal fade" id="AppointmentModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{__('messages.make_appointment')}}</h2>
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
                {!! Form::open(['id'=>'addAppointmentForm']) !!}
                <div class="row mb-5">
                    <div class="col-sm-12 mb-5">
                        {{ Form::hidden('from_time', null,['id'=>'timeSlot',]) }}
                        {{ Form::hidden('to_time', null,['id'=>'toTime',]) }}
                        {{ Form::hidden('date', null,['id'=>'Date',]) }}
                        {{ Form::hidden('vcard_id', $vcard->id) }}
                        {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','required', 'placeholder' => __('messages.form.enter_name')]) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('email',__('messages.common.email').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('email', null, ['class' => 'form-control form-control-solid','required', 'placeholder' => __('messages.form.enter_email')]) }}
                    </div>
                    <div class="col-sm-12 mb-5">
                        {{ Form::label('phone',__('messages.common.phone').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('phone', null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.form.enter_phone')]) }}
                    </div>
                    <div class="d-flex">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'serviceSave']) }}
                        <button type="button" class="btn btn-light btn-active-light-primary me-2"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
