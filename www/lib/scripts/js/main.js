$(document).on("ready", function() {
	$("#alert-message").delay(5000).fadeOut(2000);

	$("#alert-message").on("click", function() {
		$("#alert-message").hide();
	});
});