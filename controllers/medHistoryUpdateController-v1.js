
function validateHealthForm() {

    let msg = "";
    let firstInvalidField = null;

    function getRadioValue(name) {
        const selected = document.querySelector(`input[name="${name}"]:checked`);
        return selected ? selected.value : null;
    }

    function isCheckboxChecked(name) {
        return document.querySelectorAll(`input[name="${name}"]:checked`).length > 0;
    }

    function focusAndToast(field, message) {
        if (!firstInvalidField) {
            firstInvalidField = field;
            firstInvalidField.scrollIntoView({ behavior: "smooth", block: "center" });
            firstInvalidField.focus();
        }
        showToastTime("errorToast", message, 0.5);
    }

    // 1. Good health
    const goodHealth = getRadioValue("goodHealth");
    if (!goodHealth) {
        return focusAndToast(document.getElementsByName("goodHealth")[0], "Please answer if you are in good health.");
    }

    // 2. Under treatment
    const underTreatment = getRadioValue("underTreatment");
    const treatmentConditionInput = document.getElementById("treatmentCondition");
    const treatmentCondition = treatmentConditionInput.value.trim();
    if (!underTreatment) {
        return focusAndToast(document.getElementsByName("underTreatment")[0], "Please answer if you are under medical treatment.");
    } else if (underTreatment === "yes" && treatmentCondition === "") {
        return focusAndToast(treatmentConditionInput, "Please specify the condition being treated.");
    }

    // 3. Serious illness
    const seriousIllness = getRadioValue("seriousIllness");
    const illnessConditionInput = document.getElementById("illnessCondition");
    const illnessCondition = illnessConditionInput.value.trim();
    if (!seriousIllness) {
        return focusAndToast(document.getElementsByName("seriousIllness")[0], "Please answer if you have had serious illness or surgical operation.");
    } else if (seriousIllness === "yes" && illnessCondition === "") {
        return focusAndToast(illnessConditionInput, "Please describe the illness or operation.");
    }

    // 4. Hospitalized
    const hospitalized = getRadioValue("hospitalized");
    const hospitalizedConditionInput = document.getElementById("hospitalizedCondition");
    const hospitalizedCondition = hospitalizedConditionInput.value.trim();
    if (!hospitalized) {
        return focusAndToast(document.getElementsByName("hospitalized")[0], "Please answer if you have ever been hospitalized.");
    } else if (hospitalized === "yes" && hospitalizedCondition === "") {
        return focusAndToast(hospitalizedConditionInput, "Please provide the date and reason for hospitalization.");
    }

    // 5. Medication
    const medication = getRadioValue("medication");
    const medicationConditionInput = document.getElementById("medicationCondition");
    const medicationCondition = medicationConditionInput.value.trim();
    if (!medication) {
        return focusAndToast(document.getElementsByName("medication")[0], "Please answer if you are taking any medication.");
    } else if (medication === "yes" && medicationCondition === "") {
        return focusAndToast(medicationConditionInput, "Please specify the medication you are taking.");
    }

    // 6. Tobacco
    const tobaccoUse = getRadioValue("tobaccoUse");
    if (!tobaccoUse) {
        return focusAndToast(document.getElementsByName("tobaccoUse")[0], "Please answer if you use tobacco products.");
    }

    // 7. Alcohol
    const substanceUse = getRadioValue("substanceUse");
    if (!substanceUse) {
        return focusAndToast(document.getElementsByName("substanceUse")[0], "Please answer if you consume alcoholic beverages.");
    }

    // Question 8: Allergies
    const allergicTo = getRadioValue("allergicTo");
    if (!allergicTo) {
        return focusAndToast(document.querySelector('input[name="allergicTo"]'), "Please answer if you are allergic.");
    }

    if (allergicTo === "yes") {
        const selectedAllergies = Array.from(document.querySelectorAll('input[name="allergies"]:checked')).map(cb => cb.value);

        if (selectedAllergies.length === 0) {
            return focusAndToast(document.querySelector('input[name="allergies"]'), "Please select at least one allergy.");
        }

        if (selectedAllergies.includes("Others")) {
            const otherDetail = document.querySelector('input[name="otherAllergyDetail"]');
            if (!otherDetail || otherDetail.value.trim() === "") {
                return focusAndToast(otherDetail, "Please specify the other allergy.");
            }
        }

        // Optional: You can log or process selectedAllergies here
        console.log("Selected Allergies:", selectedAllergies);
    }


    submitMedicalHistoryAjax();

}

function getMedicalFormValues() {
    const formValues = {
        prevDentist: document.getElementById("prevDentist").value.trim() || null,
        lastDentalVisit: document.getElementById("lastDentalVisit").value || null,
        physician: document.getElementById("physician").value.trim() || null,
        specialty: document.getElementById("specialty").value.trim() || null,
        officeAddress: document.getElementById("officeAddress").value.trim() || null,
        officeNumber: document.getElementById("officeNumber").value.trim() || null,
        treatmentCondition: document.getElementById("treatmentCondition").value.trim() || null,
        goodHealth: document.querySelector('input[name="goodHealth"]:checked')?.value || null,
        underTreatment: document.querySelector('input[name="underTreatment"]:checked')?.value || null,
        treatmentCondition: document.getElementById("treatmentCondition").value.trim() || null,

        seriousIllness: document.querySelector('input[name="seriousIllness"]:checked')?.value || null,
        illnessCondition: document.getElementById("illnessCondition").value.trim() || null,

        hospitalized: document.querySelector('input[name="hospitalized"]:checked')?.value || null,
        hospitalizedCondition: document.getElementById("hospitalizedCondition").value.trim(),

        medication: document.querySelector('input[name="medication"]:checked')?.value || null,
        medicationCondition: document.getElementById("medicationCondition").value.trim() || null,

        tobaccoUse: document.querySelector('input[name="tobaccoUse"]:checked')?.value || null,
        substanceUse: document.querySelector('input[name="substanceUse"]:checked')?.value || null,

        allergies: document.querySelector('input[name="allergicTo"]:checked')?.value || null,
        allergiesCondition: Array.from(document.querySelectorAll('input[name="allergies"]:checked')).map(cb => cb.value) || null,
        otherAllergyField: document.getElementById("otherAllergyField").value.trim() || null,


        // bleedingDisorder: document.querySelector('input[name="bleedingDisorder"]:checked')?.value || null,
        pregnant: document.querySelector('input[name="pregnant"]:checked')?.value || null,
        nursing: document.querySelector('input[name="nursing"]:checked')?.value || null,
        birthControl: document.querySelector('input[name="birthControl"]:checked')?.value || null,

        // Collect q1 - q27 in an array
        medicalHistory: Array.from({ length: 37 }, (_, i) => {
            const el = document.getElementById("q" + (i + 1));
            return el ? (el.type === "checkbox" ? el.checked : el.value) : null;
        }),
        medicalHistoryOther: document.getElementById("otherCondition").value.trim() || null

    };

    return formValues;

}

function submitMedicalHistoryAjax() {
    const formData = getMedicalFormValues(); // Assuming the getMedicalFormValues() function is already defined
    console.log("Form Data Before:", formData); // For debugging purposes
    let fd = new FormData();

    // Append each key-value pair to FormData
    for (const key in formData) {
        if (formData.hasOwnProperty(key)) {
            fd.append(key, formData[key]);
        }
    }

    for (let pair of fd.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    fd.append('clientId', document.getElementById("clientId").value);
    // AJAX call
    $.ajax({
        url: "services/updateMedHistoryV2Service.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result === "success") {
                toastSuccess("Medical history updated successfully.");
            } else {
                toastError(result);
            }
        },
        error: function (xhr, status, error) {
            toastError("An error occurred: " + error);
        }
    });
}

function updateMedHistoryProfile() {

    var confirmation = confirm("Are you sure you want to update this medical history profile?");

    if (confirmation) {
        var clientId = document.getElementById("clientId").value;
        var q1 = document.getElementById("q1").checked;
        var q2 = document.getElementById("q2").checked;
        var q3 = document.getElementById("q3").checked;
        var q4 = document.getElementById("q4").checked;
        var q5 = document.getElementById("q5").checked;
        var q6 = document.getElementById("q6").checked;
        var q7 = document.getElementById("q7").checked;
        var q8 = document.getElementById("q8").checked;
        var q9 = document.getElementById("q9").checked;
        var q10 = document.getElementById("q10").checked;
        var q11 = document.getElementById("q11").checked;
        var q12 = document.getElementById("q12").checked;
        var q13 = document.getElementById("q13").checked;
        var q14 = document.getElementById("q14").checked;
        var q15 = document.getElementById("q15").checked;
        var q16 = document.getElementById("q16").checked;
        var q17 = document.getElementById("q17").checked;
        var q18 = document.getElementById("q18").checked;
        var q19 = document.getElementById("q19").checked;
        var q20 = document.getElementById("q20").checked;
        var q21 = document.getElementById("q21").checked;
        var q22 = document.getElementById("q22").checked;
        var q23 = document.getElementById("q23").checked;
        var q24 = document.getElementById("q24").checked;
        var q25 = document.getElementById("q25").checked;
        var q26 = document.getElementById("q26").checked;
        var q27 = document.getElementById("q27").value;

        submitform(
            clientId,
            q1, q2, q3, q4, q5, q6, q7, q8, q9, q10,
            q11, q12, q13, q14, q15, q16, q17, q18, q19, q20,
            q21, q22, q23, q24, q25, q26, q27
        );
    }




}
function submitform(clientId, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10,
    q11, q12, q13, q14, q15, q16, q17, q18, q19, q20,
    q21, q22, q23, q24, q25, q26, q27) {
    var fd = new FormData();


    fd.append('clientId', clientId);
    fd.append('q1', q1);
    fd.append('q2', q2);
    fd.append('q3', q3);
    fd.append('q4', q4);
    fd.append('q5', q5);
    fd.append('q6', q6);
    fd.append('q7', q7);
    fd.append('q8', q8);
    fd.append('q9', q9);
    fd.append('q10', q10);
    fd.append('q11', q11);
    fd.append('q12', q12);
    fd.append('q13', q13);
    fd.append('q14', q14);
    fd.append('q15', q15);
    fd.append('q16', q16);
    fd.append('q17', q17);
    fd.append('q18', q18);
    fd.append('q19', q19);
    fd.append('q20', q20);
    fd.append('q21', q21);
    fd.append('q22', q22);
    fd.append('q23', q23);
    fd.append('q24', q24);
    fd.append('q25', q25);
    fd.append('q26', q26);
    fd.append('q27', q27);

    $.ajax({
        url: "services/medHistoryUpdateService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == "success") {
                showToast("successToast", "Sucessfully updated");
            } else {
                showToast("errorToast", result);
            }
        }
    });
}
function reloadPage() {

    window.location.href = "clientProfileList.php";
}
