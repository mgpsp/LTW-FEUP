	<link rel="stylesheet" href="css/event.css">
	<link rel="stylesheet" href="css/navbar.css">
</head>
<body>
	<?php
		include('navbar.php');
		include('database/connection_external.php');
		include('database/utilities.php');

		if (isset($event_id)) {
			$event = getEventByID($event_id);
	?>

	<div id="event-container">
		<div id="event-banner">
			<div id="event-name"><?php echo $event['name']?></div>
		</div>

		<div id="event-info">
			<ul>
				<li>
					<?php if($event['private']) {?>
						<img src="../images/private.png" height="12" width="12">
					<?php } else { ?>
						<img src="../images/public.png" height="12" width="12">
					<?php } ?>
					Hosted by <?php echo $event['host']?>
				</li>
				<li><img src="../images/clock.png" height="12" width="12"> <?php echo date("l, F jS \a\\t H:i", strtotime($event['eventDate']))?></li>
				<li><img src="../images/location.png" height="12" width="12"> <?php echo $event['location']?></li>
				<div class="line-divisor"></div>
				<li><?php echo $event['description']?></li>
			</ul>
		</div>
	</div>
	<?php } ?>