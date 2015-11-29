	<link rel="stylesheet" href="css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="header">
		<a href="../index.php?page=main"><img id="site-logo" src="../images/logas.png" alt="Site logo" height="37" width="35"></a>
		<form id="search-bar" action="../index.php?page=main" method="post">
			<input id="search-box" type="text" placeholder="Search">
		</form>
		<a id="logout-button" href="../database/logout.php"><img  src="../images/logout.png" alt="Logout" height="15" width="15"></a>
		<a id="username" href="#"><img  src="../images/user.png" alt="Logout" height="15" width="15"> <?= $_SESSION['username'] ?></a>
		<div id="add-event-button"><img  src="../images/addEvent.png" alt="Logout" height="13" width="13"> Add event</div>
  	</div>

  	<div id="dim"></div>

  	<div id="upcoming-events-container">
  		<div id="upcoming-events-title"><?= $_SESSION['username'] ?>'s upcoming events</div>
  		<div class="line-divisor"></div>
  		<div id="upcoming-events">
  			<?php
  				include('database/upcomingevents.php');
  				if (empty($upcoming_events))
  					echo '<div id="no-upcoming-events">You have no upcoming events.<br><font size ="4px">Check in to some events.</font></div>';
  				else
  					foreach (array_slice($upcoming_events, 0, 3) as $event) {
  			?>

  			<div class="event-container">
  				<div class="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
  					<div class="going-label"><img src="../images/goingLabel.png"></div>
  					<div class="event-hover">
  						<a href='../database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/no.png" height="26" width="26"></a>
  					</div>
  				</div>
  				<div class="event-date"><?php echo strtoupper(date("D, j M H:i", strtotime($event['eventDate'])))?></div>
  				<div class="event-name"><?php echo $event['name'] ?></div>
  				<div class="event-location"><?php echo $event['location'] ?></div>
  			</div>
  			<?php } ?>
  		</div>
  	</div>

  	<div id="add-event-form">
  		<div id="add-event-title">Add event</div><br><br>
  		<div id="field-name">
  			<ul>
	  			<li>Event Name</li>
	  			<li>Location</li>
	  			<li>Type</li>
	  			<li>Date/Time</li>
	  			<li>Description</li>
	  			<li>Event Photo</li>
	  			<li>Private</li>
	  		</ul>
	  	</div>
	  	<form id="data-field" action="#" method="post" enctype="multipart/form-data">
	  		<ul>
		  		<li><input id="name" type="text" required="required" placeholder="Add a short, clear name"></li>
		  		<li><input id="location" type="text" required="required" placeholder="Include a place or address"></li>
		  		<li><input id="type" type="text" required="required" placeholder="Specify the type of the event"></li>
		  		<li><input id="date" type="date" required="required" value="<?php echo date('Y-m-d'); ?>" >
		  		<input id="time" type="time" required="required" value="<?php echo date('H:i'); ?>"></li>
		  		<li><textarea id="description" rows="4" cols="50" placeholder="Tell people more about the event"></textarea></li>
		  		<li><input id="photo" type="file" name="photo"></li>
		  		<li><input id="private" type="checkbox"></li>
	  		</ul>
	  		<input id="create-button" type="submit" value="Create">
	  		<input id="cancel-button" type="button" value="Cancel">
	  	</form>
  	</div>

  	<script type="text/javascript" src="scripts/main.js"></script>
  	<script type="text/javascript" src="scripts/addevent.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>