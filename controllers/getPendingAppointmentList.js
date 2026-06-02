getclientdata();
function getclientdata(){
  //  document.getElementById("content-table").style.zoom = "70%";
    var fd = new FormData();
    $.ajax({
        url: "services/pendingAppointmentListService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            $('#dataTable').DataTable().destroy();
            $('#dataTable').find('tbody').append(result);
            $('#dataTable').DataTable().draw();
            
        }

        
    });
    document.getElementById("content-table").style.zoom = "60%";

    
}
function approve(clientid){
    var approveDate = prompt("Please enter Date (YYYY-MM-DD)");
    if (approveDate.length != 10){
        alert("Invalid Date Format");

    }else{
        var fd = new FormData();
        fd.append('clientid', clientid);
        fd.append('date', approveDate);
        $.ajax({
            
            url: "services/pendingApproveDateUpdateService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
               location.reload();
                
            }
    
            
        });
    }


    
    
    
}


function decline(clientid){
    var x = confirm("Do you want to decline this Appointment?");
    if(x){
        var fd = new FormData();
        fd.append('clientid', clientid);
        
        $.ajax({
            
            url: "services/pendingDeclineDateUpdateService.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
               location.reload();
                
            }
    
            
        });
    }


}
    
    

