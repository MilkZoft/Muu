<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data[0]["ID_Link"]) 				: 0;
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"]) 				: recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) 	: recoverPOST("description";
	$URL         = isset($data) ? recoverPOST("URL", $data[0]["URL"]) 					: recoverPOST("URL";
	$follow      = isset($data) ? recoverPOST("follow", $data[0]["Follow"]) 			: recoverPOST("follow");
	$position    = isset($data) ? recoverPOST("position", $data[0]["Position"]) 		: recoverPOST("position");
	$situation   = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 		: recoverPOST("situation");
	$edit        = isset($data) ? TRUE 													: FALSE;
	$action	     = isset($data) ? "edit"												: "save";
	$href	     = isset($data) ? path($this->application ."/cpanel/edit/$ID") 			: path($this->application ."/cpanel/add/");
	
	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "title", "class" => "input required", "field" => __(_("Title")), "p" => TRUE, "value" => $title));

			print formInput(array("name" => "URL", "class" => "input required", "field" => __(_("URL")), "p" => TRUE, "value" => $URL));
			
			print formInput(array("name" => "description", "class" => "input", "field" => __(_("Description")), "p" => TRUE, "value" => $description));
			
			$options = array(
				0 => array("value" => 1, "option" => __(_("Yes")), "selected" => ($follow == 1) ? TRUE : FALSE),
				1 => array("value" => 0, "option" => __(_("No")),  "selected" => ($follow == 0) ? TRUE : FALSE)
			);

			print formSelect(array("name" => "follow", "class" => "select", "p" => TRUE, "field" => __(_("Follow"))), $options);

			$options = array(
				0 => array("value" => "Web Friends", "option" => __(_("Web Friends")), "selected" => ($position === "Web Friends") ? TRUE : FALSE),
				1 => array("value" => "Directory", "option" => __(_("Directory")),   "selected" => ($position === "Directory")   ? TRUE : FALSE)
			);

			print formSelect(array("name" => "position", "class" => "select", "p" => TRUE, "field" => __(_("Position"))), $options);
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __(_("Situation"))), $options);
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);