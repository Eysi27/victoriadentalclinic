
function backup() {
    toastSuccess("Backup started successfully. Please wait for the process to complete.");
    var fd = new FormData();
    $.ajax({
        url: "services/backupService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {

            toastSuccessDownload(result);
        }
    });

}

function toastSuccess(message) {
    let toastElement = $("#successToast");
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 3000 }).toast("show");
}

function toastSuccessDownload(message) {
    let toastElement = $("#successToast");
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 5000 }).toast("show");
}