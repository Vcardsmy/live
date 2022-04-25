/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/sadmin/states/states.js ***!
  \*****************************************************/
$(document).on('select2:open', function () {
  document.querySelector('.select2-search__field').focus();
});
listenClick('#newStateBtn', function () {
  $('#addStateModal').modal('show');
});
listenHiddenBsModal('#addStateModal', function (e) {
  $('#addNewForm')[0].reset();
  $('#countryState').val(null).trigger('change');
});
listenSubmit('#addNewForm', function (e) {
  e.preventDefault();
  var stateUrl = route('states.store');
  $.ajax({
    url: stateUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addStateModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.state-edit-btn', function (event) {
  var editStateId = $(event.currentTarget).data('id');
  EditStateRenderData(editStateId);
});

function EditStateRenderData(id) {
  var stateUrl = route('states.edit', id);
  $.ajax({
    url: stateUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#stateId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editCountryId').val(result.data.country_id).trigger('change');
        $('#editStateModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var stateId = $('#stateId').val();
  var stateUrl = route('states.update', stateId);
  $.ajax({
    url: stateUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editStateModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.state-delete-btn', function (event) {
  var stateDeleteId = $(event.currentTarget).data('id');
  var url = route('states.destroy', {
    state: stateDeleteId
  });
  deleteItem(url, 'State');
});
/******/ })()
;