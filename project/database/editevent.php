<?php
	include_once('connection.php');

	$event_id = $_POST["eventid"];
	$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
	$location = htmlspecialchars($_POST["location"], ENT_QUOTES);
	$type = $_POST["type"];
	$eventDate = htmlspecialchars($_POST["datetime"], ENT_QUOTES);
	$description = trim(htmlspecialchars($_POST["description"], ENT_QUOTES));
	$private = $_POST["private"];

	$stmt = $db->prepare('SELECT * FROM Events WHERE eventID = ?');
	$stmt->execute(array($event_id));
	$result = $stmt->fetch();

	$uploads_dir = "../images/uploads";
	if ($_FILES["photo"]["name"] === null) {
		$image = $result['banner'];
	}
	else {
		$image_name = uniqid() . "-" . $_FILES["photo"]["name"];
		$tmp_name = $_FILES["photo"]["tmp_name"];
		$image = "$uploads_dir/$image_name";
	    move_uploaded_file($tmp_name, $image);
	}		

	$stmt = $db->prepare('UPDATE Events SET banner = ?, name = ?, description = ?, eventDate = ?, location = ?, private = ?, type = ? WHERE eventID = ?');
	$stmt->execute(array($image, $name, $description, $eventDate, $location, $private, $type, $event_id));
	echo "true";
?>