<?php
	session_start();
	include_once('connection.php');

	$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
	$location = htmlspecialchars($_POST["location"], ENT_QUOTES);
	$type = $_POST["type"];
	$eventDate = htmlspecialchars($_POST["datetime"], ENT_QUOTES);
	$description = trim(htmlspecialchars($_POST["description"], ENT_QUOTES));
	$private = $_POST["private"];
	$host = $_SESSION['userID'];

	$uploads_dir = "../images/uploads";
	if ($_FILES["photo"]["name"] === null)
		$image_name = "eventBanner.png";
	else {
		$image_name = uniqid() . "-" . $_FILES["photo"]["name"];
		$tmp_name = $_FILES["photo"]["tmp_name"];
    	move_uploaded_file($tmp_name, "$uploads_dir/$image_name");
	}

	$stmt = $db->prepare('INSERT INTO Events (host, banner, name, eventDate, location, description, private, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
	$stmt->execute(array($host, "images/uploads/$image_name", $name, $eventDate, $location, $description, $private, $type));

	$event_id = $db->lastInsertId();

	$stmt = $db->prepare('INSERT INTO EventGuests (eventID, userID, status) VALUES (?, ?, ?)');
	$stmt->execute(array($event_id, $_SESSION['userID'], "going"));
	echo "true";
?>