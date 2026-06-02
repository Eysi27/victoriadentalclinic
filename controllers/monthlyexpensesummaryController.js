
getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    //alert("G");
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    document.getElementById("h3id").innerHTML = "For The Month " + getMonthName(month) + ", " + year;
    $("#loading").fadeIn();
    var fd = new FormData();
    fd.append("month", month);
    fd.append("year", year);
    $.ajax({
        url: "services/monthlyexpensesummaryService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            document.getElementById("responseBody").innerHTML = result;

        },
        complete: function () {

            $("#loading").fadeOut();

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}
