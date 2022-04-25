/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/email_sub/email-sub.js ***!
  \****************************************************/
listen('click', '.email-subscribe-delete-btn', function (event) {
  var deleteEmailId = $(event.currentTarget).data('id');
  var url = route('email.sub.destroy', {
    emailSubscription: deleteEmailId
  });
  deleteItem(url, Lang.get('messages.subscriptions'));
});
/******/ })()
;