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
				$event['going'] = isUserGoing($_SESSION['userID'], $event_id);
	?>

	<div id="event-container">
		<div id="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
			<?php
				if($event['going']) {
			?>
			<div id="going-label" style="visibility: visible;"><img src="../images/goingLabel.png" height="120" width="120"></div>
			<div id="event-hover">
				<a title="Not going" href='../database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/no.png" height="90" width="90"></a>
				<?php if($_SESSION['username'] === $event['host']) {?>
				<a title="Edit" href=""><img src="../images/settings1.png" width="100" height="100"></a>
				<?php } ?>
			</div>
			<?php
				} else {
			?>
			<div id="going-label" style="visibility: hidden;"><img src="../images/goingLabel.png" height="120" width="120"></div>
			<div id="event-hover">
				<a title="Going" href='../database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/yes.png" height="100" width="100"></a>
				<?php if($_SESSION['username'] === $event['host']) {?>
				<a title="Edit" href=""><img src="../images/settings.png" width="100" height="100"></a>
				<?php } ?>
			</div>
			<?php } ?>
			<div id="event-name"><?php echo $event['name']?></div>
		</div>

		<div id="going-info">
			<div id="going-avatars">
			<?php
				$goings = getGoings($event_id);
				if (!empty($goings)) {
					foreach ($goings as $going) {
						$user = getUserByID($going['userID']);
			?>
				<div class="going-avatar" style="background: url('<?php echo $user['avatar'] ?>') 50% 50% no-repeat; background-size: cover;" title="<?php echo $user['username'] ?>"></div>
			<?php } }?>
			</div>
			<div class="line-divisor"></div>
			<div id="going-number"><?php echo count($goings) ?> going</div>
		</div>

		<div id="event-info">
			<div id="event-type">
				<img src="../images/<?php echo $event['type']?>.png" height="40" width="40" title="<?php echo $event['type']?>">
			</div>
			<ul>
				<li>
					<?php if($event['private'] === true) {?>
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
			<input id="event-id" name="event-id" type="hidden" value="<?php echo $event_id?>">
			<input id="post-button" type="submit" value="Post">
		</form>
		<div id="comments-title">COMMENTS</div>
		<?php
			$comments = getEventComments($event_id);
			if (empty($comments)) {
		?>
		<div id="no-comments">Be the first to comment on this event.</div>
		<?php } else
			foreach ($comments as $comment) {
				$avatar = getUserAvatarByUsername($comment['author']);
		?>
		<div class="comment-container">
			<div class="username"><?php echo $comment['author']?> <a class="comment-date"><?php echo $comment['commentDate']?></a></div>
			<div class="user-avatar" style="background: url('<?php echo $avatar ?>') 50% 50% no-repeat; background-size: cover;"></div>
			<div class="comment"><?php echo $comment['content']?></div>
		</div>
		<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>

	<script type="text/javascript" src="scripts/addcomment.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>