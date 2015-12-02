<?php
	include_once('connection.php');

	$event_id = $_GET['eid'];
	$user_id = $_GET['uid'];

	$stmt = $db->prepare('INSERT INTO EventGuests(eventID, userID, status) VALUES (?, ? ,?)');
	$stmt->execute(array($event_id, $user_id, "going"));

	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER']))
    	$previous = $_SERVER['HTTP_REFERER'];

	header("Location: " . $previous);
?>