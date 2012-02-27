$(document).on("ready", function(){
	
	$("#URL").keyup( function(){
		if($("#URL").val() !== "") $("#videos").slideUp('medium');
		if($("#URL").val() == "") $("#videos").slideDown('medium');
	});
	
	var matches = $('#URL').val();
		var filter = /^http:\/\/(?:www\.)?youtube.com\/watch\?(?=.*v=\w+)(?:\S+)?$/;

	alert(filter.test(matches));

});
