function getMFE() {
    $.ajax({
        url: URLS.getmfe,
        type: "GET",
        dataType: "json",
        data: {
            account: accountSelected,
            initDate: initDate,
            endDate: endDate,
            user: user,
            Market_pos : Market_pos,
            Trade_Result : Trade_Result,
            Instrument : Instrument,
        },
        success: function (response) {

        }
    });
}
