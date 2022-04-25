/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/assets/js/sadmin/plans/plans.js ***!
  \***************************************************/
listenClick('#planStatus', function () {
  var planId = $(this).data('id');
  var updateUrl = route('plan.status', planId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      displaySuccessMessage(response.message);
      $('#userTable').DataTable().ajax.reload();
    }
  });
});
listen('click', '.plan-delete-btn', function (event) {
  var deletePlanId = $(event.currentTarget).data('id');
  var url = route('plans.destroy', {
    plan: deletePlanId
  });
  deleteItem(url, 'Plan');
});
listenChange('.is_default', function (event) {
  var subscriptionPlanId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('make.plan.default', subscriptionPlanId),
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        Livewire.emit('refresh');
      }
    }
  });
});
/******/ })()
;