function addTreatment(){
    console.log="aaa"
    var treatment=document.getElementById("treatment").value;
    var description=document.getElementById("description").value;
   
 
    document.getElementById("formResult").innerHTML = "";
    if (treatment == "") {
        document.getElementById("formResult").innerHTML = "Treatment is required.";
    }else if(description==""){
        document.getElementById("formResult").innerHTML = "Treatment Description is required.";
    }else{
        submitform(treatment,description);
    }



}

function submitform(treatment,description){
    var fd = new FormData();
    fd.append('treatment', treatment);
    fd.append('description', description);
    $.ajax({
        url: "services/treatmentAddService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                document.getElementById("bodyResult").innerHTML ="<div class='row'><div class='col-lg-12' align='center'><a href='#' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>NEW TREATMENT SUCCESSFULLY ADDED</h3><button class='btn btn-primary' onclick='reloadPage();'>ADD NEW RECORD</button></div></div>";
             }else {
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage(){
location.reload();
}
