loadUpdateTreatmentForm();
function loadUpdateTreatmentForm(){

    var treatmentId=document.getElementById("treatmentId").value;
    var fd = new FormData();
    fd.append('treatmentId', treatmentId);
    $.ajax({
        url: "services/treatmentLoadUpdateService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            document.getElementById("bodyResult").innerHTML=result;
          
        }
    });


}


function updateTreatment(){
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
    var treatmentId=document.getElementById("treatmentId").value;
    fd.append('treatmentId', treatmentId);
    fd.append('treatment', treatment);
    fd.append('description', description);
    
    $.ajax({
        url: "services/treatmentUpdateService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                document.getElementById("bodyResult").innerHTML ="<div class='row'><div class='col-lg-12' align='center'><a href='#' class='btn btn-success btn-circle btn-lg'><i class='fas fa-check'></i></a><br><br><h3>NEW TREATMENT SUCCESSFULLY UPDATED</h3><a class='btn btn-primary' href=\"treatmentList.php\"'>Back to Treatment List</a></div></div>";
             }else {
                document.getElementById("formResult").innerHTML = result;
            }
        }
    });
}
function reloadPage(){
location.reload();
}
