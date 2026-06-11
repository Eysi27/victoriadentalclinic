function showToast(toastType, message) {

    let toastElement = $("#" + toastType);
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 3000 }).toast("show");
}

function showToastTime(toastType, message, time) {

    let toastElement = $("#" + toastType);
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: time * 1000 }).toast("show");
}

function toastRedirect(toastType, message, redirect) {
    showToast(toastType, message);
    setTimeout(function () {
        window.location.href = redirect;
    }, 2000);
}

function toastReload(toastType, message) {
    showToast(toastType, message);
    setTimeout(function () {
        location.reload();
    }, 2000);
}

function toastError(message) {
    let toastElement = $("#errorToast");
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 3000 }).toast("show");
}

function toastSuccess(message) {
    let toastElement = $("#successToast");
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 3000 }).toast("show");
}