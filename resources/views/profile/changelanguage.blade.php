<div class="modal show fade" id="changeLanguageModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">{{ __('messages.user.change_language') }}</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000,                                          4.000000)"
                               fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000,                                        -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"></rect>
                            </g>
                        </svg>
					</span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="changeLanguageForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    @method('PUT')
                    <div class="alert alert-danger d-none" id="editLanguageValidationErrorsBox"></div>
                            <div class="mb-1">
                                <div class="position-relative mb-3">
                                        @php
                                            $user = Auth::user();
                                        @endphp
                                        {{ Form::label('Language', __('messages.language').':',['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                                        {{ Form::select('language', \App\Models\User::LANGUAGES, isset($user) ? getCurrentLanguageName() : null, ['class' => 'form-control form-select form-select-solid fw-bold select2Selector', 'required','data-dropdown-parent' => '#changeLanguageModal', 'data-control' => 'select2','id' => 'selectLanguage']) }}
                                </div>
                            </div>
                    <div class="pt-15">
                        {{ Form::button(__('messages.common.save'),['class' => 'btn btn-primary me-3','id' => 'languageChangeBtn','data-kt-users-modal-action' => 'submit']) }}
                        {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary me-2','data-bs-dismiss' => 'modal']) }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
