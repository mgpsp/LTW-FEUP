	<link rel="stylesheet" href="css/signin.css">
</head>
<body>
	<div class="sitename"><a href="index.php">going.</a></div> 
	<form class="sign-form" id="register-form" action="../index.php?page=main" method="post">
		<input class="username-field" id="username" type="text" required="required" placeholder="username"  maxlength="25"><br>
		<input class="email-field" id="email" type="text" required="required" placeholder="e-mail"><br>
		<input class="password-field" id="password" type="password" required="required" placeholder="password"><br>
		<div id="register-failed">Username or email already exist.</div>
		<input id="register-button" type="submit" value="Register">
	</form>

	<script type="text/javascript" src="scripts/signup.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>