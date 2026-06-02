$(document).ready(function() {
	display_events();
}); //end document.ready block

function display_events() {
	var events = new Array();
$.ajax({
    url: 'display_event.php',  
    dataType: 'json',
    success: function (response) {
         
    var result=response.data;
    $.each(result, function (i, item) {
    	events.push({
            event_id: result[i].event_id,
            title: result[i].title,
            start: result[i].start,
            end: result[i].end,
            color: result[i].color,
            url: result[i].url
        }); 	
    })
	var calendar = $('#calendar').fullCalendar({
	    defaultView: 'month',
		 timeZone: 'local',
	    editable: true,
        selectable: true,
		selectHelper: true,
        select: function(start, end) {
				
				$('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
				$('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
				$('#event_entry_modal').modal('show');
			},
        events: events,
	    eventRender: function(event, element, view) { 
            element.bind('click', function() {
					eventDeletion(event.event_id);
				});
    	}
		}); //end fullCalendar block	
	  },//end success block
	  error: function (xhr, status) {
	  // alert(response.msg);
	  }
	});//end ajax block	
}
function eventDeletion(id){

  var x = confirm("Are you sure you want to delete this event?"+id);
  if(x){

    var fd = new FormData();
    fd.append('id', id);
    $.ajax({
        url: "services/deleteCalendarEvent.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (result) {
            result=result.trim();
            if (result == "success") {
                location.reload();
            }else {
              alert("An error has occured during event deletion. Try again.");
            }
        }
    });
  }

}
function save_event()
{
var event_name=document.getElementById("event_name").value;
var event_start_date=$("#event_start_date").val();
var event_end_date=$("#event_end_date").val();
if(event_name=="" || event_start_date=="" || event_end_date=="")
{
alert("Please enter all required details.");
return false;
}
$.ajax({
 url:"save_event.php",
 type:"POST",
 dataType: 'json',
 data: {event_name:event_name,event_start_date:event_start_date,event_end_date:event_end_date},
 success:function(response){
   $('#event_entry_modal').modal('hide');  
   if(response.status == true)
   {
	// alert(response.msg);
	location.reload();
   }
   else
   {
	//  alert(response.msg);
   }
  },
  error: function (xhr, status) {
  console.log('ajax error = ' + xhr.statusText);
  // alert(response.msg);
  }
});    
return false;
}