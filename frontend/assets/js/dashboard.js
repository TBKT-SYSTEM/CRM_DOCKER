var currentChart = null;
$(function () {
  genChartTest();
});

async function genChartTest() {
  // Profit =====================================
  // var chartData = await getChartData(API_URL + "user/table");
  // console.log(chartData['data']);
  var chartOptions = {
    series: [{
      color: "#6BCB77",
      name: 'DONE',
      data: [7, 5, 4, 5, 6, 2, 3, 2, 1, 4, 3, 4]
    }, {
      color: "#4D96FF",
      name: 'PENDING',
      data: [3, 1, 2, 3, 3, 2, 4, 0, 1, 5, 3, 2]
    }, {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: [5, 1, 2, 2, 3, 3, 4, 4, 1, 2, 3, 5]
    }, {
      color: "#686D76",
      name: 'CANCELLED',
      data: [2, 1, 1, 4, 1, 1, 5, 3, 2, 4, 1, 1]
    }],
    chart: {
      type: 'bar',
      height: 500,
      stacked: true,
      fontFamily: "Plus Jakarta Sans', sans-serif",
      toolbar: {
        show: true,
        tools: {
          download: false,
          selection: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: false,
          reset: true,
        },
      },
      events: {
        click: function (event, chartContext, config) {
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          var seriesNameClick = chartOptions.series[seriesIndex].name;

          var yearChart = $('#selRfqChart').val();
          var month = chartOptions.xaxis.categories[dataPointIndex];

          var seriesNameVal = checkSeriesName(seriesNameClick);
          var dataStatus = checkDashStatus(seriesNameClick);
          var clickMount = `<p class="card-title fw-semibold text-center">${month} ${yearChart}: ${seriesNameVal}</p>`;

          $('#month_click').html(clickMount);

          let dataPoint = chartOptions.series[seriesIndex].data[dataPointIndex];
          updateTable(dataPoint);

          var rfqNo = $('#tblChartBody tr:first-child td:first-child').text();
          $('#rfqNo').html('<strong>No. </strong>' + rfqNo);
          $('#sentDate').html('<strong>Sent Date </strong>' + getRandomDate());
          $('#dueDate').html('<strong>Due Date </strong>' + getRandomDate());
          $('#dashStatus').html(dataStatus);

        }
      }
    },
    tooltip: {
      custom: function ({ seriesIndex, dataPointIndex, w }) {
        var totalData = w.globals.series[seriesIndex][dataPointIndex];
        var dataTooltip = generateRandomTooltip(totalData);
        return `<div style="overflow: auto; padding: 10px; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
              ${dataTooltip}
            </div>`;
      }
    },
    responsive: [{
      breakpoint: 480,
      options: {
        legend: {
          position: 'bottom',
          offsetX: -10,
          offsetY: 0
        }
      }
    }],
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 5,
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'last',
        dataLabels: {
          total: {
            enabled: true,
            style: {
              fontSize: '13px',
              fontFamily: "Plus Jakarta Sans', sans-serif",
              fontWeight: 600
            },
          }
        }
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      type: 'category',
      categories: ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May.', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.'],
    },
    legend: {
      position: 'top'
    },
    fill: {
      opacity: 1
    }
  };

  currentChart = new ApexCharts(document.querySelector("#chart-test"), chartOptions);
  currentChart.render().then(function () {
    var firstCategory = chartOptions.xaxis.categories[0]; // เดือนแรก
    var firstSeriesName = chartOptions.series[0].name; // ชื่อซีรีส์แรก
    var yearChart = $('#selRfqChart').val(); // ปีปัจจุบัน
    var firstClickChart = `<p class="card-title fw-semibold text-center">${firstCategory} ${yearChart}: ${checkSeriesName(firstSeriesName)}</p>`;
    $('#month_click').html(firstClickChart);
    var dataPoint = chartOptions.series[0].data[0];
    updateTable(dataPoint);
    var firstRowData = $('#tblChartBody tr:first-child td:first-child').text();
    $('#rfqNo').html('<strong>No. </strong>' + firstRowData);
    var dataStatus = checkDashStatus(firstSeriesName);
    $('#dashStatus').html(dataStatus);
  });
}
function newChartMonth(paraDone, paraPending, paraDeleyed, paraCancelled) {
  var chartNew = {
    series: [{
      color: "#6BCB77",
      name: 'DONE',
      data: paraDone
    }, {
      color: "#4D96FF",
      name: 'PENDING',
      data: paraPending
    }, {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: paraDeleyed
    }, {
      color: "#686D76",
      name: 'CANCELLED',
      data: paraCancelled
    }],
    chart: {
      type: 'bar',
      height: 500,
      stacked: true,
      fontFamily: "Plus Jakarta Sans', sans-serif",
      toolbar: {
        show: true,
        tools: {
          download: false,
          selection: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: false,
          reset: true,
        },
      },
      events: {
        click: function (event, chartContext, config) {
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          var seriesNameClick = chartNew.series[seriesIndex].name;

          var yearChart = $('#selRfqChart').val();
          var month = chartNew.xaxis.categories[dataPointIndex];

          var seriesNameVal = checkSeriesName(seriesNameClick);
          var dataStatus = checkDashStatus(seriesNameClick);

          var clickMount = `<p class="card-title fw-semibold text-center">${month} ${yearChart}: ${seriesNameVal}</p>`;
          $('#month_click').html(clickMount)
          let dataPoint = chartNew.series[seriesIndex].data[dataPointIndex];
          updateTable(dataPoint);
          var rfqNo = $('#tblChartBody tr:first-child td:first-child').text();
          $('#rfqNo').html('<strong>No. </strong>' + rfqNo);
          $('#sentDate').html('<strong>Sent Date </strong>' + getRandomDate());
          $('#dueDate').html('<strong>Due Date </strong>' + getRandomDate());
          $('#dashStatus').html(dataStatus);
        }
      }
    },
    tooltip: {
      custom: function ({ seriesIndex, dataPointIndex, w }) {
        var totalData = w.globals.series[seriesIndex][dataPointIndex];
        var dataTooltip = generateRandomTooltip(totalData);
        return `<div style="overflow: auto; padding: 10px; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
              ${dataTooltip}
            </div>`;
      }
    },
    responsive: [{
      breakpoint: 480,
      options: {
        legend: {
          position: 'bottom',
          offsetX: -10,
          offsetY: 0
        }
      }
    }],
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 5,
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'last',
        dataLabels: {
          total: {
            enabled: true,
            style: {
              fontSize: '13px',
              fontFamily: "Plus Jakarta Sans', sans-serif",
              fontWeight: 600
            },
          }
        }
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      type: 'category',
      categories: ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May.', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.'],
    },
    legend: {
      position: 'top'
    },
    fill: {
      opacity: 1
    }
  };
  renderChart(chartNew);
}
function newChartCus(paraDone, paraPending, paraDeleyed, paraCancelled) {
  var chartNew = {
    series: [{
      color: "#6BCB77",
      name: 'DONE',
      data: paraDone
    }, {
      color: "#4D96FF",
      name: 'PENDING',
      data: paraPending
    }, {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: paraDeleyed
    }, {
      color: "#686D76",
      name: 'CANCELLED',
      data: paraCancelled
    }],
    chart: {
      type: 'bar',
      height: 500,
      stacked: true,
      fontFamily: "Plus Jakarta Sans', sans-serif",
      toolbar: {
        show: true,
        tools: {
          download: false,
          selection: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: false,
          reset: true,
        },
      },
      events: {
        click: function (event, chartContext, config) {
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          var seriesNameClick = chartNew.series[seriesIndex].name;

          var yearChart = $('#selRfqChart').val();
          var month = chartNew.xaxis.categories[dataPointIndex];

          var seriesNameVal = checkSeriesName(seriesNameClick);
          var dataStatus = checkDashStatus(seriesNameClick);

          var clickMount = `<p class="card-title fw-semibold text-center">${month} ${yearChart}: ${seriesNameVal}</p>`;
          $('#month_click').html(clickMount)
          let dataPoint = chartNew.series[seriesIndex].data[dataPointIndex];
          updateTable(dataPoint);
          var rfqNo = $('#tblChartBody tr:first-child td:first-child').text();
          $('#rfqNo').html('<strong>No. </strong>' + rfqNo);
          $('#sentDate').html('<strong>Sent Date </strong>' + getRandomDate());
          $('#dueDate').html('<strong>Due Date </strong>' + getRandomDate());
          $('#dashStatus').html(dataStatus);
        }
      }
    },
    tooltip: {
      custom: function ({ seriesIndex, dataPointIndex, w }) {
        var totalData = w.globals.series[seriesIndex][dataPointIndex];
        var dataTooltip = generateRandomTooltipCus(totalData);
        return `<div style="overflow: auto; padding: 10px; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
              ${dataTooltip}
            </div>`;
      }
    },
    responsive: [{
      breakpoint: 480,
      options: {
        legend: {
          position: 'bottom',
          offsetX: -10,
          offsetY: 0
        }
      }
    }],
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 5,
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'last',
        dataLabels: {
          total: {
            enabled: true,
            style: {
              fontSize: '13px',
              fontFamily: "Plus Jakarta Sans', sans-serif",
              fontWeight: 600
            },
          }
        }
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      type: 'category',
      categories: ['ITT', 'MTA', 'KPMT', 'MTTh', 'KEP'],
    },
    legend: {
      position: 'top'
    },
    fill: {
      opacity: 1
    }
  };
  renderChart(chartNew);
}
function renderChart(chartNew) {
  currentChart = new ApexCharts(document.querySelector("#chart-test"), chartNew);
  currentChart.render().then(function () {
    var typeChart = $('#selTypeChart').val();

    if (typeChart == 1) {

      var firstCategory = chartNew.xaxis.categories[0];
      var firstSeriesName = chartNew.series[0].name;
      var yearChart = $('#selRfqChart').val();
      var firstClickChart = `<p class="card-title fw-semibold text-center">${firstCategory} ${yearChart}: ${checkSeriesName(firstSeriesName)}</p>`;
      $('#month_click').html(firstClickChart);
      let dataPoint = chartNew.series[0].data[0];
      updateTable(dataPoint);
      var firstRowData = $('#tblChartBody tr:first-child td:first-child').text();
      $('#rfqNo').html('<strong>No. </strong>' + firstRowData);
      var dataStatus = checkDashStatus(firstSeriesName);
      $('#dashStatus').html(dataStatus);

    } else {

      var firstCategory = chartNew.xaxis.categories[0];
      var firstSeriesName = chartNew.series[0].name;
      var yearChart = $('#selRfqChart').val();
      var firstClickChart = `<p class="card-title fw-semibold text-center">${firstCategory}: ${checkSeriesName(firstSeriesName)}</p>`;
      $('#month_click').html(firstClickChart);
      let dataPoint = chartNew.series[0].data[0];
      updateTable(dataPoint);
      var firstRowData = $('#tblChartBody tr:first-child td:first-child').text();
      $('#rfqNo').html('<strong>No. </strong>' + firstRowData);
      var dataStatus = checkDashStatus(firstSeriesName);
      $('#dashStatus').html(dataStatus);
    }

  });
}
function checkDashStatus(status) {
  if (status == 'DONE') {
    return `<p class="fw-semibold text-center text-success" style="font-size: 30px;"><u>ALL DONE</u></p>`
  } else if (status == 'PENDING') {
    return `<div class="position-relative" id="SST60">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/SST60.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator online pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-success">DONE</u></p>
                    <p>Mr. Tanaisd</p>
                    <p>SYS</p>
                    <p class="text-success">07 Jul 24</p>
                </div>
            </div>
            <div class="position-relative" id="K0084">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0084.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator pending pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-secondary">PENDING</u></p>
                    <p>Mr. Noraphat</p>
                    <p>SYS</p>
                    <p class="text-secondary">Waiting...</p>
                </div>
            </div>
            <div class="position-relative" id="K0071">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0071.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator pending pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-secondary">PENDING</u></p>
                    <p>Mr. Kidakarn</p>
                    <p>SYS</p>
                    <p class="text-secondary">Waiting...</p>
                </div>
            </div>
            <div class="position-relative" id="K0070">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0070.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator pending pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-secondary">PENDING</u></p>
                    <p>Mr. Chaitawat</p>
                    <p>SYS</p>
                    <p class="text-secondary">Waiting...</p>
                </div>
            </div>`
  } else if (status == 'DELAYED') {
    return `<div class="position-relative" id="SST60">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/SST60.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator online pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-success">DONE</u></p>
                    <p>Mr. Tanaisd</p>
                    <p>SYS</p>
                    <p class="text-success">07 Jul 24</p>
                </div>
            </div>
            <div class="position-relative" id="K0084">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0084.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator online pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-success">DONE</u></p>
                    <p>Mr. Noraphat</p>
                    <p>SYS</p>
                    <p class="text-success">07 Jul 24</p>
                </div>
            </div>
            <div class="position-relative" id="K0071">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0071.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator online pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-success">DONE</u></p>
                    <p>Mr. Kidakarn</p>
                    <p>SYS</p>
                    <p class="text-success">07 Jul 24</p>
                </div>
            </div>
            <div class="position-relative" id="K0070">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/K0070.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                <div class="status-indicator deleyed pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="text-danger">DELAYED</u></p>
                    <p>Mr. Chaitawat</p>
                    <p>SYS</p>
                    <p class="text-danger">Overdue 2 days!!</p>
                </div>
            </div>`
  } else {
    return `<p class="fw-semibold text-center" style="font-size: 23px; color: #686D76"><u>This RFQ was CANCELLED</u></p>`
  }
}
function checkSeriesName(seriesName) {
  if (seriesName == 'DONE') {
    return `<u class="fw-semibold text-success">DONE</u>`
  } else if (seriesName == 'PENDING') {
    return `<u class="fw-semibold" style="color: #4D96FF;">PENDING</u></u>`
  } else if (seriesName == 'DELAYED') {
    return `<u class="fw-semibold text-danger">DELAYED</u></u>`
  } else {
    return `<u class="fw-semibold text-dark">CANCELLED</u></u>`
  }
}
function generateRandomTooltipCus(numRows) {
  var data = [];
  for (var i = 0; i < numRows; i++) {
    var randomNumber = Math.floor(Math.random() * 1000);
    var status = ['EJ40', 'G-CAR(4N15)', 'ES01 GEAR', '4JJ1 ES01', 'IZ COVER 4JJ1'][Math.floor(Math.random() * 5)]; // เพิ่มตัวเลือก KEP

    data.push(`RFQ-SM-${String(randomNumber).padStart(3, '0')} : ${status}`);
  }
  return data.join('<br/>'); // แยกแต่ละบรรทัดด้วย `<br/>` เพื่อให้อ่านง่ายขึ้น
}
function generateRandomTooltip(numRows) {
  var data = [];
  for (var i = 0; i < numRows; i++) {
    var randomNumber = Math.floor(Math.random() * 1000);
    var status = ['ITT', 'MTA', 'KPMT', 'MTTh', 'KEP'][Math.floor(Math.random() * 5)]; // เพิ่มตัวเลือก KEP

    data.push(`RFQ-SM-${String(randomNumber).padStart(3, '0')} : ${status}`);
  }
  return data.join('<br/>'); // แยกแต่ละบรรทัดด้วย `<br/>` เพื่อให้อ่านง่ายขึ้น
}
function generateRandomData(numRows) {
  var typeChart = $('#selTypeChart').val();

  if (typeChart == 1) {

    var data = [];
    for (var i = 0; i < numRows; i++) {
      var randomNumber = Math.floor(Math.random() * 1000); // สุ่มเลข 3 หลัก
      var randomPrefix = Math.floor(Math.random() * 1000); // สุ่มเลข prefix 3 หลัก
      var status = ['ITT', 'MTA', 'KPMT', 'MTTh', 'KEP'][Math.floor(Math.random() * 4)];

      data.push(`<tr>
          <td>RFQ-SM-${String(randomNumber).padStart(3, '0')}</td>
          <td>${status}</td>
        </tr>`);
    }
    return data.join('');
  } else {

    var data = [];
    for (var i = 0; i < numRows; i++) {
      var randomNumber = Math.floor(Math.random() * 1000); // สุ่มเลข 3 หลัก
      var randomPrefix = Math.floor(Math.random() * 1000); // สุ่มเลข prefix 3 หลัก
      var status = ['EJ40', 'G-CAR(4N15)', 'ES01 GEAR', '4JJ1 ES01', 'IZ COVER 4JJ1'][Math.floor(Math.random() * 4)];

      data.push(`<tr>
          <td>RFQ-SM-${String(randomNumber).padStart(3, '0')}</td>
          <td>${status}</td>
        </tr>`);
    }
    return data.join('');
  }

}
function updateTable(numRows) {
  var dataBody = generateRandomData(numRows);

  if ($.fn.DataTable.isDataTable('#tblChart')) {
    $('#tblChart').DataTable().destroy();
  }

  $('#tblChartBody').html(dataBody);

  $('#tblChart').DataTable({
    scrollY: '160px',
    pageLength: 3,
    lengthChange: false,
    paging: false,
    searching: false,
    scrollCollapse: true,
  });

}
function getRandomDate() {
  var start = new Date();
  var end = new Date();
  end.setDate(start.getDate() + 30);

  var date = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
  return formatDate(date);
}

$('#selTypeChart, #selRfqChart').on('change', function () {
  var selTypeChartValue = $('#selTypeChart').val();
  var selRfqChartValue = $('#selRfqChart').val();

  var paraDone = [];
  var paraPending = [];
  var paraDeleyed = [];
  var paraCancelled = [];

  if (currentChart) {
    currentChart.destroy();
  }

  if (selTypeChartValue == 1 && selRfqChartValue == 2023) {
    paraDone = [2, 1, 2, 5, 3, 2, 7, 1, 4, 2, 3, 6];
    paraPending = [0, 2, 3, 3, 2, 1, 6, 8, 4, 3, 2, 2];
    paraDeleyed = [5, 1, 2, 4, 3, 8, 2, 7, 6, 1, 2, 5];
    paraCancelled = [2, 1, 1, 4, 1, 1, 5, 3, 2, 4, 1, 1];
    newChartMonth(paraDone, paraPending, paraDeleyed, paraCancelled);
  } else if (selTypeChartValue == 1 && selRfqChartValue == 2024) {
    paraDone = [5, 1, 2, 2, 3, 8, 9, 7, 6, 1, 2, 5];
    paraPending = [1, 1, 2, 1, 3, 2, 5, 1, 4, 2, 0, 2];
    paraDeleyed = [1, 3, 7, 6, 7, 1, 6, 8, 4, 3, 2, 1];
    paraCancelled = [1, 3, 4, 4, 2, 1, 2, 5, 6, 2, 3, 3];
    newChartMonth(paraDone, paraPending, paraDeleyed, paraCancelled);
  } else if (selTypeChartValue == 2 && selRfqChartValue == 2023) {
    paraDone = [3, 5, 2, 7, 3];
    paraPending = [2, 3, 7, 6, 7];
    paraDeleyed = [5, 1, 6, 2, 3];
    paraCancelled = [2, 1, 1, 4, 1];
    newChartCus(paraDone, paraPending, paraDeleyed, paraCancelled);
  } else if (selTypeChartValue == 2 && selRfqChartValue == 2024) {
    paraDone = [5, 1, 2, 2, 3];
    paraPending = [4, 1, 2, 7, 3];
    paraDeleyed = [3, 2, 2, 6, 7];
    paraCancelled = [3, 2, 4, 1, 2];
    newChartCus(paraDone, paraPending, paraDeleyed, paraCancelled);
  } else {
    console.log("Error: No chart found");
  }
});

