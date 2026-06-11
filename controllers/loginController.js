var interval = window.setInterval(function(){
    loginChecker();
},5000);

loginChecker();

function loginChecker(){

    var fd = new FormData();
    $.ajax({
        url: "services/checkIfLogged.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "logged") {
               location.href="basecode.php";
            }else{
                console.log("not logged in");
            }
        }
    });

}



function forgotPassword() {
    var x = confirm("Are you sure you want to reset your password?");
    
    if(x){
    //BUSINESS LOGIC - VALIDATION OF REQUEST / RESPONSE
    var username = document.getElementById("loginUser").value;
    if (username == null || username == "") {
        document.getElementById("forgotResult").innerHTML = "Please enter your username in the username field so we can identify your account.";
    } 
    else {
        document.getElementById("forgotResult").innerHTML = "Processing...";
        validateUsername(username);
    }
}
}

function validateUsername(username) {
    var fd = new FormData();
    fd.append('username', username);
    $.ajax({
        url: "services/validateFPUsername.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            if (result == "recognized") {
                document.getElementById("forgotResult").innerHTML = "Your account has been recognized. Please check your email.";
            }else {
                document.getElementById("forgotResult").innerHTML = "We cannot identify your account.";
            }
        }
    });

}