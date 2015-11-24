	<link rel="stylesheet" href="css/signin.css">
</head>
<body>
	<div class="login-sitename">going.</div> 
	<form class="login-form" action="database/login.php" method="post">
		<input class="login-form-username" id="username" type="text" required="required" placeholder="username"><br>
		<input class="login-form-password" id="password" type="password" required="required" placeholder="password"><br>
		<div id="login-failed"> Username or password incorrect.</div>
		<input id="login-button" type="submit" value="Login">
	</form><br>

	<div id="register">Don't have an account? <a href="index.php">Register here.</a></div>