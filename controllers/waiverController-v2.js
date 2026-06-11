var message = "";
setDentistSignature();
populatePatientNames();

function setDentistSignature() {

    var dentistName = document.getElementById("dentistName").value;

    if (dentistName == 'Dr. Nikki Sarmiento') {

        document.getElementById("dentist-signature-box").innerHTML = '<img src="img/e-sign.png" alt="signature" style = "height: 100%; width: auto; display: block margin: 0 auto;" > ';
    } else {
        document.getElementById("dentist-signature-box").innerHTML = "";
    }

}

function populatePatientNames() {
    const today = new Date();

    // Format it to YYYY-MM-DD
    const formattedDate = today.toISOString().split('T')[0];

    // Set the input value
    document.getElementById('dateSigned').value = formattedDate;
    var fd = new FormData();
    $.ajax({
        url: "services/waiverPatientNames.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            document.getElementById("patients").innerHTML = result;
        }
    });
}

function getSelectedPatientId(input) {
    const options = document.querySelectorAll('#patients option');
    const inputValue = input.value;
    let selectedId = '';

    for (let option of options) {
        if (option.value === inputValue) {
            selectedId = option.dataset.id;
            break;
        }
    }

    document.getElementById('patientId').value = selectedId;
    console.log('Selected data-id:', selectedId);
}
function submitConsentform() {
    var dateSigned = document.getElementById("dateSigned").value;
    var dentistSignature = document.getElementById("dentist-signature-input").value;
    var patientName = document.getElementById("patientName").value;
    var patientSignature = document.getElementById("patient-signature-input").value;
    var dentistName = document.getElementById("dentistName").value;
    var clientId = document.getElementById("patientId").value;

    if (dateSigned == "" || patientSignature == "" || dentistName == "" || patientName == "") {
        toastError("Please fill in all fields.");
        return;
    } else if (clientId == "") {
        toastError("Patient not registered.");
        return;
    } else if (dentistName != "Dr. Nikki Sarmiento" && dentistSignature == "") {
        toastError("Please provide a dentist signature.");
        return;
    }


    var fd = new FormData();
    fd.append('dateSigned', dateSigned);
    fd.append('dentistSignature', dentistSignature);
    fd.append('patientSignature', patientSignature);
    fd.append('dentistName', dentistName);
    fd.append('patientName', patientName);
    fd.append('clientId', clientId);
    $.ajax({
        url: "services/addWaiver.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == "success") {
                message += "Consent Waiver Successfully Added.";
                toastSuccess(message);
                setTimeout(() => location.reload(), 3000);

            } else {
                toastError(result);
            }
        }
    });
}