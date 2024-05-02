    
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12" >
                <h6 class="text-white " style="font-size: 13px;">Net P&L</h6>
                <h5 class="text-primary" id="totalNetPl"> <div class="spinner-border text-primary spinner-border-md"  role="status"> </div></h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Annual Return</h6>
                <h5 class="text-primary"> $2.500</h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">DrawDown</h6>
                <h5 class="text-danger"> $2.500</h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Profit Factor</h6>
                <h5 class="text-primary">1.4</h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Avg Win/loss</h6>
                <h5 class="text-primary">2.0</h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Q. Trades</h6>
                <h5 class="text-primary">350</h5>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2" style="height: 100px; width: 100%; background-color: var(--bg);">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">CAGR</h6>
                <h5 class="text-primary">5%</h5>
            </div>
        </div>
    </div>


    {{--   <div class="col-sm-12">
    <div id="chartDiv" style=" height:
    300px;  background-color: black;"></div>
     </div> --}}

  @push('dashboard_chart_bar')
  <script>

    /* 
        var chartPalette = JSC.getPalette();
      var items = [
        {
          name: 'Alex',
          pattern: {
            date: [
              '6/5/20',
              '6/6/20',
              '6/7/20',
              '6/8/20',
              '6/9/20',
              '6/10/20',
              '6/11/20',
              '6/12/20',
              '9/5/20',
              '9/6/20',
              '9/7/20',
              '9/8/20'
            ]
          }
        },
        {
          name: 'Mike',
          pattern: {
            date: [
              '1/1/20',
              '1/2/20',
              '1/3/20',
              '1/4/20',
              '1/5/20',
              '6/9/20',
              '6/10/20',
              '6/11/20',
              '6/12/20',
              '6/13/20',
              '6/14/20',
              '6/15/20'
            ]
          }
        },
        {
          name: 'Jeff',
          pattern: {
            date: [
              '2/1/20',
              '2/2/20',
              '2/3/20',
              '2/4/20',
              '2/5/20',
              '2/6/20',
              '2/7/20',
              '2/8/20',

              '7/9/20',
              '7/10/20',
              '7/11/20',
              '7/12/20',
              '7/13/20',
              '7/14/20',
              '7/15/20'
            ]
          }
        }
      ];
      items.forEach(function(item, i) {
        item.color = chartPalette[i];
        item.visible = true;
      });

      var chartConfig = {
        debug: true,
        type: 'calendar year solid',
        calendar_range: ['1/1/20', '12/31/20'],
        annotations: [
          {
            label_text: '<b>Vacation Days 2020</b>',
            position: 'top'
          }
        ],
        defaultSeries: {
          shape_innerPadding: 0,
          legendEntry_visible: false,
          defaultPoint: { outline_color: '#323232', opacity: 0.08 }
        },
        legend: {
          header: 'Days Off,,Name',
          title_label_text: 'Click entries below to <br>toggle vacation highlights',
          customEntries: items.map(function(item, i) {
            return {
              name: item.name,
              id: 'lid-' + i,
              icon_color: item.color,
              value: item.pattern.date.length.toString(),
              events: {
                click: function() {
                  var item = items[i];
                  if (item.visible) {
                    hideDays(i);
                    item.visible = false;
                  } else {
                    item.visible = true;
                    showDays(i);
                  }
                }
              }
            };
          })
        }
      };

      chartConfig.legend.customEntries.push({
        name: 'Holidays',
        value: '',
        lineAbove: { width: 1 },
        icon: { color: '#ffb77d' }
      });

      var chart;
      makeHolidayPoints(initChart);
      function initChart(holidayPoints) {
        chartConfig.series = [{ points: holidayPoints }];
        chart = JSC.chart('chartDiv', chartConfig, function(c) {
          showAll(c);
        });
      }

      function showAll(chartRef) {
        for (var i = 0; i < items.length; i++) {
          showDays(i, chartRef);
        }
      }
      function hideAll() {
        for (var i = 0; i < items.length; i++) {
          hideDays(i);
        }
      }
      function hideDays(i) {
        var highlight = chart.highlights('id-' + i);
        highlight && highlight.remove();
        // Gray out legend entry
        chart
          .legends(0)
          .entries('lid-' + i)
          .options({ color: '#bababa' });
      }
      function showDays(i, chartRef) {
        var id = 'id-' + i,
          config = items[i];
        var c = chartRef || chart;
        var highlight = c.highlights(id);
        config.id = id;
        config.outline = { width: 0 };
        if (!highlight) {
          c.highlights.add(config);
        }
        c.legends(0)
          .entries('lid-' + i)
          .options({ color: 'black' });
      }

      function makeHolidayPoints(callback) {
        JSC.fetch('./usHolidays.json.txt')
          .then(function(response) {
            return response.json();
          })
          .then(function(data) {
            var holidayPoints = data.map(function(item) {
              return {
                date: item.pattern,
                fill: '#ffb77d',
                opacity: 0.8,
                outline: {
                  dashStyle: 'dot',
                  color: '#ffa14d',
                  width: 1
                },
                tooltip: '<b>%name</b> ' + item.name
              };
            });
            callback(holidayPoints);
          });
      } 
    */


   /*  var ctx8 = document.getElementById("bar-net").getContext("2d");

    const optionsBars = {
        responsive: true,
        scales: {
            x: {
                display:false,
                grid: {
                    display: false
                }
            },
            y: {
                display:false,
                grid: {
                    display: false
                }
            },
        
        },
        plugins: {
            legend: false,
            title: {
                display: false,
                text: ''
            },
            datalabels: {
                display: false
            }
        }
    };

    const labels5 = ['Risk', 'CAG', 'CAG', 'CAG', 'Cons'];
    const data5 = {
    labels: labels5,
    datasets: [
        {
        label: 'Dataset 1',
        data: [11, 16, 10, 5, 14],
        backgroundColor: item => {
            let colors = item.raw > 10 ? '#70bcfe' : '#4ee0b6';
            return colors;
        }
        }
    ]
    };
    new Chart(ctx8, {
    type: "bar",
    data: data5,
    options: optionsBars,
    }); */
  </script>
  
  @endpush