const annualReturnElement = document.getElementById("annualReturn");
const drawDownElement = document.getElementById("DrawDown");
const profitFactorElement = document.getElementById("profitFactor");
const avgWinLossElement = document.getElementById("avgWinLoss");
const QTradesElement = document.getElementById("QTrades");
const cagrElement = document.getElementById("cagr");

const drawDownElement2 = document.getElementById("DrawDown2");
const profitFactorElement2 = document.getElementById("profitFactor2");
const avgWinLossElement2 = document.getElementById("avgWinLoss2");
const QTradesElement2 = document.getElementById("QTrades2");

const AvgWinRatioElement = document.getElementById("AvgWinRatio");
const progressWinRatioElement = document.getElementById("progressWinRatio");
const progressWinRatioElement2 = document.getElementById("progressWinRatio2");

function getOverviewData() {
    annualReturnElement.innerHTML = loaderGlobal;
    drawDownElement.innerHTML = loaderGlobal;
    profitFactorElement.innerHTML = loaderGlobal;
    avgWinLossElement.innerHTML = loaderGlobal;
    QTradesElement.innerHTML = loaderGlobal;
    cagrElement.innerHTML = loaderGlobal;
    AvgWinRatio.innerHTML = "...%";
    $.ajax({
        url: URLS.overviewData,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
        },
        success: function (data) {
            let minDrawDown = 0;
            let maxInicialBalance = 0;
            let maxNetPNL = 0;
            let maxQTrades = 0;
            let maxAnnualReturn = 0;
            let maxProfitFactor = 0;
            let maxAvgWinLoss = 0;
            let maxCAGR = 0;

            if (data.length > 0) {
                minDrawDown = data[0].DrawDown;
                maxInicialBalance = data[0].Inicial_Balance;
                maxNetPNL = data[0].Net_PNL;
                maxQTrades = data[0].Q_Trades;
                maxAnnualReturn = data[0].Annual_Return;
                maxProfitFactor = data[0].Profit_Factor;
                maxAvgWinLoss = data[0].Avg_Win_Loss;
                maxCAGR = data[0].CAGR;
                accountsGlobal = [];

                for (let i = 1; i < data.length; i++) {
                    minDrawDown = Math.min(minDrawDown, data[i].DrawDown);
                    maxInicialBalance = Math.min(
                        maxInicialBalance,
                        data[i].Inicial_Balance
                    );
                    maxNetPNL = Math.min(maxNetPNL, data[i].Net_PNL);
                    maxQTrades = Math.min(maxQTrades, data[i].Q_Trades);
                    maxAnnualReturn = Math.min(
                        maxAnnualReturn,
                        data[i].Annual_Return
                    );
                    maxProfitFactor = Math.min(
                        maxProfitFactor,
                        data[i].Profit_Factor
                    );

                    maxAvgWinLoss = Math.max(
                        maxAvgWinLoss,
                        data[i].Avg_Win_Loss
                    );
                    maxCAGR = Math.min(maxCAGR, data[i].CAGR);

                    accountsGlobal.push(data[i].Account);
                }
            }

            annualReturnElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(maxAnnualReturn) +
                '">' +
                formatDecimalNumber(maxAnnualReturn * 100) +
                "%</h6>";
            drawDownElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(minDrawDown) +
                '"> $' +
                formatDecimalNumber(minDrawDown) +
                "</h6>";
            profitFactorElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(maxProfitFactor) +
                '">' +
                formatDecimalNumber(maxProfitFactor) +
                "</h6>";
            avgWinLossElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(maxAvgWinLoss) +
                '">' +
                formatDecimalNumber(maxAvgWinLoss) +
                "</h6>";
            QTradesElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(maxQTrades) +
                '">' +
                maxQTrades.toFixed(2) +
                "</h6>";
            cagrElement.innerHTML =
                '<h6 class="' +
                getPrimaryDangeClass(maxCAGR) +
                '">' +
                formatDecimalNumber(maxCAGR * 100) +
                "%</h6>";
        },
        error: function (xhr, status, error) {},
    });
}

const tradesWinElement = document.getElementById("tradesWin");
const tradesLossElement = document.getElementById("tradesLoss");

const daysWin = document.getElementById("daysWin");
const daysLoss = document.getElementById("daysLoss");
const progressDays = document.getElementById("progressDays");
const progressDays2 = document.getElementById("progressDays2");

function getMetricsData() {
    $.ajax({
        url: URLS.getMetrics,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
        },
        success: function (data) {
            let tradesWin = 0;
            let tradesLoss = 0;
            let totalTrades = 0;

            let daysWinData = 0;
            let daysLossData = 0;
            let percentajeDaysData = 0;

            data.forEach((e) => {
                tradesWin += e.Trade_Win;
                tradesLoss += e.Trade_Loss;

                daysWinData += e.Positive_Days;
                daysLossData += e.Negative_Days;
            });
            totalTrades = tradesWin + tradesLoss;
            pertentajeTrades = (tradesWin / totalTrades) * 100;

            let className =
                pertentajeTrades > 30 ? "text-primary" : "text-danger";
            AvgWinRatioElement.innerHTML =
                '<h6 class="' +
                className +
                '">' +
                pertentajeTrades.toFixed(2) +
                "%</h6>";

            progressWinRatioElement.style.width =
                pertentajeTrades.toFixed(2) + "%";
            progressWinRatioElement2.style.width =
                Math.abs(pertentajeTrades.toFixed(2) - 100) + "%";

            tradesWinElement.innerHTML = `${tradesWin} W`;
            tradesLossElement.innerHTML = `${tradesLoss} L`;

            totalDays = daysWinData + daysLossData;
            percentajeDaysData = (daysWinData / totalDays) * 100;

            daysWin.innerHTML = `${daysWinData} W`;
            daysLoss.innerHTML = `${daysLossData} L`;
            let classNameDays =
                percentajeDaysData > 30 ? "text-primary" : "text-danger";
            percentajeDays.classList.add(classNameDays);
            percentajeDays.innerHTML = `${percentajeDaysData.toFixed(2)} %`;

            progressDays.style.width = percentajeDaysData.toFixed(2) + "%";
            progressDays2.style.width =
                Math.abs(percentajeDaysData.toFixed(2) - 100) + "%";
        },
        error: function (xhr, status, error) {},
    });
}
