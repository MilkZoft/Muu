<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$name         = recoverPOST("name", $data[0]["Name"]);
	$sloganEn     = recoverPOST("slogan_en", $data[0]["Slogan_English"]);
	$sloganEs     = recoverPOST("slogan_es", $data[0]["Slogan_Spanish"]);
	$sloganFr     = recoverPOST("slogan_fr", $data[0]["Slogan_French"]);
	$sloganPt     = recoverPOST("slogan_pt", $data[0]["Slogan_Portuguese"]);
	$URL	 	  = recoverPOST("URL", $data[0]["URL"]);
	$language     = recoverPOST("language", $data[0]["Language"]);
	$theme	      = recoverPOST("theme", $data[0]["Theme"]);
	$gallery	  = recoverPOST("gallery", $data[0]["Gallery"]);
	$validation   = recoverPOST("validation", $data[0]["Validation"]);
	$application  = recoverPOST("application", $data[0]["Application"]);
	$message	  = recoverPOST("message", $data[0]["Message"]);
	$activation   = recoverPOST("activation", $data[0]["Activation"]);
	$emailRecieve = recoverPOST("email1", $data[0]["Email_Recieve"]);
	$emailSend    = recoverPOST("email2", $data[0]["Email_Send"]);
	$situation    = recoverPOST("situation", $data[0]["Situation"]);	
	$action	      = "edit";
	$href		  = path($this->application ."/cpanel/edit");

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(
								"name" 	=> "name", 
								"class" => "required span10", 
								"field" => __(_("Name of the Website")), 
								"p" 	=> TRUE, 
								"value" => $name));

			print formInput(array(
								"name" 	=> "URL", 
								"class" => "required span10", 
								"field" => __(_("URL of the Website")), 
								"p" 	=> TRUE, 
								"value" => $URL));

			print formInput(array(
								"name" 	=> "slogan_spanish", 
								"class" => "required span10", 
								"field" => getLanguage("Spanish", TRUE) ." ". __(_("Slogan of the Website")), 
								"p" 	=> TRUE, 
								"value" => $sloganEs));
			
			print formInput(array(
								"name" 	=> "slogan_english", 
								"class" => "required span10", 
								"field" => getLanguage("English", TRUE) ." ". __(_("Slogan of the Website")), 
								"p" 	=> TRUE, 
								"value" => $sloganEn));							
		
			print formInput(array(
								"name" 	=> "slogan_french", 
								"class" => "required span10", 
								"field" => getLanguage("French", TRUE) ." ". __(_("Slogan of the Website")), 
								"p" 	=> TRUE, 
								"value" => $sloganFr));	
			
			print formInput(array(
								"name" 	=> "slogan_portuguese", 
								"class" => "required span10", 
								"field" => getLanguage("Portuguese", TRUE) ." ". __(_("Slogan of the Website")), 
								"p" 	=> TRUE, 
								"value" => $sloganPt));
			
			print formInput(array(
								"name" 	=> "email_recieve", 
								"class" => "required span10", 
								"field" => __(_("E-Mail for recieve notifications")), 
								"p" 	=> TRUE, 
								"value" => $emailRecieve));

			print formInput(array(
								"name" 	=> "email_send", 
								"class" => "required span10", 
								"field" => __(_("Email for send notifications")), 
								"p" 	=> TRUE, 
								"value" => $emailSend));

			print formSelect(array(
								"name" 	=> "theme", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Default theme"))), $themes);
			
			print formSelect(array(
								"name" 	=> "application", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Default application"))), $defaultApplications);	
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __(_("Active")),
						"selected" => ($validation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __(_("Inactive")),
						"selected" => ($validation === "Inactive") ? TRUE : FALSE
					)
			);

			print formSelect(array(
								"name" 	=> "validation", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Comments validations"))), $options);
			
			$options = array(
				0 => array(
						"value"    => "User",
						"option"   => __(_("User")),
						"selected" => ($activation === "User") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Admin",
						"option"   => __(_("Administrator")),
						"selected" => ($activation === "Admin") ? TRUE : FALSE
					)
			);

			print formSelect(array(
								"name" 	=> "activation", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Accounts activation"))), $options);
			
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

			print formSelect(array(
								"name" 	=> "situation", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Situation"))), $options);			
			
			print formTextarea(array(
								"id" 	=> "editor", 
								"name" 	=> "message", 
								"class" => "required span10", 
								"field" => __(_("Message when the Website is inactive")), 
								"p" 	=> TRUE, 
								"value" => $message));
			
			print formField(NULL, __(_("Languages")) ."<br />". getLanguageRadios($language));
			
			print formSave("edit");

		print formClose();
	print div(FALSE);