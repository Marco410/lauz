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
    calendarNetProfit = [];
    calendarData = [];
    startDateCalendar = new Date();
    loaderCalendar1.style.display = "inline-block";
    loaderCalendar1.innerHTML = loaderGlobal;

    const dataPost = {
        account: accountSelected,
        initDate: initDate,
        endDate: endDate,
        Market_pos: directionGlobal,
        Trade_Result: winningGlobal,
    };

    $.ajax({
        url: URLS.getCalendarNetProfit,
        type: "GET",
        dataType: "json",
        data: dataPost,
        success: function (data) {
            data.forEach((item) => {
                calendarNetProfit.push({
                    t: new Date(item.EntryTime + "T00:00:00"),
                    v: item.NetPL,
                });

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
            renderCalendar();
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

function renderCalendar() {
    let calendarEl = document.getElementById("calendar");
    let tooltipSpan = document.getElementById("tooltip-span");
    let calendar = new FullCalendar.Calendar(calendarEl, {
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
    calendar.render();
    loaderCalendar1.style.display = "none";
}
