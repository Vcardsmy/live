
listenClick('#planStatus', function () {
    let planId = $(this).data('id')
    let updateUrl = route('plan.status', planId)
    $.ajax({
        type: 'get',
        url: updateUrl,
        success: function (response) {
            displaySuccessMessage(response.message)
            $('#userTable').DataTable().ajax.reload()
        },
    })
})

listen('click', '.plan-delete-btn', function (event) {
    let deletePlanId = $(event.currentTarget).data('id')
    let url = route('plans.destroy', { plan: deletePlanId })
    deleteItem(url, 'Plan')
})

listenChange('.is_default', function (event) {
    let subscriptionPlanId = $(event.currentTarget).data('id');
    $.ajax({
        url: route('make.plan.default',subscriptionPlanId),
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.emit('refresh')
            }
        },
    });
});
