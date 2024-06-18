let tableAccounts = $("#tableAccounts").DataTable({
    responsive: true,
    fixedHeader: true,
    searching: false,
    pageLength: 10,
    ajax: {
        type: "get",
        url: URLS.accounts,
        dataSrc: function (data) {
            return data;
        },
        error: function (e) {},
    },
    layout: {
        topStart: null,
        bottomStart: null,
    },
    order: [],
    columns: [
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray); margin-left:15px">${data}</small>`;
            },
        },
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">Uprofit</small>`;
            },
        },
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">HiloTime</small>`;
            },
        },
        {
            data: "Inicial_Balance",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">$${formatDecimalNumber(
                    data
                )}</small>`;
            },
        },
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<small class="text-xs" style="color: var(--textGray);">Connected</small>`;
            },
        },
        {
            data: "Account",
            render: function (data, type, row, meta) {
                return `<button class="btn btn-primary btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Edit</button>
                        <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Delete</button>
                        <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Reset</button>`;
            },
        },
    ],
});

function formatDecimalNumber(number) {
    return new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(number);
}
