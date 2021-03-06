<?php
	session_start();
	include('pages/header.php');

	$redirectTo = isset($_GET['page']) ? $_GET['page'] : 'signIn';

	$loginRequired = array('main', 'event', 'search', 'userevents', 'settings', 'profile', 'about');

	if (!isset($_SESSION['username']))
		$_SESSION['username'] = null;
	else if ($redirectTo === 'signIn')
		header("Location: index.php?page=main");

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

			if (isset($_GET['userid']))
				$userid = $_GET['userid'];

			include('pages/userevents.php');
			break;
		case 'settings':
			include('pages/settings.php');
			break;
		case 'profile':
			if (isset($_GET['userid']))
				$userid=$_GET['userid'];
			include('pages/userprofile.php');
			break;
		case 'about':
			include('pages/about.php');
			break;
		default:
			include('pages/notfound.php');
			break;
	}

	include 'pages/footer.php';
?>