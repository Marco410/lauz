<div class="row p-4 m-4">
  <div class="col-sm-12 mb-4">
    <div class="row">
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select" style="background-color: var(--bgDark) !important;">
          <option selected value="">Period</option>
          <option selected value="Years">Years</option>
          <option selected value="Months">Months</option>
          <option selected value="Weeks">Weeks</option>
          <option selected value="Days">Days</option>
          <option selected value="Hours">Hours</option>
        </select>
      </div>
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select" style="background-color: var(--bgDark) !important;">
          <option selected value="Instrument">Instrument</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
      <div class="card-header pb-0" style="background-color: var(--bgDark)">
        <h6 class="text-white">Cum Net Profit</h6>
      </div>
      <div class="card-body p-3 text-center">
        <div class="spinner-border text-primary spinner-border-md mt-3" id="cumNetProfitLoader" role="status"> </div>
        <div class="chart">
          <canvas id="chart-line3" class="chart-canvas" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
      <div class="card-header pb-0" style="background-color: var(--bgDark)">
        <h6 class="text-white">Net Profit</h6>
      </div>
      <div class="card-body p-3 text-center">
        <div class="spinner-border text-primary spinner-border-md mt-3" id="netProfitLoader" role="status"> </div>
        <div class="chart">
          <canvas id="chart-bar2" class="chart-canvas" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="row">
      <div class="col-sm-12 ">
          <div class="card mb-4" style="background-color: var(--bgDark);min-height: 330px; height: 330px;" >
              <div class="card-body px-0 pt-2 pb-2" >
                <div class="row">
                  <div class="col-sm-4">
                    <label class="text-white">Overview for Day</label>
                  </div>
                  <div class="col-sm-8">
                    <label class="text-white text-right">Days Traded: 17 W 17L - 50% </label>
                  </div>
                </div>
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Day^v</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">P&L</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">P&Win RT%</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Profits</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Loss</th>
                        <th style="padding: 10px;" class="text-white text-xs font-weight-bolder opacity-7">Trades</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Mon</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Tue</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xs" style="color: var(--textGray);">Wed</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-white" role="progressbar" style="width: 30%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xs" style="color: var(--textGray);">5</small></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

      </div>
  </div>

    <div class="col-sm-4">
      <div class="card z-index-2" style="background-color: var(--bgDark);min-height: 330px">
        <div class="card-header pb-0" style="background-color: var(--bgDark)">
          <h6 class="text-white">Cum Max Drawdown</h6>
        </div>
        <div class="card-body p-3 text-center">
          <div class="spinner-border text-primary spinner-border-md mt-3" id="cumMaxDrawdown" role="status"> </div>
          <div class="chart">
            <canvas id="chart-line4" class="chart-canvas" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 330px">
        <div class="card-header pb-0" style="background-color: var(--bgDark)">
          <h6 class="text-white">Max Drawdown</h6>
        </div>
        <div class="card-body p-3 text-center">
          <div class="spinner-border text-primary spinner-border-md mt-3" id="maxDrawDown" role="status"> </div>
          <div class="chart">
            <canvas id="chart-bar3" class="chart-canvas" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>

{{--     <div class="col-sm-4" >
      <div class="card" style="background-color: var(--bgDark)">
        <div style="padding: 20px" id='calendar2'></div>
      </div>
    </div> --}}

    <div class="col-sm-4">
        <div class="card mb-4" style="background-color: var(--bgDark);min-height: 330px;height: 330px;" >
            <div class="card-body p-4" >
              <div id='calendar2'></div>
            </div>
        </div>
    </div>

 </div>


@push('dashboard_chart_bar')
<script src="../assets/js/lauz/tabs/period.js"></script>
@endpush