	<link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<div id="container">
<body>
	<?php include('navbar.php') ?>

  	<div id="user-upcoming-events-container">
  		<div><div id="title-right"><a href="index.php?page=userevents&filter=past">PAST EVENTS</a> <a href="index.php?page=userevents&filter=upcoming">SEE ALL</a></div>
	  	<div id="upcoming-events-title"><?= $_SESSION['username'] ?>'s upcoming events</div></div>
  		<div class="line-divisor"></div>
		<?php
			include('database/upcomingevents.php');
			$upcoming_events = getUserUpcomingEvents($_SESSION['userID']);
			if (empty($upcoming_events))
				echo '<div class="no-upcoming-events">You have no upcoming events.</div>';
			else
				foreach (array_slice($upcoming_events, 0, 4) as $event) {
		?>
		<div class="event-container">
			<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
				<div class="event-hover">
					<a title="Not going" href='database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/no.png" height="26" width="26"></a>
				</div>
			</div>
			<div class="event-type"><img src="images/<?php echo $event['type']?>.png" height="19" width="19" title="<?php echo $event['type']?>"></div>
			<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
			<div class="event-name"><a title="<?php echo $event['name'] ?>" href="index.php?page=event&id=<?php echo $event['eventID'] ?>"><?php echo $event['name'] ?></a></div>
			<div class="event-location" title="<?php echo $event['location'] ?>"><?php echo $event['location'] ?></div>
		</div>
		<?php } ?>
  	</div>

  	<div id="upcoming-events-container">
  		<div id="all-events-title">What are you looking for?</div>
  		<div class="line-divisor"></div>
  		<div onclick="location.href='index.php?page=search&type=All&filter=upcoming';" class="type-images" style='background: url("images/allevents.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=All&filter=upcoming">All</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Academic&filter=upcoming';" class="type-images" style='background: url("images/academicevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Academic&filter=upcoming">Academic</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Arts&filter=upcoming';" class="type-images" style='background: url("images/artsevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Arts&filter=upcoming">Arts</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Business&filter=upcoming';" class="type-images" style='background: url("images/businessevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Business&filter=upcoming">Business</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Community&filter=upcoming';" class="type-images" style='background: url("images/communityevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Community&filter=upcoming">Community</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Food%20%26%20Drinks&filter=upcoming';" class="type-images" style='background: url("images/eatingevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Food%20%26%20Drinks&filter=upcoming">Food & Drinks</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Music&filter=upcoming';" class="type-images" style='background: url("images/musicevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Music&filter=upcoming">Music</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Politics&filter=upcoming';" class="type-images" style='background: url("images/politicevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Politics&filter=upcoming">Politics</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Recreation&filter=upcoming';" class="type-images" style='background: url("images/recreationevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Recreation&filter=upcoming">Recreation</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Religion&filter=upcoming';" class="type-images" style='background: url("images/religiousevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Religion&filter=upcoming">Religion</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Sports&filter=upcoming';" class="type-images" style='background: url("images/sportsevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Sports&filter=upcoming">Sports</a>
  		</div>
  		<div onclick="location.href='index.php?page=search&type=Other&filter=upcoming';" class="type-images" style='background: url("images/otherevent.png") 50% 50% no-repeat;'>
  			<a href="index.php?page=search&type=Other&filter=upcoming">Other</a>
  		</div>
  	</div>

  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="scripts/addevent.js"></script>