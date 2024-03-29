@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Sign Up</h1>
            <p class="text-lead text-white">Create new account for free.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-sm-7 mx-auto">
          <div class="card z-index-0" style="background-color: var(--bgDark)">
            <div class="card-body">
              <form role="form text-left" method="POST" action="/register">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="First Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                      @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" aria-label="Name" aria-describedby="last_name" value="{{ old('last_name') }}">
                      @error('last_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                

                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-label="Name" aria-describedby="username" value="{{ old('username') }}">
                  @error('username')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
               
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation" id="password_confirmation" aria-label="password_confirmation" aria-describedby="password_confirmation-addon">
                  @error('password_confirmation')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                  <label class="form-check-label text-white" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-white font-weight-bolder">Terms and Conditions</a>
                  </label>
                  @error('agreement')
                    <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0 text-white">Already have an account? <a href="login" class="text-primary font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

