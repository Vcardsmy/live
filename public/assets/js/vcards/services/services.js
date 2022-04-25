/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/assets/js/vcards/services/services.js ***!
  \*********************************************************/
listenClick('#addServiceBtn', function () {
  $('#addServiceModal').modal('show');
});
listenHiddenBsModal('#addServiceModal', function () {
  resetModalForm('#addServiceForm');
  $('#servicePreview').attr('src', defaultServiceIconUrl);
  $(".cancel-service").hide();
});
listenHiddenBsModal('#showServiceModal', function () {
  $('#showName,#showDesc').empty();
  $('#servicePreview').attr('src', defaultServiceIconUrl);
});
listenHiddenBsModal('#editServiceModal', function () {
  $('.cancel-edit-service').hide();
});
listenChange('#serviceIcon', function () {
  changeImg(this, '#serviceIconValidationErrors', '#servicePreview', defaultServiceIconUrl);
  $(".cancel-service").show();
});
listenClick('.cancel-service', function () {
  $('#servicePreview').attr('src', defaultServiceIconUrl);
});
listenSubmit('#addServiceForm', function (e) {
  e.preventDefault();
  $('#serviceSave').prop('disabled', true);
  $.ajax({
    url: route('vcard.service.store'),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addServiceModal').modal('hide');
        Livewire.emit('refresh');
        $('#serviceSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#serviceSave').prop('disabled', false);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var vcardServiceId = $(event.currentTarget).data('id');
  editVcardServiceRenderData(vcardServiceId);
});
var serviceIconUrl = '';

function editVcardServiceRenderData(id) {
  $.ajax({
    url: route('vcard.service.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#serviceId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editDescription').val(result.data.description);
        $('#editServicePreview').attr('src', result.data.service_icon);
        $('#editServiceModal').modal('show');
        serviceIconUrl = result.data.service_icon;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenChange('#editServiceIcon', function () {
  changeImg(this, '#editServiceIconValidation', '#editServicePreview', serviceIconUrl);
  $('.cancel-edit-service').show();
});
listenClick('.cancel-edit-service', function () {
  $('#editServicePreview').attr('src', serviceIconUrl);
});
listenSubmit('#editServiceForm', function (event) {
  event.preventDefault();
  var vcardServiceId = $('#serviceId').val();
  $.ajax({
    url: route('vcard.service.update', vcardServiceId),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editServiceModal').modal('hide');
        Livewire.emit('refresh');
        $('.cancel-edit-service').hide();
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('vcard.service.destroy', recordId), vcard_service);
});
listenClick('.view-btn', function (event) {
  var vcardServiceId = $(event.currentTarget).data('id');
  vcardServiceRenderDataShow(vcardServiceId);
});

function vcardServiceRenderDataShow(id) {
  $.ajax({
    url: route('vcard.service.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        console.log(result.data.name);
        $('#showName').append(result.data.name);
        var element = document.createElement('textarea');
        element.innerHTML = result.data.description;
        $('#showDesc').append(element.value);
        $('#showServiceIcon').attr('src', result.data.service_icon);
        $('#showServiceModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}
/******/ })()
;