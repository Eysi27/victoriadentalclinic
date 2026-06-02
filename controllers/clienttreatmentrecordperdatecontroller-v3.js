changeDate("from");
getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    //alert("G");]
    var dentist = document.getElementById("dentist").value;
    var group = document.getElementById("group").value;
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    document.getElementById("h3id").innerHTML = "DATE RANGE: " + from + " to " + to;

    $("#loading").fadeIn();
    var fd = new FormData();
    fd.append("from", from);
    fd.append("to", to);
    fd.append("group", group);
    fd.append("dentist", dentist);
    $.ajax({
        url: "services/clienttreatmentreportservice.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("resultResponse").innerHTML = result;

        },
        complete: function () {

            $("#loading").fadeOut();

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}
