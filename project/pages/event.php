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
				<a title="Edit" id="edit-event" href="#"><img src="../images/settings1.png" width="100" height="100"></a>
				<?php } ?>
			</div>
			<?php
				} else {
			?>
			<div id="going-label" style="visibility: hidden;"><img src="../images/goingLabel.png" height="120" width="120"></div>
			<div id="event-hover">
				<a title="Going" href='../database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="../images/yes.png" height="100" width="100"></a>
				<?php if($_SESSION['username'] === $event['host']) {?>
				<a title="Edit" id="edit-event" href="#"><img src="../images/settings.png" width="100" height="100"></a>
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
			<div class="user-avatar" style="background: url('<?php echo $avatar ?>') 50% 50% no-repeat; background-size: cover;"></div>
			<div class="username"><?php echo $comment['author']?> <a class="comment-date"><?php echo $comment['commentDate']?></a></div>
			<div class="comment"><?php echo $comment['content']?></div>
		</div>
		<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>

	<div id="dim"></div>

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
	  	<form id="data-field" action="" method="post" enctype="multipart/form-data">
	  		<ul>
		  		<li><input id="name" type="text" required="required" placeholder="Add a short, clear name"></li>
		  		<li><input id="location" type="text" required="required" placeholder="Include a place or address"></li>
		  		<li>
		  			<select id="type">
		  				<option value="Academic">Academic</option>
		  				 <option value="Arts">Arts</option>
					    <option value="Business">Business</option>
					    <option value="Community">Community</option>
					    <option value="Food & Drinks">Food & Drinks</option>
					    <option value="Music">Music</option>
					    <option value="Politics">Politics</option>
					    <option value="Recreation">Recreation</option>
					    <option value="Religion">Religion</option>
					    <option value="Sports">Sports</option>
					    <option value="Other">Other</option>
		  			</select>
		  		</li>
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

	<script type="text/javascript" src="scripts/addcomment.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>