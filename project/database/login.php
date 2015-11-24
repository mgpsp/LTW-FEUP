<?php
	include_once('connection.php');
	global $db;
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? AND password = ?');
	$stmt->execute(array($username, $password));

	if (!($result = $stmt->fetch()))
		echo "false";
	else
		echo "true";
?>