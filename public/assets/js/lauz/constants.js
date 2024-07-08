const URLS = {
    accounts: "/get-accounts",
    getInstruments: "/get-instruments",
    netpl: "/get-netpl",
    overviewData: "/get-overview-data",
    tradesTable: "/get-total-trades",
    netProfit: "/get-net-profit",
    getCalendarNetProfit: "/get-calendar",
    getMaxDrawdown: "/get-max-drawdown",
    createNote: "/create-note",
    getNotes: "/notes",
    getNetPNL: "/get-daily-net-cumulative-pl",
    getmfe: "/get-mfe",
    getPerformanceTable: "/get-performance-table",
    getMetrics: "/get-metrics",
    getRecentTrades: "/get-recent-trades",
    getOverviewForDay: "/get-overview-day",
    getTradesDirection: "/get-trades-direction",
};

const COLORS = {
    primary: getComputedStyle(document.documentElement).getPropertyValue(
        "--primary"
    ),
    secondaryColor: getComputedStyle(document.documentElement).getPropertyValue(
        "--secondary"
    ),
    third: getComputedStyle(document.documentElement).getPropertyValue(
        "--third"
    ),
    blue: getComputedStyle(document.documentElement).getPropertyValue("--blue"),
};

const OPACITY = {
    primaryWithOpacity9: `rgba(${hexToRgb(COLORS.primary)}, 0.9)`,
    primaryWithOpacity6: `rgba(${hexToRgb(COLORS.primary)}, 0.6)`,
    primaryWithOpacity15: `rgba(${hexToRgb(COLORS.primary)}, 0.15)`,
    thirdWithOpacity9: `rgba(${hexToRgb(COLORS.third)}, 0.9)`,
    thirdWithOpacity6: `rgba(${hexToRgb(COLORS.third)}, 0.6)`,
    thirdWithOpacity15: `rgba(${hexToRgb(COLORS.third)}, 0.15)`,
};

function hexToRgb(hex) {
    hex = hex.replace(/^#/, "");
    const bigint = parseInt(hex, 16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return `${r}, ${g}, ${b}`;
}
