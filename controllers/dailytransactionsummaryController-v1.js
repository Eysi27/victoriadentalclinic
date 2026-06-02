changeDateToday("from");
getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    //alert("G");
    var group = document.getElementById("group").value;
    var from = document.getElementById("from").value;
    document.getElementById("h3id").innerHTML = "DATE: " + from;
    $("#loading").fadeIn();
    var fd = new FormData();
    fd.append("from", from);
    fd.append("group", group);
    $.ajax({
        url: "services/dailytransactionsummaryservice.php",
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
