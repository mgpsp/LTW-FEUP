<?php
	session_start();
	include('templates/header.php');

	$redirectTo = isset($_GET['page']) ? $_GET['page'] : 'signIn';

	$loginRequired = array('main');

	foreach ($loginRequired as $page) {
		if ($redirectTo === $page && $_SESSION['username'] === null) {
			$redirectTo = 'signIn';
			break;
		}
	}

	switch($redirectTo) {
		case 'signIn':
			include('templates/signin.php');
			break;
		case 'signUp':
			include('templates/signup.php');
			break;
		case 'main':
			include('templates/main.php');
			break;
		default:
			include('templates/signin.php');
			break;
	}

	include 'templates/footer.php';
?>