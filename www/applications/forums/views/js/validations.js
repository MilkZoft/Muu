$(document).ready(function() {
	$('#save').click(function() {
		var content = tinyMCE.get("editor").getContent();
		if(content.length == 0) {
			alert("Ingresa un contenido válido");
			return false;			
		}
	});
	
	$('#edit').click(function() {
		var content = tinyMCE.get("editor").getContent();
		if(content.length == 0) {
			alert("Ingresa un contenido válido");
			return false;			
		}
	});
});
