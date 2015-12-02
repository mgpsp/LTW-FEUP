<?php
	include_once('connection.php');

	$event_id = $_GET['eid'];
	$user_id = $_GET['uid'];

	$stmt = $db->prepare('DELETE FROM EventGuests WHERE userID = ? AND eventID = ?');
	$stmt->execute(array($user_id, $event_id));

	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER']))
    	$previous = $_SERVER['HTTP_REFERER'];

	header("Location: " . $previous);
?>