const totalMfe = document.getElementById("totalMFE");
const totalMae = document.getElementById("totalMAE");
const totalAvg_trade = document.getElementById("totalAvgTrade");
const totalAvg_tradeDay = document.getElementById("totalAVGDay");
const totalComision = document.getElementById("totalComision");
const totalSharpeRatio = document.getElementById("totalSharpeRatio");

function getMFE() {
    totalMfe.innerHTML = loaderGlobal;
    totalMae.innerHTML = loaderGlobal;
    totalAvg_trade.innerHTML = loaderGlobal;
    totalAvg_tradeDay.innerHTML = loaderGlobal;
    totalComision.innerHTML = loaderGlobal;
    totalSharpeRatio.innerHTML = loaderGlobal;

    const dataPost = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
    };

    $.ajax({
        url: URLS.getmfe,
        type: "GET",
        dataType: "json",
        data: dataPost,
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
