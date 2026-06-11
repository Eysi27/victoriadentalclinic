function addBookAppointmentInfo(){
    console.log="aaa"
    var Name=document.getElementById("Name").value;
    var Mobile=document.getElementById("Mobile").value;
    var Email=document.getElementById("Email").value;
   
    document.getElementById("formResult").innerHTML = "";
    if (Name == "") {
        document.getElementById("formResult").innerHTML = "Name is required";
    }
    else if (Mobile == "") {
        document.getElementById("formResult").innerHTML = "Mobile is required";
    }
    else if (Email == "") {
        document.getElementById("formResult").innerHTML = "Email is required";
    }
  
    else{
        submitform(Name,Mobile,Email);
    }

}


function submitform(Name,Mobile,Email){
    var fd = new FormData();
    fd.append('Name', Name);
    fd.append('Mobile', Mobile);
    fd.append('Email', Email);
   
    $.ajax({
        url: "services/addBookAppointmentservices.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                document.getElementById("bodyResult").innerHTML ="<div class='row'><div class='col-lg-12' align='center'><a href='#' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>APPOINTMENT SUCCESSFULLY REGISTERED</h3><button class='btn btn-primary' onclick='reloadPage();'>BOOK NEW APPOINTMENT</button></div></div>";
             }else {
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage(){
location.reload();
}
