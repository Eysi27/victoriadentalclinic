function addPatientPersonalInfo() {
    console.log = "aaa"
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
    else if (age <= 1) {
        msg = "Please review Birth date";
    }
    else if (birthday == null) {
        msg = "Birthday is required";
    }
    else if (occupation == "") {
        msg = "Occupation is required";
    }
    else if (homeAddress == "") {
        msg = "Home Address is required";
    }
    else if (contactNumber == "") {
        msg = "Contact Number is required";
    }
    else if (age < 18) {
        if (guardianName == "") {
            msg = "Guardian Name is required";
        }
        else if (guardianOccupation == "") {
            msg = "Guardian Occupation is required";
        }

    }
    if (msg == '') {
        submitform(lastName, firstName, middleName, nickName, gender, age, birthday, occupation, homeAddress, contactNumber, guardianName, guardianOccupation, referredBy, civilStatus, religion, base64Image, hmo, cardNumber, company);
    } else {
        showToast("errorToast", msg);
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
function submitform(lastName, firstName, middleName, nickName, gender, age, birthday, occupation, homeAddress, contactNumber, guardianName, guardianOccupation, referredBy, civilStatus, religion, imageBlob, hmo, cardNumber, company) {

    var imgname = generateUUID() + ".jpg";
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
                document.getElementById("bodyResult").innerHTML = "<div class='row'><div class='col-lg-12' align='center'><a href='#' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>CLIENT PROFILE SUCCESSFULLY REGISTERED</h3><button class='btn btn-primary' onclick='reloadPage();'>ADD NEW RECORD</button></div></div>";
            } else {
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage() {
    location.reload();
}
