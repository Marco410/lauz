window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.style.display = "none";
});

const totalNetPLElement = document.getElementById("totalNetPl");

$.ajax({
    url: URLS.netpl,
    type: "GET",
    dataType: "json",
    success: function (response) {
        console.log("response");
        console.log(response);
        console.log("response.totalNetPL");
        console.log(response.totalNetPL);

        var className =
            response.totalNetPL > 0 ? "text-primary" : "text-danger";
        totalNetPLElement.innerHTML =
            '<h5 class="' + className + '"> $' + response.totalNetPL + "</h5>";

        const table = document.getElementById("myTable");
        // Obtener la referencia al cuerpo de la tabla
        const tbody = table.getElementsByTagName("tbody")[0];
        var totalMonth = 0;
        // Iterar sobre los datos recibidos
        for (const year in response) {
            if (year !== "totalNetPL") {
                // Crear una nueva fila para el año
                const row = tbody.insertRow();
                // Crear la celda para el año
                const cellYear = row.insertCell();
                cellYear.innerHTML =
                    '<small class="text-xxs" style="color: var(--textGray)" >' +
                    year +
                    "</small>";

                // Iterar sobre los meses
                for (let month = 1; month <= 12; month++) {
                    // Crear la celda para el mes
                    const cellMonth = row.insertCell();
                    // Si hay datos para este año y mes, mostrar la sumatoria del NetPL
                    if (response[year][month]) {
                        var classNameTd =
                            response[year][month].totalNetPL > 0
                                ? "text-primary"
                                : "text-danger";
                        var sign =
                            response[year][month].totalNetPL > 0 ? "+" : "-";
                        cellMonth.innerHTML =
                            '<small class="text-xxs" style="color: var(--textGray)" ><label class="' +
                            classNameTd +
                            '" >' +
                            sign +
                            "</label>$" +
                            formatNumber(
                                Math.abs(response[year][month].totalNetPL)
                            ) +
                            "</small>";
                        totalMonth += response[year][month].totalNetPL;
                    } else {
                        cellMonth.innerHTML =
                            '<small class="text-xxs" style="color: var(--textGray)" >-</small>'; // Si no hay datos, mostrar un guión
                    }
                }
                var classNameT =
                    totalMonth > 0 ? "text-primary" : "text-danger";
                var signT = totalMonth > 0 ? "+" : "-";
                const cellTotal = row.insertCell();
                cellTotal.innerHTML =
                    '<small class="text-xxs" style="color: var(--textGray)" ><label class="' +
                    classNameT +
                    '" >' +
                    signT +
                    "</label>$" +
                    formatNumber(Math.abs(totalMonth)) +
                    "</small>";
            }
        }
        const loaderTable = document.getElementById("loader-table");
        loaderTable.style.display = "none";
    },
    error: function (xhr, status, error) {
        console.error(error);
    },
});

function formatNumber(number) {
    if (number >= 1000) {
        return (number / 1000).toFixed(0) + "K";
    } else {
        return number.toFixed(2);
    }
}
