	<div id="header">
		<a href="index.php?page=main"><img id="site-logo" src="images/logas.png" alt="Site logo" height="37" width="35"></a>
		<form id="search-bar" action="index.php?page=main" method="post">
			<input id="search-box" type="text" placeholder="Search">
		</form>
		<a id="logout-button" href="database/logout.php"><img  src="images/logout.png" alt="Logout" height="15" width="15" title="Logout"></a>
		<a id="username" href="#"><img src="images/user.png" alt="Logout" height="15" width="15"> <?= $_SESSION['username'] ?></a>
		<div id="add-event-button"><img src="images/addEvent.png" alt="Logout" height="13" width="13"> Add event</div>

		<div id="block-hover"></div>
		<div id="dropdown-menu">
  			<div id="dropdown-profile"><a href="index.php?page=profile&userid=<?php echo $_SESSION['userID']?>">My profile</a></div>
  			<div id="dropdown-settings"><a href="index.php?page=settings">Settings</a></div>
  		</div>
  	</div>

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
		  		<li><input id="location-add" type="text" required="required" placeholder="Include a place or address"></li>
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
		  		<li><input id="photo" type="file" name="photo" accept="image/*"></li>
		  		<li><input id="private" type="checkbox"></li>
	  		</ul>
	  		<input id="create-button" type="button" value="Create" onclick="create_event();">
	  		<input id="cancel-button" type="button" value="Cancel">
	  	</form>
  	</div>

 	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  	<script type="text/javascript" src="scripts/addevent.js"></script>
  	