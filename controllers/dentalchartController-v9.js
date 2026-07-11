let currentTooth = null;
let currentClientId = null;
let penColor = 'red';

document.querySelectorAll('input[name="penColor"]').forEach(input => {
    input.addEventListener('change', () => penColor = input.value);
});

document.body.addEventListener('click', function (e) {
    // Make sure it’s a .tooth img
    if (e.target && e.target.matches('.tooth img')) {
        const toothElement = e.target.closest('.tooth');
        currentTooth = toothElement.dataset.tooth;
        currentClientId = toothElement.dataset.clientid;
        currentRemarks = toothElement.dataset.remarks;
        document.getElementById("selected-tooth-region").textContent = currentTooth;
        document.getElementById("remarkSelect").value = currentRemarks;

        document.getElementById('toothImage').src = e.target.src;
        clearSVGRegions();
        // show selected tooth number beside the modal title
        const sel = document.getElementById('selected-tooth');
        if (sel) sel.textContent = ` ${currentTooth}`;

        const modal = new bootstrap.Modal(document.getElementById('drawingModal'));
        modal.show();
    }
});


function clearSVGRegions() {
    ["top", "bottom", "left", "right", "center"].forEach(id => {
        document.getElementById(id).setAttribute("fill", "transparent");
    });
}

["top", "bottom", "left", "right", "center"].forEach(id => {
    document.getElementById(id).addEventListener("click", () => {
        document.getElementById(id).setAttribute("fill", penColor);
    });
});

function saveRegion() {
    const svgWrapper = document.getElementById("svg-wrapper");
    const clientId = document.getElementById("clientid").value;
    const remarks = document.getElementById("remarkSelect").value;

    // Clone the wrapper and move it offscreen
    const clone = svgWrapper.cloneNode(true);
    clone.style.position = "absolute";
    clone.style.top = "-10000px";
    clone.style.left = "-10000px";
    clone.style.zIndex = "-1";
    document.body.appendChild(clone);

    // Ensure image inside clone supports CORS
    const clonedImg = clone.querySelector("img");
    if (clonedImg) {
        clonedImg.crossOrigin = "anonymous";
    }

    bootstrap.Modal.getInstance(document.getElementById('drawingModal')).hide();
    // clear displayed tooth number after hiding modal
    const selAfterSave = document.getElementById('selected-tooth');
    if (selAfterSave) selAfterSave.textContent = '';
    // Allow rendering time especially on iOS
    setTimeout(() => {
        html2canvas(clone, {
            scale: 2,
            useCORS: true,
            allowTaint: false,
            backgroundColor: null
        }).then(canvas => {
            const imageData = canvas.toDataURL("image/png");

            const formData = new FormData();
            formData.append("tooth", currentTooth);
            formData.append("image", imageData);
            formData.append("clientid", clientId);
            formData.append("remarks", remarks);

            // Cleanup clone
            document.body.removeChild(clone);

            // Save via fetch
            fetch("dentalcharts/save_remarks.php", {
                method: "POST",
                body: formData
            }).then(res => res.json())
                .then(data => {
                    if (data.status === "success") {

                        getclientdentalChart();
                    }
                });
        });
    }, 300); // slight delay to ensure rendering

}



function resetDrawingModal() {
    // Reset pen color to red
    document.querySelector('input[name="penColor"][value="red"]').checked = true;

    // Reset remarks dropdown
    document.getElementById('remarkSelect').value = "-";

    // Reset tooth image to default
    const toothImage = document.getElementById('toothImage');

    if (currentTooth >= 11 && currentTooth <= 18 || currentTooth >= 51 && currentTooth <= 55) {
        toothImage.src = "dentalcharts/upper_tooth_1.png";
    } else if (currentTooth >= 21 && currentTooth <= 28 || currentTooth >= 61 && currentTooth <= 65) {
        toothImage.src = "dentalcharts/upper_tooth_2.png";
    } else if (currentTooth >= 31 && currentTooth <= 38 || currentTooth >= 71 && currentTooth <= 75) {
        toothImage.src = "dentalcharts/lower_tooth_2.png";
    } else if (currentTooth >= 41 && currentTooth <= 48 || currentTooth >= 81 && currentTooth <= 85) {
        toothImage.src = "dentalcharts/lower_tooth_1.png";
    }


    // Clear SVG (if any marks were added via JS drawing)
    const svg = document.getElementById('svgOverlay');
    Array.from(svg.children).forEach(shape => {
        shape.setAttribute('fill', 'transparent');
    });
    // clear selected tooth display
    const sel = document.getElementById('selected-tooth');
    if (sel) sel.textContent = '';
}

// Clear selected tooth when modal is closed by any means
const drawingModalEl = document.getElementById('drawingModal');
if (drawingModalEl) {
    drawingModalEl.addEventListener('hidden.bs.modal', () => {
        const sel = document.getElementById('selected-tooth');
        if (sel) sel.textContent = '';
    });
}




