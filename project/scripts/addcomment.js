document.getElementById('comment-box').onclick = function() {
	document.getElementById('post-button').style.display = 'block';
}

document.getElementById("cancel-button-edit").onclick = function () {
	$('#dim').fadeOut(150);
	$('#edit-event-form').fadeOut(150);
}