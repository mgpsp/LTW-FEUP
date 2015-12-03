document.getElementById('comment-box').onclick = function() {
	document.getElementById('post-button').style.display = 'block';
}

document.getElementById('edit-event').onclick = function() {
	$('#dim').fadeIn(150);
	$('#add-event-form').fadeIn(150);
}