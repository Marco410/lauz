<div class="row p-4 m-4">
    <div class="col-sm-8">
     <div class="row">
      <div class="d-flex justify-content-between" >
          <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
              <div class="row">
                  <div class="col-sm-12">
                      <p class="text-white " style="font-size: 12px;">MFE</p>
                  </div>
              </div>
          </div>
          <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-white " style="font-size: 12px;">MAE</p>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-white " style="font-size: 12px;">Avg. Trade</p>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-white " style="font-size: 12px;">Avg. #Trades per Day</p>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-white " style="font-size: 12px;">Commission</p>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-2 px-2 border border-white " style="height: 80px; width: 100%; background-color: var(--bgDark);">
          <div class="row">
              <div class="col-sm-12">
                  <p class="text-white " style="font-size: 12px;">Sharpe Ratio</p>
              </div>
          </div>
      </div>



    </div>


       <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bg)">
          <div class="card-header pb-0" style="background-color: var(--bg)">
            <h6 class="text-white">Daily Net Cumulative P&L</h6>
          </div>
          <div class="card-body p-3 ">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bg)">
          <div class="card-header pb-0" style="background-color: var(--bg)">
            <h6 class="text-white">Daily Net P&L</h6>
          </div>
          <div class="card-body p-3 ">
            <div class="chart">
              <canvas id="chart-bar" class="chart-canvas" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bg)">
          <div class="card-header pb-0" style="background-color: var(--bg)">
            <h6 class="text-white">Trades for Direction</h6>
          </div>
          <div class="card-body p-3 ">
            <div class="row">
                <div class="col-sm-8">
                    <div class="chart" style="padding-top:30px; padding-bottom:40px">
                        <canvas id="pie-bar" class="chart-canvas" height="150"></canvas>
                      </div>
                </div>
                <div class="col-sm-4">
                    <label class="text-secondary" style="padding-top:30px">Longs: 100</label>
                    <label class="text-secondary">70 W 30L - 70%</label>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>
                    <label class="text-secondary">Shorts: 100</label>
                    <label class="text-secondary">70 W 30L - 70%</label>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card" style="background-color: var(--bg)">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-11">
                    <h6 class="text-white">Trades for Instrument</h6>
                    <div class="chart" >
                        <canvas id="pie-bar2" class="chart-canvas" height="100"></canvas>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

     </div>
    
    </div>
    <div class="col-sm-4">

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4" style="background-color: var(--bgTable)" >
                    <div class="card-body px-0 pt-0 pb-2" >
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Performance</th>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">All Trades</th>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Longs</th>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Shorts</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">Total Net Profit</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">$5.000</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">3000</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">2000</small></td>
                            </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">Max DrawDown</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">-$2.000</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">-500</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">-2000</small></td>
                             </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">Profit Factor</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1.4</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1.2</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1.5</small></td>
                             
                            </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">Avg Win Trade</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">$61</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">$59</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">$62</small></td>
                            </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">Max. Consec. Win</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">4</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">3</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">7</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-xxs" style="color: var(--textGray);">Largest Win Trade</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">$316</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">$80</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">$360</small></td>
                              </tr>
                              <tr>
                                <td><small class="text-xxs" style="color: var(--textGray);">Largest Lose Trade</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">-$200</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">-$200</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">-$60</small></td>
                              </tr>
                              <tr>
                                <td><small class="text-xxs" style="color: var(--textGray);">Avg time in Market</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">12.61 min</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">13.44min</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">10.12min</small></td>
                              </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-sm-12">
                <label class="text-white">Recent Trades</label>
                <div class="card mb-4" style="background-color: var(--bgTable)" >
                    <div class="card-body px-0 pt-0 pb-2" >
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">Date</th>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">QTY</th>
                              <th style="padding: 10px;" class="text-white text-xxs font-weight-bolder opacity-7">P&L</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">07/01/24</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                            </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">06/01/24</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                             </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">05/01/24</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                             
                            </tr>
                            <tr>
                              <td><small class="text-xxs" style="color: var(--textGray);">04/01/24</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                              <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                            </tr>
                            <tr>
                                <td><small class="text-xxs" style="color: var(--textGray);">04/01/24</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                              </tr>
                              <tr>
                                <td><small class="text-xxs" style="color: var(--textGray);">04/01/24</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">1</small></td>
                                <td><small class="text-xxs" style="color: var(--textGray);">+$200</small></td>
                              </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
 </div>