/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/home_page/home_page.js ***!
  \****************************************************/


listenSubmit('#addEmail', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('email.sub'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        document.getElementById('addEmail').reset();
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick(".navbar-nav .nav-item .nav-link", function () {
  $(".navbar-collapse").collapse('hide');
});
/******/ })()
;