const calHeatmapElement = document.querySelector("#cal-heatmap");
const loaderCalendar = document.querySelector("#calendarLoader");
const loaderCalendar1 = document.querySelector("#calendarLoader1");
let cal = null;

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
                range: ["#f46d22", "#e0e0e0", "#b2f35f"],
                domain: [-0.1, 0, 0.1],
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
            Tooltip,
            {
                radius: 2,
                text: function (timestamp, value, dayjsDate) {
                    const dataPoint = calendarNetProfitMap.get(
                        dayjsDate.format("YYYY-MM-DD")
                    );
                    const trade = dataPoint ? dataPoint.trade : "No trade data";
                    return (
                        `${
                            value > 0 ? "Good day" : "Bad day"
                        }. NetPL: ${value}, Q_Trades: ${trade} on ` +
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
    calendarNetProfit = [];
    calendarNetProfitMap = new Map();
    calendarData = [];
    startDateCalendar = new Date();

    const dataPost = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
        Instrument: selectedInstrumentGlobal,
    };

    $.ajax({
        url: URLS.getCalendarNetProfit,
        type: "GET",
        dataType: "json",
        data: dataPost,
        success: function (data) {
            data.forEach((item) => {
                const timestamp = item.EntryTime;
                const dataPoint = {
                    t: new Date(item.EntryTime + "T00:00:00"),
                    v: item.NetPL,
                    trade: item.Q_Trades,
                };

                calendarNetProfit.push(dataPoint);
                calendarNetProfitMap.set(timestamp, dataPoint);

                calendarData.push({
                    title: `Date: ${item.EntryTime} \n NetPNL: ${item.NetPL} \n`,
                    start: item.EntryTime,
                    backgroundColor:
                        item.NetPL < 0
                            ? COLORS.third
                            : item.NetPL > 0
                            ? COLORS.primary
                            : "white",
                });
            });

            //this cause startDateCalendar overwrites at the end
            if (calendarNetProfit.length > 0) {
                startDateCalendar = calendarNetProfit[1].t;
            } else {
                startDateCalendar = new Date();
            }
            if (calendarNetProfit.length > 0) {
                startDate = calendarNetProfit[0].t;
                startDate.setMonth(
                    calendarNetProfit[0].t.getMonth() - monthRest
                );
            } else {
                startDate = new Date();
            }
            initHeatMap();
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
