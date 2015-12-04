<?php
	$db = new PDO('sqlite:data/database.db');
	$stmt = $db->prepare('PRAGMA foreign_keys = ON');
	$stmt->execute();
?>