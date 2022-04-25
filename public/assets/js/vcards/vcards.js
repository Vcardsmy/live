/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/assets/js/vcards/vcards.js ***!
  \**********************************************/
$(document).on('click', '#vcardStatus', function () {
  var vcardId = $(this).data('id');
  var updateUrl = route('vcard.status', vcardId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      displaySuccessMessage(response.message);
      Livewire.emit('refresh');
    }
  });
});
$(document).on('click', '.copy-clipboard', function () {
  var vcardId = $(this).data('id');
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val($('#vcardUrl' + vcardId).text()).select();
  document.execCommand('copy');
  $temp.remove();
  displaySuccessMessage('copied successfully');
});
listen('click', '.vcard_delete-btn', function (event) {
  var vcardDeleteId = $(event.currentTarget).data('id');
  var url = route('vcards.destroy', {
    vcard: vcardDeleteId
  });
  deleteItem(url, 'VCard');
});

window.deleteVcard = function (url, header) {
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
    confirmButtonColor: '#009ef7'
  }).then(function (result) {
    if (result.isConfirmed) {
      deleteVcardAjax(url, header, callFunction);
    }
  });
};

function deleteVcardAjax(url, header) {
  var callFunction = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  $.ajax({
    url: url,
    type: 'DELETE',
    dataType: 'json',
    success: function success(obj) {
      if (obj.success) {
        Livewire.emit('refresh');
      }

      obj.data.make_vcard ? $('.create-vcard-btn').removeClass('d-none') : $('.create-vcard-btn').addClass('d-none');
      Swal.fire({
        title: Lang.get('messages.common.deleted') + ' !',
        text: header + Lang.get('messages.common.has_been_deleted'),
        icon: 'success',
        timer: 2000,
        confirmButtonColor: '#009ef7'
      });

      if (callFunction) {
        eval(callFunction);
      }
    },
    error: function error(data) {
      Swal.fire({
        title: 'Error',
        icon: 'error',
        text: data.responseJSON.message,
        type: 'error',
        timer: 5000,
        confirmButtonColor: '#009ef7'
      });
    }
  });
}
/******/ })()
;