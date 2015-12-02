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
			if ($event != null) {
				$event['going'] = isUserGoing($event['eventID'], $_SESSION['userID']);
	?>

	<div id="event-container">
		<div id="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
			<div id="event-hover"></div>
			<div id="event-name"><?php echo $event['name']?></div>
		</div>

		<div id="going-info">Quem vai e tal.</div>

		<div id="event-info">
			<div id="event-type">
				<img src="../images/<?php echo $event['type']?>.png" height="40" width="40" title="<?php echo $event['type']?>">
			</div>
			<ul>
				<li>
					<?php if($event['private']) {?>
						<img src="../images/private.png" height="12" width="12" title="Private">
					<?php } else { ?>
						<img src="../images/public.png" height="12" width="12" title="Public">
					<?php } ?>
					Hosted by <?php echo $event['host']?>
				</li>
				<li><img src="../images/clock.png" height="12" width="12" title="Date"> <?php echo date("l, F jS \a\\t H:i", strtotime($event['eventDate']))?></li>
				<li><img src="../images/location.png" height="12" width="12" title="Location"> <?php echo $event['location']?></li>
				<div class="line-divisor"></div>
				<li><?php echo $event['description']?></li>
			</ul>
		</div>

		<div id="post-comment-title">POST A NEW COMMENT</div>
		<form id="comment-form" action="../database/addcomment.php" method="post">
			<textarea id="comment-box" name="comment-box" rows="4" cols="50" placeholder="Write something..." required></textarea>
			<input id="event-id" name="event-id" type="hidden" value="1">
			<input id="post-button" type="submit" value="Post">
		</form>
		<div id="comments-title">COMMENTS</div>
		<div class="comment-container">
			<div class="username">martalopes <a class="comment-date">01/12/2015 at 09:40</a></div>
			<div class="user-avatar"></div>
			<div class="comment">Também há muitas séries que comecei a ver graças ao TVD.<br><br>
				Acho que por vezes, dá já para avaliar nos primeiros 5 ou 10 minutos. E outra coisa ainda, devias ter acrescentado a representação dos actores. Acho que isso também importa. Se parece que estão a “vender o material” ou com cara de enjoados.
			Também há muitas séries que comecei a ver graças ao TVD.<br><br>
				Acho que por vezes, dá já para avaliar nos primeiros 5 ou 10 minutos. E outra coisa ainda, devias ter acrescentado a representação dos actores. Acho que isso também importa. Se parece que estão a “vender o material” ou com cara de enjoados.</div>

		</div>
	</div>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>

	<script type="text/javascript" src="scripts/addcomment.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>