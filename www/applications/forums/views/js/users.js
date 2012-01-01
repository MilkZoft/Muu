$(document).ready(function() {
	
	$('.signIn').click(function() {
		var url = document.URL;
		$(this).colorbox({width:"30%", height:"70%", iframe:true, onClosed:function(){location.href=url;}});
	});
	
	$('.signUp').click(function() {
		var url = document.URL;
		$(this).colorbox({width:"35%", height:"75%", iframe:true, onClosed:function(){location.href=url;}});
	});

});
