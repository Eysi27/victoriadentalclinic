getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    $.ajax({
        url: "services/medicineListService.php",
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

$('#editTreatmentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    $('#editTreatmentId').val(button.data('treatmentid'));
    $('#editGenericName').val(button.data('genericname'));
    $('#editDispense').val(button.data('dispense'));
    $('#editSignetur').val(button.data('signetur'));
});

function deleteMedicine(id) {
    var fd = new FormData();
    $('#editTreatmentModal').modal('hide');
    fd.append('medid', id);

    $.ajax({
        url: "services/deleteMedicineService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == 'success') {


                toastSuccess("Successfully Deleted.");

                toastReload('successToast', "Succesfully Deleted.");
            } else {
                toastError(result);
            }

        }

    });


}
function SaveMedicine() {
    var medid = document.getElementById("editTreatmentId").value;
    var genericname = document.getElementById("editGenericName").value;
    var dispense = document.getElementById("editDispense").value;
    var signetur = document.getElementById("editSignetur").value;
    var fd = new FormData();
    $('#editTreatmentModal').modal('hide');
    fd.append('medid', medid);
    fd.append('genericname', genericname);
    fd.append('dispense', dispense);
    fd.append('signetur', signetur);
    $.ajax({
        url: "services/upsertMedicineService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == 'success') {

                if (medid != '') {
                    toastReload('successToast', "Succesfully Updated.");
                } else {
                    toastReload('successToast', "Succesfully Added.");

                }
                // location.reload();
            } else {
                toastError(result);
            }

        }

    });

}