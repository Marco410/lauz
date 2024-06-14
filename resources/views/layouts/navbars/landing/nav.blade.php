<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid container">
    <div class="col-sm-2" >
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ url('dashboard') }}">
        <img src="{{ asset('assets/img/logo.svg') }}" class="image ms-3" height="35px" alt="">
      </a>
    </div>

   <div class="col-sm-7">
    <div class="collapse navbar-collapse " id="navigation">
      <ul class="navbar-nav mx-auto d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="#">
            Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="#">
            Acerca de
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Servicios
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Recursos
          </a>
        </li>
        @auth
        <li class="nav-item">
          <a class="nav-link me-2 text-primary" style="margin-right: 10px;" href="{{ url('dashboard') }}">
            {{ auth()->user()->name }} {{ auth()->user()->last_name }}
          </a>
        </li>
        @else
          <li class="nav-item">
            <a class="btn btn-sm btn-secondary mt-3" style="margin-right: 10px;" href="{{ url('register') }}">
              Registrarse
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-primary mt-3" href="{{ url('login') }}">
              Iniciar Sesión
            </a>
          </li>

        @endauth
     
      </ul>
     
    </div>
   </div>
    
  </div>
</nav>
<!-- End Navbar -->
