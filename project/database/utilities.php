<?php

	function getEventByID($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getEventsByType($type) {
		global $db;
		if ($type != "All") {
			$stmt = $db->prepare('SELECT * FROM Events WHERE type = ?');
			$stmt->execute(array($type));
		}
		else {
			$stmt = $db->prepare('SELECT * FROM Events');
			$stmt->execute();
		}
		
		return $stmt->fetchAll();
	}

	function searchEvents($val) {
		global $db;
		$val = '%'. $val . '%';
		$stmt = $db->prepare('SELECT * FROM Events WHERE name LIKE :search_str');
		$stmt->bindParam(':search_str', $val);
		$stmt->execute();
		return $stmt->fetchAll();
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

	function getUserAvatarByUsername($username) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Users WHERE username = ?');
		$stmt->execute(array($username));
		$result = $stmt->fetch();
		return $result['avatar'];
	}

	function getUserByID($user_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Users WHERE userID = ?');
		$stmt->execute(array($user_id));
		return $stmt->fetch();
	}

	function getGoings($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM EventGuests WHERE eventID = ? AND status = ?');
		$stmt->execute(array($event_id, "going"));
		return $stmt->fetchAll();
	}
?>