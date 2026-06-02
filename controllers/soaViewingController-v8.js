
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
            // loadPayment();
        }
    });

}





function showPaymentModal(tsubid, hmo, balance) {
    if (balance > 0) {
        $('#remainingBalance').val(balance);
        $('#paymenttsubid').val(tsubid);
        $('#paymentModal').modal('show');
    } else {
        toastError("No remaining balance to pay.");
    }

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
            // if (result == "true") {
            openSignatureModal(function (sigData) {
                setSignature('patient', sigData);
            });
            // } else if (result == "false") {
            //     toastError("This is already signed by the patient.");

            // } else {

            // }
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
    var remainingBalance = parseFloat(document.getElementById("remainingBalance").value);
    var amount = parseFloat(document.getElementById("paymentAmount").value);

    if (amount <= remainingBalance) {
        $('#paymentModal').modal('hide');

        var soaid = document.getElementById("soaid").value;

        var date = document.getElementById("paymentDate").value;
        var tsubid = document.getElementById("paymenttsubid").value;
        var paymentTypeOption = document.getElementById("paymentType");

        var paymentType = paymentTypeOption.value;


        var fd = new FormData();
        fd.append("tsubid", tsubid);
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

                    document.getElementById("paymentForm").reset();
                    loadSoa();
                    toastSuccess("Payment Added.");
                    // toastReload("successToast", "Payment Added.");

                } else {
                    toastError("An Error occured: " + result);
                }
            }
        });

    } else {
        toastError("Payment amount cannot be greater than the remaining balance.");
    }


}

function deletePayment(ref, amount) {
    var usertype = document.getElementById("usertypeTopbar").value;

    if (usertype == 0 || usertype == 100) {
        if (confirm("Do you want to delete this payment amounting to " + amount + "?")) {
            var fd = new FormData();
            fd.append("ref", ref);
            $.ajax({
                url: "services/paymentDeletionService.php",
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (result) {
                    if (result == 'Success') {

                        toastSuccess("Payment Deleted.");
                        loadSoa();
                    } else {
                        toastError("An Error occured: " + result);
                    }
                }
            });
        }
    } else {
        toastError("You do not have permission to delete payment.");
    }

}