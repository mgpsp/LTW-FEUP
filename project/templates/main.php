	<link rel="stylesheet" href="css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="header">
		<a href="../index.php?page=main"><img id="site-logo" src="../images/logo.png" alt="Site logo" height="30" width="30"></a>
		<form id="search-bar" action="../index.php?page=main" method="post">
			<input id="search-box" type="text" placeholder="Search">
		</form>
		<a href="../database/logout.php"><img id="logout-button" src="../images/logout.png" alt="Logout" height="16" width="16"></a>
		<a id="username" href=""><?= $_SESSION['username'] ?></a>
  </div>
	</div>