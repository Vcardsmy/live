'use strict';

listenSubmit('#addEmail', function (e) {
    e.preventDefault();

    $.ajax({
        url: route('email.sub'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {

                displaySuccessMessage(result.message);
                document.getElementById('addEmail').reset();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".navbar-nav .nav-item .nav-link", function () {
    $(".navbar-collapse").collapse('hide');
});
