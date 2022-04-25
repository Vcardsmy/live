listenClick('.user-is-verified', function () {
    let userId = $(this).data('id');
    let updateUrl = route('users.email-verified', userId);
    $.ajax({
        type: 'get',
        url: updateUrl,
        success: function (response) {
            Livewire.emit('refresh');
            displaySuccessMessage(response.message);
        },
    });
});

listenClick('.user-active', function () {
    let userId = $(this).data('id');
    let updateUrl = route('users.status', userId);
    $.ajax({
        type: 'get',
        url: updateUrl,
        success: function (response) {
            Livewire.emit('refresh');
            displaySuccessMessage(response.message);
        },
    });
});

listenClick('.user-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('users.destroy', recordId), 'User');
});

listen('contextmenu', '.user-impersonate', function (e) {
    e.preventDefault(); // Stop right click on link
    return false;
});

var control = false;
listen('keyup keydown', function (e) {
    control = e.ctrlKey;
});

listenClick( '.user-impersonate', function () {
    if (control) {
        return false; // Stop ctrl + click on link
    }
    let id = $(this).data('id');
    let element = document.createElement('a');
    element.setAttribute('href', route('impersonate', id));
    element.setAttribute('data-turbo', false);
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
    $('.user-impersonate').prop('disabled', true);
});

listenSubmit('#userCreateForm', function () {
    if ($.trim($('#userFirstName').val()) == '') {
        displayErrorMessage('First Name field is required.')
        return false
    }

    if ($.trim($('#userLastName').val()) == '') {
        displayErrorMessage('Last Name field is required.')
        return false
    }
});

listenSubmit('#userEditForm', function () {
    if ($.trim($('#userFirstName').val()) == '') {
        displayErrorMessage('First Name field is required.')
        return false
    }

    if ($.trim($('#userLastName').val()) == '') {
        displayErrorMessage('Last Name field is required.')
        return false
    }
});
