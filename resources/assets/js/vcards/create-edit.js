'use strict'

listenChange( '#profileImg', function () {
    let validFile = isValidFile($(this),
        '#profileImageValidationErrors')
    if (validFile) {
        displayPhoto(this, '#profilePreview')
    } else {
        $('#profilePreview').attr('src', defaultProfileUrl)
    }
})

listenClick( '.cancel-profile', function () {
    $('#profilePreview').attr('src', defaultProfileUrl)
})

listenClick( '.cancel-cover', function () {
    $('#coverPreview').attr('src', defaultCoverUrl)
})

listenChange('#coverImg', function () {
    let validFile = isValidFile($(this),
        '#coverImageValidationErrors')
    if (validFile) {
        displayPhoto(this, '#coverPreview')
    } else {
        $('#coverPreview').attr('src', defaultCoverUrl)
    }
})


listenClick( '.img-radio ', function () {
    $('.img-radio').removeClass('img-border')
    $(this).addClass('img-border')
    $('#templateId').val($(this).attr('data-id'))
})

listenClick('.template-save', function () {
    let template = $('#templateId').val()
    if (isEmpty(template)) {
        displayErrorMessage('Choose any one template')
        return false
    }
    $('#editForm')[0].submit()
})

listenChange('select[name^="startTime"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this).closest('.buisness_end').find('select[name^="endTime"] option');
    endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        }else{
            $(this).attr('disabled', false);
        }
    });
});

document.addEventListener('turbo:load', loadVcardCreateEdit)
 
function loadVcardCreateEdit() {
    if(!$('#vcardCreateEditIsTrue').length){
        return
    }
    if($('#vcardCreateEditIsTrue').length && $('#vcardCreateEditIsTrue').val()) {
        $('select[name^="startTime"]').each(function () {
            let selectedIndex = $(this)[0].selectedIndex;
            let endSelectedIndex = $(this).closest('.buisness_end').find('select[name^="endTime"] option:selected')[0].index;
            let endTimeOptions = $(this).closest('.buisness_end').find('select[name^="endTime"] option');
            if (selectedIndex >= endSelectedIndex) {
                endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
            }
            endTimeOptions.each(function (index) {
                if (index <= selectedIndex) {
                    $(this).attr('disabled', true);
                } else {
                    $(this).attr('disabled', false);
                }
            });
        });
    }
    
    $('select[name^="endTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
        startTimeOptions.each(function (index) {
            if (index <= selectedIndex) {
                $(this).attr('disabled', true);
            }else{
                $(this).attr('disabled', false);
            }
        });
    });

    $('select[name^="startTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let endSelectedIndex = $(this).
            closest('.add-slot').
            find('select[name^="endTimes"] option:selected')[0].index;
        let endTimeOptions = $(this).
            closest('.add-slot').
            find('select[name^="endTimes"] option');
        if (selectedIndex >= endSelectedIndex) {
            endTimeOptions.eq(selectedIndex + 1).
                prop('selected', true).
                trigger('change');
        }
        endTimeOptions.each(function (index) {
            if (index <= selectedIndex) {
                $(this).attr('disabled', true);
            } else {
                $(this).attr('disabled', false);
            }
        });
    });

    $('#dob').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
    })
}


listenClick( '.add-session-time', function () {
    let selectedIndex = 0
    let dayId = $(this).data('day')
    if ($(this).parent().prev().children('.session-times').find('.timeSlot:last-child').length > 0){
        selectedIndex = $(this).
        parent().
        prev().
        children('.session-times').
        find('.timeSlot:last-child').
        children('.add-slot').
        find('select[name^="endTimes"] option:selected')[0].index;
    }

    let day = $(this).closest('.weekly-content').attr('data-day');
    let $ele = $(this);
    let weeklyEle = $(this).closest('.weekly-content');
    $.ajax({
        url: route('get.slot'),
        data: { day: day },
        success: function (data) {
            weeklyEle.find('.unavailable-time').html('');
            weeklyEle.find('input[name="checked_week_days[]"').
            prop('checked', true).prop('disabled', false);
            $ele.closest('.weekly-content').
            find('.session-times').
            append(data.data);
            weeklyEle.find('select[data-control="select2"]').select2();

            let startTimeOptions = $('#add-session-' + dayId).
                parent().
                prev().
                children('.session-times').
                find('.timeSlot:last-child').
                children('.add-slot').
                find('select[name^="startTimes"] option')
            startTimeOptions.each(function (index) {
                if (index <= selectedIndex) {
                    $(this).attr('disabled', true);
                }else{
                    $(this).attr('disabled', false);
                }
            });

        },
    });
});
listenClick( '.deleteBtn', function () {

    let selectedIndex = 0;
    if ($(this).closest('.timeSlot').prev().length > 0){
        selectedIndex = $(this).
        closest('.timeSlot').
        prev().
        children('.add-slot').
        find('select[name^="endTimes"] option:selected')[0].index;
    }


    if ($(this).
    closest('.weekly-row').
    find('.session-times').
    find('select').length === 2) {
        let dayChk = $(this).
        closest('.weekly-row').
        find('input[name="checked_week_days[]"');
        dayChk.prop('checked', false).prop('disabled', true);
        $(this).
        closest('.weekly-row').
        append('<div class="unavailable-time">Unavailable</div>');
    }

    let startTimeOptions = $(this).
    closest('.timeSlot').
    next().
    children('.add-slot').
    find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
        }
    });

    $(this).parent().siblings('.error-msg').remove();
    $(this).parent().closest('.timeSlot').remove();
    $(this).parent().remove();
});


listenChange('select[name^="startTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this).closest('.add-slot').find('select[name^="endTimes"] option');
    let endSelectedIndex = $(this).closest('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;
    if(selectedIndex >= endSelectedIndex){
        endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
    }
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        }else{
            $(this).attr('disabled', false);
        }
    });
});



listenChange( 'select[name^="endTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        }else{
            $(this).attr('disabled', false);
        }
    });
});
