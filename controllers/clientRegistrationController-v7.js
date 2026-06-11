var message = "";
setDentistSignature();
function switchToTab1(tab) {
    document.getElementById(tab).click();
}

function addPatientPersonalInfo() {
    var lastName = document.getElementById("lastName").value;
    var firstName = document.getElementById("firstName").value;
    var middleName = document.getElementById("middleName").value;
    var nickName = document.getElementById("nickName").value;
    var age = document.getElementById("age").value; //age
    var e = document.getElementById("gender");
    var gender = e.value;


    var cStatus = document.getElementById("civilStatus");
    var civilStatus = cStatus.value;
    var hmoOption = document.getElementById("hmo");
    var hmo = hmoOption.value;

    var cardNumber = document.getElementById("cardNumber").value;
    var company = document.getElementById("company").value;

    var religion = document.getElementById("religion").value;
    const base64Image = document.getElementById('capturedPhoto').value;

    var birthday = document.getElementById("birthday").value;
    var occupation = document.getElementById("occupation").value;
    var homeAddress = document.getElementById("homeAddress").value;
    var contactNumber = document.getElementById("contactNumber").value;
    var guardianName = document.getElementById("guardianName").value;
    var guardianOccupation = document.getElementById("guardianOccupation").value;
    var referredBy = document.getElementById("referredBy").value;
    var emailAddress = document.getElementById("emailAddress").value;
    var msg = '';
    document.getElementById("formResult").innerHTML = "";
    if (lastName == "") {
        msg = "Last Name is required";
    }
    else if (firstName == "") {
        msg = "First Name is required";
    }
    else if (nickName == "") {
        msg = "Nickname is required";
    }
    else if (civilStatus == "") {
        msg = "Civil Status is required";
    }
    else if (gender == "") {
        msg = "Gender is required";
    }
    else if (religion == "") {
        msg = "Religion is required";
    }

    else if (birthday == null) {
        msg = "Birthday is required";
    }

    else if (homeAddress == "") {
        msg = "Home Address is required";
    }
    else if (contactNumber == "") {
        msg = "Contact Number is required";
    } else if (cardNumber.includes('#')) {
        msg = "Please do not use # sign in the card number";
    } else if (age < 18) {
        if (guardianName == "") {
            msg = "Guardian Name is required";
        }
        else if (guardianOccupation == "") {
            msg = "Guardian Occupation is required";
        }

    }


    if (msg == '') {

        switchToTab1("tab2-tab");
    } else {

        showToast("errorToast", msg);
    }



}

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



    // // 10. Pregnant
    // const pregnant = getRadioValue("pregnant");
    // if (!pregnant) {
    //     return focusAndToast(document.getElementsByName("pregnant")[0], "Please answer if you are currently pregnant.");
    // }

    // // 10. nursing
    // const nursing = getRadioValue("nursing");
    // if (!nursing) {
    //     return focusAndToast(document.getElementsByName("nursing")[0], "Please answer if you are currently pregnant.");
    // }
    // // 10. nursing
    // const birthControl = getRadioValue("birthControl");
    // if (!birthControl) {
    //     return focusAndToast(document.getElementsByName("birthControl")[0], "Please answer if you are currently pregnant.");
    // }

    // All validations passed

    switchToTab1("tab3-tab");

    // submitMedicalHistoryAjax(); // Call the AJAX function to submit the form data

    // return true;
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

function computeAge() {

    var birthday = document.getElementById("birthday").value;
    var dob = new Date(birthday);

    if (birthday == null || birthday == '') {
        document.getElementById("message").innerHTML = "**Choose a date please!";
        return false;
    } else {

        //calculate month difference from current date in time  
        var month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format  
        var age_dt = new Date(month_diff);

        //extract year from date      
        var year = age_dt.getUTCFullYear();

        //now calculate the age of the user  
        var age = Math.abs(year - 1970);

        //display the calculated age  
        document.getElementById("age").value = age;
    }
}
function generateUUID() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        const r = Math.random() * 16 | 0;
        const v = c === 'x' ? r : (r & 0x3 | 0x8); // version 4 UUID
        return v.toString(16);
    });
}

function setDentistSignature() {

    var dentistName = document.getElementById("dentistName").value;

    if (dentistName == 'Dr. Nikki Sarmiento') {

        document.getElementById("dentist-signature-box").innerHTML = '<img src="img/e-sign.png" alt="signature" style = "height: 100%; width: auto; display: block margin: 0 auto;" > ';
    } else {
        document.getElementById("dentist-signature-box").innerHTML = "";
    }

}
function submitClientform(type) {
    var dateSigned = document.getElementById("dateSigned").value;
    var dentistSignature = document.getElementById("dentist-signature-input").value;
    var patientSignature = document.getElementById("patient-signature-input").value;
    var dentistName = document.getElementById("dentistName").value;


    var msg = '';
    if (!dateSigned) {
        msg = 'Date signed is Required';
    } else if (patientSignature == '') {
        msg = 'Incomplete Signature';
    } else if (dentistName == '') {
        msg = "Dentist Name is required.";
    } else if (dentistName != 'Dr. Nikki Sarmiento' && dentistSignature == '') {
        msg = "Dentist Signature is required.";
    }

    if (type == "submit") {
        if (msg != '') {
            toastError(msg);
            return;
        }
    }

    message = "";
    if (confirm("Are you sure you want to proceed?")) {
        const imageBlob = document.getElementById('capturedPhoto').value;
        var lastName = document.getElementById("lastName").value;
        var firstName = document.getElementById("firstName").value;
        var middleName = document.getElementById("middleName").value;
        var nickName = document.getElementById("nickName").value;
        var age = document.getElementById("age").value; //age
        var e = document.getElementById("gender");
        var gender = e.value;
        var cStatus = document.getElementById("civilStatus");
        var civilStatus = cStatus.value;
        var hmoOption = document.getElementById("hmo");
        var hmo = hmoOption.value;
        var cardNumber = document.getElementById("cardNumber").value;
        var company = document.getElementById("company").value;
        var religion = document.getElementById("religion").value;
        const base64Image = document.getElementById('capturedPhoto').value;
        var birthday = document.getElementById("birthday").value;
        var occupation = document.getElementById("occupation").value;
        var homeAddress = document.getElementById("homeAddress").value;
        var contactNumber = document.getElementById("contactNumber").value;
        var guardianName = document.getElementById("guardianName").value;
        var guardianOccupation = document.getElementById("guardianOccupation").value;
        var referredBy = document.getElementById("referredBy").value;
        var emailAddress = document.getElementById("emailAddress").value;
        var fd = new FormData();
        fd.append('lastName', lastName);
        fd.append('lastName', lastName);
        fd.append('firstName', firstName);
        fd.append('middleName', middleName);
        fd.append('nickName', nickName);
        fd.append('gender', gender);
        fd.append('age', age);
        fd.append('birthday', birthday);
        fd.append('occupation', occupation);
        fd.append('homeAddress', homeAddress);
        fd.append('contactNumber', contactNumber);
        fd.append('guardianName', guardianName);
        fd.append('guardianOccupation', guardianOccupation);
        fd.append('referredBy', referredBy);
        fd.append('civilStatus', civilStatus);
        fd.append('religion', religion);
        fd.append('profilePhoto', imageBlob);
        fd.append('company', company);
        fd.append('hmo', hmo);
        fd.append('emailAddress', emailAddress);

        fd.append('cardNumber', cardNumber);
        $.ajax({
            url: "services/clientRegistrationService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                result = result.trim();
                if (result == "success") {
                    message += "Patient Profile Recorded.<br>"
                    // submitMedHistory(type);

                    submitMedicalHistoryAjax();
                } else {
                    toastError(result);
                }
            }
        });

    }

}
function reloadPage() {
    location.reload();
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

    // AJAX call
    $.ajax({
        url: "services/registrationMedHistoryService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result === "success") {
                message += "Medical History Added.<br>";
                submitConsentform();
            } else {
                toastError(result);
            }
        },
        error: function (xhr, status, error) {
            toastError("An error occurred: " + error);
        }
    });
}



function submitConsentform() {
    var dateSigned = document.getElementById("dateSigned").value;
    var dentistSignature = document.getElementById("dentist-signature-input").value;
    var patientSignature = document.getElementById("patient-signature-input").value;
    var dentistName = document.getElementById("dentistName").value;
    var fd = new FormData();
    fd.append('dateSigned', dateSigned);
    fd.append('dentistSignature', dentistSignature);
    fd.append('patientSignature', patientSignature);
    fd.append('dentistName', dentistName);
    $.ajax({
        url: "services/consentAddService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result = result.trim();
            if (result == "success") {
                message += "Consent Successfully Added.";
                toastSuccess(message);
                setTimeout(() => location.reload(), 3000);

            } else {
                toastError(result);
            }
        }
    });
}