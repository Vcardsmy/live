/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/assets/js/users/users.js ***!
  \********************************************/
listenClick('.user-is-verified', function () {
  var userId = $(this).data('id');
  var updateUrl = route('users.email-verified', userId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      Livewire.emit('refresh');
      displaySuccessMessage(response.message);
    }
  });
});
listenClick('.user-active', function () {
  var userId = $(this).data('id');
  var updateUrl = route('users.status', userId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      Livewire.emit('refresh');
      displaySuccessMessage(response.message);
    }
  });
});
listenClick('.user-delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('users.destroy', recordId), 'User');
});
listen('contextmenu', '.user-impersonate', function (e) {
  e.preventDefault(); // Stop right click on link

  return false;
});
var control = false;
listen('keyup keydown', function (e) {
  control = e.ctrlKey;
});
listenClick('.user-impersonate', function () {
  if (control) {
    return false; // Stop ctrl + click on link
  }

  var id = $(this).data('id');
  var element = document.createElement('a');
  element.setAttribute('href', route('impersonate', id));
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
  $('.user-impersonate').prop('disabled', true);
});
/******/ })()
;