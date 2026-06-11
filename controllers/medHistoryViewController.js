
loadMedHistory();
function loadMedHistory(clientId){
    var clientId=document.getElementById("clientId").value;
    var fd = new FormData();
    fd.append('clientId', clientId);
   
    
    $.ajax({
        url: "services/medHistoryViewService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
           
           
                document.getElementById("bodyResult").innerHTML =result;
           
        }
    });
}
