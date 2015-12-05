<?php
	$db = new PDO('sqlite:database/data/database.db');
	$stmt = $db->prepare('PRAGMA foreign_keys = ON');
	$stmt->execute();
?>