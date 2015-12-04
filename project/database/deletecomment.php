<?php
	session_start();
	include_once('connection.php');

	$comment_id = $_GET['id'];
	$author = $_GET['author'];
	$username = $_SESSION['username'];

	if ($username == $author) {
		$stmt = $db->prepare('DELETE FROM Comments WHERE commentID = ?');
		$stmt->execute(array($comment_id));
	}

	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER']))
    	$previous = $_SERVER['HTTP_REFERER'];

	header("Location: " . $previous);
?>