<?php
	session_start();
	include_once('connection.php');
	
	$author = $_SESSION['username'];
	$event_id = $_POST["event-id"];
	$content = $_POST["comment-box"];

	$stmt = $db->prepare('INSERT INTO Comments (content, eventID, author) VALUES (?, ?, ?)');
	$stmt->execute(array($content, $event_id, $author));
	
	header("Location: ../index.php?page=event&id=" . $event_id);
?>