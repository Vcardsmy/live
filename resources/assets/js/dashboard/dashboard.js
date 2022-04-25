document.addEventListener('turbo:load', loadDashboardData);

function loadDashboardData() {
    clickDayData()
    appointmentsDataAjax()
    datePickerInitialise()
}
let dashboardChartType = 'line'
let dashboardStacked = false
listenClick('#dayData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('usersData.dashboard'),
        type: 'GET',
        data: { day: 'day' },
        success: function (result) {
            if (result.success) {
                $('#dailyReport').empty();
                $(document).find('#month').removeClass('show active');
                $(document).find('#week').removeClass('show active');
                $(document).find('#day').addClass('show active');
                if (result.data.users.data != '') {
                    $.each(result.data.users.data, function (index, value) {
                        let data = [
                            {
                                'name': value.first_name + ' ' +
                                    value.last_name,
                                'email': value.email,
                                'contact': !isEmpty(value.contact)
                                    ? '+' + value.region_code + ' ' +
                                    value.contact
                                    : 'N/A',
                                'registered': moment.parseZone(
                                    value.created_at).
                                    format('Do MMM Y hh:mm A'),
                            }];
                        $(document).find('#dailyReport').append(
                            prepareTemplateRender('#sadminDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#dailyReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold">${noData}</td>
                    </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

function clickDayData () {
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
        data: { week: 'week' },
        success: function (result) {
            if (result.success) {
                $('#weeklyReport').empty();
                $(document).find('#month').removeClass('show active');
                $(document).find('#week').addClass('show active');
                $(document).find('#day').removeClass('show active');
                if (result.data.users.data != '') {
                    $.each(result.data.users.data, function (index, value) {
                        let data = [
                            {
                                'name': value.first_name + ' ' +
                                    value.last_name,
                                'email': value.email,
                                'contact': !isEmpty(value.contact)
                                    ? '+' + value.region_code + ' ' +
                                    value.contact
                                    : 'N/A',
                                'registered': moment.parseZone(
                                    value.created_at).
                                    format('Do MMM Y hh:mm A'),
                            }];
                        $(document).find('#weeklyReport').append(
                            prepareTemplateRender('#sadminDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#weeklyReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold">${noData}</td>
                    </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
listenClick('#monthData', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('usersData.dashboard'),
        type: 'GET',
        data: { month: 'month' },
        success: function (result) {
            if (result.success) {
                $('#monthlyReport').empty();
                $(document).find('#month').addClass('show active');
                $(document).find('#week').removeClass('show active');
                $(document).find('#day').removeClass('show active');
                if (result.data.users.data != '') {
                    $.each(result.data.users.data, function (index, value) {
                        let data = [
                            {
                                'name': value.first_name + ' ' +
                                    value.last_name,
                                'email': value.email,
                                'contact': !isEmpty(value.contact)
                                    ? '+' + value.region_code + ' ' +
                                    value.contact
                                    : 'N/A',
                                'registered': moment.parseZone(
                                    value.created_at).
                                    format('Do MMM Y hh:mm A'),
                            }];
                        $(document).find('#monthlyReport').append(
                            prepareTemplateRender('#sadminDashboardTemplate',
                                data));
                    });
                } else {
                    $(document).find('#monthlyReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold">${noData}</td>
                    </tr>`);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

function appointmentsDataAjax () {
    if (!$('#appointmentReport').length) {
        return
    }
    $.ajax({
        url: route('appointmentsData.data'),
        type: 'GET',
        success: function (result) {
            $(document).find('#appointmentReport').children().remove()
            if (result.data.data != '') {
                $.each(result.data.data, function (index, value) {
                    let data = [
                        {
                            'vcardname': value.vcard.name,
                            'name': value.name,
                            'phone': !isEmpty(value.phone) ? '+' + value.phone : 'N/A',
                            'email': value.email,
                        }];
                    $(document).find('#appointmentReport').append(
                        prepareTemplateRender('#appointmentTemplate',
                            data));
                });
            }
            else
            {
                $(document).find('#appointmentReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold">${noData}</td>
                    </tr>`);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}
let start = '';
let end = '';
const datePickerInitialise = () => {
    let timeRange = $('#dashboardTimeRange');
    let isPickerApply = true;
    const today = moment();
    start = moment().subtract('30', 'days');
    end = today.clone().endOf('days');
    timeRange.on('apply.daterangepicker', function (ev, picker) {
        isPickerApply = true;
        start = picker.startDate;
        end = picker.endDate;
        loadDashboardChart(start.format('YYYY-MM-D  H:mm:ss'), end.format('YYYY-MM-D  H:mm:ss'));
    });
    

    window.cb = function (start, end) {
        timeRange.find('span').html(start.format('MMM D, YYYY') + ' - ' +end.format('MMM D, YYYY'));
    };

    timeRange.daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        showDropdowns: true,
        autoUpdateInput: false,
        ranges: {
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [
                moment().startOf('week').subtract(7, 'days'),
                moment().startOf('week').subtract(1, 'days')],
        },
    }, cb);
    cb(start, end);

    loadDashboardChart(start.format('YYYY-MM-D H:mm:ss'),
        end.format('YYYY-MM-D H:mm:ss'));
};


const loadDashboardChart = (startDate, endDate) => {
    $.ajax({
        type: 'GET',
        url: route('dashboard.vcard.chart'),
        dataType: 'json',
        data: {
            start_date: startDate,
            end_date: endDate,
        },
        success: function (result) {
            dashboardWeeklyBarChart(result);
        },
        cache: false,
    });
}

const dashboardWeeklyBarChart = (result) => {
    const dashboardWeeklyUserBarChartContainer = $('#dashboardWeeklyUserBarChartContainer')
    if (!dashboardWeeklyUserBarChartContainer.length) {
        return
    }
    
    dashboardWeeklyUserBarChartContainer.html('');
    $('canvas#dashboardWeeklyUserBarChart').remove();
    dashboardWeeklyUserBarChartContainer.append('<canvas id="dashboardWeeklyUserBarChart" height="275" width="905" style="display: block; width: 905px; height: 500px;"></canvas>');

    let data = result.data;
    const weeklyData = {
        labels: data.weeklyLabels,
        datasets: data.dataset
    };
    const DATA_COUNT = 7;
    const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};
    let barChartData = {
        labels: data.weeklyLabels,
        datasets: data.data,
    };
    let ctx = $('#dashboardWeeklyUserBarChart');
    let config = new Chart(ctx, {
        type: dashboardChartType,
        data: barChartData,
        options: {
            scales: {
                y:{
                    stacked: dashboardStacked,
                    ticks: {
                        min: 0,
                        precision: 0,
                    },
                    min: 0
                },
                x:{
                    stacked: dashboardStacked,
                },
            },
        },
    });
}

listenClick('#dashboardChangeChart', function () {
    if (dashboardChartType === 'bar') {
        dashboardChartType = 'line';
        dashboardStacked = false;
        $('.chart').removeClass('fa-chart-line')
        $('.chart').addClass('fa-chart-bar')
        loadDashboardChart(start.format('YYYY-MM-D H:mm:ss'), end.format('YYYY-MM-D H:mm:ss'))
    } else {
        dashboardChartType = 'bar'
        dashboardStacked = true
        $('.chart').addClass('fa-chart-line')
        $('.chart').removeClass('fa-chart-bar')
        loadDashboardChart(start.format('YYYY-MM-D H:mm:ss'), end.format('YYYY-MM-D H:mm:ss'))
    }
})

