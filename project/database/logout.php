<?php
	session_start();
	$_SESSION['username'] = null;
	$_SESSION['userID'] = null;
	header("Location: ../index.php?page=signIn");
?>