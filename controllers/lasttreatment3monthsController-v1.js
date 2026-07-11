changeDateToday("asOf");
getclientdata();

function getclientdata() {
    var group = document.getElementById("group").value;
    var asOf = document.getElementById("asOf").value;
    document.getElementById("h3id").innerHTML = "As of: " + asOf;
    $("#loading").fadeIn();
    var fd = new FormData();
    fd.append("asOf", asOf);
    fd.append("group", group);
    $.ajax({
        url: "services/lasttreatment3monthsService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("responseBody").innerHTML = result;
        },
        complete: function () {
            $("#loading").fadeOut();
        }
    });
    document.getElementById("content-table").style.zoom = "60%";
}

function notifyPatients() {
    var rows = document.querySelectorAll('#responseBody table tbody tr');
    if (rows.length === 0) {
        toastError('No patients available to notify. Please load the report first.');
        return;
    }

    $('#notifyConfirmModal').modal('show');
}

function confirmNotifyPatients() {
    $('#notifyConfirmModal').modal('hide');

    var rows = document.querySelectorAll('#responseBody table tbody tr');
    var emailsSent = 0;
    var emailsSkipped = 0;
    var pending = 0;
    var completed = 0;
    var rowsToProcess = [];

    rows.forEach(function (row) {
        var emailCell = row.cells[2];
        var nameCell = row.cells[1];
        var mobileCell = row.cells[3];
        var statusCell = row.querySelector('.notify-status');
        if (!emailCell || !nameCell || !statusCell) {
            emailsSkipped++;
            if (statusCell) {
                statusCell.textContent = 'Skipped';
            }
            return;
        }

        var email = emailCell.textContent.trim();
        var fullName = nameCell.textContent.trim();
        var mobileNumber = mobileCell ? mobileCell.textContent.trim().replace(/[^0-9]/g, '') : '';
        if (!email && !mobileNumber) {
            emailsSkipped++;
            statusCell.textContent = 'Skipped';
            return;
        }

        rowsToProcess.push({
            row: row,
            statusCell: statusCell,
            email: email,
            mobileNumber: mobileNumber,
            fullName: fullName
        });
    });

    if (rowsToProcess.length === 0) {
        toastError('No valid email addresses or mobile numbers found to notify.');
        return;
    }

    var subject = 'Time for your dental cleaning';
    var messageTemplate = 'We noticed your last Oral Prophylaxis cleaning was over 5 months ago. ' +
        'Please schedule a revisit for a cleaning at Victoria Advanced Dental Care.\n\n' +
        'Thank you,\nVictoria Advanced Dental Care';

    function finalizeRow(item, result) {
        if (item.finalized) {
            return;
        }

        item.emailDone = item.emailDone || !item.email;
        item.smsDone = item.smsDone || !item.mobileNumber;

        if (!item.emailDone || !item.smsDone) {
            return;
        }

        item.finalized = true;
        completed++;

        var emailSuccess = result && result.email;
        var smsSuccess = result && result.sms;
        if (emailSuccess && smsSuccess) {
            emailsSent++;
            item.statusCell.textContent = 'Notified [email,sms]';
        } else if (emailSuccess) {
            emailsSent++;
            item.statusCell.textContent = 'Notified [email]';
        } else if (smsSuccess) {
            emailsSent++;
            item.statusCell.textContent = 'Notified [sms]';
        } else {
            emailsSkipped++;
            item.statusCell.textContent = 'Skipped';
        }

        if (completed === pending) {
            toastSuccess('Notification process complete.<br> Sent: ' + emailsSent + ',<br>skipped: ' + emailsSkipped + '.');
        }
    }

    function processSmsBatches() {
        var batchSize = 100;
        for (var i = 0; i < rowsToProcess.length; i += batchSize) {
            var batch = rowsToProcess.slice(i, i + batchSize).filter(function (item) {
                return item.mobileNumber;
            });
            if (batch.length === 0) {
                continue;
            }

            var mobileNumbers = batch.map(function (item) {
                return item.mobileNumber;
            }).join(',');

            sendNotificationEmail('', subject, '', '', mobileNumbers, function (result) {
                batch.forEach(function (item) {
                    item.smsDone = true;
                    item.smsSuccess = !!(result && result.sms);
                    finalizeRow(item, { email: item.emailSuccess, sms: item.smsSuccess });
                });
            });
        }
    }

    rowsToProcess.forEach(function (item) {
        item.statusCell.textContent = 'Processing...';
        item.emailDone = false;
        item.smsDone = false;
        item.finalized = false;
        item.emailSuccess = false;
        item.smsSuccess = false;
        pending++;

        var greetings = item.fullName || 'Patient';
        var msg = 'Dear ' + greetings + ',\n\n' +
            messageTemplate;

        if (item.email) {
            sendNotificationEmail(item.email, subject, greetings, msg, '', function (result) {
                item.emailDone = true;
                item.emailSuccess = !!(result && result.email);
                finalizeRow(item, { email: item.emailSuccess, sms: item.smsSuccess });
            });
        } else {
            item.emailDone = true;
            item.emailSuccess = false;
            finalizeRow(item, { email: false, sms: item.smsSuccess });
        }
    });

    processSmsBatches();

    if (pending === 0) {
        toastError('No valid email addresses found to notify.');
    }
}

function sendNotificationEmail(to, subject, greetings, msg, mobileNumbers, callback) {
    var fd = new FormData();
    fd.append('to', to);
    fd.append('subject', subject);
    fd.append('greetings', greetings);
    fd.append('msg', msg);
    fd.append('mobileNumbers', mobileNumbers || '');

    $.ajax({
        url: 'services/mailerService.php',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            callback(response || { email: false, sms: false });
        },
        error: function () {
            callback({ email: false, sms: false });
        }
    });
}
