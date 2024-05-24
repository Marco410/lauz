window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.style.display = "none";
});

const totalNetPLElement = document.getElementById("totalNetPl");
const totalNetPLElement2 = document.getElementById("totalNetPl2");
const loaderTable = document.getElementById("loader-table");
const loaderChart = document.getElementById("loader-chart");

let accountsSelectGlobal = document.querySelector('select[name="accounts"]');
let accountsSelectGlobal2 = document.querySelector('select[name="accounts2"]');

let initDateGlobal = document.querySelector('input[name="initDate"]');
let initDateGlobal2 = document.querySelector('input[name="initDate2"]');
let endDateGlobal = document.querySelector('input[name="endDate"]');
let endDateGlobal2 = document.querySelector('input[name="endDate2"]');

let datosTotalNetPL = [];
let datosMeses = [];
const nombresMeses = [
    "Ene",
    "Feb",
    "Mar",
    "Abr",
    "May",
    "Jun",
    "Jul",
    "Ago",
    "Sep",
    "Oct",
    "Nov",
    "Dic",
];

getAccounts();

function getAccounts() {
    $.ajax({
        url: URLS.accounts,
        type: "GET",
        dataType: "json",

        success: function (data) {
            if (data.length > 0) {
                accountsGlobal = [];
                for (let i = 1; i < data.length; i++) {
                    accountsGlobal.push(data[i].Account);
                }
            }

            accountsGlobal.forEach((item) => {
                let optionElement = document.createElement("option");
                optionElement.value = item;
                optionElement.textContent = item;
                accountsSelectGlobal2.appendChild(optionElement);
            });
            accountsGlobal.forEach((item) => {
                let optionElement = document.createElement("option");
                optionElement.value = item;
                optionElement.textContent = item;
                accountsSelectGlobal.appendChild(optionElement);
            });

            accountSelected = accountsGlobal[0];
            getAllData(true);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

accountsSelectGlobal.addEventListener("change", handleSelectAccount);
accountsSelectGlobal2.addEventListener("change", handleSelectAccount);

initDateGlobal.addEventListener("change", handleChangeInitDate);
initDateGlobal2.addEventListener("change", handleChangeInitDate);
endDateGlobal.addEventListener("change", handleChangeEndDate);
endDateGlobal2.addEventListener("change", handleChangeEndDate);

function handleSelectAccount(event) {
    let selectedValue = event.target.value;
    accountsSelectGlobal.value = selectedValue;
    accountsSelectGlobal2.value = selectedValue;
    accountSelected = selectedValue;
    getAllData(false);
}

function handleChangeInitDate(event) {
    let selectedDate = event.target.value;
    initDate = selectedDate;
    initDateGlobal.value = initDate;
    initDateGlobal2.value = initDate;
}

function handleChangeEndDate(event) {
    let selectedDate = event.target.value;
    endDate = selectedDate;
    if (initDate != "") {
        if (Date.parse(endDate) < Date.parse(initDate)) {
            alert("Please select a new date");
            endDateGlobal.value = "";
            endDateGlobal2.value = "";
        } else {
            endDateGlobal.value = endDate;
            endDateGlobal2.value = endDate;
        }
    } else {
        alert("Please select an initial date");
        endDateGlobal.value = "";
        endDateGlobal2.value = "";
    }
    getAllData(false);
}

function getAllData(isOnLoad) {
    getOverviewData();
    getNetPL();
    getCalendarNetProfit();
    if (!isOnLoad) {
        //Functions that no need to be executed on load
        getNetProfit();
        getMaxDrawdow();
    }
}

function getNetPL() {
    loaderTable.style.display = "inline-block";
    loaderChart.style.display = "inline-block";

    $.ajax({
        url: URLS.netpl,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
        },
        success: function (response) {
            var className =
                response.totalNetPL > 0 ? "text-primary" : "text-danger";
            totalNetPLElement.innerHTML =
                '<h6 class="' +
                className +
                '"> $' +
                response.totalNetPL +
                "</h6>";
            totalNetPLElement2.innerHTML =
                '<h6 class="' +
                className +
                '"> $' +
                response.totalNetPL +
                "</h6>";

            const table = document.getElementById("myTable");
            const tbody = table.getElementsByTagName("tbody")[0];
            var totalMonth = 0;
            tbody.innerHTML = "";
            for (const year in response) {
                if (year !== "totalNetPL") {
                    const row = tbody.insertRow();
                    const cellYear = row.insertCell();
                    cellYear.innerHTML =
                        '<small class="text-xs" style="color: var(--textGray)" >' +
                        year +
                        "</small>";

                    for (let month = 1; month <= 12; month++) {
                        const cellMonth = row.insertCell();
                        if (response[year][month]) {
                            var classNameTd =
                                response[year][month].totalNetPL > 0
                                    ? "text-primary"
                                    : "text-danger";
                            var sign =
                                response[year][month].totalNetPL > 0
                                    ? "+"
                                    : "-";
                            cellMonth.innerHTML =
                                '<small class="text-xs" style="color: var(--textGray)" ><label class="' +
                                classNameTd +
                                '" >' +
                                sign +
                                "</label>$" +
                                formatNumber(
                                    Math.abs(response[year][month].totalNetPL)
                                ) +
                                "</small>";
                            totalMonth += response[year][month].totalNetPL;
                        } else {
                            cellMonth.innerHTML =
                                '<small class="text-xs" style="color: var(--textGray)" >-</small>'; // Si no hay datos, mostrar un guión
                        }
                    }
                    var classNameT =
                        totalMonth > 0 ? "text-primary" : "text-danger";
                    var signT = totalMonth > 0 ? "+" : "-";
                    const cellTotal = row.insertCell();
                    cellTotal.innerHTML =
                        '<small class="text-xs" style="color: var(--textGray)" ><label class="' +
                        classNameT +
                        '" >' +
                        signT +
                        "</label>$" +
                        formatNumber(Math.abs(totalMonth)) +
                        "</small>";
                }
            }
            loaderTable.style.display = "none";
            const datos = response;
            let totalNetPLSum = 0;
            for (const year in datos) {
                const yearData = datos[year];
                for (const month in yearData) {
                    const monthData = yearData[month];
                    const monthIndex = parseInt(month) - 1;
                    const totalNetPL = monthData.totalNetPL;
                    const yearMonth = nombresMeses[monthIndex] + " " + year;

                    datosMeses.push(yearMonth);
                    totalNetPLSum += totalNetPL;
                    datosTotalNetPL.push(totalNetPLSum);
                }
            }

            renderizarGrafico(datosTotalNetPL, datosMeses);

            loaderChart.style.display = "none";
        },
        error: function (xhr, status, error) {
            console.error(error);
            loaderTable.style.display = "none";
            loaderChart.style.display = "none";
        },
    });
}

function formatNumber(number) {
    if (number >= 1000) {
        return (number / 1000).toFixed(0) + "K";
    } else {
        return number.toFixed(2);
    }
}

function getPrimaryDangeClass(number) {
    return number > 0 ? "text-primary" : "text-danger";
}

var options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false,
        },
    },
    interaction: {
        intersect: false,
        mode: "index",
    },
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
                padding: 10,
                color: "#b2b9bf",
                font: {
                    size: 8,
                    family: "Open Sans",
                    style: "normal",
                    lineHeight: 2,
                },
            },
            grid: {
                drawBorder: false,
                display: true,
                drawTicks: false,
                borderDash: [2, 1],
                color: "#4b4b51",
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
                color: "#b2b9bf",
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
};

function renderizarGrafico(datosTotalNetPL, datosMeses) {
    var ctx3 = document.getElementById("chart-line2").getContext("2d");

    var gradient = ctx3.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0.1, OPACITY.primaryWithOpacity6);
    gradient.addColorStop(0.3, OPACITY.primaryWithOpacity15);

    var existingChart = Chart.getChart(ctx3);

    if (existingChart) {
        existingChart.destroy();
    }

    new Chart(ctx3, {
        type: "line",
        data: {
            labels: datosMeses,
            datasets: [
                {
                    label: "Total NetPL",
                    tension: 0.5,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: OPACITY.primaryWithOpacity6,
                    borderWidth: 0.7,
                    backgroundColor: gradient,
                    fill: true,
                    data: datosTotalNetPL,
                    maxBarThickness: 6,
                },
            ],
        },
        options: options,
    });
}
