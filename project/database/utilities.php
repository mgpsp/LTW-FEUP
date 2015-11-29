<?php

	function getEventByID($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getUserByID($user_id) {

	}
?>