@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-1">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
   
    </div>
    <div class="container">
      <div class="row mt-lg-n12 mt-md-n11 mt-n12">
        <div class="col-sm-7 mx-auto">
          <div class="card z-index-0" style="background-color: var(--bgDark)">
            <div class="card-header pb-0 text-center bg-transparent" >
              <h3 class="font-weight-bolder text-bold text-white">Welcome to Lauz</h3>
            </div>
            <div class="card-body">
                <p class="text-white" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p class="text-white" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <input type="hidden" class="form-control" placeholder="" name="email" id="email" value="{{ auth()->user()->email }}">
             
                <div class="text-center">
                  <a href="{{ url('quiz') }}" class="btn btn-primary w-100 my-4 mb-2">Continue</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

