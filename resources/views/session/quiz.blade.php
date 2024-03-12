@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-1">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
   
    </div>
    <div class="container">
      <div class="row mt-lg-n12 mt-md-n11 mt-n12">
        <div class="col-sm-11 mx-auto">
          <div class="col-sm-11 mx-auto">
            <div class="card z-index-0">
            
              <div class="card-body">
                <form role="form text-left" method="POST" action="/store-quiz">
                  @csrf

                  <h5>How long have you been invest?</h5>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="how_long_invest" id="inlineRadio1" value="<6 months">
                    <label class="form-check-label" for="inlineRadio1"> <i class="fas fa-user" ></i> {{"<6 months"}}</label>

                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="how_long_invest" id="inlineRadio2" value="6-12 months">
                    <label class="form-check-label" for="inlineRadio2"><i class="fas fa-user" ></i> {{"6-12 months"}}</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="how_long_invest" id="inlineRadio3" value="1-3 years">
                    <label class="form-check-label" for="inlineRadio3"><i class="fas fa-user" ></i> {{"1-3 years"}}</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="how_long_invest" id="inlineRadio4" value="5+ years"">
                    <label class="form-check-label" for="inlineRadio4"><i class="fas fa-user" ></i> {{"5+ years"}}</label>
                  </div>
                  @error('how_long_invest')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                  <br>
                  <h5>How often are you invest?</h5>
                  <select name="how_often_invest" class="form-select">
                    <option selected value="New to trading">New to trading</option>
                    <option value="Every Day">Every Day</option>
                    <option value="A few times a Month">A few times a Month</option>
                    <option value="A few times a year">A few times a year</option>
                  </select>

                  <br>
                  <h5>What are you looking to do?</h5>
                  <select name="looking" class="form-select">
                    <option selected value="Journal, track, my stats">Journal, track, my stats</option>
                    <option value="Looking for a CopyTrading">Looking for a CopyTrading</option>
                    <option value="Looking for education">Looking for education</option>
                    <option value="Looking for Auto-Strategy">Looking for Auto-Strategy</option>
                  </select>

                  <br>
                  <h5>What type of investment capital do you plan to operate?</h5>
                  <select name="investment_type" class="form-select">
                    <option selected value="Funding">Funding</option>
                    <option value="Own resources">Own resources</option>
                    <option value="Investment fund">Investment fund</option>
                    <option value="I don't have it defined">I don't have it defined</option>
                  </select>
               
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Continue</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

