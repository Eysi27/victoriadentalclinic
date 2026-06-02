loadMedHistory();

function loadMedHistory() {
    var clientId = document.getElementById("clientId").value;
    var fd = new FormData();
    fd.append('clientId', clientId);
    fd.append('consentId', '');


    $.ajax({
        url: "services/consentMedHistoryViewService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {


            document.getElementById("medHistory").innerHTML = result;

        }
    });

}

function addConsent() {
    var dateSigned = document.getElementById("dateSigned").value;
    var dentistSignature = document.getElementById("dentist-signature-input").value;
    var patientSignature = document.getElementById("patient-signature-input").value;
    var dentistName = document.getElementById("dentistName").value;
    var clientId = document.getElementById("clientId").value;


    var msg = '';
    if (!dateSigned) {
        msg = 'Date signed is Required';
    } else if (patientSignature == '') {
        msg = 'Incomplete Signature';
    } else if (clientId == '') {
        msg = 'Invalid Form.';
    }


    if (msg == '') {
        submitform(dateSigned, dentistSignature, patientSignature, dentistName, clientId);
    } else {
        showToast("errorToast", msg);
    }



}

function submitform(dateSigned, dentistSignature, patientSignature, dentistName, clientId) {
    var fd = new FormData();
    fd.append('dateSigned', dateSigned);
    fd.append('dentistSignature', dentistSignature);
    fd.append('patientSignature', patientSignature);
    fd.append('dentistName', dentistName);
    fd.append('clientId', clientId);
    $.ajax({
        url: "services/consentAddService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == "success") {
                showToast("successToast", "Successfully Added");
            } else {
                showToast("errorToast", result);
            }
        }
    });
}
function reloadPage() {
    location.reload();
}
