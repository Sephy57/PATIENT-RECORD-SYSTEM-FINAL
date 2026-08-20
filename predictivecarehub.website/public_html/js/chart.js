setTimeout(() => {
  let container = document.getElementById('carousel');
  if (info) {
    if (JSON.parse(info.data).length == 1) {
      document.getElementsByClassName('carousel-button')[0].style.display =
        'none';
      document.getElementsByClassName('carousel-button')[1].style.display =
        'none';
    }

    for (let i = 0; i < JSON.parse(info.data).length; i++) {
      let data_active = i === 0 ? 'data-active' : '';
      container.innerHTML += `
    <div class="flex flex-wrap slider p-0 xl:py-5 mt-5 xl:mt-0 slides" ${data_active} data-aos="zoom-in">
          <div class="w-full pr-0 lg:pr-2 h-auto flex justify-center items-center mb-6">
          <div class="p-0 xl:p-6 flex w-full justify-center items-center rounded pie-background">
          <canvas id="clientChartPie${i}" width="200" height="125"></canvas>
          </div>
          </div>
          <div class="w-full pr-0 lg:pr-2 h-auto flex justify-between flex-col ">
          <div class="p-0 xl:p-6 flex w-full justify-center items-center rounded bar-background">
          <canvas id="clientChartBar${i}" width="200" height="125"></canvas>
              </div>
          </div>
          <div class="pr-0 lg:pr-2 h-auto mt-5 w-full">
              <h1 class="!text-white text-xl mb-2 ss">Sign & Symptoms</h1>
              <div class="flex gap-2 flex-wrap" id="clientSymptoms${i}">
              </div>
              </div>
              </div>
              `;
    }
  } else {
    container.innerHTML = `<h1 class='text-center text-white text-xl ss'>No data available.</h1>`;
    document.getElementsByClassName('carousel-button')[0].style.display =
      'none';
    document.getElementsByClassName('carousel-button')[1].style.display =
      'none';
  }
}, 99);

var info;

let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    info = JSON.parse(this.responseText);
  }
};
xhttp.open('GET', '../functions/get_predictive_data.php', true);
xhttp.send();

let dateInput = document.getElementById('analysis_date');

dateInput.addEventListener('change', function () {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      info = JSON.parse(this.responseText);
    }
  };
  xhttp.open(
    'GET',
    `../functions/get_predictive_data.php?id=${dateInput.value}`,
    true
  );
  xhttp.send();

  let container = document.getElementById('carousel');
  container.innerHTML = '';

  reupdateData();
});

const colors = [
  '#bdcf32',
  '#ef9b20',
  '#f46a9b',
  '#e60049',
  '#0bb4ff',
  '#50e991',
  '#e6d800',
  '#9b19f5',
  '#ffa300',
  '#dc0ab4',
  '#b3d4ff',
  '#00bfa0',
];

const data_labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December',
];

setTimeout(() => {
  if (info) {
    for (let i = 0; i < JSON.parse(info.data).length; i++) {
      //create piechart
      createPieChart(
        JSON.parse(info.data)[i].current,
        'clientChartPie' + i,
        data_labels,
        JSON.parse(info.data)[i].disease
      );

      // create barchart
      createBarChart(
        'clientChartBar' + i,
        data_labels,
        JSON.parse(info.data)[i].previous,
        JSON.parse(info.data)[i].current,
        JSON.parse(info.year),
        JSON.parse(info.data)[i].disease
      );

      createSymptomsList(
        JSON.parse(info.data)[i].prec_prev,
        'clientSymptoms' + i
      );
    }
  }
}, Math.floor(Math.random() * (200 - 150) + 150));

function createPieChart(data, pie_id, data_labels, disease_name) {
  let chart = document.getElementById(pie_id);
  new Chart(chart, {
    type: 'line',
    data: {
      labels: data_labels,
      datasets: [
        {
          label: 'CALCULATED DATA PREDICTION',
          data: data.map((data) => {
            return parseInt(data);
          }),
          backgroundColor: colors,
          borderColor: '#777',
          borderWidth: 2,
          fill: false,
          pointRadius: 5,
          pointHoverRadius: 7,
        },
      ],
    },
    options: {
      title: {
        display: false,
      },
      tooltips: {
        enabled: true,
      },
      plugins: {
        labels: [
          {
            render: 'percentage',
            fontColor: '#222',
            fontSize: 14,
            fontStyle: 'bold',
            position: 'border',
            // arc: true,
          },
        ],
      },
      responsive: true,
      maintainAspectRatio: true,
      legend: {
        labels: {
          fontColor: '#222', // Change to the desired font color
          fontSize: 14,
        },
      },
    },
  });
}

function createBarChart(
  bar_id,
  data_labels,
  previous,
  current,
  year,
  disease_name
) {
  Chart.defaults.global.defaultFontStyle = 'Bolder';
  let chart = document.getElementById(bar_id);
  new Chart(chart, {
    type: 'bar',
    data: {
      labels: data_labels,
      datasets: [
        {
          label: 'Total Cases in ' + (parseInt(year) - 1),
          data: previous.map((data) => {
            return parseInt(data);
          }),
          backgroundColor: 'rgba(255, 99, 132,1)',
          borderWidth: 1,
        },
        {
          label: 'Moving Average in ' + year,
          data: current.map((data) => {
            return parseInt(data);
          }),
          backgroundColor: 'rgba(54, 162, 235,1)',
          borderWidth: 1,
        },
      ],
    },
    options: {
      title: {
        display: true,
        text: disease_name.toUpperCase(),
        // fontColor: '#EFEFF1',
      },
      plugins: {
        legend: {
          labels: {
            fontColor: '#222',
            fontSize: 14,
            fontStyle: 'bold',
            font: {
              weight: 'bold',
            },
          },
        },
      },
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  });
}

// create list of symptoms
function createSymptomsList(prec_prev, id) {
  let container = document.getElementById(id);
  for (let i = 0; i < prec_prev.length; i++) {
    container.innerHTML += `<div class="bg-white px-3 py-2 rounded hover:bg-gray-200 w-full sm:w-auto">${prec_prev[i]}</div>`;
  }
}

function reupdateData() {
  setTimeout(() => {
    let container = document.getElementById('carousel');
    document.getElementsByClassName('carousel-button')[0].style.display =
        'block';
      document.getElementsByClassName('carousel-button')[1].style.display =
        'block';
        
    if (info) {
      if (JSON.parse(info.data).length == 1) {
        document.getElementsByClassName('carousel-button')[0].style.display =
          'none';
        document.getElementsByClassName('carousel-button')[1].style.display =
          'none';
      }

      for (let i = 0; i < JSON.parse(info.data).length; i++) {
        let data_active = i === 0 ? 'data-active' : '';
        container.innerHTML += `
    <div class="flex flex-wrap slider p-0 xl:py-5 mt-5 xl:mt-0 slides" ${data_active} data-aos="zoom-in">
          <div class="w-full pr-0 lg:pr-2 h-auto flex justify-center items-center mb-6">
          <div class="p-0 xl:p-6 flex w-full justify-center items-center rounded pie-background">
          <canvas id="clientChartPie${i}" width="200" height="125"></canvas>
          </div>
          </div>
          <div class="w-full pr-0 lg:pr-2 h-auto flex justify-between flex-col ">
          <div class="p-0 xl:p-6 flex w-full justify-center items-center rounded bar-background">
          <canvas id="clientChartBar${i}" width="200" height="125"></canvas>
              </div>
          </div>
          <div class="pr-0 lg:pr-2 h-auto mt-5 w-full">
              <h1 class="!text-white text-xl mb-2 ss">Sign & Symptoms</h1>
              <div class="flex gap-2 flex-wrap" id="clientSymptoms${i}">
              </div>
              </div>
              </div>
              `;
      }
    } else {
      container.innerHTML = `<h1 class='text-center text-white text-xl ss'>No data available.</h1>`;
      document.getElementsByClassName('carousel-button')[0].style.display =
        'none';
      document.getElementsByClassName('carousel-button')[1].style.display =
        'none';
    }
  }, 99);

  setTimeout(() => {
    if (info) {
      for (let i = 0; i < JSON.parse(info.data).length; i++) {
        //create piechart
        createPieChart(
          JSON.parse(info.data)[i].current,
          'clientChartPie' + i,
          data_labels,
          JSON.parse(info.data)[i].disease
        );

        // create barchart
        createBarChart(
          'clientChartBar' + i,
          data_labels,
          JSON.parse(info.data)[i].previous,
          JSON.parse(info.data)[i].current,
          JSON.parse(info.year),
          JSON.parse(info.data)[i].disease
        );

        createSymptomsList(
          JSON.parse(info.data)[i].prec_prev,
          'clientSymptoms' + i
        );
      }
    }
  }, Math.floor(Math.random() * (200 - 150) + 150));
}
