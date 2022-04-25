
listenClick('#addTestimonialBtn', function () {
    $('#addFrontTestimonialModal').modal('show');
});

listenHiddenBsModal( '#addFrontTestimonialModal', function () {
    resetModalForm('#addFrontTestimonialForm');
    $('#testimonialPreview').attr('src', defaultProfileUrl);
    $(".cancel-testimonial").hide();
});
listenChange('#testimonialImg', function () {
    changeImg(this, '#testimonialImgValidation', '#testimonialPreview',
        defaultProfileUrl);
    $(".cancel-testimonial").show();
});


listenHiddenBsModal( '#editTestimonialModal', function () {
    $(".cancel-edit-testimonial").hide();
})
listenClick('.cancel-testimonial', function () {
    $('#testimonialPreview').attr('src', defaultProfileUrl);
});

listenClick( '.view-testimonial-btn', function (event) {
    let frontTestimonailId = $(event.currentTarget).data('id');
    TestimonialRenderDataShow(frontTestimonailId);
});
 function TestimonialRenderDataShow(id) {
    $.ajax({
        url: route('frontTestimonial.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').append(result.data.name);
                let element = document.createElement('textarea');
                element.innerHTML = result.data.description;
                $('#showDesc').append(element.value);
                $('#showTestimonialIcon').attr('src', result.data.testimonial_url);
                $('#showTestimonialModal').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

listenSubmit( '#addFrontTestimonialForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('frontTestimonial.store'),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addFrontTestimonialModal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

let testimonialImgUrl = '';
function EditTestimonialRenderData(id) {
    $.ajax({
        url: route('frontTestimonial.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#testimonialId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.description);
                $('#editTestimonialPreview').
                    attr('src', result.data.testimonial_url);
                $('#editTestimonialModal').modal('show');
                testimonialImgUrl = result.data.testimonial_url;
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

listenChange( '#editTestimonialImg', function () {
    changeImg(this, '#editTestimonialImgValidation', '#editTestimonialPreview',
        testimonialImgUrl);
});

listenHiddenBsModal( '#showTestimonialModal', function () {
    $('#showName,#showDesc').empty()
    $('#servicePreview').attr('src', defaultProfileUrl)
})

listenClick('.cancel-edit-testimonial', function () {
    $('#editTestimonialPreview').attr('src', testimonialImgUrl);
});

listenClick('.front-testimonial-edit-btn', function (event) {
    let testimonialId = $(event.currentTarget).data('id');
    EditTestimonialRenderData(testimonialId);
});

listenSubmit('#editFrontTestimonialForm', function (e) {
    e.preventDefault();
    let testimonialId = $('#testimonialId').val();
    $.ajax({
        url: route('frontTestimonial.updateData', testimonialId),
        method: 'post',
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editTestimonialModal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listen('click', '.front-testimonial-delete-btn', function (event) {
    let deleteFrontTestimonialId = $(event.currentTarget).data('id')
    let url = route('frontTestimonial.destroy', { frontTestimonial: deleteFrontTestimonialId })
    deleteItem(url, Lang.get('messages.vcard.testimonial'))
})
