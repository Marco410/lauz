<div class="row p-4 m-4">
    <div class="col-sm-8">
     <div class="row">
      <div class="col-sm-6">
        <div class="d-flex justify-content-between" >
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="text-white " style="font-size: 13px;">MFE</h6>
                    <h6 class="text-primary"  id="totalMFE"> <div class="spinner-border text-primary spinner-border-md"  role="status"> </div></h6>
                </div>
            </div>
        </div>
        <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
          <div class="row">
              <div class="col-sm-12">
                  <h6 class="text-white " style="font-size: 13px;">MAE</h6>
                  <h6 class="text-primary" id="totalMAE"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
              </div>
          </div>
      </div>
      <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
          <div class="row">
              <div class="col-sm-12">
                  <h6 class="text-white " style="font-size: 13px;">Avg. Trade</h6>
                  <h6 class="text-danger" id="totalAvgTrade"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
              </div>
          </div>
      </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="d-flex justify-content-between" >
     
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
              <div class="row">
                  <div class="col-sm-12">
                      <h6 class="text-white " style="font-size: 12px;">Avg. #Trades per Day</h6>
                      <h6 class="text-primary" id="totalAVGDay"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
                  </div>
              </div>
          </div>
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
              <div class="row">
                  <div class="col-sm-12">
                      <h6 class="text-white " style="font-size: 13px;">Commision</h6>
                      <h6 class="text-primary" id="totalComision"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
                  </div>
              </div>
          </div>
          <div class="card text-center rounded-4 justify-content-center m-1 px-1" style="height: 80px; width: 100%; background-color: var(--bgDark);">
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="text-white " style="font-size: 13px;">Sharpe Ratio</h6>
                    <h6 class="text-primary" id="totalSharpeRatio"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
                </div>
            </div>
        </div>
        </div>
      </div>
   
       <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
          <div class="card-header pb-0" style="background-color: var(--bgDark)">
            <h6 class="text-white">Daily Net Cumulative P&L</h6>
          </div>
          <div class="card-body p-3  text-center">
            <div class="spinner-border text-primary spinner-border-md mt-3" id="dailyNetCumPNLLoader" role="status"> </div>
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
          <div class="card-header pb-0" style="background-color: var(--bgDark)">
            <h6 class="text-white">Daily Net P&L</h6>
          </div>
          <div class="card-body p-3 text-center">
            <div class="spinner-border text-primary spinner-border-md mt-3" id="dailyNetNetPNLLoader" role="status"> </div>
            <div class="chart">
              <canvas id="chart-bar" class="chart-canvas" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card z-index-2" style="background-color: var(--bgDark); min-height: 300px">
        
          <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                
                    <div class="chart" >
                      <div class="card-header pb-0 text-center" style="background-color: var(--bgDark)">
                        <h6 class="text-white">Trades for Direction</h6>
                        <div class="spinner-border text-primary spinner-border-md mt-3" id="tradesDirectionLoader" role="status"> </div>
                      </div>
                        <div class="position-relative">
                          <canvas id="pie-bar" class="chart-canvas" height="60"></canvas>
                          <h4 class="position-absolute  start-50 translate-middle" style="bottom: 25px; color:var(--textGray)" id="totalLongsTitle">-</h4>
                        </div>
                      </div>
                </div>
                <div class="col-sm-5">
                    <h6 class="text-primary" >Longs: <span id="totalLongs">-</span></h6>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                      <h6 class="text-primary" style="font-size: 11px" id="totalWinLongs">- W</h6>
                      <h6 class="text-white" style="font-size: 11px">/</h6>
                      <h6 class="text-danger" style="font-size: 11px" id="totalLossLongs" > - L</h6>
                      <h6 class="text-primary" style="font-size: 11px" id="percentajeWLongs">- %</h6>
                    </div>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-primary" role="progressbar" id="progressLongs" style="width: 50%; border-radius: 10px 0px 0px 10px; !important"  aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-white" role="progressbar" id="progressLongsL" style="width: 50%; border-radius: 0px 10px 10px 0px; !important" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>
                    <h6 class="text-primary" >Shorts: <span id="totalShorts">-</span></h6>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                      <h6 class="text-primary" style="font-size: 11px" id="totalWinShorts">- W</h6>
                      <h6 class="text-white" style="font-size: 11px">/</h6>
                      <h6 class="text-danger" style="font-size: 11px" id="totalLossShorts">- L</h6>
                      <h6 class="text-primary" style="font-size: 11px" id="percentajeShorts" >- %</h6>
                    </div>
                    <div class="progress"  style="background-color: transparent;">
                      <div class="progress-bar bg-primary" role="progressbar" id="progressShorts" style="width: 50%; border-radius: 10px 0px 0px 10px; !important" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-white" role="progressbar" id="progressShortsL"  style="width: 50%;border-radius: 0px 10px 10px 0px; !important" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card" style="background-color: var(--bgDark); min-height: 300px">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-11">
                    <h6 class="text-white">Trades for Instrument</h6>
                    <div class="row mt-4">
                      <div class="col-sm-5 mt-4 p-3">
                        <div id="legend-container"></div>
                      </div>
                      <div class="col-sm-7 p-3 text-center">
                        <div class="spinner-border text-primary spinner-border-md mt-3" id="tradesForInstrumentLoader" role="status"> </div>
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

     </div>
    
    </div>
    <div class="col-sm-4">

        <div class="row">
            <div class="col-sm-12 mt-1">
                <div class="card mb-4" style="background-color: var(--bgDark); height: 408px; min-height: 408px" >
                    <div class="card-body px-1 pb-2 text-center" >
                      <div class="spinner-border text-primary spinner-border-md mt-3" id="loaderPerformanceTable" role="status"> </div>
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tablePerformance">
                          <thead>
                            <tr>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Performance</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">All Trades</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Longs</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Shorts</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-sm-12 ">
                <div class="card mb-4" style="background-color: var(--bgDark);height: 318px; min-height: 318px" >
                  <div class="card-body">
                    <h6 class="text-white">Recent Trades</h6>
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tablePerformance">
                          <thead>
                            <tr>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">Date</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">QTY</th>
                              <th style="padding: 8px; font-size: 13px" class="text-white font-weight-bolder">P&L</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">07/01/24</small>
                              </td>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">1</small>
                              </td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">+$200</small></td>
                            </tr>
                            <tr>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">07/01/24</small>
                              </td>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">1</small>
                              </td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">+$200</small></td>
                            </tr>
                          
                            <tr>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">07/01/24</small>
                              </td>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">1</small>
                              </td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">+$200</small></td>
                            </tr>
                          
                            <tr>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">07/01/24</small>
                              </td>
                              <td>
                                <small class="text-xs fw-lighter" style="color: var(--textGray);">1</small>
                              </td>
                              <td><small class="text-xs fw-lighter" style="color: var(--textGray);">+$200</small></td>
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


 @push('dashboard_chart_bar')
<script src="../assets/js/lauz/tabs/overviewCharts.js"></script>
@endpush
