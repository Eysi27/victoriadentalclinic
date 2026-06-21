document.addEventListener('DOMContentLoaded', function () {
    // Automatically load report if the dentist list already has a selected value.
    if (document.getElementById('dentist').value !== '') {
        loadPayrollReport();
    }
});

function loadPayrollReport() {
    var dentist = document.getElementById('dentist').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;

    if (!dentist) {
        document.getElementById('responseBody').innerHTML = '<div class="alert alert-warning">Please select a dentist before loading the report.</div>';
        document.getElementById('payrollTotals').style.display = 'none';
        return;
    }

    var subtitle = 'Date Range: ' + (from || '-') + ' to ' + (to || '-') + ' | Dentist: ' + dentist;
    var subtitleEl = document.getElementById('reportSubtitle');
    if (subtitleEl) {
        subtitleEl.innerText = subtitle;
    }
    document.getElementById('payslipDentist').innerText = dentist;
    document.getElementById('payslipPeriod').innerText = (from || '-') + ' to ' + (to || '-');
    document.getElementById('payslipCommission').innerText = document.getElementById('commissionPercentage').value + '%';

    var fd = new FormData();
    fd.append('dentist', dentist);
    fd.append('from', from);
    fd.append('to', to);

    document.getElementById('loading').style.display = 'block';
    document.getElementById('responseBody').innerHTML = '';
    document.getElementById('payrollTotals').style.display = 'none';
    document.getElementById('totalReceived').innerText = '0.00';

    $.ajax({
        url: 'services/dentistPayrollReportService.php',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById('responseBody').innerHTML = result;
            attachPayrollListeners();
            updateDisbursements();
        },
        complete: function () {
            document.getElementById('loading').style.display = 'none';
        }
    });
}

function printPayroll() {
    window.print();
}

function attachPayrollListeners() {
    var container = document.getElementById('responseBody');
    if (!container) return;
    container.querySelectorAll('.commission-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateRowDisbursement(this);
            recalculateTotal();
        });
    });
    document.getElementById('payrollTotals').style.display = container.querySelectorAll('.commission-checkbox').length ? 'block' : 'none';
}

function updateDisbursements() {
    var percent = parseFloat(document.getElementById('commissionPercentage').value) || 0;
    var rows = document.querySelectorAll('#responseBody table tbody tr');
    rows.forEach(function (row) {
        var checkbox = row.querySelector('.commission-checkbox');
        if (!checkbox) return;
        var amount = parseFloat(row.dataset.amount) || 0;
        var disbursement = checkbox.checked ? amount * percent / 100 : amount;
        row.querySelector('.disbursement-amount').innerText = disbursement.toFixed(2);
    });
    recalculateTotal();
}

function updateRowDisbursement(checkbox) {
    var row = checkbox.closest('tr');
    if (!row) return;
    var percent = parseFloat(document.getElementById('commissionPercentage').value) || 0;
    var amount = parseFloat(row.dataset.amount) || 0;
    var disbursement = checkbox.checked ? amount * percent / 100 : amount;
    row.querySelector('.disbursement-amount').innerText = disbursement.toFixed(2);
}

function recalculateTotal() {
    var percent = parseFloat(document.getElementById('commissionPercentage').value) || 0;
    var adjustments = parseFloat(document.getElementById('adjustments').value) || 0;
    var deductions = parseFloat(document.getElementById('deductions').value) || 0;

    var total = 0;
    document.querySelectorAll('#responseBody table tbody tr').forEach(function (row) {
        var amount = parseFloat(row.dataset.amount) || 0;
        var checked = row.querySelector('.commission-checkbox').checked;
        var payout = checked ? amount * percent / 100 : amount;
        total += payout;
    });

    total = total + adjustments - deductions;
    if (total < 0) {
        total = 0;
    }
    document.getElementById('totalReceived').innerText = total.toFixed(2);
}
