$(document).ready(function() {
	
	$("#alert-message").delay(5000).fadeOut(2000);

	$("#alert-message").click(function() {
		$("#alert-message").fadeOut("slow");
	});
});