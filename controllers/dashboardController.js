loadEarningsBar();
loadPatientsBar();
loadMonthlyEarningsBar();
loadMonthlyPatientsBar();
loadDashPatient();
loadDashEarnings();
loadDashAppointments();
loadDashPendings();
function loadEarningsBar() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadEarningsBarService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            var data = JSON.parse(result);


            chartBar("earningsbar", data.label, data.datas, 1000000, "Earnings: ");
            //you can uncomment this for checking
            //  document.getElementById("jsResult").innerHTML=result;
        }
    });

}

function loadMonthlyEarningsBar() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadMonthlyEarningsBarService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            var data = JSON.parse(result);


            chartBar("monthlyearningsbar", data.label, data.datas, 300000, "Earnings: ");
            //you can uncomment this for checking
            //  document.getElementById("jsResult").innerHTML=result;
        }
    });

}

function loadPatientsBar() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadPatientsBarService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            var data = JSON.parse(result);


            chartBar2("patientsbar", data.label, data.datas, 800, "Patients: ");
            //you can uncomment this for checking
            //  document.getElementById("jsResult").innerHTML=result;
        }
    });

}

function loadMonthlyPatientsBar() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadMonthlyPatientsBarService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            var data = JSON.parse(result);


            chartBar2("monthlypatientsbar", data.label, data.datas, 100, "Patients: ");
            //you can uncomment this for checking
            //  document.getElementById("jsResult").innerHTML=result;
        }
    });

}


function loadDashPatient() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadDashPatientService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("dashPatient").innerHTML = formatThis(result);
        }
    });

}
function loadDashEarnings() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadDashEarningsService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("dashEarnings").innerHTML = formatThis(result);
        }
    });

}

function loadDashAppointments() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadDashAppointmentsService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("dashhmoRecord").innerHTML = formatThis(result);
        }
    });

}
function loadDashPendings() {
    var fd = new FormData();
    $.ajax({
        url: "services/loadDashPendingsService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("dashConsent").innerHTML = formatThis(result);
        }
    });

}


function formatThis(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
