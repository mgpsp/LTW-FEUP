<!DOCTYPE html>
<html>
	<head>
		<title>Edit news</title>
		<meta charset="UTF-8">
		<link rel="stylesheet">
	</head>
	<body>
		<?php
				include_once('database/connection.php');
				global $db;
				$stmt = $db->prepare('SELECT * FROM news WHERE id = ?');
				$stmt->execute(array($_GET['id']));
				$result = $stmt->fetch();
		?>
		<form action="http://gnomo.fe.up.pt/~up201305998/exercise3/action_edit_news.php" method="get" id="edit">
			<input type="hidden" name="id" value="<?php $_GET['id']?>">
			Title: <input type="text" name="title" value="<?php echo $result['title'] ?>">
			<p>
			Introduction: <br> <textarea rows="10" cols="70" name="intro" form="edit" ><?php echo $result['introduction'] ?></textarea>
			<p>
			Text: <br> <textarea rows="20" cols="70" name="fulltext" form="edit" ><?php echo $result['fulltext'] ?></textarea>
			<p>
			<input type="submit" value="Edit">
		</form>
	</body>
</html>