getclientdata();
function getclientdata() {

    var fd = new FormData();
    $.ajax({
        url: "services/clientSoaListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(result);
            $('#dataTable').DataTable().draw();

        },

        error: function (xhr, status, error) {
            console.error("Error occurred: " + status + " - " + error);
            console.error(xhr.responseText);  // To see the error response from the server
        }
    });
    document.getElementById("content-table").style.zoom = "60%";
}
