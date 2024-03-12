<div class="row p-4 m-4">
  <div class="col-sm-12 mb-4">
    <div class="row">
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select">
          <option selected value="Period">Period</option>
        </select>
      </div>
      <div class="col-sm-4">
        <select name="how_often_invest" class="form-select">
          <option selected value="Instrument">Instrument</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4 mt-4">
    <div class="card z-index-2" style="background-color: var(--bg)">
      <div class="card-header pb-0" style="background-color: var(--bg)">
        <h6 class="text-white">Cum Net Profit</h6>
      </div>
      <div class="card-body p-3 ">
        <div class="chart">
          <canvas id="chart-line3" class="chart-canvas" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4 mt-4">
    <div class="card z-index-2" style="background-color: var(--bg)">
      <div class="card-header pb-0" style="background-color: var(--bg)">
        <h6 class="text-white">Net Profit</h6>
      </div>
      <div class="card-body p-3 ">
        <div class="chart">
          <canvas id="chart-bar2" class="chart-canvas" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="row">
      <div class="col-sm-4">
        <label class="text-white">Overview for Day</label>
      </div>
      <div class="col-sm-8">
        <label class="text-white text-right">Days Traded: 17 W 17L - 50%/label>
      </div>
      <div class="col-sm-12">
          <div class="card mb-4" style="background-color: var(--bgTable)" >
              <div class="card-body px-0 pt-0 pb-2" >
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Day^v</th>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">P&L</th>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">P&Win RT%</th>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Profits</th>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Loss</th>
                        <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Trades</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><small class="text-xxs" style="color: var(--textGray);">Mon</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xxs" style="color: var(--textGray);">Tue</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">5</small></td>
                      </tr>
                      <tr>
                        <td><small class="text-xxs" style="color: var(--textGray);">Wed</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                        <td> 
                          <br> 
                          <div class="progress"  style="background-color: transparent;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <label class="" style="color: var(--textGray);">70 W 30L - 70%</label>
                        </td>
                        <td><small class="text-xxs" style="color: var(--textGray);">+$500</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">-$300</small></td>
                        <td><small class="text-xxs" style="color: var(--textGray);">5</small></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

      </div>
  </div>

    <div class="col-sm-4 mt-4">
      <div class="card z-index-2" style="background-color: var(--bg)">
        <div class="card-header pb-0" style="background-color: var(--bg)">
          <h6 class="text-white">Cum Max Drawdown</h6>
        </div>
        <div class="card-body p-3 ">
          <div class="chart">
            <canvas id="chart-line4" class="chart-canvas" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-4 mt-4">
      <div class="card z-index-2" style="background-color: var(--bg)">
        <div class="card-header pb-0" style="background-color: var(--bg)">
          <h6 class="text-white">Max Drawdown</h6>
        </div>
        <div class="card-body p-3 ">
          <div class="chart">
            <canvas id="chart-bar3" class="chart-canvas" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div style="padding: 20px" id='calendar2'></div>
    </div>

 </div>