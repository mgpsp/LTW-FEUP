
<!DOCTYPE html>
<html>
	<head>
		<title>CSS Exercise</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style1.css">
	</head>
	<body>
		<div id="header">
			<h1>Online Newspaper</h1>
			<h2>CSS Exercise</h2>
		</div>
		<div id="menu">
			<ul>
				<li><a href="">Politics</a></li>
				<li><a href="">Sports</a></li>
				<li><a href="">World</a></li>
				<li><a href="">Education</a></li>
				<li><a href="">Society</a></li>
			</ul>
		</div>
		<div id="content">
			<?php
				include_once('database/connection.php');
				global $db;
				$stmt = $db->prepare('SELECT * FROM news WHERE id = ?');
				$stmt->execute(array($_GET['id']));
				$result = $stmt->fetch();
			?>
			<div class="news-item">
				<h3><?php echo $result['title'] ?></h3>
				<img src="http://ipsumimage.appspot.com/300x200,ff7700" alt="300x200">
				<p class="introduction"><?php echo $result['introduction'] ?></p>
			</div>
			<div id="comments">
				<h3>Comments</h3><br>
				<?php
				$db = new PDO('sqlite:news.db');
				
				$stmt = $db->prepare('SELECT * FROM comments WHERE news_id = ?');
				$stmt->execute(array($_GET['id']));  
				$result = $stmt->fetchAll();
				
				foreach( $result as $row) {
				?>
				<h2><?php echo $row['author'] ?></h3>
				<p><?php echo $row['text'] ?></p><br>
				<?php } ?>
			</div>
		</div>
		<div id="footer">
			<p>CSS Exercises @ FEUP - 2013</p>
		</div>
	</body>
</html>

