
listenClick( '.makePayment', function () {
    let payloadData = {
        plan_id: $(this).data('id'),
        from_pricing: typeof fromPricing != 'undefined'
            ? fromPricing
            : null,
        price: $(this).data('plan-price'),
        payment_type: $('#paymentType option:selected').val(),
    };
    $(this).addClass('disabled');
    $('.makePayment').text('Please Wait...');
    $.post(route('purchase-subscription'), payloadData).done((result) => {
        if (typeof result.data == 'undefined') {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                window.location.href = route('subscription.index');
            }, 3000);

            return true;
        }

        let sessionId = result.data.sessionId;
        stripe.redirectToCheckout({
            sessionId: sessionId,
        }).then(function (result) {
            $(this).
            html(Lang.get('messages.subscription.purchase')).
            removeClass('disabled')
            $('.makePayment').attr('disabled', false);
            displaySuccessMessage(result.message)
        });
    }).catch(error => {
        $(this).
        html(Lang.get('messages.subscription.purchase')).
        removeClass('disabled')
        $('.makePayment').attr('disabled', false);
        displayErrorMessage(error.responseJSON.message)
    });

});

listenChange('#paymentType', function () {
    let paymentType = $(this).val();
    if (isEmpty(paymentType)){
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
    let pricing = typeof fromPricing != 'undefined' ? fromPricing : null;
    $(this).addClass('disabled');
    $.ajax({
        type: 'GET',
        url: route('paypal.init'),
        data: {
            'planId': $(this).data('id'),
            'from_pricing': pricing,
            'payment_type': $('#paymentType option:selected').val(),
        },
        success: function (result) {
            if (result.url) {
                window.location.href = result.url;
            }

            if (result.statusCode === 201) {
                let redirectTo = '';

                $.each(result.result.links,
                    function (key, val) {
                        if (val.rel == 'approve') {
                            redirectTo = val.href
                        }
                    })
                location.href = redirectTo
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
            $('.paymentByPaypal').text('Pay / Switch Plan')
        },
        complete: function () {
        },
    });
});

listenClick('.paymentByRazorPay', function () {

    let pricing = typeof fromPricing != 'undefined' ? fromPricing : null;
    $('.paymentByRazorPay').text('Please Wait...');
    $(this).addClass('disabled');
    $.ajax({
        type: 'GET',
        url: route('razorpay.init'),
        data: {
            'planId': $(this).data('id'),
            'from_pricing': pricing,
            'payment_type': $('#paymentType option:selected').val(),
        },
        success: function (result) {
            if (result.success) {
                let { id, amount, name, email, contact } = result.data

                options.amount = amount
                options.order_id = id
                options.prefill.name = name
                options.prefill.email = email
                options.prefill.contact = contact
                let razorPay = new Razorpay(options)
                razorPay.open()
                razorPay.on('payment.failed')
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
        complete: function () {
        },
    });

});

listenClick('.manuallyPay', function (){
    $('.paymentByRazorPay').text('Please Wait...');
    $(this).addClass('disabled');
    let planId = $(this).attr('data-id')
    let payloadData = {
        planId: $(this).data('id'),
        from_pricing: typeof fromPricing != 'undefined'
            ? fromPricing
            : null,
        price: $(this).data('plan-price'),
        paymentToPay: $('#amountToPay').val(),
        endDate :   $('#planEndDate').val(),
        payment_type: $('#paymentType option:selected').val(),
    };
    $.ajax({
        type: 'POST',
        url: route('subscription.manual', planId),
        data: payloadData,
        success: function (result) {
            displaySuccessMessage(result.message)
            window.location.href = route('subscription.index');
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
        complete: function () {
        },
    });
    
})

listenClick( '.plan-zero', function () {
    let planId = $(this).attr('data-id')
    $(this).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"> </span>
            </div> ${Lang.get('messages.common.loading')}`).addClass('disabled')
    $.post(route('subscription.plan-zero', planId)).done((result) => {
        displaySuccessMessage(result.message)
        setTimeout(function () {
            location.replace(route('subscription.index'))
        }, 2000)
    }).catch(error => {
        $(this).attr('disabled', false)
        $(this).
            html(Lang.get('messages.subscription.purchase')).
            removeClass('disabled')
        displayErrorMessage(error.responseJSON.message)
    })
})

listenClick('.freePayment', function () {
    if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata ==
        '') {
        window.location.href = route('login');

        return true;
    }

    if ($(this).data('plan-price') === 0) {
        $(this).addClass('disabled');
        let data = {
            plan_id: $(this).data('id'),
            price: $(this).data('plan-price'),
        };
        $.post(route('purchase-subscription'), data).done((result) => {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                location.reload();
            }, 5000);
        }).catch(error => {
            $(this).html(Lang.get('messages.subscription.choose_plan')).removeClass('disabled');
            $('.freePayment').attr('disabled', false);
            displayErrorMessage(error.responseJSON.message);
        });

        return true;
    }
});
