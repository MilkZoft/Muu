<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array("name" => "name", "class" => "input", "field" => __("Name of the Website"), "p" => TRUE, "value" => $name));

			print formInput(array("name" => "URL", "class" => "input", "field" => __("URL of the Website"), "p" => TRUE, "value" => $URL));

			print formInput(array("name" => "slogan_spanish", "class" => "input", "field" => getLanguage("Spanish", TRUE) ." ". __("Slogan of the Website"), "p" => TRUE, "value" => $sloganEs));
			
			print formInput(array("name" => "slogan_english", "class" => "input", "field" => getLanguage("English", TRUE) ." ". __("Slogan of the Website"), "p" => TRUE, "value" => $sloganEn));							
		
			print formInput(array("name" => "slogan_french", "class" => "input", "field" => getLanguage("French", TRUE) ." ". __("Slogan of the Website"), "p" => TRUE, "value" => $sloganFr));	
			
			print formInput(array("name" => "slogan_portuguese", "class" => "input", "field" => getLanguage("Portuguese", TRUE) ." ". __("Slogan of the Website"), "p" => TRUE, "value" => $sloganPt));
			
			print formInput(array("name" => "email_recieve", "class" => "input", "field" => __("E-Mail for recieve notifications"), "p" => TRUE, "value" => $emailRecieve));

			print formInput(array("name" => "email_send", "class" => "input", "field" => __("Email for send notifications"), "p" => TRUE, "value" => $emailSend));

			print formSelect(array("name" => "theme", "class" => "select", "p" => TRUE, "field" => __("Default theme")), $themes);
			
			print formSelect(array("name" => "application", "class" => "select", "p" => TRUE, "field" => __("Default application")), $defaultApplications);			
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
						"selected" => ($validation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __("Inactive"),
						"selected" => ($validation === "Inactive") ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "validation", "class" => "select", "p" => TRUE, "field" => __("Comments validations")), $options);
			
			$options = array(
				0 => array(
						"value"    => "User",
						"option"   => __("User"),
						"selected" => ($activation === "User") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Admin",
						"option"   => __("Administrator"),
						"selected" => ($activation === "Admin") ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "activation", "class" => "select", "p" => TRUE, "field" => __("Accounts activation")), $options);
			
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
			
			print formTextarea(array("id" => "editor", "name" => "message", "class" => "input", "field" => __("Message when the Website is inactive"), "p" => TRUE, "value" => $message));
			
			print formField(NULL, __("Languages") ."<br />". getLanguageRadios($language));
			
			print formSave("edit");

		print formClose();
	print div(FALSE);
