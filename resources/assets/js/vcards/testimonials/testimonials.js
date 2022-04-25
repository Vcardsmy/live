listenClick( '#addTestimonialBtn', function () {
    $('#addTestimonialModal').modal('show')
})

listenHiddenBsModal( '#addTestimonialModal', function () {
    resetModalForm('#addTestimonialForm')
    $('#testimonialPreview').attr('src', defaultProfileUrl)
    $(".cancel-testimonial").hide();
})

listenChange('#testimonialImg', function () {
    changeImg(this, '#testimonialImgValidation', '#testimonialPreview',
        defaultProfileUrl)
    $(".cancel-testimonial").show();
})

listenHiddenBsModal( '#editTestimonialModal', function () {
    $(".cancel-edit-testimonial").hide();
})

listenClick( '.cancel-testimonial', function () {
    $('#testimonialPreview').attr('src', defaultProfileUrl)
})

listenSubmit( '#addTestimonialForm', function (e) {
    e.preventDefault()
    $('#testimonialSave').prop('disabled', true);
    $.ajax({
        url: route('testimonial.store'),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addTestimonialModal').modal('hide');
                Livewire.emit('refresh');
                $('#testimonialSave').prop('disabled', false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#testimonialSave').prop('disabled', false);
        },
    })
})

listenClick( '.testimonial-edit-btn', function (event) {
    let testimonialId = $(event.currentTarget).data('id')
    edittestimonialRenderData(testimonialId)
})

let testimonialImgUrl = ''
 function edittestimonialRenderData(id) {
    $.ajax({
        url: route('testimonial.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#testimonialId').val(result.data.id)
                $('#editName').val(result.data.name)
                $('#editDescription').val(result.data.description)
                $('#editTestimonialPreview').attr('src', result.data.image_url)
                $('#editTestimonialModal').modal('show')
                testimonialImgUrl = result.data.image_url
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listenChange( '#editTestimonialImg', function () {
    changeImg(this, '#editTestimonialImgValidation', '#editTestimonialPreview',
        testimonialImgUrl)
    $(".cancel-edit-testimonial").show();
})

listenClick( '.cancel-edit-testimonial', function () {
    $('#editTestimonialPreview').attr('src', testimonialImgUrl)
})

listenHiddenBsModal( '#showTestimonialModal', function () {
    $('#showName,#showDesc').empty()
    $('#servicePreview').attr('src', defaultProfileUrl)
})

listenSubmit('#editTestimonialForm', function (event) {
    event.preventDefault()
    let testimonialId = $('#testimonialId').val()
    $.ajax({
        url: route('testimonial.update', testimonialId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editTestimonialModal').modal('hide');
                Livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('click', '.testimonial-delete-btn', function (event) {
    let testimonialDeleteId = $(event.currentTarget).data('id')
    let url = route('testimonial.destroy', {testimonial: testimonialDeleteId })
    deleteItem(url, 'Vcard Testimonial')
})

listenClick( '.testimonial-view-btn', function (event) {
    let vcardTestimonailId = $(event.currentTarget).data('id');
    vcardTestimonailRenderDataShow(vcardTestimonailId);
});

 function vcardTestimonailRenderDataShow(id) {
    $.ajax({
        url: route('testimonial.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').append(result.data.name);
                let element = document.createElement('textarea');
                element.innerHTML = result.data.description;
                $('#showDesc').append(element.value);
                $('#showTestimonialIcon').attr('src', result.data.image_url);
                $('#showTestimonialModal').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
