function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	var styleTag = "background: url('" + e.target.result + "') 50% 50% no-repeat; background-size: cover;"
            $('#avatar').attr('style', styleTag);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#upload-avatar").change(function(){
    readURL(this);
});

function edit_settings() {
	var username = document.getElementById("change-username");
	var email = document.getElementById("change-email");
	var password = document.getElementById("change-password");

	var formData = new FormData();
	formData.append("username", username.value);
	formData.append("email", email.value);
	formData.append("password", password.value);
	formData.append("avatar",  $('#upload-avatar')[0].files[0]);

	$.ajax({
		type: 'POST',
	    url: 'database/editsettings.php',
	    data: formData,
	    dataType: 'text',
		mimeType: false,
	    contentType: false,
	    processData: false,
	    success: function(r) {
	    	window.location.reload();
    	}
	})
}