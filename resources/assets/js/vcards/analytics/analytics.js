document.addEventListener('turbo:load', loadAnalytics)

let chartType = 'line'
function loadAnalytics(){
    let timeRange = $('#timeRange');
    let isPickerApply = true;
    const today = moment();
    let start = moment().subtract('30','days');
    let end = today.clone().endOf('days');

    timeRange.on('apply.daterangepicker', function (ev, picker) {
        isPickerApply = true;
        start = picker.startDate;
        end = picker.endDate;
        loadDashboardData(start.format('YYYY-MM-D  H:mm:ss'), end.format('YYYY-MM-D  H:mm:ss'));
    });

    window.cb = function (start, end) {
        timeRange.find('span').
        html(
            start.format('MMM D, YYYY') + ' - ' +
            end.format('MMM D, YYYY'));
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
    

    loadDashboardData(start.format('YYYY-MM-D H:mm:ss'),
        end.format('YYYY-MM-D H:mm:ss'));


    let applyBtn = $('.range_inputs > button.applyBtn');
    $(document).on('click', '.ranges li', function () {
        if ($(this).data('range-key') === 'Custom Range') {
            applyBtn.css('display', 'initial');
        } else {
            applyBtn.css('display', 'none');
        }
    });
    applyBtn.css('display', 'none');
}

listenClick('#changeChart', function () {
    if (chartType === 'bar') {
        chartType = 'line'
        $('.chart').removeClass('fa-chart-line');
        $('.chart').addClass('fa-chart-bar');
        loadDashboardData(start.format('YYYY-MM-D H:mm:ss'),
            end.format('YYYY-MM-D H:mm:ss'))
    } else {
        chartType = 'bar'
        $('.chart').addClass('fa-chart-line');
        $('.chart').removeClass('fa-chart-bar');
        loadDashboardData(start.format('YYYY-MM-D H:mm:ss'),
            end.format('YYYY-MM-D H:mm:ss'))
    }
})

function loadDashboardData (startDate, endDate) {
    if (!$('#analyticVcardId').length) {
        return
    }
    let analyticVcardId = $('#analyticVcardId').val();
    $.ajax({
        type: 'GET',
        url: route('vcard.chart', analyticVcardId),
        dataType: 'json',
        data: {
            start_date: startDate,
            end_date: endDate,
            vcardId: analyticVcardId,
        },
        success: function (result) {
            WeeklyBarChart(result);
        },
        cache: false,
    });
};

function WeeklyBarChart (result) {
    if (!$('#weeklyUserBarChartContainer').length) {
        return
    }
    let visitors = $('#analyticVisitors').val();
    $('#weeklyUserBarChartContainer').html('');
    $('canvas#weeklyUserBarChart').remove();
    $('#weeklyUserBarChartContainer').
        append(
            '<canvas id="weeklyUserBarChart" height="275" width="905" style="display: block; width: 905px; height: 500px;"></canvas>');

    let data = result.data;
    const weeklyData = {
        labels: data.weeklyLabels,
        datasets: [
            {
                label: visitors,
                backgroundColor: '#009ef7',
                data: data.totalVisitorCount,
                lineTension: 0.5,
                radius: 4
            }],
    };
    let ctx = $('#weeklyUserBarChart');
    let config = new Chart(ctx, {
        type: chartType,
        data: weeklyData,
        options: {
            scales: {
                y: {
                    ticks: {
                        min: 0,
                        precision: 0,
                    },
                    min: 0
                },
            },
        },
    });
};
