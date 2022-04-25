/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/users/create-edit.js ***!
  \**************************************************/
listenChange('#profile', function () {
  var validFile = isValidFile($(this), '#profileValidationErrors');

  if (validFile) {
    displayPhoto(this, '#profilePreview');
  } else {
    $('#profilePreview').attr('src', defaultProfileUrl);
  }
});
listenClick('.cancel-profile', function () {
  $('#profilePreview').attr('src', defaultProfileUrl);
});
/******/ })()
;