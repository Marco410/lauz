<div class="row p-4 m-4">
  <div class="col-sm-12 mb-4">
    <div class="row">
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select" style="background-color: var(--bgDark) !important;">
          <option selected value="Period">Period</option>
        </select>
      </div>
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select" style="background-color: var(--bgDark) !important;">
          <option selected value="Instrument">Instrument</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
      <div class="card-header pb-0" style="background-color: var(--bgDark)">
        <h6 class="text-white">Cum Net Profit</h6>
      </div>
      <div class="card-body p-3 ">
        <div class="chart">
          <canvas id="chart-line3" class="chart-canvas" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
      <div class="card-header pb-0" style="background-color: var(--bgDark)">
        <h6 class="text-white">Net Profit</h6>
      </div>
      <div class="card-body p-3 ">
        <div class="chart">
          <canvas id="chart-bar2" class="chart-canvas" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="row">
      <div class="col-sm-12 ">
          <div class="card mb-4" style="background-color: var(--bgDark);min-height: 330px; height: 330px;" >
              <div class="card-body px-0 pt-2 pb-2" >
                <div class="row">
                  <div class="col-sm-4">
                    <label class="text-white">Overview for Day</label>
                  </div>
                  <div class="col-sm-8">
                    <label class="text-white text-right">Days Traded: 17 W 17L - 50% </label>
                  </div>
                </div>
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Day^v</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">P&L</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">P&Win RT%</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Profits</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Loss</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Trades</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Mon</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Tue</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Wed</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

      </div>
  </div>

    <div class="col-sm-4">
      <div class="card z-index-2" style="background-color: var(--bgDark);min-height: 330px">
        <div class="card-header pb-0" style="background-color: var(--bgDark)">
          <h6 class="text-white">Cum Max Drawdown</h6>
        </div>
        <div class="card-body p-3 ">
          <div class="chart">
            <canvas id="chart-line4" class="chart-canvas" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
        <div class="card-header pb-0" style="background-color: var(--bgDark)">
          <h6 class="text-white">Max Drawdown</h6>
        </div>
        <div class="card-body p-3 ">
          <div class="chart">
            <canvas id="chart-bar3" class="chart-canvas" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>

{{--     <div class="col-sm-4" >
      <div class="card" style="background-color: var(--bgDark)">
        <div style="padding: 20px" id='calendar2'></div>
      </div>
    </div> --}}

    <div class="col-sm-4">
        <div class="card mb-4" style="background-color: var(--bgDark);min-height: 330px;height: 330px;" >
            <div class="card-body p-4" >
              <div id='calendar2'></div>
            </div>
        </div>
    </div>

 </div>


@push('dashboard_chart_bar')
<script>
   var ctx7 = document.getElementById("chart-line3").getContext("2d");

   var gradientStroke3 = ctx7.createLinearGradient(92, 237, 193, 50);

  gradientStroke3.addColorStop(1, OPACITY.primaryWithOpacity6);
  gradientStroke3.addColorStop(0.1, OPACITY.primaryWithOpacity15);
  gradientStroke3.addColorStop(0, OPACITY.primaryWithOpacity6); 

    new Chart(ctx7, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor:COLORS.primary,
            borderWidth: 1,
            backgroundColor: gradientStroke3,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230],
            maxBarThickness: 6

          },

        ],
      },
      options: options
    }); 

    var ctx8 = document.getElementById("chart-bar2").getContext("2d");

    const labels55 = ['Ene','Feb','Mar','Abr','May','Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov','Dic'];
    const data55 = {
      labels: labels55,
      datasets: [
        {
          label: 'Dataset 1',
          data: [10,11, 16, 10, 5, 14,20,15,8,12,24,5],
          backgroundColor: [
                COLORS.third,
              ],
          borderColor : 'transparent',
        }
      ]
    };
    new Chart(ctx8, {
      type: "bar",
      data: data55,
      options: {
      responsive: true,
      scales: {
        r: {
          pointLabels: {
            display: true,
            centerPointLabels: true,
            font: {
              size: 12
            },
          },
          grid: {
            color: 'rgba(255,255,255,0.2)',
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

    var ctx9 = document.getElementById("chart-line4").getContext("2d");


    var gradientStroke4 = ctx7.createLinearGradient(92, 237, 193, 50);

    gradientStroke4.addColorStop(1, OPACITY.primaryWithOpacity6);
    gradientStroke4.addColorStop(0.1, OPACITY.primaryWithOpacity15);
    gradientStroke4.addColorStop(0, OPACITY.primaryWithOpacity6); 


      new Chart(ctx9, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: COLORS.primary,
              borderWidth: 1,
              backgroundColor: gradientStroke4,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230],
              maxBarThickness: 6

            },
      
          ],
        },
        options:options,
      }); 


      var ctx10 = document.getElementById("chart-bar3").getContext("2d");

        const labels7 =['Ene','Feb','Mar','Abr','May','Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov','Dic'];
        const data7 = {
          labels: labels7,
          datasets: [
            {
              label: 'Dataset 1',
              data: [10,11, 16, 10, 5, 14,20,15,8,12,24,5],
              backgroundColor: [
                COLORS.third,
              ],
              borderColor : 'transparent',
            }
          ]
        };
        new Chart(ctx10, {
          type: "bar",
          data: data7,
          options: {
          responsive: true,
          scales: {
            r: {
              pointLabels: {
                display: true,
                centerPointLabels: true,
                font: {
                  size: 12
                },
              },
              grid: {
                color: 'rgba(255,255,255,0.2)',
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