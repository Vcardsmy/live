listenClick( '#addServiceBtn', function () {
    $('#addServiceModal').modal('show')
})

listenHiddenBsModal( '#addServiceModal', function () {
    resetModalForm('#addServiceForm')
    $('#servicePreview').attr('src', defaultServiceIconUrl)
    $(".cancel-service").hide();
})

listenHiddenBsModal( '#showServiceModal', function () {
    $('#showName,#showDesc').empty()
    $('#servicePreview').attr('src', defaultServiceIconUrl)
})

listenHiddenBsModal( '#editServiceModal', function () {
    $('.cancel-edit-service').hide();
})


listenChange( '#serviceIcon', function () {
    changeImg(this, '#serviceIconValidationErrors', '#servicePreview',
        defaultServiceIconUrl)
    $(".cancel-service").show();
})

listenClick( '.cancel-service', function () {
    $('#servicePreview').attr('src', defaultServiceIconUrl)
})

listenSubmit('#addServiceForm', function (e) {
    e.preventDefault()
    $('#serviceSave').prop('disabled',true)
    $.ajax({
        url: route('vcard.service.store'),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addServiceModal').modal('hide');
                Livewire.emit('refresh');
                $('#serviceSave').prop('disabled', false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#serviceSave').prop('disabled',false)
        },
    })
})

listenClick( '.service-edit-btn', function (event) {
    let vcardServiceId = $(event.currentTarget).data('id')
    editVcardServiceRenderData(vcardServiceId)
})

let serviceIconUrl = ''
 function editVcardServiceRenderData(id) {
    $.ajax({
        url: route('vcard.service.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#serviceId').val(result.data.id)
                $('#editName').val(result.data.name)
                $('#editDescription').val(result.data.description)
                $('#editServicePreview').attr('src', result.data.service_icon)
                $('#editServiceModal').modal('show')
                serviceIconUrl = result.data.service_icon
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listenChange('#editServiceIcon', function () {
    changeImg(this, '#editServiceIconValidation', '#editServicePreview',
        serviceIconUrl)
    $('.cancel-edit-service').show();
})

listenClick( '.cancel-edit-service', function () {
    $('#editServicePreview').attr('src', serviceIconUrl)
})

listenSubmit( '#editServiceForm', function (event) {
    event.preventDefault()
    let vcardServiceId = $('#serviceId').val()
    $.ajax({
        url: route('vcard.service.update', vcardServiceId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editServiceModal').modal('hide');
                Livewire.emit('refresh');
                $('.cancel-edit-service').hide();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick( '.service-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('vcard.service.destroy', recordId),
        'Vcard Service');
})

listenClick( '.service-view-btn', function (event) {
    let vcardServiceId = $(event.currentTarget).data('id')
    vcardServiceRenderDataShow(vcardServiceId)
})

 function vcardServiceRenderDataShow(id) {
    $.ajax({
        url: route('vcard.service.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').append(result.data.name)
                let element = document.createElement('textarea')
                element.innerHTML = result.data.description
                $('#showDesc').append(element.value)
                $('#showServiceIcon').attr('src', result.data.service_icon)
                $('#showServiceModal').modal('show')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}
