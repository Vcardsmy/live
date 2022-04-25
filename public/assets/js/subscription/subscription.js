/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/assets/js/subscription/subscription.js ***!
  \**********************************************************/
var paymentTable = '#paymentTable';
listenClick('#planStatus', function () {
  $(this).attr('disabled', true);
  var planId = $(this).data('id');
  var tenantId = $(this).data('tenant');
  var updateStatus = route('subscription.status', planId);
  $.ajax({
    type: 'get',
    url: updateStatus,
    data: {
      'id': planId,
      'tenant_id': tenantId
    },
    success: function success(response) {
      displaySuccessMessage(response.message);
      Livewire.emit('refresh');
    }
  });
});
listenClick('.subscribed-user-plan-edit-btn', function (event) {
  var SubscriptionId = $(event.currentTarget).data('id');
  $('#editSubscriptionModal').modal('show');
  editSubscriptionRenderData(SubscriptionId);
});

function editSubscriptionRenderData(id) {
  var SubscriptionUrl = route('subscription.user.plan.edit', id);
  $.ajax({
    url: SubscriptionUrl,
    type: 'GET',
    data: {
      'id': id
    },
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#SubscriptionId').val(result.data.id);
        $('#EndDate').val(result.data.ends_at);
      }

      $('#EndDate').flatpickr({
        minDate: result.data.ends_at,
        disableMobile: true,
        dateFormat: 'Y-m-d'
      });
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var subscriptionId = $('#SubscriptionId').val();
  var subscriptionUrl = route('subscription.user.plan.update', subscriptionId);
  $.ajax({
    url: subscriptionUrl,
    type: 'get',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editSubscriptionModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenHiddenBsModal('#editSubscriptionModal', function (e) {
  $('#editForm')[0].reset();
});
/******/ })()
;