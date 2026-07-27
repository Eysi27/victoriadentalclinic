$(document).ready(function () {
  display_events();
}); //end document.ready block


const defaultRadio = document.getElementById("defaultEvent");
const customRadio = document.getElementById("customEvent");

const defaultContainer = document.getElementById("defaultEventContainer");
const customContainer = document.getElementById("customEventContainer");

function toggleEventInput() {
  if (defaultRadio.checked) {
    defaultContainer.style.display = "block";
    customContainer.style.display = "none";
  } else {
    defaultContainer.style.display = "none";
    customContainer.style.display = "block";
  }
}

defaultRadio.addEventListener("change", toggleEventInput);
customRadio.addEventListener("change", toggleEventInput);

// Initialize on page load
toggleEventInput();


function display_events() {

  $.ajax({
    url: 'display_event.php',
    dataType: 'json',
    success: function (response) {

      var events = [];

      $.each(response.data, function (i, item) {

        events.push({
          event_id: item.event_id,
          title: item.title,
          start: item.start,
          end: item.end,
          color: item.color,
          url: item.url
        });

      });

      // Destroy existing calendar before recreating
      if ($('#calendar').data('fullCalendar')) {
        $('#calendar').fullCalendar('destroy');
      }

      $('#calendar').fullCalendar({
        defaultView: 'month',
        timeZone: 'local',
        editable: true,
        selectable: true,
        selectHelper: true,

        // Hide the default time displayed by FullCalendar
        displayEventTime: false,

        events: events,

        select: function (start, end) {
          $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
          $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
          $('#event_entry_modal').modal('show');
        },

        eventRender: function (event, element) {
          element.on('click', function () {
            eventDeletion(event.event_id);
          });
        }
      });

    },

    error: function (xhr, status, error) {
      console.log(error);
    }

  });

}
function eventDeletion(id) {

  var x = confirm("Are you sure you want to delete this event?" + id);
  if (x) {

    var fd = new FormData();
    fd.append('id', id);
    $.ajax({
      url: "services/deleteCalendarEvent.php",
      data: fd,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (result) {
        result = result.trim();
        if (result == "success") {
          location.reload();
        } else {
          alert("An error has occured during event deletion. Try again.");
        }
      }
    });
  }

}
function save_event() {

  let event_name = "";

  // Get value based on selected radio button
  if ($("#defaultEvent").is(":checked")) {
    event_name = $("#event_name").val();
  } else {
    event_name = $("#custom_event_name").val().trim();
  }

  var event_start_date = $("#event_start_date").val();
  var event_end_date = $("#event_end_date").val();

  if (event_name == "" || event_start_date == "" || event_end_date == "") {
    alert("Please enter all required details.");
    return false;
  }
  var event_time = $("#appointmentTime").val(); // e.g. "14:30"


  $.ajax({
    url: "save_event.php",
    type: "POST",
    dataType: "json",
    data: {
      event_name: event_name,
      event_start_date: event_start_date,
      event_end_date: event_end_date,
      event_time: event_time
    },
    success: function (response) {
      $("#event_entry_modal").modal("hide");

      if (response.status == true) {
        location.reload();
      } else {
        // alert(response.msg);
      }
    },
    error: function (xhr, status) {
      console.log("ajax error = " + xhr.statusText);
    }
  });

  return false;
}