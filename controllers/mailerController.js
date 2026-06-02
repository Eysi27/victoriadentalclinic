function sendMail(to, subject, greetings, msg) {
    var fd = new FormData();
    fd.append('to', to);
    fd.append('subject', subject);
    fd.append('greetings', greetings);
    fd.append('msg', msg);
    $.ajax({
        url: "services/mailerService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            console.log("notification sent");
        }
    });
}