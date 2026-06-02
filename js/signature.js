const modalSignature = document.getElementById('signature-modal');
const canvasSignature = document.getElementById('signature-pad');
const ctx = canvasSignature.getContext('2d');
ctx.strokeStyle = "#222"; // Set stroke color (black-ish)
ctx.lineWidth = 3;
let signatureCallback = null;
let drawing = false;

// Mouse Events
canvasSignature.addEventListener('mousedown', startPosition);
canvasSignature.addEventListener('mousemove', draw);
canvasSignature.addEventListener('mouseup', endPosition);
canvasSignature.addEventListener('mouseout', endPosition);

// Touch Events
canvasSignature.addEventListener('touchstart', startPosition, { passive: false });
canvasSignature.addEventListener('touchmove', draw, { passive: false });
canvasSignature.addEventListener('touchend', endPosition);



function resizeCanvas() {
    const rect = canvasSignature.getBoundingClientRect();
    canvasSignature.width = rect.width;
    canvasSignature.height = rect.height;
    ctx.strokeStyle = "#222";
    ctx.lineWidth = 3;

}
function getXY(e) {
    const rect = canvasSignature.getBoundingClientRect();
    let clientX, clientY;

    if (e.touches && e.touches.length > 0) {
        clientX = e.touches[0].clientX;
        clientY = e.touches[0].clientY;
    } else if (e.changedTouches && e.changedTouches.length > 0) {
        clientX = e.changedTouches[0].clientX;
        clientY = e.changedTouches[0].clientY;
    } else {
        clientX = e.clientX;
        clientY = e.clientY;
    }

    return {
        x: clientX - rect.left,
        y: clientY - rect.top
    };
}

function startPosition(e) {
    e.preventDefault();
    drawing = true;
    const pos = getXY(e);
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function draw(e) {
    if (!drawing) return;
    e.preventDefault();
    const pos = getXY(e);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function endPosition(e) {
    if (drawing) {
        ctx.closePath();
    }
    drawing = false;
}


function clearPad() {
    ctx.clearRect(0, 0, canvasSignature.width, canvasSignature.height);
}

function openSignatureModal(callback) {
    signatureCallback = callback;
    clearPad();
    modalSignature.style.display = "flex";
    setTimeout(() => {
        resizeCanvas();

    }, 10);
}

function closeSignatureModal() {
    modalSignature.style.display = "none";
}

function confirmSignature() {
    const dataURL = canvasSignature.toDataURL('image/png');
    if (typeof signatureCallback === "function") {
        signatureCallback(dataURL);
    }
    closeSignatureModal();
}
function setSignature(role, sigData) {
    const box = document.getElementById(`${role}-signature-box`);
    const input = document.getElementById(`${role}-signature-input`);

    // Set hidden input
    input.value = sigData;
    input.dispatchEvent(new Event('change'));
    // Show image preview inside the div
    box.innerHTML = `<img src="${sigData}" alt="${role} signature" style="width: 100%; height: 100%; object-fit: contain;">`;

}
