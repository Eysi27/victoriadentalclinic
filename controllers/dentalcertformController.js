loadCert();
function loadCert() {
    // var soaid = document.getElementById("soaid").value;
    var certid = document.getElementById("certid").value;
    var fd = new FormData();
    fd.append("soaid", certid)
    $.ajax({
        url: "services/printDentalCertService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("bodyResult").innerHTML = result;
            // loadPayment();
        }
    });

}



