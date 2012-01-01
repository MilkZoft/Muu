var delay 	     = 500;
var search_timer = null;

$(".noresults").hide();
$(".loadgif").hide();

$("#inputsearch").click( function() {
	if($("input[name='search']").val() != "") {
		var post = { "search" : $("input[name='search']").val()};
		
		$("#videos").html('');
		search(post, "/videos/ajax/search");
	}
});

$("input[name='search']").keypress(function(event) {
	if(event.which == 13) {
		$("#inputsearch").click();
		return false;
	} else {
		clearTimeout(search_timer);
		search_timer = setTimeout(click, delay);
	}
});

$("#nextresults").click( function() {
	var post = { "next" : $("input[name='next']").val()};
	search(post, "/videos/ajax/next");
});

function click() {
	$("#inputsearch").click();
}

function search(post, url) {
	$.ajax({
		type: "POST",
		url: PATH + url,
		data: post,
		dataType: "json",
		beforeSend: function(jqXHR, settings){
			$("input[name='nextresults']").hide();
			$(".loadgif").show();
		},
		
		success: function(response, textStatus, jqXHR) {
			var videos = response["response"];
			
			if(videos != false && videos["videos"] != false) {
				for(var i in videos["videos"]) {
					$("#videos").append(getObject(videos["videos"][i]));
				}
				
				if(videos["next"] != false) {
					$("input[name='nextresults']").removeClass("no-display");
					
					$("input[name='next']").val(videos["next"]);
				} else {
					$("input[name='nextresults']").addClass("no-display");
				}
			} else {
				$("input[name='nextresults']").addClass("no-display");
			}
		},
		
		error: function(jqXHR, textStatus){
			
		},
		
		complete: function(jqXHR, textStatus){
			$(".loadgif").hide();
			$("input[name='nextresults']").show();
		}
	});
}

function getObject(data) {
	var video     = '<div class="video"><p class="titleVideo">'
	
	video = video + '<input type="checkbox" value="'+data["id"]+'" name="videos[]">';
	video = video + '<a href="#" title="'+data["title"]+'">';
	video = video + data["cut"]+'</a></p>';
	
	video = video + '<iframe width="195" height="200"';
	video = video + ' src="http://www.youtube.com/embed/' + data["id"] + '"';
	video = video + ' frameborder="0" allowfullscreen></iframe>';
	
	video = video + '</div>';
	
	return video;
}
