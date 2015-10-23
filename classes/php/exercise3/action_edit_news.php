<?php
	include_once('database/connection.php');
	global $db;
	$stmt = $db->prepare('UPDATE news
						SET title = :title, introduction = :introduction, fulltext = :fulltext
						WHERE id = :id');
	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$stmt->bindParam(':title', $_GET['title']);
	$stmt->bindParam(':introduction', $_GET['introduction']);
	$stmt->bindParam(':fulltext', $_GET['fulltext']);
	$stmt->execute();
?>