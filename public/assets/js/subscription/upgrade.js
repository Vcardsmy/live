/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/subscription/upgrade.js ***!
  \*****************************************************/
listenClick('.makePayment', function () {
  var _this = this;

  var payloadData = {
    plan_id: $(this).data('id'),
    from_pricing: typeof fromPricing != 'undefined' ? fromPricing : null,
    price: $(this).data('plan-price'),
    payment_type: $('#paymentType option:selected').val()
  };
  $(this).addClass('disabled');
  $('.makePayment').text('Please Wait...');
  $.post(route('purchase-subscription'), payloadData).done(function (result) {
    if (typeof result.data == 'undefined') {
      displaySuccessMessage(result.message);
      setTimeout(function () {
        window.location.href = subscriptionPlans;
      }, 3000);
      return true;
    }

    var sessionId = result.data.sessionId;
    stripe.redirectToCheckout({
      sessionId: sessionId
    }).then(function (result) {
      $(this).html(Lang.get('messages.subscription.purchase')).removeClass('disabled');
      $('.makePayment').attr('disabled', false);
      displaySuccessMessage(result.message);
    });
  })["catch"](function (error) {
    $(_this).html(Lang.get('messages.subscription.purchase')).removeClass('disabled');
    $('.makePayment').attr('disabled', false);
    displayErrorMessage(error.responseJSON.message);
  });
});
listenChange('#paymentType', function () {
  var paymentType = $(this).val();

  if (isEmpty(paymentType)) {
    $('.proceed-to-payment').addClass('d-none');
    $('.RazorPayPayment').addClass('d-none');
    $('.stripePayment').addClass('d-none');
    $('.ManuallyPayment').addClass('d-none');
  }

  if (paymentType == 1) {
    $('.proceed-to-payment').addClass('d-none');
    $('.RazorPayPayment').addClass('d-none');
    $('.stripePayment').removeClass('d-none');
    $('.ManuallyPayment').addClass('d-none');
  }

  if (paymentType == 2) {
    $('.proceed-to-payment').addClass('d-none');
    $('.paypalPayment').removeClass('d-none');
    $('.RazorPayPayment').addClass('d-none');
    $('.ManuallyPayment').addClass('d-none');
  }

  if (paymentType == 3) {
    $('.proceed-to-payment').addClass('d-none');
    $('.paypalPayment').addClass('d-none');
    $('.RazorPayPayment').removeClass('d-none');
    $('.ManuallyPayment').addClass('d-none');
  }

  if (paymentType == 4) {
    $('.proceed-to-payment').addClass('d-none');
    $('.paypalPayment').addClass('d-none');
    $('.RazorPayPayment').addClass('d-none');
    $('.ManuallyPayment').removeClass('d-none');
  }
});
listenClick('.paymentByPaypal', function () {
  $('.paymentByPaypal').text('Please Wait...');
  var pricing = typeof fromPricing != 'undefined' ? fromPricing : null;
  $(this).addClass('disabled');
  $.ajax({
    type: 'GET',
    url: route('paypal.init'),
    data: {
      'planId': $(this).data('id'),
      'from_pricing': pricing,
      'payment_type': $('#paymentType option:selected').val()
    },
    success: function success(result) {
      if (result.url) {
        window.location.href = result.url;
      }

      if (result.statusCode === 201) {
        var redirectTo = '';
        $.each(result.result.links, function (key, val) {
          if (val.rel == 'approve') {
            redirectTo = val.href;
          }
        });
        location.href = redirectTo;
      }
    },
    error: function error(_error) {
      displayErrorMessage(_error.responseJSON.message);
      $('.paymentByPaypal').text('Pay / Switch Plan');
    },
    complete: function complete() {}
  });
});
listenClick('.paymentByRazorPay', function () {
  var pricing = typeof fromPricing != 'undefined' ? fromPricing : null;
  $('.paymentByRazorPay').text('Please Wait...');
  $(this).addClass('disabled');
  $.ajax({
    type: 'GET',
    url: route('razorpay.init'),
    data: {
      'planId': $(this).data('id'),
      'from_pricing': pricing,
      'payment_type': $('#paymentType option:selected').val()
    },
    success: function success(result) {
      if (result.success) {
        var _result$data = result.data,
            id = _result$data.id,
            amount = _result$data.amount,
            name = _result$data.name,
            email = _result$data.email,
            contact = _result$data.contact;
        options.amount = amount;
        options.order_id = id;
        options.prefill.name = name;
        options.prefill.email = email;
        options.prefill.contact = contact;
        var razorPay = new Razorpay(options);
        razorPay.open();
        razorPay.on('payment.failed');
      }
    },
    error: function error(_error2) {
      displayErrorMessage(_error2.responseJSON.message);
    },
    complete: function complete() {}
  });
});
listenClick('.manuallyPay', function () {
  $('.paymentByRazorPay').text('Please Wait...');
  $(this).addClass('disabled');
  var planId = $(this).attr('data-id');
  var payloadData = {
    planId: $(this).data('id'),
    from_pricing: typeof fromPricing != 'undefined' ? fromPricing : null,
    price: $(this).data('plan-price'),
    paymentToPay: paymentPay,
    endDate: endDate,
    payment_type: $('#paymentType option:selected').val()
  };
  $.ajax({
    type: 'POST',
    url: route('subscription.manual', planId),
    data: payloadData,
    success: function success(result) {
      displaySuccessMessage(result.message);
      window.location.href = subscriptionPlans;
    },
    error: function error(_error3) {
      displayErrorMessage(_error3.responseJSON.message);
    },
    complete: function complete() {}
  });
});
listenClick('.plan-zero', function () {
  var _this2 = this;

  var planId = $(this).attr('data-id');
  $(this).html("\n            <div class=\"spinner-border spinner-border-sm\" role=\"status\">\n                <span class=\"sr-only\"> </span>\n            </div> ".concat(Lang.get('messages.common.loading'))).addClass('disabled');
  $.post(route('subscription.plan-zero', planId)).done(function (result) {
    displaySuccessMessage(result.message);
    setTimeout(function () {
      location.replace(route('subscription.index'));
    }, 2000);
  })["catch"](function (error) {
    $(_this2).attr('disabled', false);
    $(_this2).html(Lang.get('messages.subscription.purchase')).removeClass('disabled');
    displayErrorMessage(error.responseJSON.message);
  });
});
listenClick('.freePayment', function () {
  var _this3 = this;

  if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata == '') {
    window.location.href = route('login');
    return true;
  }

  if ($(this).data('plan-price') === 0) {
    $(this).addClass('disabled');
    var data = {
      plan_id: $(this).data('id'),
      price: $(this).data('plan-price')
    };
    $.post(route('purchase-subscription'), data).done(function (result) {
      displaySuccessMessage(result.message);
      setTimeout(function () {
        location.reload();
      }, 5000);
    })["catch"](function (error) {
      $(_this3).html(Lang.get('messages.subscription.choose_plan')).removeClass('disabled');
      $('.freePayment').attr('disabled', false);
      displayErrorMessage(error.responseJSON.message);
    });
    return true;
  }
});
/******/ })()
;