<?php
	session_start();
	include('pages/header.php');

	if (!isset($_SESSION['username']))
		$_SESSION['username'] = null;

	$redirectTo = isset($_GET['page']) ? $_GET['page'] : 'signIn';

	$loginRequired = array('main', 'event');

	foreach ($loginRequired as $page) {
		if ($redirectTo === $page && $_SESSION['username'] === null) {
			$redirectTo = 'signIn';
			break;
		}
	}

	switch($redirectTo) {
		case 'signIn':
			include('pages/signin.php');
			break;
		case 'signUp':
			include('pages/signup.php');
			break;
		case 'main':
			include('pages/main.php');
			break;
		case 'event':
			if (isset($_GET['id']))
				$event_id = $_GET['id'];
			include('pages/event.php');
			break;
		default:
			include('pages/signin.php');
			break;
	}

	include 'pages/footer.php';
?>