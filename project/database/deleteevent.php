<?php
	session_start();
	include_once('connection.php');

	$event_id = $_GET['id'];
	$host = $_GET['host'];
	$username = $_SESSION['username'];

	if ($username == $host) {
		$stmt = $db->prepare('DELETE FROM Events WHERE eventID = ?');
		$stmt->execute(array($event_id));
	}

	header("Location: ../index.php?page=main");
?>