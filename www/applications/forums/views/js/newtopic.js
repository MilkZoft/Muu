$(document).ready(function() {
	
	$('.newTopic').click(function() {
		var url = document.URL;
		$(this).colorbox({width:"50%", height:"72%", iframe:true, onClosed:function(){location.href=url;}});
	});

});
