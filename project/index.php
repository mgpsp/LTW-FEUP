<?php
	include('templates/header.php');

	$redirectTo = isset($_GET['page']) ? $_GET['page'] : 'signIn';

	switch($redirectTo) {
		case 'signIn':
			include('templates/signin.php');
			break;
		default:
			include('templates/signin.php');
			break;
	}

	include 'templates/footer.php';
?>