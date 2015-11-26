<?php
	session_start();
	include_once('connection.php');
	global $db;
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? AND password = ?');
	$stmt->execute(array($username, $password));

	if (!($result = $stmt->fetch())) {
		$_SESSION['username'] = null;
		echo "false";
	}
	else {
		$_SESSION['username'] = $username;
		echo "true";
	}
?>