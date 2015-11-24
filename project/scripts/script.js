document.getElementById("login-button").onclick = function() {
	var username = document.getElementById("username");
	var password = document.getElementById("password");

	if (username.value == '') {
		username.style.backgroundColor = 'rgba(200, 0, 0, 1)';
		username.style.borderColor = 'red';
	}

	var formData = {
		"username" : username.value,
		"password" : password.value
	};

	var login = $.post("../database/login.php", formData);

	login.done(function(data)  {
		var elm = document.getElementById("login-failed");
		if (data == "false") {
			elm.style.visibility = 'visible';
			elm.style.height = '20px';
			elm.style.margin = '10px';
			$('#login-failed').fadeIn(3000);
		}
		else {
			elm.style.visibility = 'hidden';
			elm.style.height = '0px';
			elm.style.margin = '0px';
		}
	});

	return false;
};