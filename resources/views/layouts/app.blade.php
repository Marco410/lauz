<!DOCTYPE html>

  <html lang="en" >

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Lauz.io
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pageMainStyle" href="../assets/css/style.css" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>

  <script src="https://d3js.org/d3.v7.min.js"></script>
  <script src="https://unpkg.com/cal-heatmap/dist/cal-heatmap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/cal-heatmap/dist/cal-heatmap.css">
  <script src="https://unpkg.com/cal-heatmap/dist/plugins/Legend.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/cal-heatmap/dist/plugins/Tooltip.min.js"></script>
  <script src="https://unpkg.com/cal-heatmap/dist/plugins/CalendarLabel.min.js"></script>


  <script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        height:'100%',
        events: [
          {
            title: 'All Day Event',
            start: '2024-03-01',
            color: "#ff4861"
          },
          {
            title: 'Lauz event',
            start: '2024-03-03',
            end:'2024-03-05'
          },
          {
            title: 'Lauz event 2',
            start: '2024-03-22',
            end:'2024-03-26',
            color:'#61f2c6'
          },
        ],
        eventColor: '#70bbfd',
        eventClick(event){
          console.log(event);
        }
        
      });
      calendar.render();

      var calendarEl2 = document.getElementById('calendar2');
      var calendar2 = new FullCalendar.Calendar(calendarEl2, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        height:'100%',
      });
      calendar2.render();


    });

  </script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script>
<script type="text/javascript" src="https://code.jscharting.com/latest/modules/types.js"></script>

</head>

<body class="g-sidenav-show {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }}" style="background-color: {{ (\Request::is('login','register','verify-email','welcome-lauz') ? 'var(--bg)' : 'var(--bgDark)') }} ">

    @auth
    @yield('auth')
    @endauth
    @guest
    @yield('guest')
    @endguest

    <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  @stack('rtl')
  @stack('dashboard')
  @stack('dashboard_chart_bar')
  @stack('landing')

  <script src="../assets/js/lauz/constants.js"></script>
  <script src="../assets/js/lauz/data.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>

  <script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Write here...',
    });
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

</body>

</html>
