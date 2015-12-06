<?php
	
	function getEventByID($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ?');
		$stmt->execute(array($event_id));
		return $stmt->fetch();
	}

	function getUpcomingEventsByType($type) {
		global $db;
		if ($type != "All") {
			$stmt = $db->prepare('SELECT * FROM Events WHERE type = ?');
			$stmt->execute(array($type));
		}
		else {
			$stmt = $db->prepare('SELECT * FROM Events');
			$stmt->execute();
		}
		$events = $stmt->fetchAll();

		$upcoming_events = array();
		if (!empty($events)) {
			$today = date("Y-m-d H:i");
			foreach ($events as $event) {
				$event_info = getEventByID($event['eventID']);
				if ($event_info['eventDate'] > $today) {
					if (!$event_info["private"] || isUserGoing($_SESSION['userID'], $event_info['eventID']))
						$upcoming_events[] = $event_info;
				}
			}
		}

		usort($upcoming_events, "sortFunction");

		return $upcoming_events;
	}

	function getPastEventsByType($type) {
		global $db;
		if ($type != "All") {
			$stmt = $db->prepare('SELECT * FROM Events WHERE type = ?');
			$stmt->execute(array($type));
		}
		else {
			$stmt = $db->prepare('SELECT * FROM Events');
			$stmt->execute();
		}
		$events = $stmt->fetchAll();

		$upcoming_events = array();
		if (!empty($events)) {
			$today = date("Y-m-d H:i");
			foreach ($events as $event) {
				$event_info = getEventByID($event['eventID']);
				if ($event_info['eventDate'] < $today) {
					if (!$event_info["private"] || isUserGoing($_SESSION['userID'], $event_info['eventID']))
						$upcoming_events[] = $event_info;
				}
			}
		}

		usort($upcoming_events, "sortFunction");

		return $upcoming_events;
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

	function searchEvents($val) {
		global $db;
		$val = '%'. $val . '%';
		$stmt = $db->prepare('SELECT * FROM Events WHERE name LIKE :search_str');
		$stmt->bindParam(':search_str', $val);
		$stmt->execute();
		$events = $stmt->fetchAll();
		$results = array();
		foreach ($events as $event) {
			if (!$event["private"] || isUserGoing($_SESSION['userID'], $event['eventID']))
				$results[] = $event;
		}
		return $results;
	}

	 function sortComments( $a, $b ) {
	    return strtotime($b['commentDate']) - strtotime($a['commentDate']);
	}

	function getEventComments($event_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Comments WHERE eventID = ?');
		$stmt->execute(array($event_id));
		$comments = $stmt->fetchAll();
		usort($comments, "sortComments");
		return $comments;
	}

	function getUserByUsername($username) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Users WHERE username = ?');
		$stmt->execute(array($username));
		return $stmt->fetch();
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

	function getUsernameByID($user_id) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Users WHERE userID = ?');
		$stmt->execute(array($user_id));
		$result = $stmt->fetch();
		return $result['username'];
	}

	function getEventsbyHost($userid) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Events WHERE host = ?');
		$stmt->execute(array($userid));
		$events = $stmt->fetchAll();
		$results = array();
		foreach ($events as $event) {
			if (!$event["private"] || isUserGoing($_SESSION['userID'], $event['eventID']))
				$results[] = $event;
		}

		usort($results, "sortFunction");
		return $results;
	}

	function getTimeAgo($date) {
		$today = time();
		$dif = $today - strtotime($date);

		if ($dif < 60) {
			if ($dif == 1)
				return "{$dif} second ago";
			else
				return "{$dif} seconds ago";
		}
		else if ($dif < 3600) {
			$minutes = round($dif / 60);
			if ($minutes == 1)
				return "{$minutes} minute ago";
			else
				return "{$minutes} minutes ago";
		}
		else if ($dif < 86400) {
			$hours = round($dif / 3600);
			if ($hours == 1)
				return "{$hours} hour ago";
			else
				return "{$hours} hours ago";
		}
		else if ($dif < 604800) {
			$days = round($dif / 86400);
			if ($days == 1)
				return "{$days} day ago";
			else
				return "{$days} days ago";
		}
		else
			return "showDate";

	}
?>