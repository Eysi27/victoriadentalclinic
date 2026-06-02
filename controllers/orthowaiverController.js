loadDetails();
function loadDetails() {
    var clientId = document.getElementById("clientId").value;
    var fd = new FormData();
    fd.append('clientId', clientId);

    $.ajax({
        url: "services/orthowaiverViewerService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result != "") {

                document.getElementById("waiverDetails").innerHTML = result;
            } else {

            }
        }
    });
}


