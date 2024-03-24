
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start" id="sidenav-main"  style="overflow: hidden"  >
  <div class="sidenav-header" >
    <i class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-none d-xl-none justify-content-center" aria-hidden="true" id="iconSidenav"></i>
    <div class="align-items-center d-flex m-0 navbar-brand text-wrap ">
        <img class="mb-2 navbar-brand-img" src="{{ asset('assets/img/icons/more.png') }}" class="navbar-brand-img" height="20px" alt="lauz.io" id="iconHideShowSidenav">
        <a class="" href="{{ route('dashboard') }}" style="background-color: var(--bgDark); padding-top: 10px; padding-right: 10px;border-radius: 8px;">
        <h4 class="ms-3 font-weight-bold text-white brand-title">LAUZ.IO</h4>
        </a>
    </div>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="d-flex flex-column justify-content-between" style="height:88vh;">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main" >
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <img src="{{ asset('assets/img/icons/rocket.png') }}" height="20px"  alt="rocket">
          <span class="nav-link-text ms-1 ">My Performance</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('my-accounts') ? 'active' : '') }}" href="{{ url('my-accounts') }}">
          <img src="{{ asset('assets/img/icons/money-bag.png') }}" height="20px"  alt="money">
          <span class="nav-link-text ms-1">My Accounts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <img src="{{ asset('assets/img/icons/trofeo.png') }}" height="20px"  alt="trofeo">
          <span class="nav-link-text ms-1">My Challenges</span>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('leader-strategys') ? 'active' : '') }}"  href="{{ url('leader-strategys') }}">
          <img src="{{ asset('assets/img/icons/estrella.png') }}" height="20px"  alt="estrella">
          <span class="nav-link-text ms-1">Leader Strategys</span>
        </a>
      </li>

    </ul>
  </div>

    <div class=""  >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ (Request::is('import-trades') ? 'active' : '') }}" href="{{ url('import-trades') }}">
            <img src="{{ asset('assets/img/icons/descargas.png') }}" height="20px"  alt="rocket">
            <span class="nav-link-text ms-1 text-danger">Import Trades</span>
          </a>
        </li>
      </ul>
    </div>
  </div>


</aside>
