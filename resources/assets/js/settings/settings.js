document.addEventListener('turbo:load', loadSettingData);

let form;
let phone;
let prefixCode;
function loadSettingData() {
    if (!$('#createSetting').length) {
        return
    }
    form = document.getElementById('createSetting');
    
    form.addEventListener('reset', reset);
    
    phone = document.getElementById('phoneNumber').value;
    prefixCode = document.getElementById('prefix_code').value;
}

listenChange( '#appLogo', function () {
    displayPhoto(this, '#appLogo');
});

listenClick('.cancel-app-logo', function () {
    $('#appLogo').attr('src', defaultAppLogoUrl);
});

listenChange( '#favicon', function () {
    displayPhoto(this, '#favicon');
});

listenClick( '.cancel-favicon', function () {
    $('#favicon').attr('src', defaultFaviconUrl);
});

function reset () {
    document.getElementById('phoneNumber').
        setAttribute('value', phone);
    document.getElementById('prefix_code').setAttribute('value', '+'+prefixCode);
}

function isEmail(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

listenSubmit('#createSetting', function () {
   
    if ($.trim($('#settingAppName').val()) == '') {
        displayErrorMessage('App Name field is required.')
        return false
    }

    if (!isEmail($('#settingEmail').val())) {
        displayErrorMessage('Please enter valid email.')
        return false
    }

    if ($.trim($('#phoneNumber').val()) == '') {
        displayErrorMessage('Phone Number field is required.')
        return false
    }

    if ($.trim($('#settingPlanExpireNotification').val()) == '') {
        displayErrorMessage('Plan Expire Notification field is required.')
        return false
    }

    if ($.trim($('#settingAddress').val()) == '') {
        displayErrorMessage('Address field is required.')
        return false
    }
    
});
