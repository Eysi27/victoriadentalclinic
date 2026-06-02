function showToast(toastType, message) {

    let toastElement = $("#" + toastType);
    toastElement.find(".toast-body").html(message);
    toastElement.toast({ delay: 3000 }).toast("show");
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

function changeDate(inputId) {
    const dateInput = document.getElementById(inputId);

    // Get today's date
    const today = new Date();

    // First day of the current month
    const year = today.getFullYear();
    const month = today.getMonth() + 1; // months are 0-indexed
    const day = 1;

    // Pad month and day with leading zeros
    const formatted = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

    // Set the value of the input
    dateInput.value = formatted;
}

function changeDateToday(inputId) {
    const dateInput = document.getElementById(inputId);

    // Get today's date
    const today = new Date();

    // Extract year, month, and day
    const year = today.getFullYear();
    const month = today.getMonth() + 1; // months are 0-indexed
    const day = today.getDate(); // this gets the current day

    // Pad month and day with leading zeros
    const formatted = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

    // Set the value of the input
    dateInput.value = formatted;
}

function getMonthName(month) {
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const monthName = monthNames[month - 1];
    return monthName;
}


