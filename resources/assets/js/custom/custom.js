'use strict';
let source = null;
let jsrender = require('jsrender');
let csrfToken = $('meta[name="csrf-token"]').attr('content');


document.addEventListener('turbo:load', initAllComponents);

function initAllComponents () {
    initMetronicComponents();
    select2initialize();
    refreshCsrfToken();
    alertInitialize();
    modalInputFocus();
    inputFocus();
}

function alertInitialize() {
    $('.alert').delay(5000).slideUp(300)
}

let firstTime = true;

function initMetronicComponents() {
    if (firstTime) {
        firstTime = false;
        return;
    }
    setTimeout(function () {
        KTDialer.init()
        KTDrawer.init()
        KTPasswordMeter.init()
        KTMenu.init();
        KTImageInput.init();
        KTScroll.init();
        KTScrolltop.init()
        KTSticky.init()
        KTSwapper.init()
        KTToggle.init()
        KTApp.init()
    }, 250);
}

function refreshCsrfToken() {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    });
}

function select2initialize() {
    $('[data-control="select2"]').each(function () {
        $(this).select2()
    })
}

document.addEventListener('click', function (e) {
    let filterBtnEle = $(e.target).closest('.show[data-ic-dropdown-btn="true"]')
    let filterDropDownEle = $(e.target).closest('.show[data-ic-dropdown="true"]')

    if (!(filterBtnEle.length > 0 || filterDropDownEle.length > 0)) {
        $('[data-ic-dropdown-btn="true"]').removeClass('show')
        $('[data-ic-dropdown="true"]').removeClass('show')
    }
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $('[data-control="select2"]').each(function () {
            $(this).select2()
        })
    })
})

const inputFocus = () => {
    $('input:text:not([readonly="readonly"]):not([name="search"]):not(.front-input)').first().focus();
}


const modalInputFocus = () => {
    $(function () {
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('input:text').first().focus();
        });
    });
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
$(document).ajaxComplete(function () {
    // Required for Bootstrap tooltips in DataTables
    $('[data-toggle="tooltip"]').tooltip({
        'html': true,
        'offset': 10,
    });
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

toastr.options = {
    'closeButton': true,
    'debug': false,
    'newestOnTop': false,
    'progressBar': true,
    'positionClass': 'toast-top-right',
    'preventDuplicates': false,
    'onclick': null,
    'showDuration': '300',
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.resetModalForm = function (formId, validationBox = null) {
    $(formId)[0].reset();
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val('');
        $(drpSelector).trigger('change');
    });
    $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.displaySuccessMessage = function (message) {
    toastr.success(message);
};

window.displayErrorMessage = function (message) {
    toastr.error(message);
};

window.deleteItem = function (url, header) {
    var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    Swal.fire({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure') + '"' + header + '" ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        cancelButtonText: Lang.get('messages.common.no'),
        confirmButtonText: Lang.get('messages.common.yes'),
        confirmButtonColor: '#009ef7',
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteItemAjax(url, header, callFunction);
        }
    });
};

function deleteItemAjax (url, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                window.livewire.emit('refresh');
            }
            Swal.fire({
                title: Lang.get('messages.common.deleted') + ' !',
                text: header + Lang.get('messages.common.has_been_deleted'),
                icon: 'success',
                timer: 2000,
                confirmButtonColor: '#009ef7',
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                timer: 5000,
                confirmButtonColor: '#009ef7',
            });
        },
    });
}

window.format = function (dateTime, dateFormat = 'DD-MMM-YYYY') {
    var format = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : dateFormat
    return moment(dateTime).format(format)
}

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId)
    if (state === 'loading') {
        loadingButton.button('loading')
    } else {
        loadingButton.button('reset')
    }
}

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.changeImg = function (inputSelector, imgErrorsSelector, previewSelector, defaultImg) {
    let validFile = isValidFile($(inputSelector), imgErrorsSelector)
    if (validFile) {
        displayPhoto(inputSelector, previewSelector)
    } else {
        $('#servicePreview').attr('src', defaultImg)
    }
}

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: jpeg, jpg, png.').
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};
window.removeCommas = function (str) {
    return str.replace(/,/g, '');
};

window.DatetimepickerDefaults = function (opts) {
    return $.extend({}, {
        sideBySide: true,
        ignoreReadonly: true,
        icons: {
            close: 'fa fa-times',
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-arrow-up',
            down: 'fa fa-arrow-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-clock-o',
            clear: 'fa fa-trash-o',
        },
    }, opts);
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.screenLock = function () {
    $('#overlay-screen-lock').show();
    $('body').css({ 'pointer-events': 'none', 'opacity': '0.6' });
};

window.screenUnLock = function () {
    $('body').css({ 'pointer-events': 'auto', 'opacity': '1' });
    $('#overlay-screen-lock').hide();
};

window.onload = function () {
    window.startLoader = function () {
        $('.infy-loader').show();
    };

    window.stopLoader = function () {
        $('.infy-loader').hide();
    };

// infy loader js
    stopLoader();
};

$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).
        find('.nav-item.dropdown ul li').
        hasClass('active');
    if (hasActiveMenu) {
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            css('display', 'block');
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            parent('li').
            addClass('active');
    }
});

window.urlValidation = function (value, regex) {
    let urlCheck = (value == '' ? true : (value.match(regex)
        ? true
        : false));
    if (!urlCheck) {
        return false;
    }

    return true;
};

$('.languageSelection').on('click', function () {
    let languageName = $(this).data('prefix-value');
    $.ajax({
        type: 'POST',
        url: '/change-language',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { languageName: languageName },
        success: function () {
            location.reload();
        },
    });
});



if ($(window).width() > 992) {
    $('.no-hover').on('click', function () {
        $(this).toggleClass('open');
    });
}

$(document).on('click', '#readNotification', function (e) {
    e.preventDefault();
    let notificationId = $(this).data('id');
    let notification = $(this);
    $.ajax({
        type: 'POST',
        url: readNotification +'/'+ notificationId + '/read',
        data: { notificationId: notificationId },
        success: function () {
            notification.remove();
            let notificationCounter = document.getElementsByClassName(
                'readNotification').length;
            if (notificationCounter == 0) {
                $('#readAllNotification').addClass('d-none');
                $('.empty-state').removeClass('d-none');
                $('.notification-toggle').removeClass('beep');
            }
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$(document).on('click', '#readAllNotification', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: readAllNotifications,
        success: function () {
            $('.readNotification').remove();
            $('#readAllNotification').addClass('d-none');
            $('.empty-state').removeClass('d-none');
            $('.notification-toggle').removeClass('beep');
        },
        error: function (error) {
            manageAjaxErrors(error)
        },
    });
});

$('#register').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownLanguage').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#language').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#login').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLanguage').trigger('click');
});

window.checkSummerNoteEmpty = function (
    selectorElement, errorMessage, isRequired = 0) {
    if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
        displayErrorMessage(errorMessage);
        $(document).find('.note-editable').html('<p><br></p>');
        return false;
    } else if (!$(selectorElement).summernote('isEmpty')) {
        $(document).find('.note-editable').contents().each(function () {
            if (this.nodeType === 3) { // text node
                this.textContent = this.textContent.replace(/\u00A0/g, '');
            }
        });
        if ($(document).find('.note-editable').text().trim().length == 0) {
            $(document).find('.note-editable').html('<p><br></p>');
            $(selectorElement).val(null);
            if (isRequired === 1) {
                displayErrorMessage(errorMessage);

                return false;
            }
        }
    }

    return true;
};

window.preparedTemplate = function () {
    let source = $('#actionTemplate').html();
    window.preparedTemplate = Handlebars.compile(source);
};

window.ajaxCallInProgress = function () {
    ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
    ajaxCallIsRunning = false;
};

window.avoidSpace = function (event) {
    let k = event ? event.which : window.event.keyCode;
    if (k == 32) {
        return false;
    }
};

$(document).delegate('textarea', 'keydown', function(e) {
    let keyCode = e.keyCode || e.which;
    if (keyCode === 9) {
        e.preventDefault();
        let start = this.selectionStart;
        let end = this.selectionEnd;
        let text = $(this).val();
        let selText = text.substring(start, end);
        $(this).val(
            text.substring(0, start) +
            "\t" + selText.replace(/\n/g, "\n\t") +
            text.substring(end)
        );
        this.selectionStart = this.selectionEnd = start + 1;
    }
});

$(document).ready(function () {
    $('#languageDropdown').click(function (e) {
        e.stopPropagation();
    })
})

function isEmailEditProfile(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit('#userProfileEditForm' , function () {
    if ($.trim($('#editProfileFirstName').val()) == '') {
        displayErrorMessage('First Name field is required.');
        return false;
    }

    if ($.trim($('#editProfileLastName').val()) == '') {
        displayErrorMessage('Last Name field is required.');
        return false;
    }
    
    if (!isEmailEditProfile($('#isEmailEditProfile').val())) {
        displayErrorMessage('Please Enter valid Email.');
        return false;
    }
});
