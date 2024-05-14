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
    $.ajax({
        url: URLS.cumNetProfit,
        type: "GET",
        dataType: "json",
        success: function (response) {
            response.forEach((item) => {
                labelsCumNetProfit.push(item.EntryTime);
                dataCumNetProfit.push(item.Profit);
            });
            labelCumNetProfit = "Profit";
            renderCumNetProfitChart(
                labelsCumNetProfit,
                dataCumNetProfit,
                labelCumNetProfit
            );
            cumNetProfitLoader.style.display = "none";
        },
        error: function (error) {
            console.error(error);
            cumNetProfitLoader.style.display = "none";
        },
    });

    $.ajax({
        url: URLS.netProfit,
        type: "GET",
        dataType: "json",
        success: function (response) {
            response.forEach((item) => {
                labelsNetProfit.push(item.EntryTime);
                dataNetProfit.push(item.Profit);
            });
            labelNetProfit = "Profit";
            renderNetProfitChart(
                labelsNetProfit,
                dataNetProfit,
                labelNetProfit
            );
            netProfitLoader.style.display = "none";
        },
        error: function (error) {
            console.error(error);
            netProfitLoader.style.display = "none";
        },
    });
});

function renderCumNetProfitChart(labels, dataset, label) {
    var ctx7 = document.getElementById("chart-line3").getContext("2d");
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
