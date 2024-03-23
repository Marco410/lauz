@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header">
        <div class="container">
          <div class="row">
            <div class="col-sm-5 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8" style="background-color: var(--bgDark); padding: 50px;  ">
                <div class="card-body">
                  <div style="border-left: 2px solid var(--primary);border-radius: 0px;padding: 0px;padding-left: 10px; margin-bottom: 20px">
                      <h3 class="font-weight-bolder text-white" style="margin-bottom: 0px; font-size: 27px">Welcome to <strong style="color:var(--primary)">LAUZ</strong></h3>
                      <small class="text-white" style="font-family: 'Inter Light'; font-size: 11.5px">Analyzing and optimizing ypur investments</small>
                  </div>
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <div class="row">
                      <div class="col-sm-12">
                        <label style="color: white;">Email</label>
                        <div class="mb-3">
                          <div class="input-group mb-3">
                            <span class="input-group-text border-none" style="background-color: var(--bgTable); border:none;" id="basic-addon1"> <i class="fas fa-user" style="color:var(--bg300)" ></i> </span>
                            <input type="email" style="padding-left: 15px; border-radius:0px 8px 8px 0px !important;font-size: 14px !important" class="form-control" name="email" id="email" value="admin@lauz.io" placeholder="Enter your email" aria-label="Username" aria-describedby="basic-addon1">
                          </div>
                          @error('email')
                          <p class="text-danger text-xs mt-2">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">

                        <label style="color: white;">Password</label>
                        <div>
                          <div class="input-group">
                            <span class="input-group-text border-none" style="background-color: var(--bgTable); border:none;" id="basic-addon2"> <i class="fas fa-key" style="color:var(--bg300)" ></i> </span>
                            <input type="password" style="padding-left: 15px; border-radius:0px 8px 8px 0px !important;font-size: 14px !important" class="form-control" name="password" id="password" value="secret" placeholder="Enter your password" aria-label="Username" aria-describedby="basic-addon2">
                          </div>
                          @error('password')
                          <p class="text-danger text-xs mt-2">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="mt-1">
                        <small class="text-primary float-right" style="font-size: 10px; font-weight: 100;font-family: 'Inter Light'; float: right !important;">Forgot password?</small>
                      </div>
                    </div>
   
                    <div class="form-check mt-4">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="background-color: var(--bgTable)">
                      <label class="form-check-label text-white mt-1" for="flexCheckDefault">
                        Remember me
                      </label>
                    </div>
                    <div class="text-center">
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Sign in</button>
                        </div>
                        <div class="col-sm-6">
                          <a type="button" href="register"  class="btn btn-outline-primary w-100 mt-4 mb-0">Create Account</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
