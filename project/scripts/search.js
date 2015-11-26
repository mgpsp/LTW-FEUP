window.onload = function() {
	$(document).ready(function() {
	    $('#search-box').keydown(function(event) {
	        if (event.keyCode == 13) {
	            this.form.submit();
	            return false;
	         }
	    });
	  });
};