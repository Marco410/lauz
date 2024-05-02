<div class="row p-4 m-4">
    <div class="col-sm-8">
     <div class="row">
      <div class="col-sm-6">
        <div class="d-flex justify-content-between" >
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="text-white " style="font-size: 13px;">Net P&L</h6>
                    <h6 class="text-primary"> $2.500</h6>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
          <div class="row">
              <div class="col-sm-12">
                  <h6 class="text-white " style="font-size: 13px;">Annual Return</h6>
                  <h6 class="text-primary"> $2.500</h6>
              </div>
          </div>
      </div>
      <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
          <div class="row">
              <div class="col-sm-12">
                  <h6 class="text-white " style="font-size: 13px;">DrawDown</h6>
                  <h6 class="text-danger"> $2.500</h6>
              </div>
          </div>
      </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="d-flex justify-content-between" >
     
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
              <div class="row">
                  <div class="col-sm-12">
                      <h6 class="text-white " style="font-size: 13px;">Profit Factor</h6>
                      <h6 class="text-primary">1.4</h6>
                  </div>
              </div>
          </div>
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
              <div class="row">
                  <div class="col-sm-12">
                      <h6 class="text-white " style="font-size: 13px;">Avg Win/Loss</h6>
                      <h6 class="text-primary">2.0</h6>
                  </div>
              </div>
          </div>
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="text-white " style="font-size: 13px;">Q.Trades</h6>
                    <h6 class="text-primary">350</h6>
                </div>
            </div>
        </div>
        </div>
      </div>
   
       <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
          <div class="card-header pb-0" style="background-color: var(--bgDark)">
            <h6 class="text-white">Daily Net Cumulative P&L</h6>
          </div>
          <div class="card-body p-3 ">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
          <div class="card-header pb-0" style="background-color: var(--bgDark)">
            <h6 class="text-white">Daily Net P&L</h6>
          </div>
          <div class="card-body p-3 ">
            <div class="chart">
              <canvas id="chart-bar" class="chart-canvas" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
          <div class="card-header pb-0" style="background-color: var(--bgDark)">
            <h6 class="text-white">Trades for Direction</h6>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <div class="chart" >
                        <div class="position-relative">
                          <canvas id="pie-bar" class="chart-canvas" height="60"></canvas>
                          <h4 class="position-absolute  start-50 translate-middle" style="bottom: 25px; color:var(--textGray)">345</h4>
                        </div>
                      </div>
                </div>
                <div class="col-sm-5">
                    <h6 class="text-primary" >Longs: 100</h6>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                      <h6 class="text-primary" style="font-size: 11px">70 W</h6>
                      <h6 class="text-white" style="font-size: 11px">/</h6>
                      <h6 class="text-danger" style="font-size: 11px"> 30 W</h6>
                      <h6 class="text-primary" style="font-size: 11px">70 %</h6>
                    </div>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                      <h6 class="text-primary" style="font-size: 11px">70 W</h6>
                      <h6 class="text-white" style="font-size: 11px">/</h6>
                      <h6 class="text-danger" style="font-size: 11px"> 30 W</h6>
                      <h6 class="text-primary" style="font-size: 11px">70 %</h6>
                    </div>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card" style="background-color: var(--bgDark); min-height: 300px">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-11">
                    <h6 class="text-white">Trades for Instrument</h6>
                    <div class="row mt-4">
                      <div class="col-sm-5 mt-4 p-3">
                        <div id="legend-container"></div>
                      </div>
                      <div class="col-sm-7 p-3">
                        <div class="chart" >
                            <canvas id="pie-bar2" class="chart-canvas" height="100"></canvas>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

     </div>
    
    </div>
    <div class="col-sm-4">

        <div class="row">
            <div class="col-sm-12 mt-1">
                <div class="card mb-4" style="background-color: var(--bgDark); height: 408px; min-height: 408px" >
                    <div class="card-body px-1 pb-2" >
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Performance</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">All Trades</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Longs</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Shorts</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Total Net Profit</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$5.000</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$3,000</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$2,000</small></td>
                            </tr>
                            <tr>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Max DrawDown</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$2.000</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$500</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$2,000</small></td>
                             </tr>
                            <tr>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Profit Factor</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">1.4</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">1.2</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">1.5</small></td>
                             
                            </tr>
                            <tr>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Avg Win Trade</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$61</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$59</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$62</small></td>
                            </tr>
                            <tr>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Max. Consec. Win</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">4</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">3</small></td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">7</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Largest Win Trade</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$316</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$80</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">$360</small></td>
                              </tr>
                              <tr>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Largest Lose Trade</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$200</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$200</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">-$60</small></td>
                              </tr>
                              <tr>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">Avg time in Market</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">12.61 min</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">13.44min</small></td>
                                <td><small class="text-xs fw-lighter" style="color: var(--textGray);">10.12min</small></td>
                              </tr>
                            
                             
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-sm-12 ">
                <div class="card mb-4" style="background-color: var(--bgDark);height: 318px; min-height: 318px" >
                    <div class="card-body p-4" >
                      <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
 </div>


 @push('dashboard_chart_bar')
<script>

      var options = {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              beginAtZero:true,
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#c0bfc6',
                font: {
                  size: 8,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              },
              grid: {
                drawBorder: false,
                display: true,
                drawTicks: false,
                borderDash: [2, 1],
                color:'#4b4b51'
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#c0bfc6',
                padding: 10,
                font: {
                  size: 8,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
    
          },
        };
      var ctx2 = document.getElementById("chart-line").getContext("2d");

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3bd3a9",
              borderWidth: 0.7,
              backgroundColor: "rgba(92,237,194,0.15)",
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230],
              maxBarThickness: 6

            },
          ],
        },
        options: options,
      }); 


      var ctx4 = document.getElementById("chart-bar").getContext("2d");

        const labels2 = ['Ene','Feb','Mar','Abr','May','Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov','Dic','Ene','Feb','Mar','Jul', 'Ago', 'Sep',];
        const data2 = {
          labels: labels2,
          datasets: [
            {
              label: 'Dataset 1',
              data: [10,18, 16, 10, 5, 14,20,15,8,12,24,5,16, 10, 5,8,12,24],
              backgroundColor: '#ff4861',
              borderColor : 'transparent',
            }
          ]
        };
        new Chart(ctx4, {
          type: "bar",
          data: data2,
          options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero:true,
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 5,
                color: '#c0bfc6',
                font: {
                  size: 8,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#c0bfc6',
                padding: 10,
                font: {
                  size: 8,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
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


        var ctx5 = document.getElementById("pie-bar").getContext("2d");

          const labels3 = ['Risk', 'CAG'];
          const data3 = {
            labels: labels3,
            datasets: [
              {
                label: 'Dataset 1',
                data: [18, 9],
                backgroundColor: [
                  'rgba(186,232,133,1)',
                  'rgba(243,244,247,1)'
                ],
                borderColor : 'transparent',
                circumference:180,
                rotation:270,
                cutout:'70%',
                hoverOffset:5

              }
            ]
          };
          new Chart(ctx5, {
            type: "doughnut",
            data: data3,
            options: {
            responsive: true,
            plugins: {
              legend: false,
            }
          },
          });

          const getOrCreateLegendList = (chart,id) => {
            const legendContainer = document.getElementById(id);
            let listContainer = legendContainer.querySelector('ul');

            if(!listContainer){
              listContainer = document.createElement('ul');
              listContainer.className = 'listContainer';
              legendContainer.appendChild(listContainer);
            }

            return listContainer;
          }


          const htmlLegendPlugin = {
            id: 'htmlLegend',
            afterUpdate(chart, args,options) {
              const ul = getOrCreateLegendList(chart, options.containerID);

              while (ul.firstChild){
                ul.firstChild.remove();
              }

              const items = chart.options.plugins.legend.labels.generateLabels(chart);

              items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'li';

                const boxSpan = document.createElement('span');
                boxSpan.className = 'boxSpan';
                boxSpan.style.backgroundColor = item.fillStyle;
                boxSpan.style.borderColor = item.strokeStyle;

                const textContainer = document.createElement('small');
                textContainer.className = 'textContainer';
                textContainer.style.color = 'white';
                textContainer.style.textDecoration = (item.hidden) ? 'line-through' : 'none';


                const text = document.createTextNode(item.text);
                textContainer.appendChild(text);

                li.onclick = () => {
                  const {type} = chart.config;
                  if(type === 'pie' || type === 'doughnut'){
                    chart.toggleDataVisibility(item.index);
                  }else{
                    chart.setDatasetVisibility(item.datasetIndex);
                  }

                  chart.update();
                }

                li.appendChild(boxSpan);
                li.appendChild(textContainer);
                ul.appendChild(li);
              });

            }
          }

          var ctx6 = document.getElementById("pie-bar2").getContext("2d");

          const labels4 = ['NQ', 'ES','YM','NONE'];
          const data4 = {
            labels: labels4,
            datasets: [
              {
                label: 'Dataset 1',
                data: [2400, 1500,1000,800],
                backgroundColor: [
                  'rgba(115,186,249,1)',
                  'rgba(86,227,186,1)',
                  'rgba(253,73,97,1)',
                  'rgba(247,217,112,1)'
                ],
                borderColor : 'transparent',
                cutout:'70%',
                hoverOffset:10

              }
            ]
          };
          new Chart(ctx6, {
            type: "doughnut",
            data: data4,
            options: {
              responsive: true,
        
              plugins: {
                legend: {
                  display:false,
                  labels: {
                    color: 'white'
                  }
                },
                htmlLegend: {
                  containerID: 'legend-container'
                }
              }
            },
            plugins: [htmlLegendPlugin]
          });
</script>
@endpush