/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/vcards/template.js ***!
  \************************************************/
listenClick('.copy-clipboard', function () {
  var vcardId = $(this).data('id');
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val($('#vcardUrl' + vcardId).text()).select();
  document.execCommand('copy');
  $temp.remove();
  displaySuccessMessage('copied successfully');
});
/******/ })()
;