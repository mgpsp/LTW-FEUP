<?php
	if(!isset($_SESSION)) 
        session_start();

    include_once('connection_external.php');
	include('utilities.php');

	function sortFunction( $a, $b ) {
	    return strtotime($a['eventDate']) - strtotime($b['eventDate']);
	}

	$stmt = $db->prepare('SELECT * FROM EventGuests WHERE userID = ? AND status = ?');
	$stmt->execute(array($_SESSION['userID'], "going"));
	$events = $stmt->fetchAll();

  	$upcoming_events = array();
	if (!empty($events)) {
		$today = date("Y-m-d H:i");
		foreach ($events as $event) {
			$event_info = getEventByID($event['eventID']);
			if ($event_info['eventDate'] > $today)
				$upcoming_events[] = $event_info;
		}
	}

	usort($upcoming_events, "sortFunction");
?>