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
				foreach (array_slice($upcoming_events, 0, 4) as $event) {
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
  		<div id="all-events-title">What are you looking for?</div>
  		<div class="line-divisor"></div>
  		<div class="type-images" style='background: url("../images/allevents.png") 50% 50% no-repeat;'><a href="">All</a></div>
  		<div class="type-images" style='background: url("../images/academicevent.png") 50% 50% no-repeat;'><a href="">Academic</a></div>
  		<div class="type-images" style='background: url("../images/artsevent.png") 50% 50% no-repeat;'><a href="">Arts</a></div>
  		<div class="type-images" style='background: url("../images/businessevent.png") 50% 50% no-repeat;'><a href="">Business</a></div>
  		<div class="type-images" style='background: url("../images/communityevent.png") 50% 50% no-repeat;'><a href="">Community</a></div>
  		<div class="type-images" style='background: url("../images/eatingevent.png") 50% 50% no-repeat;'><a href="">Foods & Drinks</a></div>
  		<div class="type-images" style='background: url("../images/musicevent.png") 50% 50% no-repeat;'><a href="">Music</a></div>
  		<div class="type-images" style='background: url("../images/politicevent.png") 50% 50% no-repeat;'><a href="">Politics</a></div>
  		<div class="type-images" style='background: url("../images/Recreationevent.png") 50% 50% no-repeat;'><a href="">Recreation</a></div>
  		<div class="type-images" style='background: url("../images/religiousevent.png") 50% 50% no-repeat;'><a href="">Religion</a></div>
  		<div class="type-images" style='background: url("../images/sportsevent.png") 50% 50% no-repeat;'><a href="">Sports</a></div>
  		<div class="type-images" style='background: url("../images/otherevent.png") 50% 50% no-repeat;'><a href="">Other</a></div>
  	</div>

  	<script type="text/javascript" src="scripts/addevent.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>