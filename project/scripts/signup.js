window.onload = function() {
	$(document).ready(function() {
    	$('.sitename, .sign-form, #register').fadeIn(500);
    	$('html, body').animate({
    		height: '100%'
    	});
	});
};

document.getElementById("register-button").onclick = function () {
	var username = document.getElementById("username");
	var email = document.getElementById("email");
	var password = document.getElementById("password");

	var flagUser = 0, flagEmail = 0, flagPass = 0;
	if (username.value == '') {
		flagUser = 1;
		username.style.borderColor = 'red';
		email.style.borderTop = 'none';
	}
	else
		username.style.borderColor = '#F6F6F6';

	if (email.value == '') {
		if (flagUser != 1)
			email.style.borderTop = '1px solid';
		email.style.borderColor = 'red';
		flagEmail = 1;
	}
	else {
		email.style.borderTop = 'none';
		email.style.borderColor = '#F6F6F6';
	}

	if (password.value == '') {
		if (flagEmail != 1)
			password.style.borderTop = '1px solid';
		password.style.borderColor = 'red';
		flagPass = 1;
	}
	else {
		password.style.borderTop = 'none';
		password.style.borderColor = '#F6F6F6';
	}

	if (flagUser || flagEmail || flagPass)
		return false;

	var formData = {
		"username" : username.value,
		"email" : email.value,
		"password" : password.value
	};

	var register = $.post("../database/register.php", formData);

	register.done(function(data) {
		var elm = document.getElementById("register-failed");
		if (data == "true") {
			elm.style.display = 'none';
			elm.style.height = '0px';
			elm.style.margin = '0px';
			document.getElementById("register-form").submit();
		}
		else {
			elm.style.height = '20px';
			elm.style.margin = '10px';
			$('#register-failed').fadeIn(300);
		}

	})

	return false;
};