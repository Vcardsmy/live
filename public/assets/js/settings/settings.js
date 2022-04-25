/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/assets/js/settings/settings.js ***!
  \**************************************************/


listenChange('#appLogo', function () {
  displayPhoto(this, '#appLogo');
});
listenClick('.cancel-app-logo', function () {
  $('#appLogo').attr('src', defaultAppLogoUrl);
});
listenChange('#favicon', function () {
  displayPhoto(this, '#favicon');
});
listenClick('.cancel-favicon', function () {
  $('#favicon').attr('src', defaultFaviconUrl);
});
var form = document.getElementById('createSetting');
var phone = document.getElementById('phoneNumber').value;

function reset() {
  document.getElementById('phoneNumber').setAttribute('value', phone);
}

form.addEventListener('reset', reset);
/******/ })()
;