@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-sm-12">
      <div class="card mb-4 " style="background-color: var(--bgDark)" >
        <div class="card-body p-5" >
          <div class="row">
                <div class="col-sm-12">
                  
                  <h4 class="text-white">Import your trades and get advanced statistics</h4>
                </div>
                <div class="col-sm-6">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-sm-6 d-flex ">
                  <div class="btn" style="width: 100%; height: 200px; border-radius: 8px 0px 0px 8px; background-color: white;cursor: pointer;" class="text-center">
                    <br>
                    <br>
                    <br>
                  <label style="cursor: pointer;" >Sync your Broker</label>
                  </div>
                  <div class="btn" style="width: 100%; height: 200px; border-radius: 0px 8px 8px 0px; flex-direction: column;justify-content: center; align-items: center;cursor: pointer; background-color:var(--bg)" class=" text-center ">
                    <br>
                    <br>
                    <br>
                    <label class="text-white" style="cursor: pointer;" >Platform Transmit</label>
                  </div>

                </div>
              </div>
             
            </div>
        </div>
    </div>

    <div class="col-sm-12">
      <div class="card mb-4 " style="background-color: var(--bgDark)" >
        <div class="card-body p-5" >
          <div class="row">
                <div class="col-sm-12">
                  <h4 class="text-white">Platform Transmit: Use popular trading software to AutoTrades Import</h4>
                  <br>
                </div>
                <div class="col-sm-12 m-2">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-sm-12  text-center">
                  <br>
                  <img src="{{ asset('assets/img/dashboard/trades.png') }}" class="image" height="120px" style="border-radius: 10px;" alt="">
                </div>
              </div>
             
            </div>
        </div>
    </div>

    <div class="col-sm-12">
      <div class="card mb-4 " style="background-color: var(--bgDark)" >
        <div class="card-body p-5" >
          <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="text-white">Ninja Trader 8</h4>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-center" style="height: 200px;width: 100%; border-radius: 15px; background-color: white;" >
                        <br>
                        <br>
                        <br>
                        <i class="fas fa-play" ></i>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
                      <button class="btn btn-primary btn-sm" >Download</button>

                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="text-white">MetaTrader</h4>
                    </div>
                    <div class="col-sm-6">
                      <div class="text-center" style="height: 200px;width: 100%; border-radius: 15px; background-color: white;" >
                        <br>
                        <br>
                        <br>
                        <i class="fas fa-play" ></i>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
                      <button class="btn btn-primary btn-sm" >Download</button>

                    </div>
                  </div>
                </div>
             
              </div>
             
            </div>
        </div>
    </div>

</div>

@endsection