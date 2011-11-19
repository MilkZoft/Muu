<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 
		
if(isset($message)) {
	print '<div class="error-box">';
		print '<p class="error-message bold">No existen Comentarios Registrados</p>';
	print '</div>';
} else {
	print isset($search) 	 ? $search 	   : NULL;
	print isset($table) 	 ? $table 	   : NULL;
	print isset($pagination) ? $pagination : NULL;
}
