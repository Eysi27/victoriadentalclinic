
function accessSystem() {

    //BUSINESS LOGIC - VALIDATION OF REQUEST / RESPONSE
    var username = document.getElementById("loginUser").value;
    var password = document.getElementById("loginPassword").value;
    if (username != "" && password=="") {
        document.getElementById("loginResult").innerHTML = "Please Enter your Password!";
    } 
    else if (username == "" && password!="") {
        document.getElementById("loginResult").innerHTML = "Please Enter your Username!";
    } 
    else if (username == null || username =="" && password== null || password=="") {
        document.getElementById("loginResult").innerHTML = "Fields are Empty";
    }
    else {
        document.getElementById("loginResult").innerHTML = "Checking You Account....";
        validateLogin(username,password);
    }

}

function validateLogin(username,password) {
    var fd = new FormData();
    fd.append('username', username);
    fd.append('password', password);
    $.ajax({
        url: "services/validateUserAccount.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                window.location.href = "basecode.php";
            }else {
                document.getElementById("loginResult").innerHTML = "Invalid Username or Password.";
            }
        }
    });
}