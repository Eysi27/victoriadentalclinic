
// $("#bodyResult").load("esoaprint.php?soaid=" + soaid);


loadattachment();
function loadattachment() {
    var soaid = document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid", soaid)
    $.ajax({
        url: "services/loadAttachmentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("bodyResult").innerHTML = result;
        }
    });

}

function deletePhoto() {
    var id = document.getElementById("attachmentid").value;
    var fd = new FormData();
    fd.append("id", id)
    $.ajax({
        url: "services/deleteAttachmentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#photoModal').modal('hide');
            toastSuccess(result);
            loadattachment();
        }
    });

}


// function openPhotoModal(img, id) {
//     const modalImg = document.getElementById('modalImage');
//     document.getElementById("attachmentid").value = id;
//     modalImg.src = img.src;
//     $('#photoModal').modal('show');
// }

function openPhotoModal(imgElement, id) {
    var modalImage = document.getElementById('modalImage');
    modalImage.src = imgElement.src; // Set the modal image source to the clicked image's source
    modalImage.style.maxWidth = "none"; // Allow image to show at its natural size without constraining width
    modalImage.style.maxHeight = "none"; // Allow image to show at its natural size without constraining height
    document.getElementById("attachmentid").value = id;
    $('#photoModal').modal('show'); // Show the modal (using Bootstrap modal)
}


function capturePhoto() {

    var soaid = document.getElementById("soaid").value;
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const video = document.getElementById('video');
    // const photoPreview = document.getElementById('photoPreview');
    // const capturedInput = document.getElementById('capturedPhoto');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = canvas.toDataURL('image/png', 1);
    // photoPreview.src = imageData;
    // capturedInput.value = imageData;


    var fd = new FormData();
    fd.append("soaid", soaid);
    fd.append("attachment", imageData);
    $.ajax({
        url: "services/addAttachmentService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            console.log(result);
            toastSuccess(result);
            loadattachment();


        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response Text:", xhr.responseText);
            toastError("An error occurred while uploading the attachment." + error + xhr.responseText);
        }

    });
    toastSuccess("Processing...");
    closeCameraModal();

}