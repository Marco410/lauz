<div class="row p-4 m-4">
  <div class="col-sm-12 mb-4">
    <div class="row">
      <div class="col-sm-4">
        <select name="period" class="form-select" style="background-color: var(--bgDark) !important;">
          <option selected value="">Period</option>
          <option value="Years">Years</option>
          <option value="Months">Months</option>
          <option value="Weeks">Weeks</option>
          <option value="Days">Days</option>
          <option value="Hours">Hours</option>
        </select>
      </div>
      <div class="col-sm-4">
        <select  name="instrument" class="form-select" style="background-color: var(--bgDark) !important;">
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
              <div class="card-body px-0 pt-2 pb-2 text-center" >
                <div class="spinner-border text-primary spinner-border-md mt-3" id="loaderOverviewForDay" role="status"> </div>
                <div class="row">
                  <div class="col-sm-4">
                    <label class="text-white">Overview for Day</label>
                  </div>
                  <div class="col-sm-8">
                    <label class="text-white text-right">Days Traded: <strong id="totalDaysWin">-</strong>W <strong id="totalDaysLoss">-</strong>L  <strong id="totalPercentaje">-</strong>% </label>
                  </div>
                </div>
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="tableOverviewForDay">
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

    <div class="col-sm-4">
      <div class="card mb-4" style="background-color: var(--bgDark);min-height: 330px;height: 330px;" >
        <div class="card-body p-4 text-center" >
              <div class="spinner-border text-primary spinner-border-md mt-3" id="calendarLoader2" role="status"> </div>
              <div id='calendar2'></div>
              <div id="tooltip-span2" class="my-tooltip" style="display: none"></div>
            </div>
        </div>
    </div>

 </div>


@push('dashboard_chart_bar')
<script src="../assets/js/lauz/tabs/period.js"></script>
@endpush