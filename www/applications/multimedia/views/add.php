<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) 			 : 0;
	$ID_URL    = isset($data) ? recoverPOST("ID_URL", $data[0]["ID_URL"]) 		 : recoverPOST("ID_URL");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$content   = isset($data) ? recoverPOST("content", $data[0]["Content"]) 	 : recoverPOST("content");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$pwd   	   = isset($data) ? recoverPOST("pwd", $data[0]["Pwd"])				 : recoverPOST("pwd");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	
	print div("add-form", "class");
		print formOpen($href, "form-add", "multimedia");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(
				"type" 		=> "file", 
				"id"		=> "fileselect",
				"name" 		=> "fileselect[]",
				"multiple" 	=> "multiple", 
				"class" 	=> "required", 
				"field" 	=> __(_("Upload files")), 
				"p" 		=> TRUE
			));

			print div("filedrag"); 
				print __(_("Drag & drop your files here"));
			print div(FALSE);

			print div("progress") . div(FALSE);

			print div("response") . div(FALSE);

			print '<div class="clear"></div>';

			if($uploaded) {
				print formSave($action);
			}
			
			print formInput(array("name" => "upload", "type" => "hidden", "value" => path(whichApplication() ."/cpanel/upload"), "id" => "upload"));
			print formInput(array("name" => "MAX_FILE_SIZE", "type" => "hidden", "value" => "MAX_FILE_SIZE", "id" => "upload"));
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		print formClose();
	print div(FALSE);