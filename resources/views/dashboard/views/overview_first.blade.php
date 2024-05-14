    
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12" >
                <h6 class="text-white " style="font-size: 13px;">Net P&L</h6>
                <h6 class="text-primary"  id="totalNetPl"> <div class="spinner-border text-primary spinner-border-md"  role="status"> </div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Annual Return</h6>
                <h6 class="text-primary" id="annualReturn"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">DrawDown</h6>
                <h6 class="text-danger" id="DrawDown"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Profit Factor</h6>
                <h6 class="text-primary" id="profitFactor"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Avg Win/loss</h6>
                <h6 class="text-primary" id="avgWinLoss"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">Q. Trades</h6>
                <h6 class="text-primary" id="QTrades"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>
    <div class="card text-center rounded-4 justify-content-center m-2 px-2 card-overview" >
        <div class="row">
            <div class="col-sm-12">
                <h6 class="text-white" style="font-size: 13px;">CAGR</h6>
                <h6 class="text-primary" id="cagr"><div class="spinner-border text-primary spinner-border-md"  role="status"></div></h6>
            </div>
        </div>
    </div>



  @push('dashboard_chart_bar')
    <script src="../assets/js/lauz/dashboard.js"></script>
  @endpush