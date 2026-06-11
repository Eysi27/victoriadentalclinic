const modal = document.getElementById('cameraModal');
const video = document.getElementById('video');
const photoPreview = document.getElementById('photoPreview');
const capturedInput = document.getElementById('capturedPhoto');
const canvas = document.getElementById('canvas');
let stream;

let currentFacingMode = "user"; // "user" for front, "environment" for back

let isMirrored = false;

function mirror() {
    isMirrored = !isMirrored;
    video.style.transform = isMirrored ? "scaleX(-1)" : "scaleX(1)";
}
function openCameraModal() {


    modal.style.display = 'flex';

    const constraints = {
        video: { facingMode: "user" },
        audio: false
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(s => {
            stream = s;
            video.srcObject = stream;
            video.play();

            // Flip video for front cam
            if (constraints.video.facingMode === "user") {
                video.style.transform = "scaleX(-1)";
            } else {
                video.style.transform = "scaleX(1)";
            }

            // canvas.height = video.offsetHeight;
            // canvas.width = video.offsetWidth;
        })
        .catch(err => {
            alert('Camera access denied or not supported on this browser.');
            console.error(err);
        });
}



function closeCameraModal() {
    modal.style.display = 'none';
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
}



function switchCamera() {
    // Stop current stream
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }

    // Toggle camera mode
    currentFacingMode = currentFacingMode === "user" ? "environment" : "user";

    // Restart with new camera
    startCamera(currentFacingMode);
}

function startCamera(facingMode) {
    navigator.mediaDevices.getUserMedia({
        video: { facingMode: facingMode },
        audio: false
    }).then(s => {
        stream = s;
        video.srcObject = stream;
        video.play();
    }).catch(err => {
        alert('Camera access denied or not supported on this browser.');
        console.error(err);
    });
}

let currentZoom = 1;
let initialDistance = 0;
let isDragging = false;
let initialX, initialY, offsetX = 0, offsetY = 0;
let zoomContainer = document.getElementById('zoomContainer');
let modalImage = document.getElementById('modalImage');

// Open the modal and set the image source
// function openPhotoModal(imgElement) {
//     modalImage.src = imgElement.src;
//     currentZoom = 1;
//     modalImage.style.transform = `scale(${currentZoom})`;
//     $('#photoModal').modal('show');
// }

// Zoom in/out based on the button click
function zoomImage(factor) {
    currentZoom *= factor;
    modalImage.style.transform = `scale(${currentZoom})`;
}

// Reset the zoom to default state
function resetZoom() {
    currentZoom = 1;
    modalImage.style.transform = `scale(1)`;
}

// Pinch to zoom (for touch devices)
zoomContainer.addEventListener('touchstart', (e) => {
    if (e.touches.length === 2) {
        // Detect the initial pinch distance
        initialDistance = getDistance(e.touches[0], e.touches[1]);
    }
}, { passive: true });

zoomContainer.addEventListener('touchmove', (e) => {
    if (e.touches.length === 2) {
        // Get the current distance between the two fingers
        let newDistance = getDistance(e.touches[0], e.touches[1]);
        let scaleFactor = newDistance / initialDistance;

        // Apply zoom based on the pinch movement
        currentZoom *= scaleFactor;
        modalImage.style.transform = `scale(${currentZoom})`;

        // Update the initial distance for the next movement
        initialDistance = newDistance;
    }
}, { passive: true });

// Calculate the distance between two touch points
function getDistance(touch1, touch2) {
    let dx = touch1.clientX - touch2.clientX;
    let dy = touch1.clientY - touch2.clientY;
    return Math.sqrt(dx * dx + dy * dy);
}

// Make the image draggable
modalImage.addEventListener('mousedown', startDrag);
modalImage.addEventListener('touchstart', startDrag);

function startDrag(e) {
    e.preventDefault();
    isDragging = true;

    // Get the initial mouse position
    if (e.type === "mousedown") {
        initialX = e.clientX - offsetX;
        initialY = e.clientY - offsetY;
        document.addEventListener('mousemove', dragImage);
        document.addEventListener('mouseup', stopDrag);
    } else if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - offsetX;
        initialY = e.touches[0].clientY - offsetY;
        document.addEventListener('touchmove', dragImage);
        document.addEventListener('touchend', stopDrag);
    }
}

function dragImage(e) {
    let x, y;
    if (e.type === "mousemove") {
        x = e.clientX - initialX;
        y = e.clientY - initialY;
    } else if (e.type === "touchmove") {
        x = e.touches[0].clientX - initialX;
        y = e.touches[0].clientY - initialY;
    }

    // Apply the offset
    modalImage.style.transform = `scale(${currentZoom}) translate(${x}px, ${y}px)`;
}

function stopDrag() {
    offsetX = parseInt(modalImage.style.transform.split('(')[1].split('px')[0]);
    offsetY = parseInt(modalImage.style.transform.split(',')[1].split('px')[0]);
    isDragging = false;

    // Remove event listeners
    document.removeEventListener('mousemove', dragImage);
    document.removeEventListener('mouseup', stopDrag);
    document.removeEventListener('touchmove', dragImage);
    document.removeEventListener('touchend', stopDrag);
}

