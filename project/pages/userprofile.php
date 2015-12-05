	<link rel="stylesheet" href="css/userprofile.css">
	<link rel="stylesheet" href="css/navbar.css">
</head>
<body>
	<?php 
		include('navbar.php');
		include('database/upcomingevents.php');

		$username = getUsernamebyID($userid);
		$avatar = getUserByUsername($username)['avatar'];
		$upcomingevents = getUserUpcomingEvents($userid);
		$hosted_events = getEventsbyHost($userid);
	?>

	<div id="user-info">
		<div id="useravatar" style="background: url('<?php echo $avatar?>') 50% 50% no-repeat; background-size: cover;"></div>
		
		<div id="user">
			<div id="user_text" style="">USER</div>
			<div id="user_name" style=""><?php echo $username?></div>
		</div>
	</div>

	<div id="user-going-events">
		<div id="going-events-title">Going to...</div>
  		<div class="linedivisor"></div>
  		<?php
			if (empty($upcomingevents)) {
				echo '<div class="no-upcoming-events">';
				echo $username;
				echo ' has no upcoming events.</div>';
			} else
				foreach (array_slice($upcomingevents, 0, 4) as $event) {
					$event['going'] = isUserGoing($_SESSION['userID'], $event['eventID']);
		?>
		<div class="user-event-container">
			<div class="user-event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<?php if ($event['going']) {?>
				<div class="going-label"><img src="images/goingLabel.png" height="50" width="50"></div>
				<?php } ?>
				<div class="user-event-hover">
					<?php if ($event['going']) {?>
					<a title="Not going" href='database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/no.png" height="26" width="26"></a>
					<?php }else {?>
					<a title="Going" href='database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/yes.png" height="30" width="30"></a>
					<?php } ?>
				</div>
			</div>
			<div class="user-event-type"><img src="images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
			<div class="user-event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="user-event-name"><a title="<?php echo $event['name'] ?>" href="index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
			<div class="user-event-location" title="<?php echo $event['location'] ?>"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
		</div>

		<div id="user-hosted-events">
			<div id="hosted-events-title">Events hosted by <?php echo $username?></div>
	  		<div class="linedivisor"></div>
	  		<?php
				if (empty($hosted_events)) {
					echo '<div class="no-upcoming-events">';
					echo $username;
					echo ' is not hosting any event.</div>';
				} else
					foreach (array_slice($hosted_events, 0, 4) as $event) {
						$event['going'] = isUserGoing($_SESSION['userID'], $event['eventID']);
			?>
			<div class="user-event-container">
				<div class="user-event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
					<?php if ($event['going']) {?>
					<div class="going-label"><img src="images/goingLabel.png" height="50" width="50"></div>
					<?php } ?>
					<div class="user-event-hover">
						<?php if ($event['going']) {?>
						<a title="Not going" href='database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/no.png" height="26" width="26"></a>
						<?php }else {?>
						<a title="Going" href='database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/yes.png" height="30" width="30"></a>
						<?php } ?>
					</div>
				</div>
				<div class="user-event-type"><img src="images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
				<div class="user-event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
				<div class="user-event-name"><a title="<?php echo $event['name'] ?>" href="index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
				<div class="user-event-location" title="<?php echo $event['location'] ?>"><?php echo $event['location'] ?></div>
			</div>

			<?php } ?>
		</div>
	</div>