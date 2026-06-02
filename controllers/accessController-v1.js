
function accessSystem() {

    //BUSINESS LOGIC - VALIDATION OF REQUEST / RESPONSE
    var username = document.getElementById("loginUser").value;
    var password = document.getElementById("loginPassword").value;
    if (username != "" && password == "") {
        document.getElementById("loginResult").innerHTML = "Please Enter your Password!";
    }
    else if (username == "" && password != "") {
        document.getElementById("loginResult").innerHTML = "Please Enter your Username!";
    }
    else if (username == null || username == "" && password == null || password == "") {
        document.getElementById("loginResult").innerHTML = "Fields are Empty";
    }
    else {
        document.getElementById("loginResult").innerHTML = "Checking You Account....";
        validateLogin(username, password);
    }

}

function validateLogin(username, password) {
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
            try {
                var data = typeof result === "string" ? JSON.parse(result) : result;
                if (data.result === "success") {


                    const now = new Date();
                    const formatted = now.toLocaleString('en-US', {
                        dateStyle: 'medium',
                        timeStyle: 'short',
                    });

                    var message = `We detected a new login to your account on ${formatted}. If this was you, no action is needed. If not, please secure your account immediately.`;

                    sendMail(data.email, "Login Notification", "Dear " + username, message);

                    window.location.href = "basecode.php";
                } else {
                    document.getElementById("loginResult").innerHTML = "Invalid Username or Password.";
                }
            } catch (e) {
                document.getElementById("loginResult").innerHTML = "Unexpected server response.";
            }
        }
    });
}