<?php
	session_start();
	include_once('connection.php');
	
	$author = $_SESSION['userID'];
	$event_id = $_POST["event-id"];
	$content = htmlspecialchars($_POST["comment-box"], ENT_QUOTES);

	$stmt = $db->prepare('INSERT INTO Comments (content, eventID, author) VALUES (?, ?, ?)');
	$stmt->execute(array($content, $event_id, $author));
	
	header("Location: ../index.php?page=event&id=" . $event_id);
?>