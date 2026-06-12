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

    rows.forEach(function (row) {
        var emailCell = row.cells[2];
        var nameCell = row.cells[1];
        if (!emailCell || !nameCell) {
            emailsSkipped++;
            return;
        }

        var email = emailCell.textContent.trim();
        var fullName = nameCell.textContent.trim();
        if (!email) {
            emailsSkipped++;
            return;
        }

        var subject = 'Time for your dental cleaning';
        var greetings = fullName || 'Patient';
        var msg = 'Dear ' + greetings + ',\n\n' +
            'We noticed your last Oral Prophylaxis cleaning was over 3 months ago. ' +
            'Please schedule a revisit for a cleaning at Victoria Advanced Dental Care.\n\n' +
            'Thank you,\nVictoria Advanced Dental Care';

        pending++;
        sendNotificationEmail(email, subject, greetings, msg, function (success) {
            completed++;
            if (success) {
                emailsSent++;
            } else {
                emailsSkipped++;
            }
            if (completed === pending) {
                toastSuccess('Notification process complete.<br> Sent: ' + emailsSent + ',<br>skipped: ' + emailsSkipped + '.');
            }
        });
    });

    if (pending === 0) {
        toastError('No valid email addresses found to notify.');
    }
}

function sendNotificationEmail(to, subject, greetings, msg, callback) {
    var fd = new FormData();
    fd.append('to', to);
    fd.append('subject', subject);
    fd.append('greetings', greetings);
    fd.append('msg', msg);

    $.ajax({
        url: 'services/mailerService.php',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function () {
            callback(true);
        },
        error: function () {
            callback(false);
        }
    });
}
