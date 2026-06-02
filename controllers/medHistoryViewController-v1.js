
loadMedHistory();
function loadMedHistory(clientId) {
    var clientId = document.getElementById("clientId").value;
    var fd = new FormData();
    fd.append('clientId', clientId);


    $.ajax({
        url: "services/medHistoryViewService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {


            document.getElementById("bodyResult").innerHTML = result;

        }
    });
}

function toggleCondition(isYes, id) {
    const input = document.getElementById(id);
    input.disabled = !isYes;
    if (!isYes) {
        input.value = '';
    }
}
function toggleConditionCheck(isYes, elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.style.display = isYes ? 'block' : 'none';

        // Optional: uncheck all options if hidden
        if (!isYes) {
            Array.from(element.querySelectorAll('input')).forEach(input => {
                if (input.type === 'checkbox' || input.type === 'text') input.checked = false;
            });
        }
    }
}

function toggleSpecifyInput(checkbox, inputId) {
    const inputField = document.getElementById(inputId);
    if (checkbox.checked) {
        inputField.style.display = 'block';
    } else {
        inputField.style.display = 'none';
        inputField.querySelector('input').value = '';
    }
}
