/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************!*\
  !*** ./resources/assets/js/sadmin/countries/countries.js ***!
  \***********************************************************/
listenClick('#newCountryBtn', function () {
  $('#addCountryModal').modal('show');
});
listenHiddenBsModal('#addCountryModal', function () {
  resetModalForm('#addCountryForm');
});
listenSubmit('#addCountryForm', function (e) {
  e.preventDefault();
  var countryUrl = route('countries.store');
  $.ajax({
    url: countryUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addCountryModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.country-edit-btn', function (event) {
  var countryId = $(event.currentTarget).data('id');
  EditCountryRenderData(countryId);
});

function EditCountryRenderData(id) {
  var countryUrl = route('countries.edit', id);
  $.ajax({
    url: countryUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#countryId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editShortCode').val(result.data.short_code);
        $('#editPhoneCode').val(result.data.phone_code);
        $('#editCountryModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

;
listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var countryId = $('#countryId').val();
  var countryUrl = route('countries.update', countryId);
  $.ajax({
    url: countryUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCountryModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.country-delete-btn', function (event) {
  var countryDeleteId = $(event.currentTarget).data('id');
  var url = route('countries.destroy', {
    country: countryDeleteId
  });
  deleteItem(url, 'Country');
});
/******/ })()
;