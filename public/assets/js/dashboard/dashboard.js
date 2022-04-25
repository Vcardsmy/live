/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/dashboard/dashboard.js ***!
  \****************************************************/
document.addEventListener('DOMContentLoaded', clickDayData);
document.addEventListener('DOMContentLoaded', appointmentsDataAjax);
listenClick('#dayData', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('usersData.dashboard'),
    type: 'GET',
    data: {
      day: 'day'
    },
    success: function success(result) {
      if (result.success) {
        $('#dailyReport').empty();
        $(document).find('#month').removeClass('show active');
        $(document).find('#week').removeClass('show active');
        $(document).find('#day').addClass('show active');

        if (result.data.users.data != '') {
          $.each(result.data.users.data, function (index, value) {
            var data = [{
              'name': value.first_name + ' ' + value.last_name,
              'email': value.email,
              'contact': !isEmpty(value.contact) ? '+' + value.region_code + ' ' + value.contact : 'N/A',
              'registered': moment.parseZone(value.created_at).format('Do MMM Y hh:mm A')
            }];
            $(document).find('#dailyReport').append(prepareTemplateRender('#sadminDashboardTemplate', data));
          });
        } else {
          $(document).find('#dailyReport').append("\n                    <tr class=\"text-center\">\n                        <td colspan=\"5\" class=\"text-muted fw-bold\">".concat(noData, "</td>\n                    </tr>"));
        }
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

function clickDayData() {
  if (!$('#dayData').length) {
    return;
  }

  $('#dayData').click();
}

listenClick('#weekData', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('usersData.dashboard'),
    type: 'GET',
    data: {
      week: 'week'
    },
    success: function success(result) {
      if (result.success) {
        $('#weeklyReport').empty();
        $(document).find('#month').removeClass('show active');
        $(document).find('#week').addClass('show active');
        $(document).find('#day').removeClass('show active');

        if (result.data.users.data != '') {
          $.each(result.data.users.data, function (index, value) {
            var data = [{
              'name': value.first_name + ' ' + value.last_name,
              'email': value.email,
              'contact': !isEmpty(value.contact) ? '+' + value.region_code + ' ' + value.contact : 'N/A',
              'registered': moment.parseZone(value.created_at).format('Do MMM Y hh:mm A')
            }];
            $(document).find('#weeklyReport').append(prepareTemplateRender('#sadminDashboardTemplate', data));
          });
        } else {
          $(document).find('#weeklyReport').append("\n                    <tr class=\"text-center\">\n                        <td colspan=\"5\" class=\"text-muted fw-bold\">".concat(noData, "</td>\n                    </tr>"));
        }
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('#monthData', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('usersData.dashboard'),
    type: 'GET',
    data: {
      month: 'month'
    },
    success: function success(result) {
      if (result.success) {
        $('#monthlyReport').empty();
        $(document).find('#month').addClass('show active');
        $(document).find('#week').removeClass('show active');
        $(document).find('#day').removeClass('show active');

        if (result.data.users.data != '') {
          $.each(result.data.users.data, function (index, value) {
            var data = [{
              'name': value.first_name + ' ' + value.last_name,
              'email': value.email,
              'contact': !isEmpty(value.contact) ? '+' + value.region_code + ' ' + value.contact : 'N/A',
              'registered': moment.parseZone(value.created_at).format('Do MMM Y hh:mm A')
            }];
            $(document).find('#monthlyReport').append(prepareTemplateRender('#sadminDashboardTemplate', data));
          });
        } else {
          $(document).find('#monthlyReport').append("\n                    <tr class=\"text-center\">\n                        <td colspan=\"5\" class=\"text-muted fw-bold\">".concat(noData, "</td>\n                    </tr>"));
        }
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

function appointmentsDataAjax() {
  $.ajax({
    url: route('appointmentsData.data'),
    type: 'GET',
    success: function success(result) {
      if (result.data.data != '') {
        $.each(result.data.data, function (index, value) {
          var data = [{
            'vcardname': value.vcard.name,
            'name': value.name,
            'phone': !isEmpty(value.phone) ? '+' + value.phone : 'N/A',
            'email': value.email
          }];
          $(document).find('#appointmentReport').append(prepareTemplateRender('#appointmentTemplate', data));
        });
      } else {
        $(document).find('#appointmentReport').append("\n                    <tr class=\"text-center\">\n                        <td colspan=\"5\" class=\"text-muted fw-bold\">".concat(noData, "</td>\n                    </tr>"));
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}
/******/ })()
;