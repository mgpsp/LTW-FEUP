<?php
	if(!isset($_SESSION)) 
        session_start();

	include_once('connection_external.php');

	$stmt = $db->prepare('SELECT * FROM EventGuests WHERE userID = ? AND status = ?');
	$stmt->execute(array($_SESSION['userID'], "going"));
	$events = $stmt->fetchAll();

  	$upcoming_events = array();
	if (!empty($events)) {
		$today = date("Y-m-d H:i");
		foreach ($events as $event) {
			$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ? ORDER BY eventDate DESC');
			$stmt->execute(array($event['eventID']));
			$event_info = $stmt->fetch();
			if ($event_info['eventDate'] > $today)
				$upcoming_events[] = $event_info;
			else
				break;
		}
	}
?>