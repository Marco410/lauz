const calHeatmapElement = document.querySelector("#cal-heatmap");
const loaderCalendar = document.querySelector("#calendarLoader");
let cal = null;
loaderCalendar.innerHTML = loaderGlobal;
const monthRest = 2;
let startDate = new Date();

function initHeatMap() {
    var viewportWidth = window.innerWidth;
    var breakPoint = 132;
    var range = 3;

    if (viewportWidth > 1500) {
        breakPoint = 120;
    } else if (viewportWidth < 1500 && viewportWidth > 1400) {
        breakPoint = 130;
    } else if (viewportWidth < 1400 && viewportWidth > 768) {
        breakPoint = 100;
        range = 2;
    } else if (viewportWidth < 768) {
        breakPoint = 29;
        range = 3;
    }

    const heatMapConfig = {
        range: range,
        theme: "dark",
        itemSelector: "#cal-heatmap",
        width: 145,
        animationDuration: 500,
        data: {
            source: calendarNetProfit,
            x: "t",
            y: "v",
            groupY: (d) => d[0],
        },
        date: {
            locale: { weekStart: 0 },
            start: startDate,
        },
        domain: {
            type: "month",
            sort: "asc",
            label: {
                offset: {
                    x: 10,
                    y: 0,
                },
            },
        },
        subDomain: {
            type: "day",
            radius: 2,
            label: (t, v) => v,
            width: viewportWidth / breakPoint,
            height: viewportWidth / breakPoint,
            label: "D",
        },
        scale: {
            color: {
                type: "linear",
                range: ["#e0e0e0", "#b2f35f"],
                domain: [-100, 100],
                baseColor: "#161f20",
            },
        },
    };

    if (cal) {
        cal.destroy();
        cal = null;
    }

    cal = new CalHeatmap();
    cal.paint(heatMapConfig, [
        [
            Legend,
            {
                includeBlank: true,
                width: 150,
                itemSelector: "#legend",
                radius: 2,
            },
        ],
        [
            Tooltip,
            {
                radius: 2,
                text: function (date, value, dayjsDate) {
                    return (
                        (value
                            ? value > 0
                                ? "Good day"
                                : "Bad Day"
                            : "No data") +
                        "(" +
                        value +
                        ") on " +
                        dayjsDate.format("LL")
                    );
                },
            },
        ],
        [
            CalendarLabel,
            {
                width: 30,
                textAlign: "bottom",
                text: () => dayjs.weekdaysShort().map((d, i) => d),
            },
        ],
    ]);
    setTimeout(() => {
        calHeatmapElement.style.display = "block";
        loaderCalendar.style.display = "none";
    }, 700);
}

window.addEventListener("resize", function () {
    calHeatmapElement.style.display = "none";
    loaderCalendar.style.display = "inline-block";
    initHeatMap();
});

function getCalendarNetProfit() {
    $.ajax({
        url: URLS.getCalendarNetProfit,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
        },
        success: function (data) {
            data.forEach((item) => {
                calendarNetProfit.push({
                    t: new Date(item.EntryTime + "T00:00:00"),
                    v: item.NetPL,
                });
            });

            startDate = calendarNetProfit[0].t;
            startDate.setMonth(calendarNetProfit[0].t.getMonth() - monthRest);
            initHeatMap();
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
