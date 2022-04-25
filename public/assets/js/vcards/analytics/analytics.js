/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************!*\
  !*** ./resources/assets/js/vcards/analytics/analytics.js ***!
  \***********************************************************/
document.addEventListener('DOMContentLoaded', loadAnalytics);
var chartType = 'bar';

function loadAnalytics() {
  var timeRange = $('#timeRange');
  var isPickerApply = true;
  var today = moment();
  var start = moment().subtract('30', 'days');
  var end = today.clone().endOf('days');
  timeRange.on('apply.daterangepicker', function (ev, picker) {
    isPickerApply = true;
    start = picker.startDate.format('YYYY-MM-D  H:mm:ss');
    end = picker.endDate.format('YYYY-MM-D  H:mm:ss');
    loadDashboardData(start, end);
  });

  window.cb = function (start, end) {
    timeRange.find('span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
  };

  timeRange.daterangepicker({
    startDate: start,
    endDate: end,
    opens: 'left',
    showDropdowns: true,
    autoUpdateInput: false,
    ranges: {
      'This Week': [moment().startOf('week'), moment().endOf('week')],
      'Last Week': [moment().startOf('week').subtract(7, 'days'), moment().startOf('week').subtract(1, 'days')]
    }
  }, cb);
  cb(start, end);

  function loadDashboardData(startDate, endDate) {
    $.ajax({
      type: 'GET',
      url: route('vcard.chart', vcardId),
      dataType: 'json',
      data: {
        start_date: startDate,
        end_date: endDate,
        vcardId: vcardId
      },
      success: function success(result) {
        WeeklyBarChart(result);
      },
      cache: false
    });
  }

  ;

  function WeeklyBarChart(result) {
    $('#weeklyUserBarChartContainer').html('');
    $('canvas#weeklyUserBarChart').remove();
    $('#weeklyUserBarChartContainer').append('<canvas id="weeklyUserBarChart" height="275" width="905" style="display: block; width: 905px; height: 500px;"></canvas>');
    var data = result.data;
    var weeklyData = {
      labels: data.weeklyLabels,
      datasets: [{
        label: visitors,
        backgroundColor: '#009ef7',
        data: data.totalVisitorCount
      }]
    };
    var ctx = $('#weeklyUserBarChart');
    var config = new Chart(ctx, {
      type: chartType,
      data: weeklyData,
      options: {
        scales: {
          y: {
            ticks: {
              min: 0,
              precision: 0
            }
          }
        }
      }
    });
  }

  ;
  loadDashboardData(start.format('YYYY-MM-D H:mm:ss'), end.format('YYYY-MM-D H:mm:ss'));
  var applyBtn = $('.range_inputs > button.applyBtn');
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
    chartType = 'line';
    $('.chart').removeClass('fa-chart-area');
    $('.chart').addClass('fa-chart-bar');
    loadAnalytics();
  } else {
    chartType = 'bar';
    $('.chart').addClass('fa-chart-area');
    $('.chart').removeClass('fa-chart-bar');
    loadAnalytics();
  }
});
/******/ })()
;