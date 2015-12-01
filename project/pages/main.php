	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/navbar.css">
</head>
<body>
	<?php include('navbar.php') ?>

  	<div id="user-upcoming-events-container">
  		<div id="upcoming-events-title"><?= $_SESSION['username'] ?>'s upcoming events</div>
  		<div class="line-divisor"></div>
		<?php
			include('database/upcomingevents.php');
			$upcoming_events = getUserUpcomingEvents();
			if (empty($upcoming_events))
				echo '<div class="no-upcoming-events">You have no upcoming events.<br><font size ="4px">Check in to some events.</font></div>';
			else
				foreach (array_slice($upcoming_events, 0, 3) as $event) {
		?>
		<div class="event-container">
			<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<div class="going-label"><img src="../images/goingLabel.png" height="50" width="50"></div>
				<div class="event-hover">
					<a title="Not going" href='../database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/no.png" height="26" width="26"></a>
				</div>
			</div>
			<div class="event-type"><img src="../images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
			<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="event-name"><a href="../index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
			<div class="event-location"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
  	</div>

  	<div id="upcoming-events-container">
  		<div id="all-events-title">What's happenning</div>
  		<div class="line-divisor"></div>
  		<?php
			$upcoming_events = getUpcomingEvents();
			if (empty($upcoming_events))
				echo '<div class="no-upcoming-events">There are no upcoming events.</div>';
			else
				foreach ($upcoming_events as $event) {
  		?>
  		<div class="event-container">
			<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<?php
					if($event['going']) {
				?>
				<div class="going-label"><img src="../images/goingLabel.png" height="50" width="50"></div>
				<div class="event-hover">
					<a title="Not going" href='../database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/no.png" height="26" width="26"></a>
				</div>
				<?php
					} else {
				?>
				<div class="event-hover">
					<a title="Going" href='../database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/yes.png" height="30" width="30"></a>
				</div>
				<?php } ?>
			</div>
			<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="event-name"><a href="#"><?php echo $event['name'] ?></a></div>
			<div class="event-location"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
  	</div>

  	<script type="text/javascript" src="scripts/main.js"></script>
  	<script type="text/javascript" src="scripts/addevent.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>