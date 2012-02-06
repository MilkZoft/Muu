<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}
	
	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Ad"]) 				: 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"]) 			: recoverPOST("title");
	$URL       = isset($data) ? recoverPOST("URL", $data[0]["URL"]) 				: "http://";		
	$position  = isset($data) ? recoverPOST("position", $data[0]["Position"]) 		: recoverPOST("position");
	$code      = isset($data) ? recoverPOST("code", $data[0]["Code"]) 				: recoverPOST("code");
	$time 	   = isset($data) ? recoverPOST("time", $data[0]["Time"]) 				: recoverPOST("time");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 	: recoverPOST("situation");
	$principal = isset($data) ? recoverPOST("principal", $data[0]["Principal"]) 	: recoverPOST("principal");
	$edit      = isset($data) ? TRUE 												: FALSE;	
	$action	   = isset($data) ? "edit" 												: "save";
	$href	   = isset($data) ? path(whichApplication() . "/cpanel/$action/$ID/") 	: path(whichApplication() ."/cpanel/add/");

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "title", "class" => "span10 required", "field" => __(_("Title")), "p" => TRUE, "value" => $title));
			
			if(isset($banner)) { 
				print p(a(__(_("View Banner")), _webURL . _sh . $banner, FALSE, array("class" => "banner-lightbox")), "field");
			} 

			print formInput(array("type" => "file", "name" => "image", "class" => "required", "field" => __(_("Image")), "p" => TRUE));

			$options = array(
				0 => array(
						"value"    => "Top",
						"option"   => __(_("Top")) ." (960x100px)",
						"selected" => ($position === "Top") ? TRUE : FALSE
					),

				1 => array(
						"value"    => "Left",
						"option"   => __(_("Left")) ." (120x600px, 250x250px)",
						"selected" => ($position === "Left") ? TRUE : FALSE
					),

				2 => array(
						"value"    => "Right",
						"option"   => __(_("Right")) ." (120x600px, 250x250px)",
						"selected" => ($position === "Right") ? TRUE : FALSE
					),

				3 => array(
						"value"    => "Bottom",
						"option"   => __(_("Bottom")) ." (960x100px)",
						"selected" => ($position === "Bottom") ? TRUE : FALSE
					),

				4 => array(
						"value"    => "Center",
						"option"   => __(_("Center")) ." (600x100px)",
						"selected" => ($position === "Center") ? TRUE : FALSE
					),
			);

			print formSelect(array("name" => "position", "class" => "required", "p" => TRUE, "field" => __(_("Position"))), $options);
			
			print formInput(array("name" => "URL", "class" => "span10 required", "field" => __(_("URL")), "p" => TRUE, "value" => $URL));
			
			print formTextarea(array("name" => "code", "class" => "span10 required", "style" => "height: 150px;", "field" => __(_("Code")), "p" => TRUE, "value" => $code));

			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __(_("Yes")),
						"selected" => ((int) $principal === 1) ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __(_("No")),
						"selected" => ((int) $principal === 0) ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "principal", "class" => "required", "p" => TRUE, "field" => __(_("Principal"))), $options);			
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __(_("Active")),
						"selected" => ($situation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __(_("Inactive")),
						"selected" => ($situation === "Inactive") ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "situation", "class" => "required", "p" => TRUE, "field" => __(_("Situation"))), $options);			
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);