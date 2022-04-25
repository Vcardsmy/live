<div class="modal fade" id="showEnquiriesModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.enquiry_detail') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon text-hover-primary"
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
                <div class="row mb-5">
                    <div class="col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700">
                           {{ __('messages.vcard.vcard_name') }} :
                        </label>
                        <p id="vcardName" class="text-gray-600 fw-bold mb-0"></p>
                    </div>
                    <div class="col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700">
                            {{__('messages.common.name').':'}}
                        </label>
                        <p id="showName" class="text-gray-600 fw-bold mb-0"></p>
                    </div>
                    <div class="col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700">
                            {{__('messages.common.email').':'}}
                        </label>
                        <p id="showEmail" class="text-gray-600 fw-bold mb-0"></p>
                    </div>
                    <div class="col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700">
                            {{__('messages.common.phone').':'}}
                        </label>
                        <p id="showPhone" class="text-gray-600 fw-bold mb-0"></p>
                    </div>
                    <div class="col-sm-12 mb-5">
                        <label class="form-label fs-6 fw-bolder text-gray-700">
                            {{__('messages.common.message').':'}}
                        </label>
                        <p id="showMessage" class="text-gray-600 fw-bold mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
