<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "username", "class" => "input required", "field" => __("Username"), "p" => TRUE, "value" => $username));
			
			print formInput(array("name" => "pwd", "type" => "password", "class" => "input required", "field" => __("Password"), "p" => TRUE, "value" => $pwd));

			print formInput(array("name" => "pwd2", "type" => "hidden", "value" => $pwd));
	
			print formInput(array("name" => "email", "class" => "input required", "field" => __("Email"), "p" => TRUE, "value" => $username));
			
			$i = 0;
			
			foreach($privileges as $value) { 
				$options[$i]["value"]    = $value["ID_Privilege"];
				$options[$i]["option"]   = $value["Privilege"];
				$options[$i]["selected"] = ($value["ID_Privilege"] === $privilege) ? TRUE : FALSE;

				$i++;
			} 

			print formSelect(array("name" => "privilege", "class" => "select", "p" => TRUE, "field" => __("Privilege")), $options);
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __("Situation")), $options);
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);