
listenClick( '#addGalleryBtn', function () {
    $('#addGalleryModal').modal('show')
});


listenHiddenBsModal('#addGalleryModal', function (e) {
    $('#addGalleryForm')[0].reset();
    $('#typeId').val(null).trigger('change');
    $('#addGalleryPreview').attr('src', defaultGalleryUrl);
    $('.youtube_link').addClass('d-none');
    $('.image_link').removeClass('d-none');
    $('.cancel-gallery').hide();
})


listenClick( '.cancel-gallery', function () {
    $('#addGalleryPreview').attr('src', defaultGalleryUrl)
})

listenChange('#typeId',function() {
    let type = $(this).val();
    if(type==0)
    {
        $('.youtube_link').addClass('d-none');
        $('.image_link').removeClass('d-none');
        $('#linkRequired').attr('required',false);
    }
    else if(type == 1) {
        $('.image_link').addClass('d-none');
        $('.youtube_link').removeClass('d-none');
        $('#linkRequired').attr('required',true);
    }
});

listenChange('#editTypeId',function() {
    let type = $(this).val();
    if(type==0)
    {
        $('.editYouTubeLink').addClass('d-none');
        $('.editImagelink').removeClass('d-none');
        $('#editYouTube_Link').attr('required',false);
    }
    else if(type == 1) {
        $('.editYouTubeLink').removeClass('d-none');
        $('.editImagelink').addClass('d-none');
        $('#editYouTube_Link').attr('required',true);
    }
});

listenSubmit( '#addGalleryForm', function (e) {
    e.preventDefault()
    $('#GallerySave').prop('disabled', true);
    $.ajax({
        url: route('gallery.store'),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addGalleryModal').modal('hide')
                $('#addGalleryForm').trigger('reset');
                $('#GallerySave').prop('disabled', false);
                Livewire.emit('refresh');            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#GallerySave').prop('disabled', false);
        },
    });
});

listenClick( '.gallery-edit-btn', function (event) {
    let GalleryId = $(event.currentTarget).data('id')
    editGalleryRenderData(GalleryId)
});
let galleryUrl = ''
function editGalleryRenderData(id) {
    $.ajax({
        url: route('gallery.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#galleryId').val(result.data.id)
                $('#editTypeId').val(result.data.type).trigger('change');
                $('#editGalleryPreview').attr('src', result.data.gallery_image)
                $('#editYouTube_Link').val(result.data.link)
                $('#editGalleryModal').modal('show')
                galleryUrl = result.data.gallery_image
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
}

listenHiddenBsModal( '#editGalleryModal', function () {
    $('.edit-cancel-gallery').hide();
})

listenChange( '#editImage', function () {
    changeImg(this, '#editGalleryValidationErrors', '#editGalleryPreview',
        galleryUrl)
    $('.edit-cancel-gallery').show();

});

listenClick( '.edit-cancel-gallery', function () {
    $('#editGalleryPreview').attr('src', galleryUrl)
})

listenChange('#addImage', function () {
    changeImg(this, '#addGalleryValidationErrors', '#addGalleryPreview',
        galleryUrl)
    $('.cancel-gallery').show();
});

listenSubmit( '#editGalleryForm', function (event) {
    event.preventDefault()
    $('#editGallerySave').prop('disabled', true);
    let galleryId = $('#galleryId').val()
    $.ajax({
        url: route('gallery.update', galleryId),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editGalleryModal').modal('hide')
                $('#editGalleryForm').trigger('reset')
                $('#editGallerySave').prop('disabled', false);
                Livewire.emit('refresh');
                $('.edit-cancel-gallery').hide();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    });
});

listenClick('.gallery-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('gallery.destroy', recordId),
        Lang.get('messages.vcard.gallery'));
})
