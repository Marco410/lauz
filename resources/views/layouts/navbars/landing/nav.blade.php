<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 blur blur-rounded shadow py-2 start-0 end-0 mx4" style="background-color: hsla(0, 0%, 23%, 0.6)!important">
  <div class="container-fluid container">
    <div class="col-sm-2" >
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ url('dashboard') }}">
        Logo
      </a>
    </div>
   <div class="col-sm-3" >
     <div class="input-group">
       <span class="input-group-text" style="background-color: var(--bg);border-color: transparent !important;
       color: white; height: 35px; border-radius: 30px 0px 0px 30px; padding: 15px;" ><i class="fa fa-search text-white"></i></span>
       <input type="text" class="form-control" placeholder="Search..." style="background-color: var(--bg); border-color: transparent !important;
        color: white; height: 35px; border-radius: 0px 30px 30px 0px; padding: 15px;">
     </div>
   </div>

   <div class="col-sm-7">
    <div class="collapse navbar-collapse " id="navigation">
      <ul class="navbar-nav mx-auto d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Strategies
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Features
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Pricing
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            Community
          </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-sm btn-primary mt-3" href="{{ url('login') }}">
            Sign In
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            <i class="fas fa-user-circle" style="font-size: 22px"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            <i class="fas fa-question-circle" style="font-size: 22px"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 text-white" href="">
            <i class="fas fa-globe" style="font-size: 22px"></i>
          </a>
        </li>
      </ul>
     
    </div>
   </div>
    
  </div>
</nav>
<!-- End Navbar -->
