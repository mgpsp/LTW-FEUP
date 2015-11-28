document.getElementById("add-event-button").onclick = function () {
	$('#dim').fadeIn(150);
	$('#add-event-form').fadeIn(150);
}

document.getElementById("cancel-button").onclick = function () {
	$('#dim').fadeOut(150);
	$('#add-event-form').fadeOut(150);
}

/*document.getElementById("create-button").onclick = function () {
	var name = document.getElementById("name");
	var location = document.getElementById("location");
	var type = document.getElementById("type");
	var date = document.getElementById("date");
	var time = document.getElementById("time");
	var description = document.getElementById("description");
	var photo = document.getElementById("photo");

	var datetime = date.value + ' ' + time.value;

	var formData = {
		"name" : name.value,
		"location" : location.value,
		"type" : type.value,
		"datetime" : datetime,
		"description" : description.value,
		"photo" : fileInputElement.files[0]
	};

	var formData = new FormData();
	formData.append("name", name.value);
	formData.append("location", location.value);
	formData.append("type", type.value);
	formData.append("datetime", datetime.value);
	formData.append("description", description.value);
	formData.append("photo",  photo.value);

	console.log(formData);

	var addevent = $.post("../database/addevent.php", formData);

	addevent.done(function(data) {
		if (data == "true") {
			document.getElementById("data-field").submit();
		}
	});

	return false;
}*/

window.onload = function() {
	$('html, body').fadeIn(500);

	$('#data-field').submit(function(evt) {
		var name = document.getElementById("name");
		var location = document.getElementById("location");
		var type = document.getElementById("type");
		var date = document.getElementById("date");
		var time = document.getElementById("time");
		var description = document.getElementById("description");
		var photo = document.getElementById("photo");

		var datetime = date.value + ' ' + time.value;

		console.log(description.value);

		var formData = new FormData();
		formData.append("name", name.value);
		formData.append("location", location.value);
		formData.append("type", type.value);
		formData.append("datetime", datetime);
		formData.append("description", description.value);
		formData.append("photo",  $('#photo')[0].files[0]);

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
}
