getclientdata();
function getclientdata() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/clientSoaListService.php",
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
        },

        error: function (xhr, status, error) {
            console.error("Error occurred: " + status + " - " + error);
            console.error(xhr.responseText);  // To see the error response from the server
        }
    });
    document.getElementById("content-table").style.zoom = "60%";
}

function updateSoa() {

    var soaid = document.getElementById("edit-soaid").value;
    var date = document.getElementById("edit-date").value;
    var time = document.getElementById("edit-time").value;
    var dentist = document.getElementById("edit-dentist").value;

    var fd = new FormData();
    fd.append("soaid", soaid);
    fd.append("date", date);
    fd.append("time", time);
    fd.append("dentist", dentist);
    $.ajax({
        url: "services/updatesoadetails.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            toastReload("successToast", "SOA Updated Successfully");
        },

        error: function (xhr, status, error) {
            toastError("Error occurred: " + status + " - " + error);
        }
    });
    document.getElementById("content-table").style.zoom = "60%";
}

function search() {
    document.getElementById("currentPage").value = 1;
    getclientdata();
}

function setPage(page) {
    document.getElementById("currentPage").value = page;
    getclientdata();

}


function getPagination() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;

    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/clientSoaListPaginationService.php",
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

$(document).on('click', '.edit-btn', function () {
    $('#edit-soaid').val($(this).data('soaid'));
    $('#edit-dentist').val($(this).data('dentist'));
    $('#edit-date').val($(this).data('date'));
    $('#edit-time').val($(this).data('time'));

});