const periodTab = document.getElementById("periodTab");
const cumNetProfitLoader = document.getElementById("cumNetProfitLoader");
const netProfitLoader = document.getElementById("netProfitLoader");

let labelsCumNetProfit = [];
let dataCumNetProfit = [];
let labelCumNetProfit = "";

let labelsNetProfit = [];
let dataNetProfit = [];
let labelNetProfit = "";
periodTab.addEventListener("click", () => {
    getNetProfit();
    getMaxDrawdow();
});

function getNetProfit() {
    cumNetProfitLoader.style.display = "inline-block";
    netProfitLoader.style.display = "inline-block";

    $.ajax({
        url: URLS.netProfit,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
        },
        success: function (response) {
            labelsCumNetProfit = [];
            dataCumNetProfit = [];
            labelsNetProfit = [];
            dataNetProfit = [];

            let totalNetProfit = 0;
            response.forEach((item) => {
                labelsNetProfit.push(item.EntryTime);
                dataNetProfit.push(item.Profit);
                //CumNetProfit
                totalNetProfit += item.Profit;
                labelsCumNetProfit.push(item.EntryTime);
                dataCumNetProfit.push(totalNetProfit);
            });
            labelNetProfit = "Profit";
            renderNetProfitChart(
                labelsNetProfit,
                dataNetProfit,
                labelNetProfit
            );
            //CumNetProfit
            renderCumNetProfitChart(
                labelsCumNetProfit,
                dataCumNetProfit,
                labelNetProfit
            );
            netProfitLoader.style.display = "none";
            cumNetProfitLoader.style.display = "none";
        },
        error: function (error) {
            console.error(error);
            netProfitLoader.style.display = "none";
            cumNetProfitLoader.style.display = "none";
        },
    });
}

function renderCumNetProfitChart(labels, dataset, label) {
    var ctx7 = document.getElementById("chart-line3").getContext("2d");

    var existingChart = Chart.getChart(ctx7);
    if (existingChart) {
        existingChart.destroy();
    }
    var gradientStroke3 = ctx7.createLinearGradient(92, 237, 193, 50);
    gradientStroke3.addColorStop(1, OPACITY.primaryWithOpacity6);
    gradientStroke3.addColorStop(0.2, OPACITY.primaryWithOpacity15);
    gradientStroke3.addColorStop(0, OPACITY.primaryWithOpacity6);
    new Chart(ctx7, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: label,
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: COLORS.primary,
                    borderWidth: 1,
                    backgroundColor: gradientStroke3,
                    fill: true,
                    data: dataset,
                    maxBarThickness: 6,
                },
            ],
        },
        options: options,
    });
}

function renderNetProfitChart(labels, dataset, label) {
    var ctx8 = document.getElementById("chart-bar2").getContext("2d");
    var existingChart = Chart.getChart(ctx8);
    if (existingChart) {
        existingChart.destroy();
    }
    const data55 = {
        labels: labels,
        datasets: [
            {
                label: label,
                data: dataset,
                backgroundColor: [COLORS.third],
                borderColor: "transparent",
            },
        ],
    };
    new Chart(ctx8, {
        type: "bar",
        data: data55,
        options: {
            responsive: true,
            scales: {
                r: {
                    pointLabels: {
                        display: true,
                        centerPointLabels: true,
                        font: {
                            size: 12,
                        },
                    },
                    grid: {
                        color: "rgba(255,255,255,0.2)",
                    },
                },
            },
            plugins: {
                legend: false,
                title: {
                    display: false,
                    text: "Chart.js Polar Area Chart With Centered Point Labels",
                },
            },
        },
    });
}

const cumMaxDrawdown = document.getElementById("cumMaxDrawdown");
const maxDrawDown = document.getElementById("maxDrawDown");

let labelsCumMaxDrawDown = [];
let dataCumMaxDrawDown = [];
let labelCumMaxDrawDown = "DrawDown";

let labelsMaxDrawDown = [];
let dataMaxDrawDown = [];
let labelMaxDrawDown = "DrawDown";

function getMaxDrawdow() {
    cumMaxDrawdown.style.display = "inline-block";
    maxDrawDown.style.display = "inline-block";

    $.ajax({
        url: URLS.getMaxDrawdown,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
        },
        success: function (response) {
            labelsCumMaxDrawDown = [];
            dataCumMaxDrawDown = [];
            labelsMaxDrawDown = [];
            dataMaxDrawDown = [];

            let totalMaxDrawDown = 0;
            response.forEach((item) => {
                labelsMaxDrawDown.push(item.EntryTime);
                dataMaxDrawDown.push(item.Drawdown);
                //CumNetProfit
                totalMaxDrawDown += item.Drawdown;
                labelsCumMaxDrawDown.push(item.EntryTime);
                dataCumMaxDrawDown.push(totalMaxDrawDown);
            });

            renderMaxDrawDown(
                labelsMaxDrawDown,
                dataMaxDrawDown,
                labelMaxDrawDown
            );

            renderCumMaxDrawdown(
                labelsCumMaxDrawDown,
                dataCumMaxDrawDown,
                labelCumMaxDrawDown
            );

            cumMaxDrawdown.style.display = "none";
            maxDrawDown.style.display = "none";
        },
        error: function (error) {
            console.error(error);
            cumMaxDrawdown.style.display = "none";
            maxDrawDown.style.display = "none";
        },
    });
}

function renderCumMaxDrawdown(labels, dataset, label) {
    var ctx9 = document.getElementById("chart-line4").getContext("2d");
    var gradientStroke4 = ctx9.createLinearGradient(92, 237, 193, 50);
    gradientStroke4.addColorStop(1, OPACITY.primaryWithOpacity6);
    gradientStroke4.addColorStop(0.1, OPACITY.primaryWithOpacity15);
    gradientStroke4.addColorStop(0, OPACITY.primaryWithOpacity6);

    var existingChart = Chart.getChart(ctx9);
    if (existingChart) {
        existingChart.destroy();
    }

    new Chart(ctx9, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: label,
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: COLORS.primary,
                    borderWidth: 1,
                    backgroundColor: gradientStroke4,
                    fill: true,
                    data: dataset,
                    maxBarThickness: 6,
                },
            ],
        },
        options: options,
    });
}

function renderMaxDrawDown(labels, dataset, label) {
    var ctx10 = document.getElementById("chart-bar3").getContext("2d");
    var existingChart = Chart.getChart(ctx10);
    if (existingChart) {
        existingChart.destroy();
    }
    const data7 = {
        labels: labels,
        datasets: [
            {
                label: label,
                data: dataset,
                backgroundColor: [COLORS.third],
                borderColor: "transparent",
            },
        ],
    };
    new Chart(ctx10, {
        type: "bar",
        data: data7,
        options: {
            responsive: true,
            scales: {
                r: {
                    pointLabels: {
                        display: true,
                        centerPointLabels: true,
                        font: {
                            size: 12,
                        },
                    },
                    grid: {
                        color: "rgba(255,255,255,0.2)",
                    },
                },
            },
            plugins: {
                legend: false,
                title: {
                    display: false,
                    text: "Chart.js Polar Area Chart With Centered Point Labels",
                },
            },
        },
    });
}
