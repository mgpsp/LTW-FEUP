<?php

	function getEventByID($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function isUserGoing($user_id, $event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM EventGuests WHERE eventID = ? AND userID = ?');
		$stmt->execute(array($event_id, $user_id));

		if (!$stmt->fetch())
			return false;
		else
			return true;
	}

	function getEventComments($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Comments WHERE eventID = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetchAll();
	}

	function getUserAvatar($username) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Users WHERE username = ?');
		$stmt->execute(array($username));
		$result = $stmt->fetch();
		return $result['avatar'];
	}
?>