@push('dashboard')

<script>
  const calHeatmapElement = document.querySelector('#cal-heatmap');
  const loaderCalendar = document.querySelector('#loaderCalendar');
  let cal = null;
  function initHeatMap(){

  var viewportWidth = window.innerWidth;
  var breakPoint = 132;
  var range = 3;

  if(viewportWidth > 1500 ){
    breakPoint = 120;
  }
  else if(viewportWidth < 1500 && viewportWidth > 1400){
    breakPoint = 130;
  }else if ( viewportWidth < 1400 && viewportWidth > 580){
    breakPoint = 100;
    range = 2;
  }else if (viewportWidth < 579){
    breakPoint = 29;
    range = 3;
  }
  var startDate = new Date();
  var minDate = new Date();
  var maxDate = new Date();
  minDate.setMonth(minDate.getMonth() - 1);
  maxDate.setMonth(maxDate.getMonth() + 1);
  const heatMapConfig = { 
    range: range,
    theme: 'dark',
    itemSelector: '#cal-heatmap',
    width: 145,
    animationDuration: 500,
    data: {
      source: [
          { t: new Date('2024-06-06'), v: '0' },
          { t: new Date('2024-06-04'), v: '1' },
          { t: new Date('2024-06-10'), v: '0.5' },
          { t: new Date('2024-06-18'), v: '0' },
          { t: new Date('2024-06-07'), v: '0' },
          { t: new Date('2024-06-12'), v: '1' },
          { t: new Date('2024-06-24'), v: '0.5' },
          { t: new Date('2024-06-31'), v: '0' },
          { t: new Date('2024-06-02'), v: '0' },
          { t: new Date('2024-06-15'), v: '1' },
          { t: new Date('2024-06-20'), v: '0.5' },
          { t: new Date('2024-06-22'), v: '1' },
          { t: new Date('2024-06-23'), v: '0' },
          { t: new Date('2024-06-27'), v: '1' },
          { t: new Date('2024-06-28'), v: '0.5' },
          { t: new Date('2024-06-29'), v: '0' },
          { t: new Date('2024-04-03'), v: '0' },
          { t: new Date('2024-04-04'), v: '1' },
          { t: new Date('2024-04-10'), v: '0.5' },
          { t: new Date('2024-04-18'), v: '0' },
          { t: new Date('2024-04-07'), v: '0' },
          { t: new Date('2024-04-14'), v: '1' },
          { t: new Date('2024-04-21'), v: '0.5' },
          { t: new Date('2024-04-12'), v: '1' },
          { t: new Date('2024-04-01'), v: '0' },
          { t: new Date('2024-04-02'), v: '1' },
          { t: new Date('2024-04-09'), v: '0.5' },
          { t: new Date('2024-04-22'), v: '0' },
          { t: new Date('2024-04-26'), v: '0' },
          { t: new Date('2024-04-29'), v: '1' },
          { t: new Date('2024-04-06'), v: '1' },
          { t: new Date('2024-04-30'), v: '0.5' },
          { t: new Date('2024-05-28'), v: '0' },
          { t: new Date('2024-05-03'), v: '0' },
          { t: new Date('2024-05-04'), v: '1' },
          { t: new Date('2024-05-10'), v: '0.5' },
          { t: new Date('2024-05-18'), v: '0' },
          { t: new Date('2024-05-01'), v: '1' },
          { t: new Date('2024-05-16'), v: '1' },
          { t: new Date('2024-05-07'), v: '0' },
          { t: new Date('2024-05-12'), v: '1' },
          { t: new Date('2024-05-13'), v: '1' },
          { t: new Date('2024-05-14'), v: '0.5' },
          { t: new Date('2024-05-22'), v: '0' },
          { t: new Date('2024-05-25'), v: '1' },
          { t: new Date('2024-05-27'), v: '1' },
          { t: new Date('2024-05-29'), v: '1' },
          { t: new Date('2024-05-30'), v: '0.5' },
          { t: new Date('2024-05-31'), v: '0' },
        ],
        x: 't',
        y: 'v',
        groupY: d => d[0],
      },
      date: {
          locale: { weekStart: 0 },
          startDate: maxDate,
          min: minDate,
          max: maxDate,
        },
      domain: {
        type: 'month',
        sort: 'asc',
        
        label: { 
          offset: {
            x: 10,
            y: 0,
          },
        }
      },
      subDomain:  { 
        type: 'day',
        radius: 2, 
        label: (t, v) => v,
        width: viewportWidth /breakPoint,
        height: viewportWidth /breakPoint,
        label:'D' 
      },
      scale: {
        color: {
        type: 'linear',
        range: ['#e0e0e0','#61f2c6'],
        domain: [0,1],
        baseColor: '#323239',
        },
      },
    };

    if (cal) {
      cal.destroy();
      cal = null;
    }

    cal = new CalHeatmap();
    cal.paint(heatMapConfig,
        [
          [
            Legend,
            {
              includeBlank: true,
              width: 150,
              itemSelector: '#legend',
              radius: 2,
            },
          ],
          [
            Tooltip,
            {
              radius: 2,
              text: function (date, value, dayjsDate) {
                return (
                  (value ? (value > 0) ? 'Good day' : 'Bad Day'  : 'No data') + ' on ' + dayjsDate.format('LL')
                );
              },
            },
          ],
          [
            CalendarLabel,
            {
              width: 30,
              textAlign: 'bottom',
              text: () => dayjs.weekdaysShort().map((d, i) => d),
            
            },
          ],
        ]
      );
      setTimeout(() => {
        calHeatmapElement.style.display = 'block';
        loaderCalendar.style.display = 'none';
      }, 700);
  }

  initHeatMap();

    window.addEventListener('resize', function() {
      calHeatmapElement.style.display = 'none';
      loaderCalendar.style.display = 'block';
      initHeatMap();
    });

</script>
@endpush

<div class="col-sm-12 text-center justify-content-center align-items-center">
  <div class="spinner-border text-primary spinner-border-md text-center" style="margin-left: 30px" id="loaderCalendar"  role="status"> </div>
  <div id="cal-heatmap"></div>
</div>
<div class="d-flex justify-content-between" style="padding-left: 50px; padding-right: 50px; margin-top: 20px">
  <label class="text-white" style="font-size: 12px !important;">Bad day</label>
  <label class="text-white" style="font-size: 12px !important;">Good day</label>
</div>
<div class="col-sm-6 offset-sm-3 text-center ">

  <div id="legend"></div>
  <div class="d-flex justify-content-center gap-2 mt-2">
    <h6 class="text-primary" style="font-size: 11px">70 W</h6>
    <h6 class="text-white" style="font-size: 11px">/</h6>
    <h6 class="text-danger" style="font-size: 11px"> 30 W</h6>
    <h6 class="text-primary" style="font-size: 11px">70 %</h6>
  </div>
</div>

