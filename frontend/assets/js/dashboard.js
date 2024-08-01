// Earning =====================================
var earning = {
  chart: {
    id: "sparkline3",
    type: "area",
    height: 60,
    sparkline: {
      enabled: true,
    },
    group: "sparklines",
    fontFamily: "Plus Jakarta Sans', sans-serif",
    foreColor: "#adb0bb",
  },
  series: [
    {
      name: "Earnings",
      color: "#49BEFF",
      data: [25, 66, 20, 40, 12, 58, 20],
    },
  ],
  stroke: {
    curve: "smooth",
    width: 2,
  },
  fill: {
    colors: ["#f3feff"],
    type: "solid",
    opacity: 0.05,
  },
  markers: {
    size: 0,
  },
  tooltip: {
    theme: "dark",
    fixed: {
      enabled: true,
      position: "right",
    },
    x: {
      show: false,
    },
  },
};
var chart = {
  series: [
    { name: "Earnings this month:", data: [200,232,400,214,345,234,356,100] },
    { name: "Expense next month:", data: [200,232,400,214,345,234,356,100] },
  ],
  chart: {
    type: "bar",
    height: 345,
    offsetX: -15,
    toolbar: { show: true },
    foreColor: "#adb0bb",
    fontFamily: 'inherit',
    sparkline: { enabled: false },
  },
  colors: ["#5D87FF", "#49BEFF"],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      type: "category",
      categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },
    yaxis: {
      show: true,
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },

    tooltip: { theme: "light" },
    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]
};
$(function () {
  genChart();
  genBreakup();
  genEarning();
});
var chartOri = new ApexCharts(document.querySelector("#chart"), chart);
chartOri.render();

async function genChart(){
  // Profit =====================================
  var chartData = await getChartData(API_URL+"user/table");
  // console.log(chartData['data']);
  chart = {
    series: [
      { name: "Earnings this month:", data: [chartData['data'][0]['sd_id']*100, chartData['data'][1]['sd_id']*100, chartData['data'][2]['sd_id']*100, chartData['data'][3]['sd_id']*100, chartData['data'][4]['sd_id']*100, 180, 355, 390] },
      { name: "Expense next month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
    ],
    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },
    colors: ["#5D87FF", "#49BEFF"],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      type: "category",
      categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },
    yaxis: {
      show: true,
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },

    tooltip: { theme: "light" },
    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]
  };
  chartOri.updateOptions(chart);
}
function genBreakup(){
  // Breakup =====================================
  var breakup = {
    color: "#adb5bd",
    series: [60, 30, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],
    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };
  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();
  // chart.destroy();
}
function genEarning(){
  new ApexCharts(document.querySelector("#earning"), earning).render();
}
function newEarning(){
  var earningNew = {
    series: [
      {
        data: [30, 40, 20, 31, 12, 47, 66],
      },
    ],
  };
  new ApexCharts(document.querySelector("#earning"), earning).updateOptions(earningNew)
}
function newChart(paraThis,paraNext){
  // Profit =====================================
  var chartNew = {
    series: [
      { name: "Earnings this month:", data: paraThis },
      { name: "Expense next month:", data: paraNext },
    ],
    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },
  };
  chartOri.updateOptions(chartNew);
}
async function getChartData(url){
  var result = await $.ajax({
    type: 'GET',
    url: url
  });
  return result;
}
$('#selMonthChart').on('change', function() {
  var paraThis = [];
  var paraNext = [];
  if(this.value==1 || this.value==3){
    paraThis = [200,232,400,214,345,234,356,100];
    paraNext = [210,230,400,250,370,250,390,150];
  }else{
    paraThis = [110,230,165,245,400,315,245,100];
    paraNext = [120,240,160,250,320,300,240,200];
  }
  console.log(paraNext);
  newChart(paraThis,paraNext)
});