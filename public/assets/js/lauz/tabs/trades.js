const tradesTab = document.getElementById("tradesTab");
const loaderTradesTable = document.getElementById("loaderTradesTable");
tradesTab.addEventListener("click", () => {
    table.ajax.reload();
});
$.fn.dataTable.moment("DD/MM/YYYY");

const dataPost = {
    account: accountSelected,
    initDate: initDate,
    endDate: endDate,
    Market_pos: directionGlobal,
    Trade_Result: winningGlobal,
};

let table = $("#trades-table").DataTable({
    responsive: true,
    fixedHeader: true,
    searching: false,
    ajax: {
        type: "get",
        url: URLS.tradesTable,
        data: dataPost,
        dataSrc: function (data) {
            loaderTradesTable.style.display = "none";
            return data;
        },
        error: function (e) {
            loaderTradesTable.style.display = "none";
        },
    },
    layout: {
        topStart: null,
        bottomStart: "pageLength",
    },
    order: [8, "des"],
    columns: [
        {
            data: null,
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${
                    meta.row + 1
                }</small>`;
            },
        },
        {
            data: "Instrument",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Strategy",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Market_pos_",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "QTY",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "EntryPrice",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "ExitPrice",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "EntryTime",
            render: function (data, type, row, meta) {
                // Usa moment.js para convertir la fecha al formato ISO
                var date = moment(data, "DD/MM/YYYY").format("YYYY-MM-DD");
                return `<small class="text-xs" style="color: var(--textGray);">${date}</small>`;
            },
            type: "datetime",
        },
        {
            data: "ExitTime",
            render: function (data, type, row, meta) {
                var date = moment(data, "DD/MM/YYYY").format("YYYY-MM-DD");
                return `<small class="text-xs" style="color: var(--textGray);">${date}</small>`;
            },
            type: "datetime",
        },
        {
            data: "Entry_name",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Exit_name",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">${data}</small>`;
            },
        },
        {
            data: "Profit",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    data
                )}</small>`;
            },
        },
        {
            data: "CumNetProfit",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    data
                )}</small>`;
            },
        },
        {
            data: "DrowDown",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">-</small>`;
            },
        },
        {
            data: "MAE",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    data
                )}</small>`;
            },
        },
        {
            data: "MFE",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    data
                )}</small>`;
            },
        },
        {
            data: "ETD",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    data
                )}</small>`;
            },
        },

        {
            data: "AcumProfit",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">-</small>`;
            },
        },
    ],
});

$.fn.dataTable.moment("DD/MM/YYYY");

function getTradesTable() {
    /*  $.ajax({
        url: URLS.tradesTable,
        type: "GET",
        dataType: "json",
        success: function (response) {
            const tbody = document.querySelector("#trades-table tbody");
            tbody.innerHTML = "";
            response.forEach((item, index) => {
                const row = tbody.insertRow();
                const cellTradeNu = row.insertCell();
                cellTradeNu.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${
                    index + 1
                }</small>`;
                const cellInstrument = row.insertCell();
                cellInstrument.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Instrument}</small>`;
                const cellAccount = row.insertCell();
                cellAccount.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Account}</small>`;
                const cellStrategy = row.insertCell();
                cellStrategy.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Strategy}</small>`;
                const cellMarket_pos_ = row.insertCell();
                cellMarket_pos_.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Market_pos_}</small>`;
                const cellQTY = row.insertCell();
                cellQTY.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.QTY}</small>`;
                const cellEntryPrice = row.insertCell();
                cellEntryPrice.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.EntryPrice}</small>`;
                const cellExitPrice = row.insertCell();
                cellExitPrice.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.ExitPrice}</small>`;
                const cellEntryTime = row.insertCell();
                cellEntryTime.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.EntryTime}</small>`;
                const cellExitTime = row.insertCell();
                cellExitTime.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.ExitTime}</small>`;
                const cellEntry_name = row.insertCell();
                cellEntry_name.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Entry_name}</small>`;
                const cellExit_name = row.insertCell();
                cellExit_name.innerHTML = `<small class="text-xs" style="color: var(--textGray);">${item.Exit_name}</small>`;
                const cellProfit = row.insertCell();
                cellProfit.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    item.Profit
                )}</small>`;
                const cellCumNetProfit = row.insertCell();
                cellCumNetProfit.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    item.CumNetProfit
                )}</small>`;
                const cellCommis = row.insertCell();
                cellCommis.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$-</small>`;
                const cellMAE = row.insertCell();
                cellMAE.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    item.MAE
                )}</small>`;
                const cellMFE = row.insertCell();
                cellMFE.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    item.MFE
                )}</small>`;
                const cellETD = row.insertCell();
                cellETD.innerHTML = `<small class="text-xs" style="color: var(--textGray);">$${formatNumber(
                    item.ETD
                )}</small>`;
                const cellBars = row.insertCell();
                cellBars.innerHTML = `<small class="text-xs" style="color: var(--textGray);">-</small>`;

                tbody.appendChild(row);
            });

            loaderTradesTable.style.display = "none";
        },
        error: function (xhr, status, error) {
            console.error(error);
            loaderTradesTable.style.display = "none";
        },
    }); */
}
