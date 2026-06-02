function deleteTreatment(treatmentid){


    var confirmation= confirm('Are you sure you want to delete this Treatment?');
    if(confirmation){
        var fd = new FormData();
        fd.append('treatmentId', treatmentid);
        $.ajax({
            url: "services/treatmentDeletionService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                result=result.trim();
                if (result == "success") {
                    alert("A client was successfully deleted.");
                   location.reload();
                 }else {
                    alert("An error has occurred. Please try again");
                }
            }
        });
    
    }
     
    
    
    }