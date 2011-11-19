<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "title", "class" => "input required", "field" => __("Title"), "p" => TRUE, "value" => $title));

			print formInput(array("name" => "URL", "class" => "input required", "field" => __("URL"), "p" => TRUE, "value" => $URL));
			
			print formInput(array("name" => "description", "class" => "input", "field" => __("Description"), "p" => TRUE, "value" => $description));
			
			$options = array(
				0 => array("value" => 1, "option" => __("Yes"), "selected" => ($follow == 1) ? TRUE : FALSE),
				1 => array("value" => 0, "option" => __("No"),  "selected" => ($follow == 0) ? TRUE : FALSE)
			);

			print formSelect(array("name" => "follow", "class" => "select", "p" => TRUE, "field" => __("Follow")), $options);

			$options = array(
				0 => array("value" => "Web Friends", "option" => __("Web Friends"), "selected" => ($position === "Web Friends") ? TRUE : FALSE),
				1 => array("value" => "Directory", "option" => __("Directory"),   "selected" => ($position === "Directory")   ? TRUE : FALSE)
			);

			print formSelect(array("name" => "position", "class" => "select", "p" => TRUE, "field" => __("Position")), $options);
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __("Situation")), $options);
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);
