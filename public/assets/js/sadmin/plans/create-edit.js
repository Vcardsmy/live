/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/assets/js/sadmin/plans/create-edit.js ***!
  \*********************************************************/
window.featureChecked = function (featureLength) {
  var totalFeature = $('.feature:checkbox').length;

  if (featureLength === totalFeature) {
    $('#featureAll').prop('checked', true);
  } else {
    $('#featureAll').prop('checked', false);
  }
};

var featureLength = $('.feature:checkbox:checked').length;
featureChecked(featureLength);
listenClick('#featureAll', function () {
  if ($('#featureAll').is(':checked')) {
    $('.feature').each(function () {
      $(this).prop('checked', true);
    });
  } else {
    $('.feature').each(function () {
      $(this).prop('checked', false);
    });
  }
});
listenClick('.feature', function () {
  var featureLength = $('.feature:checkbox:checked').length;
  featureChecked(featureLength);
});
listenClick('.screen.image', function () {
  var template = $(this).prev();

  if (template.is(':checked')) {
    template.prop('checked', false);
    $(this).removeClass('template-border');
  } else {
    template.prop('checked', true);
    $(this).addClass('template-border');
  }
});
listenClick('#isTrial', function () {
  if ($(this).is(':checked')) {
    $('#duration_type').val(1).trigger('change');
    $('#price').val(0);
    $('#duration_type, #price').prop('disabled', true);
  } else {
    $('#price').val('');
    $('#duration_type, #price').prop('disabled', false);
  }
});
listenSubmit('#planForm', function (e) {
  e.preventDefault();

  if (!$('.templateIds').is(':checked')) {
    displayErrorMessage('Multi templates is required');
    return false;
  } else if (!$('.feature').is(':checked')) {
    displayErrorMessage('Select one or more Feature is required');
    return false;
  }

  $(this)[0].submit();
});
/******/ })()
;