const periodTab = document.getElementById("periodTab");
const cumNetProfitLoader = document.getElementById("cumNetProfitLoader");
const netProfitLoader = document.getElementById("netProfitLoader");
const loaderCalendar2 = document.getElementById("calendarLoader2");

let instrumentSelect = document.querySelector('select[name="instrument"]');
let periodSelect = document.querySelector('select[name="period"]');

let labelsCumNetProfit = [];
let dataCumNetProfit = [];
let labelCumNetProfit = "";

let labelsNetProfit = [];
let dataNetProfit = [];
let labelNetProfit = "";
periodTab.addEventListener("click", () => {
    getInstruments();
    getAllDataPeriodTab();
});

instrumentSelect.addEventListener("change", handleSelectAccount);
periodSelect.addEventListener("change", handleChangePeriod);

function handleSelectAccount(event) {
    let selectedInstrument = event.target.value;
    selectedInstrumentGlobal = selectedInstrument;
    instrumentSelect.value = selectedInstrument;
    getCalendarNetProfit();
    getAllDataPeriodTab();
}

function handleChangePeriod(event) {
    let selectedPeriod = event.target.value;
    selectedPeriodGlobal = selectedPeriod;
    periodSelect.value = selectedPeriod;
    getAllDataPeriodTab();
}

function getAllDataPeriodTab() {
    loaderCalendar2.style.display = "inline-block";
    getNetProfit();
    getMaxDrawdow();
    renderTableOverviewForDay();
    setTimeout(() => {
        renderCalendar2();
    }, 3000);
}

function getInstruments() {
    instrumentSelect.innerHTML = "";
    $.ajax({
        url: URLS.getInstruments,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
        },
        success: function (data) {
            instrumentSelect.innerHTML =
                '<option selected value="">Instrument</option>';

            if (data.length > 0) {
                instrumentsGlobal = [];
                for (let i = 0; i < data.length; i++) {
                    instrumentsGlobal.push(data[i].Instrument);
                }
            }

            instrumentsGlobal.forEach((item) => {
                let optionElement = document.createElement("option");
                optionElement.value = item;
                optionElement.textContent = item;
                instrumentSelect.appendChild(optionElement);
            });
        },
        error: function (error) {},
    });
}

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
            Market_pos: directionGlobal,
            Trade_Result: winningGlobal,
            Instrument: selectedInstrumentGlobal,
            Period: selectedPeriodGlobal,
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
            Market_pos: directionGlobal,
            Trade_Result: winningGlobal,
            Instrument: selectedInstrumentGlobal,
            Period: selectedPeriodGlobal,
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
    gradientStroke4.addColorStop(1, OPACITY.thirdWithOpacity6);
    gradientStroke4.addColorStop(0.1, OPACITY.thirdWithOpacity15);
    gradientStroke4.addColorStop(0, OPACITY.thirdWithOpacity6);

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
                    borderColor: COLORS.third,
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

function renderCalendar2() {
    let tooltipSpan = document.getElementById("tooltip-span2");
    let calendarEl2 = document.getElementById("calendar2");
    let calendar2 = new FullCalendar.Calendar(calendarEl2, {
        initialView: "dayGridMonth",
        themeSystem: "bootstrap5",
        height: "100%",
        events: calendarData,
        initialDate: startDateCalendar,
        eventClick(event) {
            alert(`${event.event._def.title}`);
        },
        eventMouseEnter: function (event, jsEvent, view) {
            tooltipSpan.innerHTML = `<strong>${event.event._def.title}</strong>`;
            tooltipSpan.style.display = "block";
        },
        eventMouseLeave: function (event, jsEvent, view) {
            tooltipSpan.style.display = "none";
        },
    });
    calendar2.render();
    loaderCalendar2.style.display = "none";
}
const loaderOverviewForDay = document.getElementById("loaderOverviewForDay");
function renderTableOverviewForDay() {
    loaderOverviewForDay.style.display = "inline-block";

    const dataPostOverViewForDay = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
    };

    const totalDaysWin = document.getElementById("totalDaysWin");
    const totalDaysLoss = document.getElementById("totalDaysLoss");
    const totalPercentaje = document.getElementById("totalPercentaje");

    let tableOverviewForDay = $("#tableOverviewForDay").DataTable({
        responsive: true,
        fixedHeader: true,
        searching: false,
        pageLength: 2,
        bDestroy: true,
        ajax: {
            type: "get",
            url: URLS.getOverviewForDay,
            data: dataPostOverViewForDay,
            dataSrc: function (data) {
                let totalDaysW = 0;
                let totalDaysL = 0;
                let totalDays = 0;
                let totalP = 0;

                data.forEach((day) => {
                    totalDaysW += day.Winning_Days;
                    totalDaysL += day.Losing_Days;
                });
                totalDays = totalDaysW + totalDaysL;
                totalP = (totalDaysW / totalDays) * 100;
                totalDaysWin.innerHTML = totalDaysW;
                totalDaysLoss.innerHTML = totalDaysL;
                totalPercentaje.innerHTML = totalP.toFixed(2);
                loaderOverviewForDay.style.display = "none";
                return data;
            },
            error: function (e) {
                loaderOverviewForDay.style.display = "none";
            },
        },
        layout: {
            topStart: null,
            bottomStart: null,
        },
        order: [],
        columns: [
            {
                data: "Day_Name",
                render: function (data, type, row, meta) {
                    return `<small class="text-xs" style="color: var(--textGray);">${data.substring(
                        0,
                        3
                    )}</small>`;
                },
            },
            {
                data: "Total_PNL",
                render: function (data, type, row, meta) {
                    return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                        data
                    )}</small>`;
                },
            },
            {
                data: "Avg_Win_Ratio",
                render: function (data, type, row, meta) {
                    const percentaje = data * 100;
                    const percent = 100 - percentaje.toFixed(2);
                    return `<br> 
                              <div class="progress"  style="background-color: transparent;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: ${percentaje.toFixed(
                                    2
                                )}%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="${percentaje.toFixed(
                        2
                    )}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-white" role="progressbar" style="width: ${percent.toFixed(
                                    2
                                )}%;border-radius: 0px 10px 10px 0px; !important" aria-valuenow="${percent.toFixed(
                        2
                    )}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <label class="" style="color: var(--textGray);">${
                                  row.Winning_Days
                              } W ${row.Losing_Days}L - ${percentaje.toFixed(
                        2
                    )}%</label>`;
                },
            },
            {
                data: "Profits",
                render: function (data, type, row, meta) {
                    return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                        data
                    )}</small>`;
                },
            },
            {
                data: "Loss",
                render: function (data, type, row, meta) {
                    return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                        data
                    )}</small>`;
                },
            },
            {
                data: "Q_Trades",
                render: function (data, type, row, meta) {
                    return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
                },
            },
        ],
    });
}
