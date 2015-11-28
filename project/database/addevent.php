<?php
	session_start();
	include_once('connection.php');

	$name = $_POST["name"];
	$location = $_POST["location"];
	$type = $_POST["type"];
	$eventDate = $_POST["datetime"];
	$description = $_POST["description"];
	$host = $_SESSION['username'];

	$uploads_dir = "../images/uploads";
	if ($_FILES["photo"]["name"] === null)
		$image_name = "eventBanner.png";
	else
		$image_name = uniqid() . "-" . $_FILES["photo"]["name"];
	$tmp_name = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($tmp_name, "$uploads_dir/$image_name");

	$stmt = $db->prepare('INSERT INTO Events (host, banner, name, eventDate, location, description, type) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$stmt->execute(array($host, "$uploads_dir/$image_name", $name, $eventDate, $location, $description, $type));
	echo "true";
?>