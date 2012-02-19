var timeads = 4000;
var temp    = 0;
 
$(document).ready(function() {
	$(".ads").hide();
	$(".principal").show();	
	
	$('.div-ads').each(function(index) {
		var length = $("#" + $(this).attr("id") + " .ads").length;
			
		if(length > 1) {
			setTimeout("ads('#" + $(this).attr("id") + "')", timeads);
		}
	});
});

function ads(position) {
	var length = $(position + ' .ads').length;
	var random = Math.floor(Math.random() * length);
	
	if(random < length && random > length) {
		ads("'" + position + "'");
	} else if(random == temp) {
		ads(position);
	} else {
		temp = random;

		$(position + ' .ads').hide();
		$(position + ' .ads').eq(random).fadeIn("slow");
		
		setTimeout("ads('" + position + "')", timeads);
	}
}
