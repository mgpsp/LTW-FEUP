<?php
	include_once('connection.php');

	function getAllNews() {
		global $db;
		
		$stmt = $db->prepare('SELECT * FROM news');
		$stmt->execute();  
		$result = $stmt->fetchAll();
		
		return $result;
	}
?>