	<link rel="stylesheet" href="css/signin.css">
</head>
<body>
	<div class="sitename"><a href="index.php">going.</a></div> 
	<form class="sign-form" id="login-form" action="../index.php?page=main" method="post">
		<input class="username-field" id="username" type="text" required="required" placeholder="username"><br>
		<input class="password-field" id="password" type="password" required="required" placeholder="password"><br>
		<div id="login-failed"> Username or password incorrect.</div>
		<input id="login-button" type="submit" value="Login">
	</form><br>

	<div id="register">Don't have an account? <a href="index.php?page=signUp">Register here.</a></div>

	<script type="text/javascript" src="scripts/signin.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>