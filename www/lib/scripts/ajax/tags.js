function setTags() {
	console.log;
	var tags = {
			"tags"        : $("#tags").val(),
			"application" : $("#application").val()
		}
		
	alert(tags);
	
	$.ajax({
		type: "POST",
		url: PATH + "/ajax/settags",
		data: tags,
		dataType: "json",
		beforeSend: function(jqXHR, settings) {
			
		},
		
		success: function(response, textStatus, jqXHR) {			
			$("#div-tags").append(response["response"]);
		},
		
		error: function(jqXHR, textStatus){
			
		},
		
		complete: function(jqXHR, textStatus){
			
		}
	});
}
