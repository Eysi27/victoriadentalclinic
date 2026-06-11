
// $("#bodyResult").load("esoaprint.php?soaid=" + soaid);


loadSoa();
function loadSoa() {
    // var soaid = document.getElementById("soaid").value;
    var soaid = document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid", soaid)
    $.ajax({
        url: "services/printSoaService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("bodyResult").innerHTML = result;
            loadPayment();
        }
    });

}

function loadPayment() {

    var soaid = document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid", soaid)
    $.ajax({
        url: "services/loadPaymentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("paymentResult").innerHTML = result;
        }
    });

}


function signature() {

    // var soaid = document.getElementById("soaid").value;
    var soaid = document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid", soaid)
    $.ajax({
        url: "services/signatureCheckerService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "true") {
                openSignatureModal(function (sigData) {
                    setSignature('patient', sigData);
                });
            } else if (result == "false") {
                toastError("This is already signed by the patient.");

            } else {

            }
        }
    });
}

function changeSignature() {
    var soaid = document.getElementById("soaid").value;
    var patientSignature = document.getElementById("patient-signature-input").value;
    var fd = new FormData();
    fd.append("soaid", soaid);
    fd.append("patientSignature", patientSignature);
    $.ajax({
        url: "services/changeSignatureService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "success") {
                toastSuccess("Successfully Signed.");
                loadSoa();
            } else {
                toastError("An Error occured: " + result);
            }
        }
    });
}

function createTicket(ref, currentvalue, column, table, refname) {
    var value = prompt("Your about to update" + table + "." + column + " for reference # " + ref + " with current value of " + currentvalue + ". Please input new value", "");

    if (value != null && value != "") {
        var fd = new FormData();
        fd.append("ref", ref);
        fd.append("currentvalue", currentvalue);
        fd.append("column", column);
        fd.append("table", table);
        fd.append("value", value);
        fd.append("refname", refname);
        $.ajax({
            url: "services/ticketservice.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                alert("Ticket has been created.");
            }
        });

    }

}

function submitPaymentForm() {
    var soaid = document.getElementById("soaid").value;
    var amount = document.getElementById("paymentAmount").value;
    var date = document.getElementById("paymentDate").value;
    var paymentTypeOption = document.getElementById("paymentType");
    var paymentType = paymentTypeOption.value;


    var fd = new FormData();
    fd.append("soaid", soaid);
    fd.append("date", date);
    fd.append("amount", amount);
    fd.append("paymentType", paymentType);
    $.ajax({
        url: "services/addPaymentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "success") {
                $('#paymentModal').modal('hide');
                document.getElementById("paymentForm").reset();
                toastSuccess("Payment Added.");
                loadPayment();
            } else {
                toastError("An Error occured: " + result);
            }
        }
    });
}