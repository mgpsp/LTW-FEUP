<?php
	include_once('database/connection.php');
	include_once('database/news.php');
	$result = getAllNews();
	
	foreach( $result as $row) {
		$newsLink = "http://gnomo.fe.up.pt/~up201305998/exercise3/news_item.php?id=" . $row['id'];
		$commentsLink = "http://gnomo.fe.up.pt/~up201305998/exercise3/news_item.php?id=" . $row['id'] . "#comments";
?>
	<div class="news-item">
		<h3><?php echo $row['title'] ?></h3>
		<img src="http://ipsumimage.appspot.com/300x200,ff7700" alt="300x200">
		<p class="introduction"><?php echo $row['introduction'] ?></p>
		<ul>
			<li><a href=<?php echo $newsLink?>>see more</a></li>
			<li><a href=<?php echo $commentsLink?>>comments (2)</a></li>
			<li><a href="partilhar1.html">share</a></li>
		</ul>
	</div>
	<?php } ?>