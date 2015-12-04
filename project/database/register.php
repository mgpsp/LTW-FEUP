<?php
	session_start();
	include_once('connection.php');
	
	$username = htmlspecialchars($_POST["username"], ENT_QUOTES);
	$password = htmlspecialchars($_POST["password"], ENT_QUOTES);
	$email = htmlspecialchars($_POST["email"], ENT_QUOTES);

	$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? OR email = ?');
	$stmt->execute(array($username, $email));

	if ($stmt->fetch()) {
		$_SESSION['username'] = null;
		$_SESSION['userID'] = null;
		$_SESSION['email'] = null;
		echo "false";
	}
	else {
		$stmt = $db->prepare('INSERT INTO Users (username, password, email, avatar) VALUES (?, ?, ?, ?)');
		$stmt->execute(array($username, $password, $email, "../images/avatares/default.png"));
		$_SESSION['username'] = $username;

		$stmt = $db->prepare('SELECT * FROM Users WHERE username = ? AND password = ?');
		$stmt->execute(array($username, $password));
		$result = $stmt->fetch();
		$_SESSION['userID'] = $result['userID'];
		$_SESSION['avatar'] = $result['avatar'];
		$_SESSION['email'] = $result['email'];
		echo "true";
	}
?>