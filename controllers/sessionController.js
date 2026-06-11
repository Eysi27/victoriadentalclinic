//20sec log out function

sessionValidate();
var interval = window.setInterval(function () {
  sessionValidate();
}, 20000);

function sessionValidate() {
  var fd = new FormData();
  $.ajax({
    url: "services/sessionCheck.php",
    data: fd,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (result) {

      if (result == 'loggedout') {
        window.location.href = "index.html";
      }
    }
  });

}