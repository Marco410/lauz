
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start" id="sidenav-main" >
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-none d-xl-none justify-content-center" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/img/icons/more.png') }}" class="navbar-brand-img" height="20px"  alt="lauz.io">
        <h4 class="ms-3 font-weight-bold text-white">LAUZ.IO</h4>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="d-flex flex-column justify-content-between" style="height:88vh;">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main" >
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <img class="mx-2" src="{{ asset('assets/img/icons/rocket.png') }}" height="20px"  alt="rocket">
          <span class="nav-link-text ms-1">My Performance</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('my-accounts') ? 'active' : '') }}" href="{{ url('my-accounts') }}">
          <img class="mx-2" src="{{ asset('assets/img/icons/money-bag.png') }}" height="20px"  alt="money">
          <span class="nav-link-text ms-1">My Accounts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <img class="mx-2" src="{{ asset('assets/img/icons/trofeo.png') }}" height="20px"  alt="trofeo">
          <span class="nav-link-text ms-1">My Challenges</span>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('leader-strategys') ? 'active' : '') }}"  href="{{ url('leader-strategys') }}">
          <img class="mx-2" src="{{ asset('assets/img/icons/estrella.png') }}" height="20px"  alt="estrella">
          <span class="nav-link-text ms-1">Leader Strategys</span>
        </a>
      </li>

    </ul>
  </div>

  <div class=""  >
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('import-trades') ? 'active' : '') }}" href="{{ url('import-trades') }}">
          <img class="mx-2" src="{{ asset('assets/img/icons/descargas.png') }}" height="20px"  alt="rocket">
          <span class="nav-link-text ms-1 text-danger">Import Trades</span>
        </a>
      </li>
    </ul>
  </div>
</div>


</aside>
