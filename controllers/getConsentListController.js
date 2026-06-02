getclientdata();
function getclientdata() {
    //  document.getElementById("content-table").style.zoom = "70%";
    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/consentListService.php",
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


function getPagination() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;

    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/consentListPaginationService.php",
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