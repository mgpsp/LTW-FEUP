document.getElementById("add-event-button").onclick = function () {
	$('#add-event-button').fadeOut(200);
	$('#add-event').animate({
		height: '200px'
	}, 800, function() {
    // Animation complete.
  });
}