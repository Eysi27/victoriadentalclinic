loadTreatment();
function loadTreatment() {
    var fd = new FormData();
    $.ajax({
        url: "services/OptionloadTreatmentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("treatment-options").innerHTML = result;
        }
    });

}
getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    $.ajax({
        url: "services/pendingAppointmentListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(result);
            $('#dataTable').DataTable().draw();

        }


    });
    document.getElementById("content-table").style.zoom = "60%";


}
function approve(clientid) {
    document.getElementById('approveClientId').value = clientid;
    document.getElementById('approveDateAssigned').value = new Date().toISOString().slice(0, 16);
    document.getElementById('approveDentist').value = '';
    document.getElementById('treatment').value = '';
    $('#approveModal').modal('show');
}

function submitApproval() {
    var clientid = document.getElementById('approveClientId').value;
    var approveDate = document.getElementById('approveDateAssigned').value;
    var dentist = document.getElementById('approveDentist').value;
    var treatment = document.getElementById('treatment').value;

    if (!approveDate) {
        alert('Please enter a date assigned.');
        return;
    }

    if (!dentist) {
        alert('Please select a dentist.');
        return;
    }

    var fd = new FormData();
    fd.append('clientid', clientid);
    fd.append('dateassigned', approveDate.replace('T', ' '));
    fd.append('dentist', dentist);
    fd.append('treatment', treatment);

    $.ajax({
        url: "services/pendingApproveDateUpdateService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#approveModal').modal('hide');
            location.reload();
        }
    });
}

$(document).ready(function () {
    $('#approveSubmitBtn').on('click', submitApproval);
});


function decline(clientid) {
    var x = confirm("Do you want to decline this Appointment?");
    if (x) {
        var fd = new FormData();
        fd.append('clientid', clientid);

        $.ajax({

            url: "services/pendingDeclineDateUpdateService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                location.reload();

            }


        });
    }


}



