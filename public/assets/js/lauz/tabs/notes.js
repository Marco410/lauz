let btn = document.getElementById("btn-create-note");
let token = document.getElementById("token");
btn.addEventListener("click", function () {
    $.ajax({
        url: URLS.createNote,
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": token.value,
        },
        data: {
            note: quill.root.innerHTML,
        },
        success: function (resp) {
            if (resp.success) {
                quill.root.innerHTML = "";
                let notes = document.getElementById("notes-view");
                let note = document.createElement("div");

                note.innerHTML =
                    '<div class="card" style="margin-top:10px;background-color: var(--bgDark)"><div class="card-body text-white note"><div class="row"><div class="col-sm-1">' +
                    resp.count +
                    '</div><div class="col-sm-8 " style="text-align: left;">' +
                    resp.note +
                    '</div><div class="col-sm-3">' +
                    moment(new Date(resp.created_at), "DD/MM/YYYY").format(
                        "DD-MM-YYYY HH:mm:ss"
                    ) +
                    " Hrs" +
                    "</div></div></div>";
                notes.prepend(note);
                alert("Note created successfully");
            } else {
                alert("Failed to create note");
            }
        },
        error: function (error) {},
    });
});

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
