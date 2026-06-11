getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    $.ajax({
        url: "services/hmoListService.php",
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

function deletehmo(id) {


    var confirmation = confirm('Are you sure you want to delete this record?');
    if (confirmation) {
        var fd = new FormData();
        fd.append('id', id);
        $.ajax({
            url: "services/hmoDeletionService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                result = result.trim();
                if (result == "success") {
                    toastReload("successToast", "Record was successfully deleted.");

                } else {
                    showToast("errorToast", result);
                }
            }
        });

    }



}