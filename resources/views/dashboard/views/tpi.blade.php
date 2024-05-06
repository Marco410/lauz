
<canvas id="polar-area" class="chart-canvas" height="500"></canvas>


@push('dashboard_chart_bar')
<script>
    var ctx4 = document.getElementById("polar-area").getContext("2d");

const DATA_COUNT = 5;
const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

const labels = ['Math', 'Chinese', 'English', 'Geography', 'Physics','History'];
const data = {
  labels: labels,
  datasets: [
    {
      label: 'Dataset 1',
      data: [120, 90, 85, 90, 88,60],
      backgroundColor: [
        OPACITY.thirdWithOpacity6,
      ],
      borderColor: OPACITY.thirdWithOpacity9,
      borderWidth: 1,
    }
  ]
};
new Chart(ctx4, {
  type: "radar",
  data: data,
  options: {
  responsive: true,
  scales: {
    r: {
        beginAtZero:true,
        pointLabels: {
            display: true,
            centerPointLabels: true,
            color: 'white',
            font: {
                size: 11,
            },
        },
        ticks: {
            backdropColor:'transparent',
            color:'white',
        tickBorderDash : [12,6],
            font:{
                size: 9,
            }
        },
      grid: {
        color: 'white',
        lineWidth: 0.5,
        drawTicks:true,
        borderDash:[5,3],
      }
    }
  },
  plugins: {
    legend: false,

    title: {
      display: false,
      text: 'Chart.js Polar Area Chart With Centered Point Labels'
    }
  }
},
});
</script>
@endpush