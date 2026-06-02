getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/hmoListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            // $('#dataTable').DataTable().destroy();
            // $('#dataTable').find('tbody').append(result);
            // $('#dataTable').DataTable().draw();
            document.getElementById("resultResponseBody").innerHTML = result;
            getPagination();
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}

function setPage(page) {
    document.getElementById("currentPage").value = page;
    getclientdata();

}
function search() {
    document.getElementById("currentPage").value = 1;
    getclientdata();
}


function getPagination() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;

    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/hmoListPaginationService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            // $('#sortableTable').DataTable().destroy();
            // $('#sortableTable').find('tbody').append(result);
            // $('#sortableTable').DataTable().draw();
            document.getElementById("pagination").innerHTML = result;

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