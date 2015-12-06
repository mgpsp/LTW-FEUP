	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/settings.css">
</head>
<div id="container">
<body>
	<?php
		include('navbar.php');
	?>

	<div id="settings-container">
		<div id="settings-title"></div>
		<form id="settings" action="" method="post" enctype="multipart/form-data">
			<input id="upload-avatar" type="file" accept="image/*">
			<div id="avatar" style="background: url('<?php echo $_SESSION['avatar']?>') 50% 50% no-repeat; background-size: cover;">
				<img id="output" />
				<div id="avatar-hover">
					<img id="change-avatar" src="images/photo.png" width="30" height="30">
				</div>
			</div>
			<input id="change-username" type="text" maxlength="20" value="<?php echo $_SESSION['username']?>"><br>
			<input id="change-email" type="text" maxlength="40" value="<?php echo $_SESSION['email']?>"><br>
			<input id="change-password" type="password" maxlength="20" placeholder="New password" value=""><br>
			<input id="save-button" type="button" value="Save" onclick="edit_settings();">
		</form>
	</div>

	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="scripts/updateavatar.js"></script>
	<script type="text/javascript" src="scripts/editsettings.js"></script>