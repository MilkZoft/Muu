<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}
	
	if(isset($data)) {		
		$ID  	   = recoverPOST("ID",        $data[0]["ID_Ad"]);
		$title     = recoverPOST("title",     $data[0]["Title"]);
		$URL       = recoverPOST("URL",       $data[0]["URL"]);
		$banner    = recoverPOST("banner",    $data[0]["Banner"]);
		$position  = recoverPOST("position",  $data[0]["Position"]);
		$code      = recoverPOST("code",      $data[0]["Code"]);
		$time 	   = recoverPOST("time",      $data[0]["Time"]);
		$situation = recoverPOST("situation", $data[0]["Situation"]);
		$principal = recoverPOST("principal", $data[0]["Principal"]);
		$edit      = TRUE;	
		$action	   = "edit";
		$href	   = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . $action . _sh . $ID . _sh;
	} else {
		$ID        = 0;
		$title     = recoverPOST("title");
		$URL       = "http://";
		$position  = recoverPOST("position");
		$code      = recoverPOST("code");
		$time 	   = recoverPOST("time");
		$situation = recoverPOST("situation");
		$principal = recoverPOST("principal");
		$edit      = FALSE;
		$action	   = "save";
		$href 	   = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "add" . _sh;
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "title", "class" => "input required", "field" => __("Title"), "p" => TRUE, "value" => $title));
			
			if(isset($banner)) { 
				print p(a(__("View Banner"), _webURL . _sh . $banner, FALSE, array("class" => "banner-lightbox")), "field");
			} 

			print formInput(array("type" => "file", "name" => "image", "class" => "input", "field" => __("Image"), "p" => TRUE));

			$options = array(
				0 => array(
						"value"    => "Top",
						"option"   => __("Top") . " (960x100px)",
						"selected" => ($position === "Top") ? TRUE : FALSE
					),

				1 => array(
						"value"    => "Left",
						"option"   => __("Left") . " (120x600px, 250x250px)",
						"selected" => ($position === "Left") ? TRUE : FALSE
					),

				2 => array(
						"value"    => "Right",
						"option"   => __("Right") . " (120x600px, 250x250px)",
						"selected" => ($position === "Right") ? TRUE : FALSE
					),

				3 => array(
						"value"    => "Bottom",
						"option"   => __("Bottom") . " (960x100px)",
						"selected" => ($position === "Bottom") ? TRUE : FALSE
					),

				4 => array(
						"value"    => "Center",
						"option"   => __("Center") . " (600x100px)",
						"selected" => ($position === "Center") ? TRUE : FALSE
					),
			);

			print formSelect(array("name" => "position", "class" => "select", "p" => TRUE, "field" => __("Position")), $options);
			
			print formInput(array("name" => "URL", "class" => "input required", "field" => __("URL"), "p" => TRUE, "value" => $URL));
			
			print formTextarea(array("name" => "code", "class" => "textarea", "style" => "height: 200px;", "field" => __("Code"), "p" => TRUE, "value" => $code));

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
