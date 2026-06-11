getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    //alert("G");
    var clientname = document.getElementById("clientname").value;
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    document.getElementById("h3id").innerHTML = "DATE RANGE: " + from + " - " + to;
    var fd = new FormData();
    fd.append("clientname", clientname);
    fd.append("from", from);
    fd.append("to", to);
    $.ajax({
        url: "services/clienttreatmentrecordperclientservice.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("resultResponsez").innerHTML = result;

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}
