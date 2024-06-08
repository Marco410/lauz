let btn = document.getElementById("btn-create-note");
let token = document.getElementById("token");

$.ajax({
    url: URLS.getNotes,
    type: "GET",
    dataType: "json",
    success: function (resp) {
        let notes = document.getElementById("notes-view");

        resp.forEach((item, index) => {
            let note = document.createElement("div");
            note.innerHTML =
                '<div class="card" style="margin-top:10px;background-color: var(--bgDark)"><div class="card-body text-white note"><div class="row"><div class="col-sm-1">' +
                (resp.length - index) +
                '</div><div class="col-sm-8"  style="text-align: left;">' +
                item.note +
                '</div><div class="col-sm-3">' +
                moment(new Date(item.created_at), "DD/MM/YYYY").format(
                    "DD-MM-YYYY HH:mm:ss"
                ) +
                " Hrs" +
                "</div></div></div>";
            notes.appendChild(note);
        });
    },
    error: function (error) {},
});
