const totalMfe = document.getElementById('totalNetPl2');
const totalMae = document.getElementById('annualReturn2');
const totalAvg_trade = document.getElementById('DrawDown2');
const totalAvg_tradeDay = document.getElementById('profitFactor2');
const totalComision = document.getElementById('avgWinLoss2');
const totalSharpeRatio = document.getElementById('QTrades2');

let accountsSelectGlobal2 = document.querySelector('select[name="accounts2"]');
let initDateGlobal2 = document.querySelector('input[name="initDate2"]');
let endDateGlobal2 = document.querySelector('input[name="endDate2"]');

// let Instrument = document.querySelector('select[name="how_often_invest"]');


function getMFE() {
    $.ajax({
        url: URLS.getmfe,
        type: "GET",
        dataType: "json",
        data: {
            account: accountsSelectGlobal2,
            initDate: initDateGlobal2,
            endDate: endDateGlobal2,
            // user: user,
            // Market_pos : Market_pos,
            // Trade_Result : Trade_Result,
            // Instrument : Instrument,
        },
        success: function (response) {

        }
    });
}
