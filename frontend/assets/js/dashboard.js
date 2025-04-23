var year, getDone, getPending, getDelay, getCancel, category, custName, custValue;
var docDataKey, docData, seriesNameClick;
var currentChart = null;

$(function () {
  genChartTest();

  $('#tblChart tbody').on('click', 'tr', async function () {
    $('#tblChart tbody tr').removeClass('selected-row');
    if ($('#selTypeChart').val() == 1) {
      $(this).addClass('selected-row');
      const rowIndex = $(this).index();
      if (docData[rowIndex]) {
        const rfqNo = docData[rowIndex].runningNo;
        const sentDate = formatDate(docData[rowIndex].createdDate);
        const dueDate = formatDate(docData[rowIndex].closingDate);
        if (seriesNameClick == 'DELAYED') {
          getData = await getSingleData(API_URL + 'dashboard/docDelay/' + rfqNo);
        } else {
          getData = await getSingleData(API_URL + 'dashboard/docPending/' + rfqNo);
        }
        var dataStatus = checkDashStatus(seriesNameClick, getData);

        $('#rfqNo').html('<strong>No. </strong>' + rfqNo);
        $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + sentDate);
        $('#dueDate').html('<strong class="me-1">Due Date </strong>' + dueDate);
        $('#dashStatus').html(dataStatus);
      }
    } else {
      const cellText = $(this).find('td:eq(0)').text();
      if (seriesNameClick == 'DELAYED') {
        getData = await getSingleData(API_URL + 'dashboard/docDelay/' + cellText);
      } else {
        getData = await getSingleData(API_URL + 'dashboard/docPending/' + cellText);
      }
      const dateData = await getSingleData(API_URL + 'dashboard/getDate/' + cellText);

      var dataStatus = checkDashStatus(seriesNameClick, getData);
      $('#rfqNo').html('<strong>No. </strong>' + cellText);
      $('#sentDate').html('<strong class="me-1">Sent Date</strong>' + dateData.Data[0].idc_created_date);
      $('#dueDate').html('<strong class="me-1">Due Date</strong>' + dateData.Data[0].idc_closing_date);
      $('#dashStatus').html(dataStatus);
    }

  });

  $(document).on('mouseenter', '.position-relative', function () {
    $('.item-detail').addClass('blur-bg');
  });

  $(document).on('mouseleave', '.position-relative', function () {
    $('.item-detail').removeClass('blur-bg');
  });

});

async function genChartTest() {
  Swal.fire({
    title: 'Loading Data...',
    text: 'Please wait while we load the data.',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  year = $('#selRfqChart').val();
  getDone = await getSingleData(API_URL + 'dashboard/getDone/' + year);
  getPending = await getSingleData(API_URL + 'dashboard/getPending/' + year);
  getDelay = await getSingleData(API_URL + 'dashboard/getDelay/' + year);
  getCancel = await getSingleData(API_URL + 'dashboard/getCancel/' + year);
  category = await getSingleData(API_URL + 'dashboard/getCsutomer/' + year);

  customCategory(category.data);

  var chartOptions = {
    series: [{
      color: "#686D76",
      name: 'CANCELLED',
      data: getCancel.data
    },
    {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: getDelay.data
    },
    {
      color: "#4D96FF",
      name: 'PENDING',
      data: getPending.data
    },
    {
      color: "#6BCB77",
      name: 'DONE',
      data: getDone.data
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
        click: async function (event, chartContext, config) {
          updateTable(docData);
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          seriesNameClick = chartOptions.series[seriesIndex].name;
          var yearChart = $('#selRfqChart').val();
          var month = chartOptions.xaxis.categories[dataPointIndex];
          var seriesNameVal = checkSeriesName(seriesNameClick);
          var clickMount = `<p class="card-title fw-semibold text-center">${month} ${yearChart}: ${seriesNameVal}</p>`;

          $('#month_click').html(clickMount);

          if (seriesNameClick == 'DELAYED') {
            getData = await getSingleData(API_URL + 'dashboard/docDelay/' + docData[0].runningNo);
          } else {
            getData = await getSingleData(API_URL + 'dashboard/docPending/' + docData[0].runningNo);
          }
          var dataStatus = checkDashStatus(seriesNameClick, getData);

          $('#rfqNo').html('<strong>No. </strong>' + docData[0].runningNo);
          $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + formatDate(docData[0].createdDate));
          $('#dueDate').html('<strong class="me-1">Due Date </strong>' + formatDate(docData[0].closingDate));
          $('#dashStatus').html(dataStatus);
        }
      }
    },
    tooltip: {
      custom: function ({ series, seriesIndex, dataPointIndex, w }) {
        const seriesName = w.globals.seriesNames[seriesIndex];
        if (seriesName == 'CANCELLED') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getCancel.docNo[docDataKey];
        } else if (seriesName == 'DONE') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getDone.docNo[docDataKey];
        } else if (seriesName == 'DELAYED') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getDelay.docNo[docDataKey];
        } else if (seriesName == 'PENDING') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getPending.docNo[docDataKey];
        }
        return `<div style="padding: 10px;">
                 ${docData.map(item => item.runningNo).join('<br>')}
               </div`;
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
    var dataPointIndex = 0;
    var firstCategory, firstSeriesName;
    var yearChart = $('#selRfqChart').val();
    let dataRoot = null;

    outerLoop:
    for (let s = 0; s < chartOptions.series.length; s++) {
      const series = chartOptions.series[s];
      for (let i = 0; i < series.data.length; i++) {
        if (series.data[i] > 0) {
          firstSeriesName = series.name;
          seriesNameClick = firstSeriesName;
          docDataKey = `DocYear${i + 1}`;
          firstCategory = chartOptions.xaxis.categories[i];

          if (firstSeriesName === 'CANCELLED') dataRoot = getCancel.docNo;
          else if (firstSeriesName === 'DELAYED') dataRoot = getDelay.docNo;
          else if (firstSeriesName === 'PENDING') dataRoot = getPending.docNo;
          else if (firstSeriesName === 'DONE') dataRoot = getDone.docNo;

          docData = dataRoot?.[docDataKey] || [];
          break outerLoop;
        }
      }
    }

    const statusText = checkSeriesName(firstSeriesName);
    const firstClickChart = `<p class="card-title fw-semibold text-center">
                                ${firstCategory} ${yearChart}: ${statusText}
                             </p>
                            `;
    $('#month_click').html(firstClickChart);

    updateTable(docData);

    $('#rfqNo').html('<strong>No. </strong>' + docData[0].runningNo);
    $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + formatDate(docData[0].createdDate));
    $('#dueDate').html('<strong class="me-1">Due Date </strong>' + formatDate(docData[0].closingDate));
    $('#dashStatus').html(checkDashStatus(firstSeriesName));
    Swal.close();
  });
}

async function customCategory(customerNew) {
  customer = [];
  custName = [];
  custValue = [];

  const transformedArray = customerNew.map(item => ({
    custname: item.idc_customer_name,
    values: [item.cancel, item.delay, item.pending, item.done]
  }));

  custName = customerNew.map(item => item.idc_customer_name);
  custValue = [];
  transformedArray.forEach(item => {
    item.values.forEach((value, index) => {
      if (!custValue[index]) {
        custValue[index] = [];
      }
      custValue[index].push(value);
    });
  });
}

function newChartMonth(paraDone, paraPending, paraDeleyed, paraCancelled) {
  var chartNew = {
    series: [{
      color: "#686D76",
      name: 'CANCELLED',
      data: paraCancelled
    }, {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: paraDeleyed
    }, {
      color: "#4D96FF",
      name: 'PENDING',
      data: paraPending
    }, {
      color: "#6BCB77",
      name: 'DONE',
      data: paraDone
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
        click: async function (event, chartContext, config) {
          updateTable(docData);
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          seriesNameClick = chartNew.series[seriesIndex].name;

          var yearChart = $('#selRfqChart').val();
          var month = chartNew.xaxis.categories[dataPointIndex];

          var seriesNameVal = checkSeriesName(seriesNameClick);
          var clickMount = `<p class="card-title fw-semibold text-center">${month} ${yearChart}: ${seriesNameVal}</p>`;

          $('#month_click').html(clickMount);

          if (seriesNameClick == 'DELAYED') {
            getData = await getSingleData(API_URL + 'dashboard/docDelay/' + docData[0].runningNo);
          } else {
            getData = await getSingleData(API_URL + 'dashboard/docPending/' + docData[0].runningNo);
          }
          var dataStatus = checkDashStatus(seriesNameClick, getData);

          $('#rfqNo').html('<strong>No. </strong>' + docData[0].runningNo);
          $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + formatDate(docData[0].createdDate));
          $('#dueDate').html('<strong class="me-1">Due Date </strong>' + formatDate(docData[0].closingDate));
          $('#dashStatus').html(dataStatus);
        }
      }
    },
    tooltip: {
      custom: function ({ seriesIndex, dataPointIndex, w }) {
        const seriesName = w.globals.seriesNames[seriesIndex];

        if (seriesName == 'CANCELLED') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getCancel.docNo[docDataKey];
        } else if (seriesName == 'DONE') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getDone.docNo[docDataKey];
        } else if (seriesName == 'PENDING') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getPending.docNo[docDataKey];
        } else if (seriesName == 'DELAYED') {
          docDataKey = `DocYear${dataPointIndex + 1}`;
          docData = getDelay.docNo[docDataKey];
        }
        return `<div style="padding: 10px;">
                 ${docData.map(item => item.runningNo).join('<br>')}
               </div`;
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

function newChartCus(paraDone, paraPending, paraDeleyed, paraCancelled, custName) {
  var chartNew = {
    series: [{
      color: "#686D76",
      name: 'CANCELLED',
      data: paraCancelled
    }, {
      color: "#FF6B6B",
      name: 'DELAYED',
      data: paraDeleyed
    }, {
      color: "#4D96FF",
      name: 'PENDING',
      data: paraPending
    }, {
      color: "#6BCB77",
      name: 'DONE',
      data: paraDone
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
        click: async function (event, chartContext, config) {
          var seriesIndex = config.seriesIndex;
          var dataPointIndex = config.dataPointIndex;
          seriesNameClick = chartNew.series[seriesIndex].name;
          var yearChart = $('#selRfqChart').val();
          const nameCategories = chartNew.xaxis.categories[dataPointIndex];
          const listKeyMap = {
            CANCELLED: 'cancel_list',
            DELAYED: 'delay_list',
            PENDING: 'pending_list',
            DONE: 'done_list'
          };

          const listKey = listKeyMap[seriesNameClick] || '';
          const dataDoc = category.data[dataPointIndex]?.[listKey] || [];

          const findDoc = await Promise.all(
            dataDoc.map(async (docNo) => {
              try {
                const dateData = await getSingleData(API_URL + 'dashboard/getDate/' + docNo);
                return {
                  runningNo: docNo,
                  customerName: nameCategories,
                  sentDate: dateData.Data[0]?.idc_created_date || '-',
                  dueDate: dateData.Data[0]?.idc_closing_date || '-'
                };
              } catch (err) {
                console.error("Error loading date for", docNo, err);
                return {
                  runningNo: docNo,
                  customerName: nameCategories,
                  sentDate: '-',
                  dueDate: '-'
                };
              }
            })
          );
          updateTable(findDoc);

          var seriesNameVal = checkSeriesName(seriesNameClick);
          var clickMount = `<p class="card-title fw-semibold text-center">${nameCategories} ${yearChart}: ${seriesNameVal}</p>`;
          $('#month_click').html(clickMount)

          if (seriesNameClick === 'DELAYED') {
            getData = await getSingleData(API_URL + 'dashboard/docDelay/' + findDoc[0].runningNo);
          } else if (seriesNameClick === 'PENDING') {
            getData = await getSingleData(API_URL + 'dashboard/docPending/' + findDoc[0].runningNo);
          }

          var dataStatus = checkDashStatus(seriesNameClick, getData);
          $('#rfqNo').html('<strong>No. </strong>' + findDoc[0].runningNo);
          $('#sentDate').html('<strong>Sent Date </strong>' + findDoc[0].sentDate);
          $('#dueDate').html('<strong>Due Date </strong>' + findDoc[0].dueDate);
          $('#dashStatus').html(dataStatus);
        }
      }
    },
    tooltip: {
      custom: function ({ seriesIndex, dataPointIndex, w }) {
        var nameSeries = w.globals.seriesNames[seriesIndex];
        let listName = '';
        switch (nameSeries) {
          case 'CANCELLED':
            listName = 'cancel_list';
            break;
          case 'DELAYED':
            listName = 'delay_list';
            break;
          case 'PENDING':
            listName = 'pending_list';
            break;
          case 'DONE':
            listName = 'done_list';
            break;
        }

        const dataObj = category.data?.[parseInt(dataPointIndex)];
        const resultList = dataObj?.[listName] || [];
        return `<div style="padding: 10px;">
                ${resultList.join('<br>')}
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
    yaxis: {
      min: 0,
      tickAmount: custName.length,
      labels: {
        formatter: function (val) {
          return Math.round(val);
        }
      }
    },
    xaxis: {
      type: 'category',
      categories: custName,
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
  currentChart.render().then(async function () {
    var typeChart = $('#selTypeChart').val();

    if (typeChart == 1) {
      var firstCategory, firstSeriesName;
      var yearChart = $('#selRfqChart').val();
      let dataRoot = null;

      outerLoop:
      for (let s = 0; s < chartNew.series.length; s++) {
        const series = chartNew.series[s];
        for (let i = 0; i < series.data.length; i++) {
          if (series.data[i] > 0) {
            firstSeriesName = series.name;
            docDataKey = `DocYear${i + 1}`;
            firstCategory = chartNew.xaxis.categories[i];
            seriesNameClick = firstSeriesName;
            if (firstSeriesName === 'CANCELLED') dataRoot = getCancel.docNo;
            else if (firstSeriesName === 'DELAYED') dataRoot = getDelay.docNo;
            else if (firstSeriesName === 'PENDING') dataRoot = getPending.docNo;
            else if (firstSeriesName === 'DONE') dataRoot = getDone.docNo;

            docData = dataRoot?.[docDataKey] || [];
            break outerLoop;
          }
        }
      }

      const statusText = checkSeriesName(firstSeriesName);
      const firstClickChart = `<p class="card-title fw-semibold text-center">
                                  ${firstCategory} ${yearChart}: ${statusText}
                               </p>
                              `;
      $('#month_click').html(firstClickChart);

      updateTable(docData);

      $('#rfqNo').html('<strong>No. </strong>' + docData[0].runningNo);
      $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + formatDate(docData[0].createdDate));
      $('#dueDate').html('<strong class="me-1">Due Date </strong>' + formatDate(docData[0].closingDate));
      $('#dashStatus').html(checkDashStatus(firstSeriesName));
    } else {
      //////////////////////////////// Customer Chart ////////////////////////////////
      var firstCategory, firstSeriesName;
      var yearChart = $('#selRfqChart').val();
      let findDoc = [];

      outerLoop:
      for (let s = 0; s < chartNew.series.length; s++) {
        const series = chartNew.series[s];
        for (let i = 0; i < series.data.length; i++) {
          if (series.data[i] > 0) {
            const firstSeriesName = series.name;
            const firstCategory = chartNew.xaxis.categories[i];
            seriesNameClick = firstSeriesName;
            let dataRoot = [];
            if (firstSeriesName === 'CANCELLED') dataRoot = category.data[i]?.cancel_list || [];
            else if (firstSeriesName === 'DELAYED') dataRoot = category.data[i]?.delay_list || [];
            else if (firstSeriesName === 'PENDING') dataRoot = category.data[i]?.pending_list || [];
            else if (firstSeriesName === 'DONE') dataRoot = category.data[i]?.done_list || [];

            for (const docNo of dataRoot) {
              try {
                const dateData = await getSingleData(API_URL + 'dashboard/getDate/' + docNo);
                findDoc.push({
                  runningNo: docNo,
                  customerName: firstCategory,
                  sentDate: dateData.Data[0].idc_created_date,
                  dueDate: dateData.Data[0].idc_closing_date
                });
              } catch (err) {
                console.error("Error loading date for", docNo, err);
              }
            }
            break outerLoop;
          }
        }
      }
      var firstCategory = chartNew.xaxis.categories[0];
      var firstSeriesName = chartNew.series[0].name;
      var firstClickChart = `<p class="card-title fw-semibold text-center">${firstCategory} ${yearChart}: ${checkSeriesName(firstSeriesName)}</p>`;
      $('#month_click').html(firstClickChart);
      updateTable(findDoc);

      $('#rfqNo').html('<strong>No. </strong>' + findDoc[0].runningNo);
      $('#sentDate').html('<strong class="me-1">Sent Date </strong>' + findDoc[0].sentDate);
      $('#dueDate').html('<strong class="me-1">Due Date </strong>' + findDoc[0].dueDate);
      $('#dashStatus').html(checkDashStatus(firstSeriesName));
    }

  });
}

function checkDashStatus(status, data) {
  let img_error = BASE_URL + 'assets/images/logos/user-3.png';
  if (status == 'DONE') {
    return `<p class="fw-semibold text-center text-success" style="font-size: 30px;"><u>ALL DONE</u></p>`
  } else if (status == 'PENDING') {
    let Data = data.Data;
    let status, classDuedate, textDuedate;
    let html = '';
    for (let i = 0; i < Data.length; i++) {
      if (Data[i].status_type == 'DONE') {
        status = 'online';
        classDuedate = 'text-success';
        textDuedate = Data[i].duedate;
      } else {
        status = 'pending';
        classDuedate = 'text-secondary';
        textDuedate = 'Waiting...';
      }
      html += `<div class="position-relative">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/${Data[i].su_username.substring(2, 7)}.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100"  onerror="this.onerror=null; this.src='${img_error}'">
                <div class="status-indicator ${status} pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="${classDuedate}">${Data[i].status_type}</u></p>
                    <p>${Data[i].name}</p>
                    <p>${Data[i].dept}</p>
                    <p class="${classDuedate}">${textDuedate}</p>
                </div>
            </div>`;
    }
    return html;
  } else if (status == 'DELAYED') {
    const Data = data.Data;
    let html = '';
    let status, classDuedate, textDuedate;
    for (let i = 0; i < Data.length; i++) {
      if (Data[i].status_type == 'DELAYED') {
        status = 'deleyed';
        classDuedate = 'text-danger';
        textDuedate = 'Overdue ' + Data[i].duedate + ' days!!';
      } else {
        status = 'online';
        classDuedate = 'text-success';
        textDuedate = Data[i].duedate;
      }
      html += `<div class="position-relative">
                <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/${Data[i].su_username.substring(2, 7)}.jpg" alt="Avatar" class="img-fluid-status rounded-circle" width="100" height="100"  onerror="this.onerror=null; this.src='${img_error}'">
                <div class="status-indicator ${status} pulse"></div>
                <div class="tooltip-custom text-center fw-semibold" id="tooltip">
                    <p><u class="${classDuedate}">${Data[i].status_type}</u></p>
                    <p>${Data[i].name}</p>
                    <p>${Data[i].dept}</p>
                    <p class="${classDuedate}">${textDuedate}</p>
                </div>
              </div>`
    }
    return html;
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

function generateRandomData(numRows) {
  var typeChart = $('#selTypeChart').val();
  if (typeChart == 1) {
    var data = [];
    for (var i = 0; i < numRows.length; i++) {

      data.push(`<tr>
          <td>${numRows[i].runningNo}</td>
          <td>${numRows[i].customerName}</td>
        </tr>`);
    }
    return data.join('');
  } else {
    var data = [];
    for (var i = 0; i < numRows.length; i++) {

      data.push(`<tr>
          <td>${numRows[i].runningNo}</td>
          <td>${numRows[i].customerName}</td>
        </tr>`);
    }
    return data.join('');
  }
}

function updateTable(numRows) {
  var dataBody = generateRandomData(numRows);
  if (dataBody) {
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
}

function formatDate(inputDate) {
  let dateParts = inputDate.split('-');
  let year = dateParts[0];
  let month = dateParts[1];
  let day = dateParts[2];

  let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  let monthName = months[parseInt(month) - 1];

  return `${day}-${monthName}-${year}`;
}

function getRandomDate() {
  var start = new Date();
  var end = new Date();
  end.setDate(start.getDate() + 30);

  var date = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
  return formatDate(date);
}

$('#selTypeChart, #selRfqChart').on('change', async function () {
  Swal.fire({
    title: 'Loading Data...',
    text: 'Please wait while we load the data.',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  var selTypeChartValue = $('#selTypeChart').val();
  var selRfqChartValue = $('#selRfqChart').val();

  if (currentChart) {
    currentChart.destroy();
  }

  if (selTypeChartValue == 1 && selRfqChartValue) {
    getDone = await getSingleData(API_URL + 'dashboard/getDone/' + selRfqChartValue);
    getPending = await getSingleData(API_URL + 'dashboard/getPending/' + selRfqChartValue);
    getDelay = await getSingleData(API_URL + 'dashboard/getDelay/' + selRfqChartValue);
    getCancel = await getSingleData(API_URL + 'dashboard/getCancel/' + selRfqChartValue);
    newChartMonth(getDone.data, getPending.data, getDelay.data, getCancel.data);
  } else if (selTypeChartValue == 2 && selRfqChartValue) {
    category = await getSingleData(API_URL + 'dashboard/getCsutomer/' + selRfqChartValue);
    if (category.data == null) {
      newChartCus([0], [0], [0], [0], ["No Data"]);
    } else {
      customCategory(category.data);
      paraCancelled = custValue[0];
      paraDeleyed = custValue[1];
      paraPending = custValue[2];
      paraDone = custValue[3];
      newChartCus(paraDone, paraPending, paraDeleyed, paraCancelled, custName);
    }
  } else {
    console.log("Error: No chart found");
  }
  Swal.close();
});

