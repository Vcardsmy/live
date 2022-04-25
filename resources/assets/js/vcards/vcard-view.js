document.addEventListener('DOMContentLoaded', displayError);
document.addEventListener('DOMContentLoaded', loadVcardView);
document.addEventListener('DOMContentLoaded', passwordLoad);
document.addEventListener('DOMContentLoaded', langDropdown);

function displayError (selector, msg) {
    let selectorAttr = $(selector);
    selectorAttr.removeClass('d-none');
    selectorAttr.show();
    selectorAttr.text(msg);
    setTimeout(function () {
        $(selector).slideUp();
    }, 3000);
}
let timezone_offset_minutes;
function loadVcardView(){
    if(!$('.date').length){
        return
    }
    timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0
        ? 0
        : -timezone_offset_minutes;

    $('.date').flatpickr({
        locale: lang,
        minDate: new Date(),
        disableMobile: true,
    })

    setTimeout(function () {
        if (isEdit) {
            $('.date').val(date).trigger('change');
        }
    }, 1000);
    let selectedDate;
    let selectedSlotTime;
    if (!$('.no-time-slot').length) {
        return;
    }
    $('.no-time-slot').removeClass('d-none');
}

listenChange('.date', function () {
    $('#slotData').empty();
    selectedDate = $(this).val();
    $('#Date').val(selectedDate);
    $.ajax({
        url: slotUrl,
        type: 'GET',
        data: {
            'date': selectedDate,
            'timezone_offset_minutes': timezone_offset_minutes,
            'vcardId': vcardId,
        },
        success: function (result) {
            if (result.success) {
                $.each(result.data, function (index, value) {
                    let data = [
                        {
                            'value': value,
                        },
                    ];
                    $('#slotData').
                        append(
                            prepareTemplateRender('#appoitmentTemplate', data));

                });
            }
        },
        error: function (result) {
            $('#slotData').html('');
            displayErrorMessage(result.responseJSON.message);

        },
    });
});

listenClick('.appointmentAdd', function () {

    if (!$('.time-slot').hasClass('activeSlot')) {
        displayErrorMessage('Please Select Date Or Hour');
    } else {

        $('#AppointmentModal').modal('show');
    }
});

listenClick('.time-slot', function () {
    if ($(this).hasClass('activeSlot')) {
        $('.time-slot').removeClass('activeSlot');
        $(this).removeClass('activeSlot');
        selectedSlotTime = $(this).addClass('activeSlot');
        if (selectedSlotTime) {
            $(this).removeClass('activeSlot');
        }
    } else {
        $('.time-slot').removeClass('activeSlot');
        selectedSlotTime = $(this).addClass('activeSlot');
    }
    let fromToTime = $(this).attr('data-id').split('-');
    let fromTime = fromToTime[0];
    let toTime = fromToTime[1];
    $('#timeSlot').val('');
    $('#toTime').val('');
    $('#timeSlot').val(fromTime);
    $('#toTime').val(toTime);
});

listenHiddenBsModal( '#AppointmentModal', function () {
    resetModalForm('#addAppointmentForm');
})

listenSubmit( '#addAppointmentForm', function (event) {
    event.preventDefault();
    $.ajax({
        url: appointmentUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addAppointmentForm')[0].reset();
                $("#AppointmentModal").modal('hide');
                $('#slotData').empty();
                $('#pickUpDate').val('');
                $('.date').flatpickr({
                    minDate: new Date(),
                    disableMobile: true,
                })
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
});

function langDropdown(){
    if(!$('.dropdown1').length){
        return
    }
    $('.dropdown1').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
    });
}

listenClick('#languageName', function () {
    let languageName = $(this).attr('data-name');
    $.ajax({
        url: languageChange + '/' + languageName,
        type: 'GET',
        success: function (result) {
            location.reload();
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick('.share', function () {
    $('#vcard1-shareModel').modal('hide');
});

listenClick('.share2', function () {
    $('#vcard2-shareModel').modal('hide');
});

listenClick('.share3', function () {
    $('#vcard3-shareModel').modal('hide');
});
listenClick('.share4', function () {
    $('#vcard4-shareModel').modal('hide');
});
listenClick('.share5', function () {
    $('#vcard5-shareModel').modal('hide');
});
listenClick('.share6', function () {
    $('#vcard6-shareModel').modal('hide');
});
listenClick('.share7', function () {
    $('#vcard7-shareModel').modal('hide');
});
listenClick('.share8', function () {
    $('#vcard8-shareModel').modal('hide');
});
listenClick('share9', function () {
    $('#vcard9-shareModel').modal('hide');
});
listenClick('.share10', function () {
    $('#vcard10-shareModel').modal('hide');
});

function passwordLoad () {
    if (password) {
        let passwordAttr = $('#passwordModal');
        passwordAttr.appendTo('body').modal('show');
    } else {
        $('.content-blur').removeClass('content-blur');
    }
}

listenHiddenBsModal('#passwordModal', function () {
    $(this).find('#password').focus();
});

listenSubmit('#passwordForm', function (event) {
    event.preventDefault();
    $.ajax({
        url: passwordUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $('#passwordModal').modal('hide');
                $('.content-blur').removeClass('content-blur');
            }
        },
        error: function (result) {
            displayError('#passwordError', result.responseJSON.message);
        },
    });
});

var $window = $(window), previousScrollTop = 0, scrollLock = true;

$window.scroll(function (event) {
    if (scrollLock) {
        previousScrollTop = $window.scrollTop();
    }
    $window.scrollTop(previousScrollTop);

});

listenSubmit('#enquiryForm', function (event) {
    event.preventDefault();
    $.ajax({
        url: enquiryUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#enquiryForm')[0].reset();
            }
        },
        error: function (result) {
            displayError('#enquiryError', result.responseJSON.message);
        },
    });
});

listenClick('.vcard1-share', function () {
    $('#vcard1-shareModel').modal('show');
});

listenClick('.vcard2-share', function () {
    $('#vcard2-shareModel').modal('show');
});

listenClick('.vcard3-share', function () {
    $('#vcard3-shareModel').modal('show');
});

listenClick('.vcard4-share', function () {
    $('#vcard4-shareModel').modal('show');
});

listenClick('.vcard5-share', function () {
    $('#vcard5-shareModel').modal('show');
});

listenClick('.vcard6-share', function () {
    $('#vcard6-shareModel').modal('show');
});

listenClick('.vcard7-share', function () {
    $('#vcard7-shareModel').modal('show');
});

listenClick('.vcard8-share', function () {
    $('#vcard8-shareModel').modal('show');
});

listenClick('.vcard9-share', function () {
    $('#vcard9-shareModel').modal('show');
});

listenClick('.vcard10-share', function () {
    $('#vcard10-shareModel').modal('show');
});

listenClick('.gallery-link', function () {
    let url = $(this).data('id');
    $('#video').attr('src', url);
});

listenHiddenBsModal('#exampleModal', function () {
    $('#video').attr('src', '');
});

window.downloadVcard = function (fileName, id) {
    $.ajax({
        url: '/vcards/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let vcard = result.data;
                let vcardString = 'BEGIN:VCARD\n' +
                    'VERSION:3.0\n';

                if (!isEmpty(vcard.first_name)) {
                    vcardString += 'FN;CHARSET=UTF-8:' + vcard.first_name + '\n';
                }
                if (!isEmpty(vcard.last_name)) {
                    vcardString += 'N;CHARSET=UTF-8:' + vcard.last_name + '\n';
                }
                if (!isEmpty(vcard.dob)) {
                    vcardString += 'BDAY;CHARSET=UTF-8:' + new Date(vcard.dob) + '\n';
                }
                if (!isEmpty(vcard.email)) {
                    vcardString += 'EMAIL;CHARSET=UTF-8:' + vcard.email + '\n';
                }
                if (!isEmpty(vcard.job_title)) {
                    vcardString += 'TITLE;CHARSET=UTF-8:' + vcard.job_title + '\n';
                }
                if (!isEmpty(vcard.company)) {
                    vcardString += 'ORG;CHARSET=UTF-8:' + vcard.company + '\n';
                }
                if (!isEmpty(vcard.region_code) && !isEmpty(vcard.phone)) {
                    vcardString += 'TEL;TYPE=WORK,VOICE:' + vcard.region_code + vcard.phone + '\n';
                }
                if (!isEmpty(vcard.url_alias)) {
                    vcardString += 'URL;CHARSET=UTF-8:' + appUrl + '/vcard/' + vcard.url_alias + '\n';
                }
                if (!isEmpty(vcard.description)) {
                    vcardString += 'NOTE;CHARSET=UTF-8:' + vcard.description + '\n';
                }
                if (!isEmpty(vcard.location)) {
                    vcardString += 'ADR;CHARSET=UTF-8:' + vcard.location + '\n';
                }
                var extension = vcard.profile_url.split('.').pop();
                vcardString += 'PHOTO;' + extension.toUpperCase() + ':' + vcard.profile_url + '\n';
                vcardString += 'REV:' + moment().toISOString() + '\n'
                vcardString += 'END:VCARD'

                var a = $("<a />");
                a.attr("download", fileName);
                a.attr("href", "data:text/vcard;charset=UTF-8," + encodeURI(vcardString));
                $("body").append(a);
                a[0].click();
                $("body").remove(a);
            }
        },
        error: function (result) {
            displayError('#enquiryError', result.responseJSON.message)
        },
    })
};
