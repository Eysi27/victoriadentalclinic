function logOut(){

    var fd = new FormData();
    $.ajax({
        url: "services/logOutService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            window.location.href="index.html";
        }
    });

}
