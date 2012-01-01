$(document).ready(function() {
	$('.actionbutton a').hover(function() {
		$(this).removeClass('ui-icon');
		$(this).addClass('ui-icon-hover');
	} , function() {
		$(this).removeClass('ui-icon-hover');
		$(this).addClass('ui-icon');
	});
	
	$('.actionbutton2 a').hover(function() {
		$(this).removeClass('ui-icon');
		$(this).addClass('ui-icon-hover');
	} , function() {
		$(this).removeClass('ui-icon-hover');
		$(this).addClass('ui-icon');
	});
});
