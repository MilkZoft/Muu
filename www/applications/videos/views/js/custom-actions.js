$(document).on("ready", function(){
	
	
	var showFields = function () {
		var displayElement = "";
		
		if($("#URL").val() !== "") { 
			displayElement = "none";
			$("#videos").slideUp('medium');
		} else if($("#URL").val() == "") {	
			displayElement = "block";
			$("#videos").slideDown('medium');
		}
		
		$('#seek').css("display", displayElement);
		$('#nextresults').css("display", displayElement);
	
	}
	
	
	var disableURLfield = function() {
		var counter = 0;

		$('input[type="checkbox"]:checked').each( function() {
			counter++;
		});
		
		if(counter > 0) {
			$("#URL").attr("disabled", "disabled");
		} else {
			$("#URL").removeAttr("disabled");
		}
	
	};
	
	
	showFields();
	disableURLfield();
	$("#URL").keyup(showFields);
	$('input[type="checkbox"]').live("click", disableURLfield);
	$('input[name="search"]').live("click", function(){
		$("#URL").removeAttr("disabled");
	});

	var matches = $('#URL').val();
	var filter = /^http:\/\/(?:www\.)?youtube.com\/watch\?(?=.*v=\w+)(?:\S+)?$/;
	
	filter.test(matches);
	
	if(filter == true) {
	
	}

});
