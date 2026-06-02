getclientdata();
function getclientdata() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;
    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/dentalcertlistService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            document.getElementById("resultResponseBody").innerHTML = result;
            getclientdataPagination();
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}


function deleteRow(button) {
    const row = button.closest("tr");
    if (row) {
        row.remove();
    }
}




function setPage(page) {
    document.getElementById("currentPage").value = page;
    getclientdata();

}

function search() {
    document.getElementById("currentPage").value = 1;
    getclientdata();
}

$('#editExpenseModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal

    $('#modal-rxid').val(button.data('rxid'));
    $('#modal-date').val(button.data('date'));
    $('#modal-name').val(button.data('name'));
    $('#modal-age').val(button.data('age'));
    $('#modal-gender').val(button.data('gender'));
    $('#modal-address').val(button.data('address'));
    $('#modal-dentist').val(button.data('dentist'));
    $('#modal-license').val(button.data('license'));
    $('#modal-treatment').val(button.data('treatment'));
    $('#modal-diagnosis').val(button.data('diagnosis'));




});




function getclientdataPagination() {

    var search = document.getElementById("tableSearch").value;
    var page = document.getElementById("currentPage").value;

    var fd = new FormData();
    fd.append("search", search);
    fd.append("page", page);
    $.ajax({
        url: "services/dentalcertListpaginationService.php",
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


function submitCart() {

    // Get form values
    const rxid = document.getElementById("modal-rxid").value;
    const date = document.getElementById("modal-date").value;
    const name = document.getElementById("modal-name").value;
    const age = document.getElementById("modal-age").value;
    const gender = document.getElementById("modal-gender").value;
    const address = document.getElementById("modal-address").value;
    const dentist = document.getElementById("modal-dentist").value;
    const license = document.getElementById("modal-license").value;
    const treatment = document.getElementById("modal-treatment").value;
    const diagnosis = document.getElementById("modal-diagnosis").value;



    var fd = new FormData();
    fd.append('rxid', rxid);
    fd.append('date', date);
    fd.append('name', name);
    fd.append('age', age);
    fd.append('gender', gender);
    fd.append('address', address);
    fd.append('dentist', dentist);
    fd.append('license', license);
    fd.append('treatment', treatment);
    fd.append('diagnosis', diagnosis);



    $.ajax({
        url: "services/upsertdentalcertService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "success") {
                if (rxid != "") {
                    toastSuccess("Dental Certificate Updated Successfully");
                } else {
                    toastSuccess("Dental Certificate Added Successfully");
                }
                $('#editExpenseModal').modal('hide');
                getclientdata();
            } else {
                console.log(result);
                toastError(result);
            }


        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}


function deleteCart() {


    var fd = new FormData();
    const id = document.getElementById("modal-prescriptionid").value;
    fd.append('id', id);


    $.ajax({
        url: "services/deletedentalcertService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "success") {

                toastSuccess("Dental Certificate Deleted Successfully");


            } else {

                toastError(result);

            }

            $('#deleteExpenseModal').modal('hide');
            getclientdata();
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}

$('#deleteExpenseModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal

    $('#modal-prescriptionid').val(button.data('id'));

});




