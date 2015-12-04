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
		<?php if (isset($filter)) {
			if ($filter == "past") {
				$events = getUserPastEvents();
		?>
			<div class="title"><?= $_SESSION['username'] ?>'s past events</div>
		<?php } else { ?>
			<div class="title"><?= $_SESSION['username'] ?>'s upcoming events</div>
		<?php $events = getUserUpcomingEvents(); } }?>
		<div class="line-divisor"></div>
		<?php
			if (empty($events))
				echo '<div class="no-events">No events found.';
			else
				foreach ($events as $event) {
		?>
		<div class="event-container">
			<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<div class="going-label"><img src="images/goingLabel.png" height="50" width="50"></div>
				<div class="event-hover">
					<a title="Not going" href='database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/no.png" height="26" width="26"></a>
				</div>
			</div>
			<div class="event-type"><img src="images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
			<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="event-name"><a href="index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
			<div class="event-location"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
	</div>