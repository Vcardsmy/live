/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/sadmin/cities/cities.js ***!
  \*****************************************************/
listenClick('#newCityBtn', function () {
  $('#addCityModal').modal('show');
});
$(document).on('select2:open', function () {
  document.querySelector('.select2-search__field').focus();
});
listenHiddenBsModal('#addCityModal', function (e) {
  $('#addNewForm')[0].reset();
  $('#StateCity').val(null).trigger('change');
});
listenSubmit('#addNewForm', function (e) {
  e.preventDefault();
  var cityUrl = route('cities.store');
  $.ajax({
    url: cityUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addCityModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.city-edit-btn', function (event) {
  var cityId = $(event.currentTarget).data('id');
  EditCityRenderData(cityId);
});

function EditCityRenderData(id) {
  var cityUrl = route('cities.edit', id);
  $.ajax({
    url: cityUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#cityId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editStateId').val(result.data.state_id).trigger('change');
        $('#editCityModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var cityId = $('#cityId').val();
  var cityUrl = route('cities.update', cityId);
  $.ajax({
    url: cityUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCityModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.city-delete-btn', function (event) {
  var deleteCityID = $(event.currentTarget).data('id');
  var url = route('cities.destroy', {
    city: deleteCityID
  });
  deleteItem(url, 'City');
});
/******/ })()
;