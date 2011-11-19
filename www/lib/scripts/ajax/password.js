$("#lock").click(function () {
	
	var post = {
			"ID_Post" :  $("#id_post").val()
		}

	$.ajax({
		type: "POST",
		url: PATH + "/ajax/removepassword",
		data: post,
		dataType: "json",
		beforeSend: function(jqXHR, settings){
		
		},
		
		success: function(response, textStatus, jqXHR) {
			if(response["response"] != false) {
				$("#lock").remove();
				$("#pass-hidden").removeClass("no-display");
				$(".addflag").append('<input name="pwd" type="text" tabindex="6" class="input" />');																		
			}
		},
		
		error: function(jqXHR, textStatus){
			
		},
		
		complete: function(jqXHR, textStatus){
			
		}
		
	});
});
