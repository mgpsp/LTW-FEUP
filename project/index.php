<?php
	session_start();
	include('pages/header.php');

	if (!isset($_SESSION['username']))
		$_SESSION['username'] = null;

	$redirectTo = isset($_GET['page']) ? $_GET['page'] : 'signIn';

	$loginRequired = array('main', 'event', 'search', 'userevents', 'settings');

	foreach ($loginRequired as $page) {
		if ($redirectTo == $page && $_SESSION['username'] == null) {
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
		case 'search':
			if (isset($_GET['type']))
				$type=$_GET['type'];

			if (isset($_GET['val']))
				$val = $_GET['val'];

			if (isset($_GET['filter']))
				$filter = $_GET['filter'];
			include('pages/search.php');
			break;
		case 'userevents':
			if (isset($_GET['filter']))
				$filter=$_GET['filter'];

			include('pages/userevents.php');
			break;
		case 'settings':
			include('pages/settings.php');
			break;
		default:
			include('pages/signin.php');
			break;
	}

	include 'pages/footer.php';
?>