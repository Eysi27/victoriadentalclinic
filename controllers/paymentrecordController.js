getclientdata();
function getclientdata() {


    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    var paymentTypeOption = document.getElementById("paymentType");
    var paymentType = paymentTypeOption.value;
    document.getElementById("h3id").innerHTML = "DATE RANGE: " + from + " - " + to;
    var fd = new FormData();

    fd.append("from", from);
    fd.append("to", to);
    fd.append("paymentType", paymentType);
    $.ajax({
        url: "services/paymentrecordservice.php",
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
