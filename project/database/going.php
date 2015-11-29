<?php
	include_once('connection.php');

	$event_id = $_GET['eid'];
	$user_id = $_GET['uid'];

	$stmt = $db->prepare('INSERT INTO EventGuests(eventID, userID, status) VALUES (?, ? ,?)');
	$stmt->execute(array($event_id, $user_id, "going"));

	header("Location: ../index.php?page=main");
?>