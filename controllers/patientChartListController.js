getclientdata();
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
            $('#dataTable').find('tbody').append(result);
            $('#dataTable').DataTable().draw();

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}
