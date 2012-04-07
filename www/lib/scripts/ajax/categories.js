function setCategory() {	
	var post = {
			"category"    : $("#category").val(),
			"application" : $("#application").val(),
			"parent" 	  : $('[name="parent"]:checked').val(),
			"language"    : $('[name="language_category"]').val()
		}

	$.ajax({
		type 	 : "POST",
		url		 : PATH + "/categories/ajax/setcategory",
		data  	 : post,
		dataType : "json",
		
		success: function(response, textStatus, jqXHR) {
			if(response["response"] != false) {						
				$("#div-categories").html(response["response"]["c1"]);					
				$("#div-categories-radio").html(response["response"]["c2"]);													
			}
		},
	});
}
