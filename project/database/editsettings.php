<?php
	session_start();
	include_once('connection.php');

	$username = htmlspecialchars($_POST["username"], ENT_QUOTES);
	$email = htmlspecialchars($_POST["email"], ENT_QUOTES);
	$password = $_POST["password"];

	$uploads_dir = "../images/avatares";
	if ($_FILES["avatar"]["name"] === null) {
		$image = $_SESSION['avatar'];
	}
	else {
		unlink('../$_SESSION["avatar"]');
		$image_name = $_FILES["avatar"]["name"];
		$tmp_name = $_FILES["avatar"]["tmp_name"];
		$image = "images/avatares/$image_name";
	    move_uploaded_file($tmp_name, "$uploads_dir/$image_name");
	}

	if ($password == "") {
		$stmt = $db->prepare('UPDATE Users SET username = ?, email = ?, avatar = ? WHERE userID = ?');
		$stmt->execute(array($username, $email, $image, $_SESSION['userID']));
	}
	else {
		$pass = hash('sha256', $password);
		$stmt = $db->prepare('UPDATE Users SET username = ?, password = ?, email = ?, avatar = ? WHERE userID = ?');
		$stmt->execute(array($username, $pass, $email, $image, $_SESSION['userID']));
	}

	$_SESSION['username'] = $username;
	$_SESSION['avatar'] = $image;
?>