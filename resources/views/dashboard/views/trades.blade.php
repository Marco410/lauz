<div class="row p-4 m-4">
    <div class="col-sm-12">
      <div class="card mb-4" style="background-color: var(--bgDark)" >
        <div class="card-body px-0 pt-0 pb-2 text-center" >
          <div class="spinner-border text-primary spinner-border-md mt-3" id="loaderTradesTable"  role="status"> </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 " id="trades-table">
              <thead>
                <tr>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Trade nu</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Instrument</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Account</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Strategy</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Market</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Q</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Entry</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Exit</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Entry time</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Exit time</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Entry</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Exit</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Profit</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Cum. net</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Commis</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">MAE</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">MFE</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">ETD</th>
                  <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Bars</th>
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

@push('dashboard_chart_bar')
<script src="../assets/js/lauz/tabs/trades.js"></script>
@endpush