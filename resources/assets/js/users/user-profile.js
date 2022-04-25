listenClick('#changePassword', function() {
    $('#changePasswordModal').modal('show').appendTo('body');
});

listenClick('#changeLanguage', function() {
    $('#changeLanguageModal').modal('show').appendTo('body');
});

listenHiddenBsModal( ['#changeLanguageModal','#changePasswordModal'], function () {
    $("#changeLanguageForm")[0].reset();
    $("#changePasswordForm")[0].reset();

    $('select.select2Selector').each(function (index, element) {
        var drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val(getLoggedInUserLang);
        $(drpSelector).trigger('change');
    });
});

listenClick('#languageChangeBtn', function() {
    $.ajax({
        url: route('user.changeLanguage'),
        type: 'PUT',
        data: $('#changeLanguageForm').serialize(),
        success: function (result) {
            $('#changeLanguageModal').modal('hide');
            displaySuccessMessage(result.message);
            location.reload();
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
})

listenClick('#passwordChangeBtn', function() {
    $.ajax({
        url: route('user.changePassword'),
        type: 'PUT',
        data: $('#changePasswordForm').serialize(),
        success: function (result) {
            $('#changePasswordModal').modal('hide');
            displaySuccessMessage(result.message);
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

function printErrorMessage(selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};
