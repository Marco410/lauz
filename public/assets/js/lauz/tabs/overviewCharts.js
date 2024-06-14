const overviewTab = document.getElementById("overviewTab");
const dailyNetCumPNLLoader = document.getElementById("dailyNetCumPNLLoader");
const dailyNetNetPNLLoader = document.getElementById("dailyNetNetPNLLoader");
let labelsCumPNL = [];
let dataCumPNL = [];

let labelsNetPNL = [];
let dataNetPNL = [];

const tradesDirectionLoader = document.getElementById("tradesDirectionLoader");
const tradesForInstrumentLoader = document.getElementById(
    "tradesForInstrumentLoader"
);
const totalLongsTitle = document.getElementById("totalLongsTitle");
const totalLongs = document.getElementById("totalLongs");
const totalShorts = document.getElementById("totalShorts");
const totalWinLongs = document.getElementById("totalWinLongs");
const totalLossLongs = document.getElementById("totalLossLongs");
const percentajeWLongs = document.getElementById("percentajeWLongs");
const progressLongs = document.getElementById("progressLongs");
const progressLongsL = document.getElementById("progressLongsL");
const totalWinShorts = document.getElementById("totalWinShorts");
const totalLossShorts = document.getElementById("totalLossShorts");
const percentajeShorts = document.getElementById("percentajeShorts");
const progressShorts = document.getElementById("progressShorts");
const progressShortsL = document.getElementById("progressShortsL");
let directionLongs = [];
let directionShorts = [];

function getPNL() {
    dailyNetCumPNLLoader.style.display = "inline-block";
    dailyNetNetPNLLoader.style.display = "inline-block";
    tradesDirectionLoader.style.display = "inline-block";
    tradesForInstrumentLoader.style.display = "inline-block";

    const dataPost = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
    };

    $.ajax({
        url: URLS.getNetPNL,
        type: "GET",
        dataType: "json",
        data: dataPost,
        success: function (response) {
            let labelsCumPNL = [];
            let dataCumPNL = [];

            let totalCumPNL = 0;

            const groupedByInstrument = {};
            response.forEach((item) => {
                totalCumPNL += item.NetPNL;
                labelsCumPNL.push(`${item.Day}/${item.Month}/${item.Year}`);
                dataCumPNL.push(totalCumPNL);

                dataNetPNL.push(item.NetPNL);

                if (item.Direction === "Long") {
                    directionLongs.push(item);
                } else {
                    directionShorts.push(item);
                }

                const instrument = item.Instrument;
                if (!groupedByInstrument[instrument]) {
                    groupedByInstrument[instrument] = [];
                }
                groupedByInstrument[instrument].push(item);
            });

            renderCumPNL(labelsCumPNL, dataCumPNL);
            renderNetPNL(labelsCumPNL, dataNetPNL);

            renderTradesForDirection(
                ["Longs", "Shorts"],
                [directionLongs.length, directionShorts.length]
            );

            totalLongsTitle.innerHTML =
                directionLongs.length + directionShorts.length;
            totalLongs.innerHTML = directionLongs.length;
            totalShorts.innerHTML = directionShorts.length;

            let wins = [];
            let losses = [];
            let percentajeLongsW = 0;
            directionLongs.forEach((long) => {
                if (long.Winning_Losses === "Win") {
                    wins.push(long);
                } else {
                    losses.push(long);
                }
            });

            totalWinLongs.innerHTML = `${wins.length} W`;
            totalLossLongs.innerHTML = `${losses.length} L`;
            percentajeLongsW = (wins.length / directionLongs.length) * 100;
            percentajeWLongs.innerHTML = `${percentajeLongsW.toFixed(0)} %`;

            progressLongs.style.width = `${percentajeLongsW.toFixed(0)}%`;
            progressLongsL.style.width = `${(100 - percentajeLongsW).toFixed(
                0
            )}%`;

            let winsShorts = [];
            let lossesShorts = [];

            directionShorts.forEach((short) => {
                if (short.Winning_Losses === "Win") {
                    winsShorts.push(short);
                } else {
                    lossesShorts.push(short);
                }
            });

            totalWinShorts.innerHTML = `${winsShorts.length} W`;
            totalLossShorts.innerHTML = `${lossesShorts.length} L`;
            percentajeShortW =
                (winsShorts.length / directionShorts.length) * 100;
            percentajeShorts.innerHTML = `${percentajeShortW.toFixed(0)} %`;

            progressShorts.style.width = `${percentajeShortW.toFixed(0)}%`;
            progressShortsL.style.width = `${(100 - percentajeShortW).toFixed(
                0
            )}%`;

            const instruments = Object.keys(groupedByInstrument);
            const totals = instruments.map(
                (instrument) => groupedByInstrument[instrument].length
            );

            renderTradesForInstrument(instruments, totals);

            dailyNetCumPNLLoader.style.display = "none";
            dailyNetNetPNLLoader.style.display = "none";
            tradesDirectionLoader.style.display = "none";
            tradesForInstrumentLoader.style.display = "none";
        },
        error: function (error) {
            console.error(error);
            dailyNetCumPNLLoader.style.display = "none";
            dailyNetNetPNLLoader.style.display = "none";
            tradesDirectionLoader.style.display = "none";
            tradesForInstrumentLoader.style.display = "none";
        },
    });
}

function renderCumPNL(labels, dataset) {
    let ctx2 = document.getElementById("chart-line").getContext("2d");
    let existingChart = Chart.getChart(ctx2);
    if (existingChart) {
        existingChart.destroy();
    }
    let gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, OPACITY.primaryWithOpacity6);
    gradientStroke1.addColorStop(0.2, OPACITY.primaryWithOpacity15);
    gradientStroke1.addColorStop(0, OPACITY.primaryWithOpacity6);

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "NetPNL",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: COLORS.primary,
                    borderWidth: 0.7,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: dataset,
                    maxBarThickness: 6,
                },
            ],
        },
        options: options,
    });
}

function renderNetPNL(labels, dataset) {
    var ctx4 = document.getElementById("chart-bar").getContext("2d");
    let existingChart = Chart.getChart(ctx4);
    if (existingChart) {
        existingChart.destroy();
    }
    const data2 = {
        labels: labels,
        datasets: [
            {
                label: "NetPNL",
                data: dataset,
                backgroundColor: COLORS.third,
                borderColor: "transparent",
            },
        ],
    };
    new Chart(ctx4, {
        type: "bar",
        data: data2,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                    },
                    ticks: {
                        display: true,
                        padding: 5,
                        color: "#c0bfc6",
                        font: {
                            size: 8,
                            family: "Open Sans",
                            style: "normal",
                            lineHeight: 2,
                        },
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawTicks: false,
                        borderDash: [5, 5],
                    },
                    ticks: {
                        display: true,
                        color: "#c0bfc6",
                        padding: 10,
                        font: {
                            size: 8,
                            family: "Open Sans",
                            style: "normal",
                            lineHeight: 2,
                        },
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

function renderTradesForDirection(labels, dataset) {
    var ctx5 = document.getElementById("pie-bar").getContext("2d");
    let existingChart = Chart.getChart(ctx5);
    if (existingChart) {
        existingChart.destroy();
    }
    const data3 = {
        labels: labels,
        datasets: [
            {
                label: "Dataset 1",
                data: dataset,
                backgroundColor: [COLORS.primary, "rgba(243,244,247,1)"],
                borderColor: "transparent",
                circumference: 180,
                rotation: 270,
                cutout: "70%",
                hoverOffset: 5,
            },
        ],
    };
    new Chart(ctx5, {
        type: "doughnut",
        data: data3,
        options: {
            responsive: true,
            plugins: {
                legend: false,
            },
        },
    });
}

function renderTradesForInstrument(labels, dataset) {
    const getOrCreateLegendList = (chart, id) => {
        const legendContainer = document.getElementById(id);
        let listContainer = legendContainer.querySelector("ul");

        if (!listContainer) {
            listContainer = document.createElement("ul");
            listContainer.className = "listContainer";
            legendContainer.appendChild(listContainer);
        }

        return listContainer;
    };

    const htmlLegendPlugin = {
        id: "htmlLegend",
        afterUpdate(chart, args, options) {
            const ul = getOrCreateLegendList(chart, options.containerID);

            while (ul.firstChild) {
                ul.firstChild.remove();
            }

            const items =
                chart.options.plugins.legend.labels.generateLabels(chart);

            items.forEach((item) => {
                const li = document.createElement("li");
                li.className = "li";

                const boxSpan = document.createElement("span");
                boxSpan.className = "boxSpan";
                boxSpan.style.backgroundColor = item.fillStyle;
                boxSpan.style.borderColor = item.strokeStyle;

                const textContainer = document.createElement("small");
                textContainer.className = "textContainer";
                textContainer.style.color = "white";
                textContainer.style.textDecoration = item.hidden
                    ? "line-through"
                    : "none";

                const text = document.createTextNode(item.text);
                textContainer.appendChild(text);

                li.onclick = () => {
                    const { type } = chart.config;
                    if (type === "pie" || type === "doughnut") {
                        chart.toggleDataVisibility(item.index);
                    } else {
                        chart.setDatasetVisibility(item.datasetIndex);
                    }

                    chart.update();
                };

                li.appendChild(boxSpan);
                li.appendChild(textContainer);
                ul.appendChild(li);
            });
        },
    };

    var ctx6 = document.getElementById("pie-bar2").getContext("2d");
    let existingChart = Chart.getChart(ctx6);
    if (existingChart) {
        existingChart.destroy();
    }
    const data4 = {
        labels: labels,
        datasets: [
            {
                label: "Trades for Instrument",
                data: dataset,
                backgroundColor: [
                    COLORS.primary,
                    COLORS.secondaryColor,
                    COLORS.third,
                    COLORS.blue,
                ],
                borderColor: "transparent",
                cutout: "70%",
                hoverOffset: 10,
            },
        ],
    };
    new Chart(ctx6, {
        type: "doughnut",
        data: data4,
        options: {
            responsive: true,

            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: "white",
                    },
                },
                htmlLegend: {
                    containerID: "legend-container",
                },
            },
        },
        plugins: [htmlLegendPlugin],
    });
}
