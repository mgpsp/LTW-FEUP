document.getElementById("add-event-button").onclick = function () {
	$('#dim').fadeIn(150);
	$('#add-event-form').fadeIn(150);
}

document.getElementById("cancel-button").onclick = function () {
	$('#dim').fadeOut(150);
	$('#add-event-form').fadeOut(150);
}

window.onload = function() {
	$('html, body').fadeIn(500);

	$('#data-field').submit(function(evt) {
		var name = document.getElementById("name");
		var location = document.getElementById("location");
		var type = document.getElementById("type");
		var date = document.getElementById("date");
		var time = document.getElementById("time");
		var description = document.getElementById("description");
		var privt = $('#private').is(':checked');

		var datetime = date.value + ' ' + time.value;

		console.log(description.value);

		var formData = new FormData();
		formData.append("name", name.value);
		formData.append("location", location.value);
		formData.append("type", type.value);
		formData.append("datetime", datetime);
		formData.append("description", description.value);
		formData.append("photo",  $('#photo')[0].files[0]);
		formData.append("private", privt);

		$.ajax({
			type: 'POST',
		    url: '../database/addevent.php',
		    data: formData,
		    dataType: 'text',
			mimeType: false,
		    contentType: false,
		    processData: false,
		    success: function(r) {
        	}
		})
		
		$('#dim').fadeOut(200);
		$('#add-event-form').fadeOut(200);
	})

	$('#search-box').keydown(function(e) {
	    if (e.keyCode == 13) {
	    	$("#search-bar").attr("action", "../index.php?page=search&val=" + $('#search-box').val());
	        $('#search-bar').submit();
    }
});
}
