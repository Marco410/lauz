const totalMfe = document.getElementById("totalMFE");
const totalMae = document.getElementById("totalMAE");
const totalAvg_trade = document.getElementById("totalAvgTrade");
const totalAvg_tradeDay = document.getElementById("totalAVGDay");
const totalComision = document.getElementById("totalComision");
const totalSharpeRatio = document.getElementById("totalSharpeRatio");

const loaderPerformanceTable = document.getElementById(
    "loaderPerformanceTable"
);

/**
    This function calculates the average Mean-Absolute-Error (MFE), Mean-Absolute-Error (MAE), average trade, average trades per day, average commission, and average Sharpe Ratio for a specified account, date range, market position, and trade result.
    @param {string} accountSelected - The selected account for which the performance metrics will be calculated.
    @param {string} initDate - The initial date for the date range of the performance metrics.
    @param {string} endDate - The end date for the date range of the performance metrics.
    @param {string} directionGlobal - The market position for the performance metrics.
    @param {string} winningGlobal - The trade result for the performance metrics.
 */
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

/**
    This function retrieves the performance table for the specified account, date range, market position, and trade result.
    It sends an AJAX request to the server to fetch the performance data and then populates a table with the received data.
    @param {string} accountSelected - The selected account for which the performance metrics will be calculated.
    @param {string} initDate - The initial date for the date range of the performance metrics.
    @param {string} endDate - The end date for the date range of the performance metrics.
    @param {string} directionGlobal - The market position for the performance metrics.
    @param {string} winningGlobal - The trade result for the performance metrics.
    @returns {void} - This function does not return any value. It populates the table with the received data.
 */
function getPerformanceTable() {
    loaderPerformanceTable.style.display = "inline-block";

    const dataPost = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
    };

    $.ajax({
        url: URLS.getPerformanceTable,
        type: "GET",
        dataType: "json",
        data: dataPost,
        success: function (response) {
            const table = document.getElementById("tablePerformance");
            const tbody = table.getElementsByTagName("tbody")[0];
            tbody.innerHTML = "";

            response.forEach((item) => {
                const row = tbody.insertRow();
                row.innerHTML = `<td><small class="text-xs fw-lighter" style="color: var(--textGray);">${
                    item.Performance
                }</small></td> <td><small class="text-xs fw-lighter" style="color: var(--textGray);">${showLabelFunction(
                    item.Performance
                )}${formatDecimalNumber(
                    item.All_Trades
                )}</small></td><td><small class="text-xs fw-lighter" style="color: var(--textGray);">${showLabelFunction(
                    item.Performance
                )}${formatDecimalNumber(
                    item.Longs
                )}</small></td><td><small class="text-xs fw-lighter" style="color: var(--textGray);">${showLabelFunction(
                    item.Performance
                )}${formatDecimalNumber(item.Shorts)}</small></td>`;
            });

            loaderPerformanceTable.style.display = "none";
        },
        error: function (error) {
            loaderPerformanceTable.style.display = "none";
        },
    });
}

/**
    This function determines whether to append a dollar sign ($) to the performance label.
    It returns an empty string if the performance label is "Profit Factor" or "Max. Concsec. Win",
    otherwise, it returns a dollar sign ($).
    @param {string} item - The performance label for which the dollar sign should be determined.
    @returns {string} - An empty string if the performance label is "Profit Factor" or "Max. Concsec. Win",
    otherwise, a dollar sign ($).
 */
function showLabelFunction(item) {
    return item === "Profit Factor" || item === "Max. Concsec. Win" ? "" : "$";
}

const loaderRecentTrades = document.getElementById("loaderRecentTrades");

const dataPostRecent = {
    account: accountSelected,
    initDate: initDate,
    endDate: endDate,
    Market_pos: directionGlobal,
    Trade_Result: winningGlobal,
};

/**
    This function initializes a DataTable for the recent trades table.
    It sets various properties such as responsiveness, fixed header, and searching options.
    It also sets the page length to 3 and configures the ajax request to fetch recent trades data.
    The ajax request uses the specified URL and data, and upon successful data retrieval, it hides the loader element.
    The function also sets the layout, order, and columns for the table.
    @param {string} accountSelected - The selected account for which the recent trades data will be fetched.
    @param {string} initDate - The initial date for the date range of the recent trades data.
    @param {string} endDate - The end date for the date range of the recent trades data.
    @param {string} directionGlobal - The market position for the recent trades data.
    @param {string} winningGlobal - The trade result for the recent trades data.
    @returns {void} - This function does not return any value. It initializes the DataTable for the recent trades table.
 */
let tableRecent = $("#tableRecentTrades").DataTable({
    responsive: true,
    fixedHeader: true,
    searching: false,
    pageLength: 3,
    ajax: {
        type: "get",
        url: URLS.getRecentTrades,
        data: dataPostRecent,
        dataSrc: function (data) {
            loaderRecentTrades.style.display = "none";
            return data;
        },
        error: function (e) {
            loaderRecentTrades.style.display = "none";
        },
    },
    layout: {
        topStart: null,
        bottomStart: null,
    },
    order: [],
    columns: [
        {
            data: "Date",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Trade_Count",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Total_PNL",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatDecimalNumber(
                    data
                )}</small>`;
            },
        },
    ],
});
