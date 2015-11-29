<?php
	session_start();
	include_once('connection.php');
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? OR email = ?');
	$stmt->execute(array($username, $email));

	if ($stmt->fetch()) {
		$_SESSION['username'] = null;
		$_SESSION['userID'] = null;
		echo "false";
	}
	else {
		$stmt = $db->prepare('INSERT INTO Users (username, password, email) VALUES (?, ?, ?)');
		$stmt->execute(array($username, $password, $email));
		$_SESSION['username'] = $username;

		$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? AND password = ?');
		$stmt->execute(array($username, $password));
		$result = $stmt->fetch();
		$_SESSION['userID'] = $result['userID'];
		echo "true";
	}
?>