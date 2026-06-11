function deleteClient(clientid){


var confirmation= confirm('Are you sure you want to delete this client?');
if(confirmation){
    var fd = new FormData();
    fd.append('clientId', clientid);
    $.ajax({
        url: "services/clientDeletionService.php",
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