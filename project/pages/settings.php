	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/settings.css">
</head>
<body>
	<?php
		include('navbar.php');
	?>

	<div id="settings-container">
		<div id="settings-title"></div>
		<form id="settings" action="" method="post" enctype="multipart/form-data">
			<input id="upload-avatar" type="file" name="photo">
			<div id="avatar">
				<div id="avatar-hover"><img id="change-avatar" src="../images/photo.png" width="30" height="30"></div>
			</div>
			<input id="change-username" type="text" maxlength="20" value="<?php echo $_SESSION['username']?>"><br>
			<input id="change-email" type="text" maxlength="20" value="<?php echo $_SESSION['email']?>"><br>
			<input id="change-password" type="password" maxlength="20" placeholder="New password" value=""><br>
			<input id="save-button" type="submit" value="Save">
		</form>
	</div>

	<script type="text/javascript" src="scripts/updateavatar.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>