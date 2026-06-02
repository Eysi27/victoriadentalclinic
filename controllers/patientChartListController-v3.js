getclientdata();
getPatientCards();
getclientdentalChart();
function getclientdata() {
    var id = document.getElementById("clientid").value;

    //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    fd.append('id', id);
    $.ajax({
        url: "services/patientChartListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').empty().append(result);
            $('#dataTable').DataTable().draw();

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}

function getclientdentalChart() {
    var id = document.getElementById("clientid").value;
    var fd = new FormData();
    fd.append('id', id);
    $.ajax({
        url: "services/patientDentalChartService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("dental-chart-region").innerHTML = result;

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}


function getPatientCards() {
    var id = document.getElementById("clientid").value;

    //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    fd.append('id', id);
    $.ajax({
        url: "services/patientChartCardService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("patientCards").innerHTML = result;

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}

$(document).on('click', '.edit-btn', function () {
    $('#edit-soaid').val($(this).data('soaid'));
    $('#edit-tsubid').val($(this).data('tsubid'));
    $('#edit-date').val($(this).data('date'));
    $('#edit-dentist').val($(this).data('dentist'));
    $('#edit-treatment').val($(this).data('treatment'));
    $('#edit-diagnosis').val($(this).data('diagnosis').replace(/<br\s*\/?>/gi, '\n'));
    $('#edit-remarks').val($(this).data('remarks'));
    $('#edit-details').val($(this).data('details').replace(/<br\s*\/?>/gi, '\n'));
    $('#edit-hmo').val($(this).data('hmo'));
    $('#edit-price').val($(this).data('price'));
});

function deleteTreatment(soaid, tsubid) {

    if (confirm("Do you want  delete this treatment? Note: All payments related to this treatment will also be deleted.")) {
        var fd = new FormData();
        fd.append('soaid', soaid);
        fd.append('tsubid', tsubid);

        $.ajax({
            url: "services/deleteTreatmentPatientChartService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {

                getclientdata(); // Refresh the data table after update
                getPatientCards(); // Refresh the patient cards after update    
                // Optionally refresh data or show a success toast
                toastReload("successToast", 'Treatment deleted successfully!');
            },
            error: function () {
                toastError('Failed to delete treatment.');
            }

        });
    }


}

function updateTreatment() {

    var soaid = document.getElementById('edit-soaid').value;
    var tsubid = document.getElementById('edit-tsubid').value;
    var treatment = document.getElementById('edit-treatment').value;
    var diagnosis = document.getElementById('edit-diagnosis').value.replace(/\n/g, '<br>');;
    var remarks = document.getElementById('edit-remarks').value;
    var details = document.getElementById('edit-details').value.replace(/\n/g, '<br>');;
    var price = document.getElementById('edit-price').value;
    var hmo = document.getElementById('edit-hmo').value;
    var fd = new FormData();
    fd.append('soaid', soaid);
    fd.append('tsubid', tsubid);
    fd.append('treatment', treatment);
    fd.append('diagnosis', diagnosis);
    fd.append('remarks', remarks);
    fd.append('details', details);
    fd.append('price', price);
    fd.append('hmo', hmo);
    $.ajax({
        url: "services/updateTreatmentPatientChartService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            // Assuming the modal ID is #editModal
            $('#editModal').modal('hide');
            getclientdata(); // Refresh the data table after update
            getPatientCards(); // Refresh the patient cards after update    
            // Optionally refresh data or show a success toast
            toastReload('successToast', 'Treatment updated successfully!');
        },
        error: function () {
            toastError('Failed to update treatment.');
        }

    });

}