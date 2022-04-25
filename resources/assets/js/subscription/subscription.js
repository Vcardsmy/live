
listenClick('#planStatus', function () {
    $(this).attr('disabled', true);
    let planId = $(this).data('id');
    let tenantId = $(this).data('tenant');
    let updateStatus = route('subscription.status', planId);
    $.ajax({
        type: 'get',
        url: updateStatus,
        data: {
            'id': planId,
            'tenant_id': tenantId,
        },
        success: function (response) {
            displaySuccessMessage(response.message);
            Livewire.emit('refresh')
        },
    });
});

listenClick('.subscribed-user-plan-edit-btn', function (event) {
    let SubscriptionId = $(event.currentTarget).data('id');
    $('#editSubscriptionModal').modal('show');
    editSubscriptionRenderData(SubscriptionId);
});

function editSubscriptionRenderData (id) {
    let SubscriptionUrl = route('subscription.user.plan.edit', id);
    $.ajax({
        url: SubscriptionUrl,
        type: 'GET',
        data: {
            'id': id,
        },
        success: function (result) {
            if (result.success) {
                Livewire.emit('refresh', 'refresh')
                $('#SubscriptionId').val(result.data.id);
                $('#EndDate').val(result.data.ends_at);
            }

            $('#EndDate').flatpickr({
                minDate: result.data.ends_at,
                disableMobile: true,
                dateFormat: 'Y-m-d',
            });

        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listenSubmit('#editSubscriptionForm', function (event) {
    event.preventDefault();
    let subscriptionId = $('#SubscriptionId').val();
    let subscriptionUrl = route('subscription.user.plan.update', subscriptionId);
    $.ajax({
        url: subscriptionUrl,
        type: 'get',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editSubscriptionModal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenHiddenBsModal('#editSubscriptionModal', function (e) {
    $('#editSubscriptionForm')[0].reset();
});


