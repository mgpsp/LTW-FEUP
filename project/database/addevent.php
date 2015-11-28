<?php
	session_start();
	include_once('connection.php');

	$name = $_POST["name"];
	$location = $_POST["location"];
	$type = $_POST["type"];
	$datetime = $_POST["datetime"];
	$description = $_POST["description"];
	$host = $_SESSION['username'];

	$target_dir = "../images/";
	$target_file = $target_dir . basename($_FILES["photo"]);

	$stmt = $db->prepare('INSERT INTO Events (host, banner, name, eventDate, location, description, type) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$stmt->execute(array($host, $target_file, $name, $eventDate, $location, $description, $type));
	header('Location: ../index.php?page=main');
?>