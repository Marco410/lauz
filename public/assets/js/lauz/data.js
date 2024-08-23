window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.style.display = "none";
});

const totalNetPLElement = document.getElementById("totalNetPl");
const loaderTable = document.getElementById("loader-table");
const loaderChart = document.getElementById("loader-chart");

let accountsSelectGlobal = document.querySelector('select[name="accounts"]');
let accountsSelectGlobal2 = document.querySelector('select[name="accounts2"]');

/* let initDateGlobal = document.querySelector('input[name="initDate"]'); */
let initDateGlobal2 = document.querySelector('input[name="initDate2"]');
/* let endDateGlobal = document.querySelector('input[name="endDate"]'); */
let endDateGlobal2 = document.querySelector('input[name="endDate2"]');

let directionSelect = document.querySelector('select[name="direction"]');
let winningSelect = document.querySelector('select[name="winning"]');

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

/**
    This function fetches a list of accounts from the server and populates the select elements with the available accounts.
    It uses jQuery's $.ajax() method to make a GET request to the specified URL (URLS.accounts).
    Upon successful retrieval of the data, it iterates through the received accounts and creates an option element for each account.
    These option elements are then appended to the respective select elements.
    If an error occurs during the AJAX request, it logs the error to the console.
    Finally, it sets the accountSelected variable to the first account in the accountsGlobal array.
    @param {string} URLS.accounts - The URL from which to fetch the list of accounts.
*/
function getAccounts() {
    $.ajax({
        url: URLS.accounts,
        type: "GET",
        dataType: "json",

        success: function (data) {
            if (data.length > 0) {
                accountsGlobal = [];
                for (let i = 0; i < data.length; i++) {
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

/* initDateGlobal.addEventListener("change", handleChangeInitDate); */
initDateGlobal2.addEventListener("change", handleChangeInitDate);
/* endDateGlobal.addEventListener("change", handleChangeEndDate); */
endDateGlobal2.addEventListener("change", handleChangeEndDate);

directionSelect.addEventListener("change", handleDirectionSelect);
winningSelect.addEventListener("change", handleWinningSelect);

/**
 * This function handles the change event of the 'accounts' select elements.
 * It updates the selected value in both select elements, updates the 'accountSelected' variable,
 * and then calls the 'getAllData' function with 'false' as the second argument.
 *
 * @param {Event} event - The event object that triggers the function.
 */
function handleSelectAccount(event) {
    let selectedValue = event.target.value;
    accountsSelectGlobal.value = selectedValue;
    accountsSelectGlobal2.value = selectedValue;

    accountSelected = selectedValue;
    getAllData(false);
}

/**
 * This function handles the change event of the 'initDate' input element.
 * It updates the selected value in both 'initDateGlobal' and 'initDateGlobal2' select elements,
 * and then updates the 'initDate' variable.
 *
 * @param {Event} event - The event object that triggers the function.
 */
function handleChangeInitDate(event) {
    let selectedDate = event.target.value;
    initDate = selectedDate;
    /* initDateGlobal.value = initDate; */
    initDateGlobal2.value = initDate;
}

/**
 * This function handles the change event of the 'endDate' input element.
 * It updates the selected value in the 'endDateGlobal2' input element, and then updates the 'endDate' variable.
 * If an initial date has been selected, it checks if the selected end date is later than the initial date.
 * If the selected end date is earlier than the initial date, it alerts the user to select a new date.
 * If the selected end date is later than the initial date, it updates the 'endDateGlobal2' input element with the selected end date.
 * If no initial date has been selected, it alerts the user to select an initial date.
 * Finally, it calls the 'getAllData' function with 'false' as the second argument.
 *
 * @param {Event} event - The event object that triggers the function.
 * @param {string} initDate - The selected initial date.
 */
function handleChangeEndDate(event) {
    let selectedDate = event.target.value;
    endDate = selectedDate;
    if (initDate != "") {
        if (Date.parse(endDate) < Date.parse(initDate)) {
            alert("Please select a new date");
            /* endDateGlobal.value = ""; */
            endDateGlobal2.value = "";
        } else {
            /*  endDateGlobal.value = endDate; */
            endDateGlobal2.value = endDate;
        }
    } else {
        alert("Please select an initial date");
        /* endDateGlobal.value = ""; */
        endDateGlobal2.value = "";
    }
    getAllData(false);
}

/**
 * This function handles the change event of the 'direction' select element.
 * It updates the selected value in the 'direction' select element, updates the 'directionGlobal' variable,
 * and then calls the 'getAllData' function with 'false' as the second argument.
 *
 * @param {Event} e - The event object that triggers the function.
 * @param {string} selectDirection - The selected value from the 'direction' select element.
 */
function handleDirectionSelect(e) {
    let selectDirection = e.target.value;
    directionGlobal = selectDirection;
    directionSelect.value = selectDirection;
    getAllData(false);
}

/**
 * This function handles the change event of the 'winning' select element.
 * It updates the selected value in the 'winning' select element, updates the 'winningGlobal' variable,
 * and then calls the 'getAllData' function with 'false' as the second argument.
 *
 * @param {Event} e - The event object that triggers the function.
 * @param {string} winningSelected - The selected value from the 'winning' select element.
 */
function handleWinningSelect(e) {
    let winningSelected = e.target.value;
    winningGlobal = winningSelected;
    winningSelect.value = winningSelected;
    getAllData(false);
}

/**
 * This function fetches and processes all the necessary data for the application.
 * It calls various other functions to retrieve data from the server and update the UI.
 *
 * @param {boolean} isOnLoad - A flag indicating whether the function is called on page load.
 */
function getAllData(isOnLoad) {
    getOverviewData();
    getMetricsData();
    getNetPL();
    getCalendarNetProfit();
    getPNL();
    getTradesDirection();
    getMFE();
    getPerformanceTable();
    table.ajax.reload();
    tableRecent.ajax.reload();
    if (!isOnLoad) {
        //Functions that no need to be executed on load
        getAllDataPeriodTab();
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
            let datosTotalNetPL = [];
            let datosMeses = [];
            var className =
                response.totalNetPL > 0 ? "text-primary" : "text-danger";
            totalNetPLElement.innerHTML =
                '<h6 class="' +
                className +
                '"> $' +
                formatDecimalNumber(response.totalNetPL) +
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

/**
 * Formats a given number by adding a comma separator for thousands and rounding it to two decimal places.
 * If the absolute value of the number is greater than or equal to 1000, it appends "K" to the formatted number.
 *
 * @param {number} number - The number to be formatted.
 * @returns {string} The formatted number as a string.
 */
function formatNumber(number) {
    if (Math.abs(number) >= 1000) {
        const rounded = Math.floor(number / 100) / 10;
        return rounded.toFixed(1).replace(".", ",") + "K";
    } else {
        return formatDecimalNumber(number);
    }
}

/**
 * Formats a given number by adding a comma separator for thousands and rounding it to two decimal places.
 * If the absolute value of the number is greater than or equal to 1000, it appends "K" to the formatted number.
 *
 * @param {number} number - The number to be formatted.
 * @returns {string} The formatted number as a string.
 */
function formatDecimalNumber(number) {
    return new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(number);
}

/**
 * This function takes a number as input and returns a CSS class based on whether the number is positive or negative.
 * If the number is positive, it returns the "text-primary" CSS class. If the number is negative, it returns the "text-danger" CSS class.
 *
 * @param {number} number - The number whose CSS class will be determined based on its sign.
 * @returns {string} The CSS class representing the primary or danger color based on the sign of the input number.
 * @example
 * getPrimaryDangeClass(100);  // Returns "text-primary"
 * getPrimaryDangeClass(-50); // Returns "text-danger"
 */
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

/**
 * Renders a line chart using Chart.js library.
 * This function takes two arrays as input: 'datosTotalNetPL' and 'datosMeses'.
 * 'datosTotalNetPL' is an array of numbers representing the total net profit for each month.
 * 'datosMeses' is an array of strings representing the months for which the total net profit is calculated.
 * The function creates a new Chart.js line chart with the provided data and options, and destroys any existing chart on the same canvas.
 * @param {Array} datosTotalNetPL - An array of numbers representing the total net profit for each month.
 * @param {Array} datosMeses - An array of strings representing the months for which the total net profit is calculated.
 * @returns {void} - This function does not return a value. It renders a line chart on the canvas with the provided data and options.
 * @example
 * renderizarGrafico([100, 200, 150, 250, 300, 200, 250], ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul"]);
 */
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
