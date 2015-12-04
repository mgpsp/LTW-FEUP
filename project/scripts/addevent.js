$(document).ready(function() 
{
	$('html, body').fadeIn(500);

	$("#add-event-button").click(function () {
		$('#dim').fadeIn(150);
		$('#add-event-form').fadeIn(150);
	});

	$("#cancel-button").click(function () {
		$('#dim').fadeOut(150);
		$('#add-event-form').fadeOut(150);
	});

	$('#search-box').keydown(function(e) {
	    if (e.keyCode == 13) {
	    	$("#search-bar").attr("action", "index.php?page=search&val=" + $('#search-box').val());
	        $('#search-bar').submit();
    	}
	});
});

function create_event() {
	var name = document.getElementById("name");
	var location_add = document.getElementById("location-add");
	var type = document.getElementById("type");
	var date = document.getElementById("date");
	var time = document.getElementById("time");
	var description = document.getElementById("description");
	var privt;
	if ($('#private').is(':checked'))
		privt = 1;
	else
		privt = 0;

	var datetime = date.value + ' ' + time.value;

	var formData = new FormData();
	formData.append("name", name.value);
	formData.append("location", location_add.value);
	formData.append("type", type.value);
	formData.append("datetime", datetime);
	formData.append("description", description.value);
	formData.append("photo",  $('#photo')[0].files[0]);
	formData.append("private", privt);

	$.ajax({
		type: 'POST',
	    url: 'database/addevent.php',
	    data: formData,
	    dataType: 'text',
		mimeType: false,
	    contentType: false,
	    processData: false,
	    success: function(r) {
	    	window.location.reload();
    	}
	})
	
	$('#dim').fadeOut(200);
	$('#add-event-form').fadeOut(200);
}

function edit_event() {
	var eventid = document.getElementById("event-id");
	var name = document.getElementById("name-edit");
	var location_edit = document.getElementById("location-edit");
	var type = document.getElementById("type-edit");
	var date = document.getElementById("date-edit");
	var time = document.getElementById("time-edit");
	var description = document.getElementById("description-edit");
	var privt;
	if ($('#private-edit').is(':checked'))
		privt = 1;
	else
		privt = 0;

	var datetime = date.value + ' ' + time.value;

	var formData = new FormData();
	formData.append("eventid", eventid.value);
	formData.append("name", name.value);
	formData.append("location", location_edit.value);
	formData.append("type", type.value);
	formData.append("datetime", datetime);
	formData.append("description", description.value);
	formData.append("photo",  $('#photo-edit')[0].files[0]);
	formData.append("private", privt);

	$.ajax({
		type: 'POST',
	    url: 'database/editevent.php',
	    data: formData,
	    dataType: 'text',
		mimeType: false,
	    contentType: false,
	    processData: false,
	    success: function(r) {
	    	window.location.reload();
    	}
	})
	
	$('#dim').fadeOut(200);
	$('#edit-event-form').fadeOut(200);
}
