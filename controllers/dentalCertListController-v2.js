getdentalcertlistdata();
populateProfileList();
populateMedicineList();
function getdentalcertlistdata() {

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
   getdentalcertlistdata();

}

function search() {
    document.getElementById("currentPage").value = 1;
   getdentalcertlistdata();
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
    loadTreatment();



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

//get profile from database
function populateProfileList() {


    var fd = new FormData();
    $.ajax({
        url: "services/ProfileListOptionService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            document.getElementById("modal-name").innerHTML = result;
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}
//get profile details from database after mag select
function getProfileDetails(fullname) {
    if (fullname === "") {
        document.getElementById("modal-age").value = "";
        document.getElementById("modal-gender").value = "";
        document.getElementById("modal-address").value = "";
        return;
    }

    var fd = new FormData();
    fd.append("fullname", fullname);

    $.ajax({
        url: "services/GetProfileDetailsService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            try {
                var data = JSON.parse(result);
                document.getElementById("modal-age").value = data.age;
                document.getElementById("modal-gender").value = data.gender;
                document.getElementById("modal-address").value = data.address;
            } catch (e) {
                console.error("Invalid JSON:", result);
            }
        }
    });
}


function submitCart() {
    const rxid = document.getElementById("modal-rxid").value;
    const date = document.getElementById("modal-date").value;
    const name = document.getElementById("modal-name").value;
    const age = document.getElementById("modal-age").value;
    const gender = document.getElementById("modal-gender").value;
    const address = document.getElementById("modal-address").value;
    const dentist = document.getElementById("modal-dentist").value;
    const license = document.getElementById("modal-license").value;
    const diagnosis = document.getElementById("modal-diagnosis").value;

    // 🔹 Collect all treatments from the table
    const treatmentRows = document.querySelectorAll("#medicine-table tbody tr");
    const treatments = [];
    

    treatmentRows.forEach(row => {
        const treatment = row.cells[0].innerText.trim();
        const tooth = row.cells[1].innerText.trim();       // tooth number
        if (treatment) {
            const treatmentEntry = tooth ? `${treatment} -Tooth#: ${tooth}` : treatment;
            treatments.push(treatmentEntry);
        }
    });
    // Convert array → single string separated by newline
const treatmentString = treatments.join("\n");
    if (treatments.length === 0) {
        toastError("Please add at least one treatment.");
        return;
    }

    const fd = new FormData();
    fd.append('rxid', rxid);
    fd.append('date', date);
    fd.append('name', name);
    fd.append('age', age);
    fd.append('gender', gender);
    fd.append('address', address);
    fd.append('dentist', dentist);
    fd.append('license', license);
    fd.append('diagnosis', diagnosis);
fd.append('treatment', treatmentString);


    $.ajax({
        url: "services/upsertdentalcertService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result.trim() === "success") {
                if (rxid !== "") {
                    toastSuccess("Dental Certificate Updated Successfully");
                } else {
                    toastSuccess("Dental Certificate Added Successfully");
                }
                $('#editExpenseModal').modal('hide');
                getdentalcertlistdata();
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
    // logThis("Dental Certificate - Delete", fd, result); // remove this line
    if (result == "success") {
        toastSuccess("Dental Certificate Deleted Successfully");
    } else {
        toastError(result);
    }
    $('#deleteExpenseModal').modal('hide');
    getdentalcertlistdata();

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}

$('#deleteExpenseModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal

    $('#modal-prescriptionid').val(button.data('id'));

});

function AddMed() {
    const rxid = document.getElementById("modal-rxid").value;
    const medicineSelect = document.getElementById("modal-treatment");
    const medicineId = medicineSelect.value;
    const toothNumberInput = document.getElementById("modal-toothnumber");

    if (!medicineId) {
    toastError("Please select Treatment to add");
    return;
}

const selectedOption = medicineSelect.options[medicineSelect.selectedIndex];
const medicineid = selectedOption.value;
const description = selectedOption.getAttribute("data-desc");


const combinedText = description;

const tableBody = document.getElementById("medicine-table").getElementsByTagName("tbody")[0];
const row = tableBody.insertRow();

// Hidden rxid
const cellRxid = row.insertCell(0);
// cellRxid.style.display = "none";
cellRxid.innerText = medicineId;

//Tooth number cell
const cellTooth = row.insertCell(1);
cellTooth.innerText = toothNumberInput.value || ""; // display tooth number if provided


// Action cell with Delete button
const cellAction = row.insertCell(2);
const deleteBtn = document.createElement("button");
deleteBtn.className = "btn btn-danger btn-sm";
deleteBtn.innerText = "Delete";
deleteBtn.onclick = function () {
    row.remove();
};
cellAction.appendChild(deleteBtn);

medicineSelect.selectedIndex = 0; // reset select
}

function populateMedicineList() {


    var fd = new FormData();
    $.ajax({
        url: "services/treatmentListOptionService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            document.getElementById("modal-treatment").innerHTML = result;
        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}



function loadTreatment() {
    var rxid = document.getElementById("modal-rxid").value;

    var fd = new FormData();
    fd.append("rxid", rxid);

    $.ajax({
        url: "services/dentalcertTreatmentSelectListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            document.getElementById("prescriptionsubList").innerHTML = result;

        }

    });
    document.getElementById("content-table").style.zoom = "60%";
}