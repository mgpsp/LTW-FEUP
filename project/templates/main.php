	<link rel="stylesheet" href="css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="header">
		<a href="../index.php?page=main"><img id="site-logo" src="../images/logo.png" alt="Site logo" height="30" width="30"></a>
		<form id="search-bar" action="../index.php?page=main" method="post">
			<input id="search-box" type="text" placeholder="Search">
		</form>
		<a href="../database/logout.php"><img id="logout-button" src="../images/logout.png" alt="Logout" height="16" width="16"></a>
		<a id="username" href=""><?= $_SESSION['username'] ?></a>
  	</div>

  	<div id="dim"></div>

  	<div id="add-event">
  		<div id="add-event-button">Add event</div>
  	</div>

  	<div id="add-event-form">
  		<div id="field-name">
  			<ul>
	  			<li>Event Name</li>
	  			<li>Location</li>
	  			<li>Type</li>
	  			<li>Date/Time</li>
	  			<li>Description</li>
	  			<li>Event Photo</li>
	  		</ul>
	  	</div>
	  	<form id="data-field" action="" method="post">
	  		<ul>
		  		<li><input id="name" type="text" required="required" placeholder="Add a short, clear name"></li>
		  		<li><input id="location" type="text" required="required" placeholder="Include a place or address"></li>
		  		<li><input id="type" type="text" required="required" placeholder="Specify the type of the event"></li>
		  		<li><input id="date" type="date" required="required" value="<?php echo date('Y-m-d'); ?>">
		  		<input id="time" type="time" required="required" value="<?php echo date('H:i'); ?>"></li>
		  		<li><textarea id="description" rows="4" cols="50" placeholder="Tell people more about the event"></textarea></li>
		  		<li><input id="photo" type="file"></li>
	  		</ul>
	  		<input id="create-button" type="submit" value="Create">
	  	</form>


  	</div>

  	<script type="text/javascript" src="scripts/addevent.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>