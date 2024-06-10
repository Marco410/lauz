const totalMfe = document.getElementById("totalNetPl2");
const totalMae = document.getElementById("annualReturn2");
const totalAvg_trade = document.getElementById("DrawDown2");
const totalAvg_tradeDay = document.getElementById("profitFactor2");
const totalComision = document.getElementById("avgWinLoss2");
const totalSharpeRatio = document.getElementById("QTrades2");

let accounts2 = document.querySelector('select[name="accounts2"]');
let initDate2 = document.querySelector('input[name="initDate2"]');
let endDate2 = document.querySelector('input[name="endDate2"]');

function getMFE() {
    $.ajax({
        url: URLS.getmfe,
        type: "GET",
        dataType: "json",
        data: {
            account: accounts2.value,
            initDate: initDate2.value,
            endDate: endDate2.value,
        },
        success: function (response) {
            promedioMFE = 0;
            promedioMAE = 0;
            promedio_trade = 0;
            promedio_trade_dia = 0;
            promedioComission = 0;
            promedioShapeRatio = 0;
            response.forEach((item) => {
                promedioMFE += item.MFE;
                promedioMAE += item.MAE;
                promedio_trade += item.AVG_Trade;
                promedio_trade_dia += item.AVG_Trades_Per_Day;
                promedioComission += item.Commission;
                promedioShapeRatio += item.Shape_Ratio;
            });

            promedioMFE = promedioMFE / response.length;
            promedioMAE = promedioMAE / response.length;
            promedio_trade = promedio_trade / response.length;
            promedio_trade_dia = promedio_trade_dia / response.length;
            promedioComission = promedioComission / response.length;
            promedioShapeRatio = promedioShapeRatio / response.length;

            totalMfe.innerHTML = promedioMFE.toFixed(2);
            totalMae.innerHTML = promedioMAE.toFixed(2);
            totalAvg_trade.innerHTML = promedio_trade.toFixed(2);
            totalAvg_tradeDay.innerHTML = promedio_trade_dia.toFixed(2);
            totalComision.innerHTML = promedioComission.toFixed(2);
            totalSharpeRatio.innerHTML = promedioShapeRatio.toFixed(2);
        },
        error: function (error) {},
    });
}

accounts2.addEventListener("change", handleSelectAccount2);
initDate2.addEventListener("change", handleInitDate2);
endDate2.addEventListener("change", handleEndDate2);

function handleSelectAccount2(e) {
    let account = e.target.value;
    accounts2.value = account;
    getMFE();
}

function handleInitDate2(e) {
    let initDate = e.target.value;
    initDate2.value = initDate;
}

function handleEndDate2(e) {
    let endDate = e.target.value;
    endDate2.value = endDate;

    console.log(initDate2.value);

    if (initDate2.value != "") {
        if (Date.parse(endDate) < Date.parse(initDate)) {
            alert("Please select a new date");
            endDate2.value = "";
        } else {
            endDate2.value = endDate;
        }
    } else {
        alert("Please select an initial date");
        endDate2.value = "";
    }
    getMFE();
}
