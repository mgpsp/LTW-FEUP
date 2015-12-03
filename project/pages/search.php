	<link rel="stylesheet" href="css/search.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/navbar.css">
</head>
<body>
	<?php
		include('navbar.php');
		include('database/connection_external.php');
		include('database/upcomingevents.php');
	?>

	<div class="events-container">
		<?php if (isset($type)) { ?>
			<div><div id="past-events"><a href="../index.php?page=search&type=<?php echo $type?>&filter=past">PAST EVENTS</a></div>
			<div class="title">Type: <a href="../index.php?page=search&type=<?php echo $type?>&filter=upcoming"><?php echo $type?></a></div></div>
		<?php } else if (isset($val)) { ?>
			<div class="title">Searching for: <?php echo $val?></div>
		<?php } ?>
		<div class="line-divisor"></div>
		<?php
			if (isset($type)) {
				if (isset($filter)) {
					if ($filter === "past")
						$events = getPastEventsByType($type);
					else
						$events = getUpcomingEventsByType($type);
				}
			}
			else if (isset($val))
				$events = searchEvents($val);

			if (empty($events))
				echo '<div class="no-events">No events found.';
			else
				foreach ($events as $event) {
					$event['going'] = isUserGoing($_SESSION['userID'], $event['eventID']);
		?>
		<div class="event-container">
			<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<div class="going-label"><img src="../images/goingLabel.png" height="50" width="50"></div>
				<div class="event-hover">
					<?php if ($event['going']) {?>
					<a title="Not going" href='../database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/no.png" height="26" width="26"></a>
					<?php }else {?>
					<a title="Going" href='../database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/yes.png" height="30" width="30"></a>
					<?php } ?>
				</div>
			</div>
			<div class="event-type"><img src="../images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
			<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="event-name"><a href="../index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
			<div class="event-location"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
	</div>

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>