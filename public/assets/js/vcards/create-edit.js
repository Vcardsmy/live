/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/assets/js/vcards/create-edit.js ***!
  \***************************************************/


listenChange('#profileImg', function () {
  var validFile = isValidFile($(this), '#profileImageValidationErrors');

  if (validFile) {
    displayPhoto(this, '#profilePreview');
  } else {
    $('#profilePreview').attr('src', defaultProfileUrl);
  }
});
listenClick('.cancel-profile', function () {
  $('#profilePreview').attr('src', defaultProfileUrl);
});
listenClick('.cancel-cover', function () {
  $('#coverPreview').attr('src', defaultCoverUrl);
});
listenChange('#coverImg', function () {
  var validFile = isValidFile($(this), '#coverImageValidationErrors');

  if (validFile) {
    displayPhoto(this, '#coverPreview');
  } else {
    $('#coverPreview').attr('src', defaultCoverUrl);
  }
});
$('#dob').flatpickr({
  format: 'YYYY-MM-DD',
  useCurrent: true,
  sideBySide: true,
  maxDate: new Date()
});
listenClick('.img-radio ', function () {
  $('.img-radio').removeClass('img-border');
  $(this).addClass('img-border');
  $('#templateId').val($(this).attr('data-id'));
});
listenClick('.template-save', function () {
  var template = $('#templateId').val();

  if (isEmpty(template)) {
    displayErrorMessage('Choose any one template');
    return false;
  }

  $('#editForm')[0].submit();
});
listenChange('select[name^="startTime"]', function (e) {
  var selectedIndex = $(this)[0].selectedIndex;
  var endTimeOptions = $(this).closest('.buisness_end').find('select[name^="endTime"] option');
  endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
  endTimeOptions.each(function (index) {
    if (index <= selectedIndex) {
      $(this).attr('disabled', true);
    } else {
      $(this).attr('disabled', false);
    }
  });
});

if (isTrue) {
  $('select[name^="startTime"]').each(function () {
    var selectedIndex = $(this)[0].selectedIndex;
    var endSelectedIndex = $(this).closest('.buisness_end').find('select[name^="endTime"] option:selected')[0].index;
    var endTimeOptions = $(this).closest('.buisness_end').find('select[name^="endTime"] option');

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

listenClick('.add-session-time', function () {
  var selectedIndex = 0;
  var dayId = $(this).data('day');

  if ($(this).parent().prev().children('.session-times').find('.timeSlot:last-child').length > 0) {
    selectedIndex = $(this).parent().prev().children('.session-times').find('.timeSlot:last-child').children('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;
  }

  var day = $(this).closest('.weekly-content').attr('data-day');
  var $ele = $(this);
  var weeklyEle = $(this).closest('.weekly-content');
  $.ajax({
    url: route('get.slot'),
    data: {
      day: day
    },
    success: function success(data) {
      weeklyEle.find('.unavailable-time').html('');
      weeklyEle.find('input[name="checked_week_days[]"').prop('checked', true).prop('disabled', false);
      $ele.closest('.weekly-content').find('.session-times').append(data.data);
      weeklyEle.find('select[data-control="select2"]').select2();
      var startTimeOptions = $('#add-session-' + dayId).parent().prev().children('.session-times').find('.timeSlot:last-child').children('.add-slot').find('select[name^="startTimes"] option');
      startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
          $(this).attr('disabled', true);
        } else {
          $(this).attr('disabled', false);
        }
      });
    }
  });
});
listenClick('.deleteBtn', function () {
  var selectedIndex = 0;

  if ($(this).closest('.timeSlot').prev().length > 0) {
    selectedIndex = $(this).closest('.timeSlot').prev().children('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;
  }

  if ($(this).closest('.weekly-row').find('.session-times').find('select').length === 2) {
    var dayChk = $(this).closest('.weekly-row').find('input[name="checked_week_days[]"');
    dayChk.prop('checked', false).prop('disabled', true);
    $(this).closest('.weekly-row').append('<div class="unavailable-time">Unavailable</div>');
  }

  var startTimeOptions = $(this).closest('.timeSlot').next().children('.add-slot').find('select[name^="startTimes"] option');
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
$('select[name^="startTimes"]').each(function () {
  var selectedIndex = $(this)[0].selectedIndex;
  var endSelectedIndex = $(this).closest('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;
  var endTimeOptions = $(this).closest('.add-slot').find('select[name^="endTimes"] option');

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
listenChange('select[name^="startTimes"]', function (e) {
  var selectedIndex = $(this)[0].selectedIndex;
  var endTimeOptions = $(this).closest('.add-slot').find('select[name^="endTimes"] option');
  var endSelectedIndex = $(this).closest('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;

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
$('select[name^="endTimes"]').each(function () {
  var selectedIndex = $(this)[0].selectedIndex;
  var startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
  startTimeOptions.each(function (index) {
    if (index <= selectedIndex) {
      $(this).attr('disabled', true);
    } else {
      $(this).attr('disabled', false);
    }
  });
});
listenChange('select[name^="endTimes"]', function (e) {
  var selectedIndex = $(this)[0].selectedIndex;
  var startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
  startTimeOptions.each(function (index) {
    if (index <= selectedIndex) {
      $(this).attr('disabled', true);
    } else {
      $(this).attr('disabled', false);
    }
  });
});
/******/ })()
;