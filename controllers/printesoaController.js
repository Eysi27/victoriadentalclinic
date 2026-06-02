loadSoa();
function loadSoa() {
    var soaid = document.getElementById("soaid").value;
    var fd = new FormData();
    fd.append("soaid", soaid)
    $.ajax({
        url: "services/printSoaService.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            document.getElementById("printbodyResult").innerHTML = result;
        }
    });

}



function createTicket(ref, currentvalue, column, table, refname) {
    var value = prompt("Your about to update" + table + "." + column + " for reference # " + ref + " with current value of " + currentvalue + ". Please input new value", "");

    if (value != null && value != "") {
        var fd = new FormData();
        fd.append("ref", ref);
        fd.append("currentvalue", currentvalue);
        fd.append("column", column);
        fd.append("table", table);
        fd.append("value", value);
        fd.append("refname", refname);
        $.ajax({
            url: "services/ticketservice.php",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (result) {
                alert("Ticket has been created.");
            }
        });

    }

}