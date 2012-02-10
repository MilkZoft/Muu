$(document).ready( function (){
	
	$("#deleteMural").click(function(){
		if(confirm("¿Eliminar imagen de Mural?")){
			$("#form-add").attr("action", url);
		} else {
			return false;
		}
	});
	
	$("#lock").css("background-image", "url(http://localhost/muucms/applications/cpanel/views/images/lock-icon.png)");
	
	$("#lock").mouseover(function() {
		$(this).css("background-image", "url(\"http://localhost/muucms/applications/cpanel/views/images/lock-off-icon.png\"");
	});
	
	$("#lock").mouseout(function() {
		$(this).css("background-image", "url(\"http://localhost/muucms/applications/cpanel/views/images/lock-icon.png\"");
	});
	
});


