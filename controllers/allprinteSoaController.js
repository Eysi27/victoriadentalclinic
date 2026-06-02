loadSoa();
function loadSoa(){
    var soaid= document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid",soaid)
    $.ajax({
        url: "services/printSoaService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
                document.getElementById("printbodyResult").innerHTML =result;
        }
    });

}



