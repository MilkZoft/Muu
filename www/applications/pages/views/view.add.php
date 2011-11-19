<?php 
	if(!defined("_access")) { 
		die("Error: You don't have permission to access here..."); 
	} 
	
	if(isset($data)) {
		$ID  	   = recoverPOST("ID", 	      $data[0]["ID_Page"]);
		$title     = recoverPOST("title",     $data[0]["Title"]); 
		$content   = recoverPOST("content",   $data[0]["Content"]);
		$situation = recoverPOST("situation", $data[0]["Situation"]);
		$principal = recoverPOST("principal", $data[0]["Principal"]);
		$language  = recoverPOST("language",  $data[0]["Language"]);
		$edit      = TRUE;
		$action    = "edit";
		$href	   = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . $action . _sh . $ID . _sh;
	} else {
		$ID        = 0;
		$title     = recoverPOST("title");
		$content   = recoverPOST("content");
		$situation = recoverPOST("situation");
		$principal = recoverPOST("principal");
		$language  = recoverPOST("language");
		$edit      = FALSE;
		$action	   = "save";
		$href 	   = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "add" . _sh;
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("type" => "text", "name" => "title", "class" => "input required", "field" => __("Title"), "p" => TRUE, "value" => $title));

			print formTextarea(array("id" => "editor", "name" => "content", "class" => "textarea", "field" => __("Content"), "p" => TRUE, "value" => $content));

			print isset($imagesLibrary)    ? $imagesLibrary    : NULL;
			print isset($documentsLibrary) ? $documentsLibrary : NULL;

			print formField(NULL, __("Languages") ."<br />". getLanguageRadios($language));
			
			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __("Yes"),
						"selected" => ((int) $principal === 1) ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __("No"),
						"selected" => ((int) $principal === 0) ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "principal", "class" => "select", "p" => TRUE, "field" => __("Principal")), $options);

			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
						"selected" => ($situation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __("Inactive"),
						"selected" => ($situation === "Inactive") ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __("Situation")), $options);

			print formSave($action);

			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);
