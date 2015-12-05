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
			$host = getUsernameByID($event['host']);
			if ($event != null) {
				$event['going'] = isUserGoing($_SESSION['userID'], $event_id);
	?>

	<div id="event-container">
		<div id="event-banner" style='background: url("<?php echo $event['banner']?>") 50% 50% no-repeat; background-size: cover;'>
			<?php
				if($event['going']) {
			?>
			<div id="going-label" style="visibility: visible;"><img src="images/goingLabel.png" height="120" width="120"></div>
			<div id="event-hover">
				<a title="Not going" href='database/notgoing.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/no.png" height="90" width="90"></a>
				<?php if($_SESSION['username'] === $host) {?>
				<a title="Edit" id="edit-event" href="#"><img src="images/settings.png" width="100" height="100"></a>
				<script type="text/javascript" src="scripts/editevent.js"></script>
				<?php } ?>
			</div>
			<?php
				} else {
			?>
			<div id="going-label" style="visibility: hidden;"><img src="images/goingLabel.png" height="120" width="120"></div>
			<div id="event-hover">
				<a title="Going" href='database/going.php?eid=<?php echo $event['eventID'] ?>&uid=<?php echo $_SESSION['userID'] ?>'><img src="images/yes.png" height="100" width="100"></a>
				<?php if($_SESSION['username'] === $host) {?>
				<a title="Edit" id="edit-event" href="#"><img src="images/settings.png" width="100" height="100"></a>
				<script type="text/javascript" src="scripts/editevent.js"></script>
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
				<a href="index.php?page=profile&userid=<?php echo $user['userID'] ?>">
				<div class="going-avatar" style="background: url('<?php echo $user['avatar'] ?>') 50% 50% no-repeat; background-size: cover;" title="<?php echo $user['username'] ?>"></div>
				</a>
			<?php } }?>
			</div>
			<div class="line-divisor"></div>
			<div id="going-number"><?php echo count($goings) ?> going</div>
		</div>

		<div id="event-info">
			<div id="event-type">
				<img src="images/<?php echo $event['type']?>.png" height="40" width="40" title="<?php echo $event['type']?>">
			</div>
			<ul>
				<li>
					<?php if($event['private']) {?>
						<img src="images/private.png" height="12" width="12" title="Private">
					<?php } else { ?>
						<img src="images/public.png" height="12" width="12" title="Public">
					<?php } ?>
					Hosted by <?php echo $host?>
				</li>
				<li><img src="images/clock.png" height="12" width="12" title="Date"> <?php echo date("l, F jS \a\\t H:i", strtotime($event['eventDate']))?></li>
				<li><img src="images/location.png" height="12" width="12" title="Location"> <?php echo $event['location']?></li>
				<div class="line-divisor"></div>
				<li><?php echo nl2br($event['description'])?></li>
			</ul>
		</div>

		<?php
			$can_comment = false;
			if (isUserGoing($_SESSION['userID'], $event_id) || $_SESSION['username'] == $host) {
				$can_comment = true;
		?>
		<div id="post-comment-title">POST A NEW COMMENT</div>
		<form id="comment-form" action="database/addcomment.php" method="post">
			<textarea id="comment-box" name="comment-box" rows="4" cols="50" placeholder="Write something..." required></textarea>
			<input id="event-id" name="event-id" type="hidden" value="<?php echo $event_id?>">
			<input id="post-button" type="submit" value="Post">
		</form>
		<?php } ?>
		<div id="comments-title">COMMENTS</div>
		<?php
			$comments = getEventComments($event_id);
			if (empty($comments)) {
				if ($can_comment) {
		?>
		<div id="no-comments">Be the first to comment on this event.</div>
		<?php } else { ?>
		<div id="no-comments">No comments to show.</div>
		<?php } } else
			foreach ($comments as $comment) {
				$author = getUserByID($comment['author']);
		?>
		<div class="comment-container">
			<?php if ($_SESSION['username'] == $author['username']) { ?>
			<div class="delete-comment"><a href="database/deletecomment.php?id=<?php echo $comment['commentID']?>&author=<?php echo $author['username']?>"><img title="Delete comment" src="images/delete.png" width="10" height="10"></a></div>
			<?php } ?>
			<a href="index.php?page=profile&userid=<?php echo $author['userID'] ?>">
			<div class="user-avatar" style="background: url('<?php echo $author['avatar'] ?>') 50% 50% no-repeat; background-size: cover;"></div>
			</a>
			<div class="username"><a href="index.php?page=profile&userid=<?php echo $author['userID'] ?>"><?php echo $author['username']?></a> <a class="comment-date"><?php echo $comment['commentDate']?></a></div>
			<div class="comment"><?php echo $comment['content']?></div>
		</div>
		<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>
	<?php } else {?>
	<div id="not-found">Event not found.</div>
	<?php } ?>

	<div id="edit-event-form">
  		<div id="edit-event-title">Edit event</div><br><br>
  		<div id="field-name-edit">
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
	  	<form id="data-field-edit" action="" method="post" enctype="multipart/form-data">
	  		<ul>
	  			<input id="event-id" type="hidden" value="<?php echo $event['eventID']?>">
		  		<li><input id="name-edit" type="text" required="required" placeholder="Add a short, clear name" value="<?php echo $event['name']?>"></li>
		  		<li><input id="location-edit" type="text" required="required" placeholder="Include a place or address" value="<?php echo $event['location']?>"></li>
		  		<li>
		  			<select id="type-edit">
		  				<?php
		  					$types = array("Academic", "Arts", "Business", "Community", "Food & Drinks", "Music", "Politics", "Recreation", "Religion", "Sports", "Other");
		  					foreach($types as $type) {
		  						if ($type != $event['type']) {?>
		  						<option value="<?php echo $type?>"><?php echo $type?></option>
		  						<?php } else {?>
		  							<option selected="selected" value="<?php echo $type?>"><?php echo $type?></option>
		  						<?php } }?>
		  			</select>
		  		</li>
		  		<li><input id="date-edit" type="date" required="required" value="<?php echo date("Y-m-d", strtotime($event['eventDate']))?>" >
		  		<input id="time-edit" type="time" required="required" value="<?php echo date('H:i', strtotime($event['eventDate'])); ?>"></li>
		  		<li><textarea id="description-edit" rows="4" cols="50" placeholder="Tell people more about the event"><?php echo $event['description']?></textarea></li>
		  		<li><input id="photo-edit" type="file" name="photo-edit" accept="image/*"></li>
		  		<?php if ($event['private']) {?>
		  			<li><input id="private-edit" type="checkbox" value="" checked></li>
		  		<?php } else { ?>
		  			<li><input id="private-edit" type="checkbox" value=""></li>
		  		<?php } ?>
	  		</ul>
	  		<input id="edit-button" type="button" value="Save" onclick="edit_event();">
	  		<input id="cancel-button-edit" type="button" value="Cancel">
	  	</form>
	  	<a href="database/deleteevent.php?id=<?php echo $event['eventID']?>&host=<?php echo $host?>">Delete event</a>
  	</div>

  	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="scripts/addcomment.js"></script>