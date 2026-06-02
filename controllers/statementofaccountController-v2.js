changeDate("from");
getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    //alert("G");
    var group = document.getElementById("group").value;
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    document.getElementById("h3id").innerHTML = "DATE RANGE: " + from + " - " + to;
    $("#loading").fadeIn();
    var fd = new FormData();
    fd.append("from", from);
    fd.append("to", to);
    fd.append("group", group);
    $.ajax({
        url: "services/statementofaccountsService.php",
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
