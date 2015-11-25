window.onload = function() {
	$(document).ready(function() {
    	$('.sitename, .sign-form, #register').fadeIn(500);
    	$('html, body').animate({
    		height: '100%'
    	});
	});
};

document.getElementById("login-button").onclick = function() {
	var username = document.getElementById("username");
	var password = document.getElementById("password");

	var flag = 0;
	if (username.value == '') {
		flag = 1;
		username.style.borderColor = 'red';
	}
	else
		username.style.borderColor = '#F6F6F6';

	if (password.value == '') {
		if (flag != 1)
			password.style.borderTop = '1px solid';

		flag = 1;
		password.style.borderColor = 'red';
	}
	else
		password.style.borderColor = '#F6F6F6';

	if (flag == 1)
		return false;

	var formData = {
		"username" : username.value,
		"password" : password.value
	};

	var login = $.post("../database/login.php", formData);

	login.done(function(data)  {
		var elm = document.getElementById("login-failed");
		if (data == "false") {
			elm.style.height = '20px';
			elm.style.margin = '10px';
			$('#login-failed').fadeIn(300);
		}
		else {
			elm.style.display = 'none';
			elm.style.height = '0px';
			elm.style.margin = '0px';
			
			document.getElementById("login-form").submit();
		}
	});

	return false;
};