loadTreatment();
function loadTreatment() {
    var fd = new FormData();
    $.ajax({
        url: "services/OptionloadTreatmentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("treatment-options").innerHTML = result;
        }
    });

}

function add() {
    var e = document.getElementById("treatment");
    var treatment = e.value;
    var remarks = document.getElementById("remarks").value;
    var details = document.getElementById("details").value;
    var diagnosis = document.getElementById("diagnosis").value;
    var price = document.getElementById("price").value || 0;
    var hmo = "";
    var isHmo = document.getElementById("hmoCovered").checked;

    if (isHmo) {
        hmo = document.getElementById("hmo").value;
    }

    var detailsForDisplay = details.replace(/\n/g, "<br>");
    var remarksForDisplay = remarks.replace(/\n/g, "<br>");
    var diagnosisForDisplay = diagnosis.replace(/\n/g, "<br>");

    document.getElementById("treatmentList").innerHTML += `
        <tr>
            <td>${treatment}</td>
            <td>${diagnosisForDisplay}</td>
            <td>${detailsForDisplay}</td>
            <td>${remarksForDisplay}</td>
            <td>${price}</td>
            <td>${hmo}</td>
            <td>
                <button class="btn btn-success btn-circle btn-sm"
                    onclick="editTreatment(this)"
                    data-treatment="${encodeURIComponent(treatment)}"
                    data-diagnosis="${encodeURIComponent(diagnosis)}"
                    data-details="${encodeURIComponent(details)}"
                    data-remarks="${encodeURIComponent(remarks)}"
                    data-hmo="${encodeURIComponent(hmo)}"
                    data-price="${encodeURIComponent(price)}"
                    title="Edit treatment">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-circle btn-sm"
                    onclick="deleteTreatment(this)" title="Delete treatment">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>
    `;

    computeTotal();

    // Reset form
    document.getElementById("remarks").value = "";
    document.getElementById("details").value = "";
    document.getElementById("diagnosis").value = "";
    document.getElementById("price").value = 0;
}


function editTreatment(button) {
    var treatment = decodeURIComponent(button.getAttribute("data-treatment"));
    var diagnosis = decodeURIComponent(button.getAttribute("data-diagnosis"));
    var details = decodeURIComponent(button.getAttribute("data-details"));
    var remarks = decodeURIComponent(button.getAttribute("data-remarks"));
    var price = decodeURIComponent(button.getAttribute("data-price"));
    var hmo = decodeURIComponent(button.getAttribute("data-hmo"));

    if (hmo != "") {
        document.getElementById("hmoCovered").checked = true;

    } else {
        document.getElementById("hmoCovered").checked = false;

    }

    document.getElementById("treatment").value = treatment;
    document.getElementById("remarks").value = remarks;
    document.getElementById("details").value = details;
    document.getElementById("diagnosis").value = diagnosis;
    document.getElementById("price").value = price;

    $(button).closest('tr').remove();

    var table = document.getElementById("treatmentList");
    var rowCount = table.rows.length;
    if (rowCount == 1) {
        table.deleteRow(0);
    }

    recomputeTotal();
}
function deleteTreatment(o) {

    $(o).closest('tr').remove();

    var table = document.getElementById("treatmentList");
    var rowCount = table.rows.length;
    if (rowCount == 1) {
        table.deleteRow(0);
    }
    recomputeTotal();
}

function computeTotal() {

    var table = document.getElementById("treatmentList");
    var rowCount = table.rows.length;
    if (rowCount > 1) {
        table.deleteRow(rowCount - 2);
    }

    var total = 0;
    for (let i in table.rows) {
        let row = table.rows[i]
        for (let j in row.cells) {
            if (j == 4) {
                let col = row.cells[j]
                total += parseFloat(col.innerHTML);
            }

        }
    }
    document.getElementById("treatmentList").innerHTML += "<td colspan=\"4\">Total</td><td>" + total + "</td><td></td></tr>";


}
function recomputeTotal() {

    var table = document.getElementById("treatmentList");
    var rowCount = table.rows.length;
    if (rowCount > 1) {
        table.deleteRow(rowCount - 1);

    }

    var total = 0;
    for (let i in table.rows) {
        let row = table.rows[i]
        for (let j in row.cells) {
            if (j == 4) {
                let col = row.cells[j]
                total += parseFloat(col.innerHTML);
            }

        }
    }
    document.getElementById("treatmentList").innerHTML += "<td colspan=\"4\">Total</td><td>" + total + "</td><td></td></tr>";


}


function submit() {
    var table = document.getElementById("treatmentList");

    var rowCount = table.rows.length;
    var total = 0;
    var consentRequired = false;
    for (let i in table.rows) {
        let row = table.rows[i]
        let treatmentName = "";
        // Make sure the row and its first cell exist
        try {
            treatmentName = row.cells[0].innerText.trim().toLowerCase();
        } catch (error) {

        }


        // Compare against ortho treatment list (case-insensitive)
        if (treatmentName.includes("orthodontics")) {
            consentRequired = true;
        }




        if (i == rowCount - 1) {
            for (let j in row.cells) {
                if (j == 1) {
                    let col = row.cells[j]
                    total = parseFloat(col.innerHTML);
                }
            }
        }


    }


    var e = document.getElementById("dentist");
    var dentist = e.value;
    var dates = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var clientid = document.getElementById("clientid").value;
    var hmo = document.getElementById("hmo").value;

    if (rowCount == 0) {
        toastError("You do not have any treatment added.");
    } else if (dentist == "" || dates == "" || time == "") {
        toastError("All Field is required.");

    } else {
        if (consentRequired) {
            var consentExist = false;
            var fd = new FormData();
            fd.append('clientId', clientid);
            $.ajax({
                url: "services/orthowaiverChecker.php",
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (result) {
                    consentExist = result;

                    if (consentExist == 'true') {
                        submitform(dentist, dates, time, clientid, total, hmo);
                    } else {
                        toastError("You need to submit waiver form for Orthodontic Treatment first before submitting E-SOA.");
                    }
                }
            });



        } else {
            submitform(dentist, dates, time, clientid, total, hmo);
        }



    }



}

function submitform(dentist, dates, time, clientid, total, hmo) {

    var agreement = document.getElementById("agreement").value;

    var confirmation = confirm('Are you sure you want to submit this form?');
    if (confirmation) {
        var fd = new FormData();
        fd.append('dentist', dentist);
        fd.append('date', dates);
        fd.append('time', time);
        fd.append('clientid', clientid);
        fd.append('total', total);
        fd.append('hmo', hmo);
        fd.append('agreement', agreement);

        $.ajax({
            url: "services/esoaSubmitService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {

                if (parseInt(result) > 0) {
                    submitSubSoa(result);
                } else {
                    toastError(result);
                }

            }
        });
    }
}
function submitSubSoa(soaid) {
    var table = document.getElementById("treatmentList");
    var rowCount = table.rows.length;
    var clientid = document.getElementById("clientid").value;
    var total = 0;
    for (let i in table.rows) {
        let row = table.rows[i]
        if (i < rowCount - 1) {
            var treatment = row.cells[0].innerHTML;
            var diagnosis = row.cells[1].innerHTML;
            var details = row.cells[2].innerHTML;
            var remarks = row.cells[3].innerHTML;
            var price = parseFloat(row.cells[4].innerHTML);
            var hmo = row.cells[5].innerHTML;

            if (treatment) {
                submitSubSoatoService(treatment, diagnosis, details, remarks, price, clientid, soaid, hmo);
            }



        }


    }
    toastRedirect("successToast", "E-SOA successfully submitted", "soaViewing.php?soaid=" + soaid);


}

function submitSubSoatoService(treatment, diagnosis, details, remarks, price, clientid, soaid, hmo) {


    var fd = new FormData();
    fd.append('treatment', treatment);
    fd.append('diagnosis', diagnosis);
    fd.append('details', details);
    fd.append('remarks', remarks);
    fd.append('price', price);
    fd.append('clientid', clientid);
    fd.append('soaid', soaid);
    fd.append('hmo', hmo);
    $.ajax({
        url: "services/esoaSubmitSubService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            console.log(result);
        }
    });



}
function reloadPage() {
    location.reload();
}


