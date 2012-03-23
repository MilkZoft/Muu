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
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __(_("Title")), 
				"p" 	=> TRUE, 
				"value" => $title
			));

			print formTextarea(array(	
				"id" 	 => "editor", 
				"name" 	 => "content", 
				"class"  => "span10",
				"style"  => "height: 400px;", 
				"field"  => __(_("Content")), 
				"p" 	 => TRUE, 
				"value"  => $content
			));

			$vars["application"]     = isset($application)     ? $application 		: NULL; 
			$vars["categories"]      = isset($categories) 	   ? $categories 		: NULL; 	  
			$vars["categoriesRadio"] = isset($categoriesRadio) ? $categoriesRadio	: NULL; 
				
			$this->view("categories", $vars, "categories");

			print isset($imagesLibrary)    ? $imagesLibrary : NULL;
			print isset($documentsLibrary) ? $documentsLibrary : NULL; 

			?>
			<div id="file-uploader">		
				<noscript>			
					<p>Please enable JavaScript to use file uploader.</p>
					<!-- or put a simple form for upload here -->
				</noscript>         
			</div>
			<?php
				
			if(isset($tags)) {
				$var["tags"] = $tags;
			
				$this->view("tags", $var, "tags");
			} else { 
				$this->view("tags", NULL, "tags");
			}
			
			print formField(NULL, __(_("Language of the post")) ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => 1, "option" => __(_("Yes")), "selected" => TRUE),
				1 => array("value" => 0, "option" => __(_("No")))
			);

			print formSelect(array(
								"name" 	=> "enable_comments", 
								"class" => "required", 
								"p" 	=> TRUE, 
								"field" => __(_("Enable Comments"))), 
								$options);				
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")), 	  "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")),  "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array(
								"name" 	=> "situation", 
								"p" 	=> TRUE, 
								"class" => "required", 
								"field" => __(_("Situation"))), 
								$options);
						
			if(!isset($pwd)) { 
				print formInput(array(
									"name" 	=> "pwd", 
									"class" => "span10", 
									"field" => __(_("Password")), 
									"p" 	=> TRUE, 
									"value" => $pwd));	
			} else { 
				print formField(NULL, __(_("Password")) ."<br />");
				
				print formInput(array(
									"id" 	=> "lock", 
									"class" => "lock", 
									"type" 	=> "button"));
	
							
				print formInput(array(
									"id" 	=> "password", 
									"type" 	=> "hidden", 
									"value" => $pwd));
			}
			
			print formInput(array(
								"type" 	=> "file", 
								"name" 	=> "image", 
								"field" => __(_("Image for this post")), 
								"p" 	=> TRUE));

			if(isset($medium)) {
				print img(_webURL . _sh . $medium);
			}
			
			print formInput(array(
				"type" 	=> "file", 
				"name" 	=> "mural", 
				"class" => "required", 
				"field" => __(_("Mural image")) ." (". _muralSize .")", 
				"p" 	=> TRUE
			));
	
			if(isset($muralImage) and is_array($muralImage)) {
				print formInput(array(
									"type" 	=> "hidden", 
									"name" 	=> "mural_exist", 
									"class" => "span10", 
									"field" => __(_("Current mural image")), 
									"p" 	=> TRUE));
				
				print img(_webURL . _sh . $muralImage[0]["Image"], NULL, NULL, array("style" => "width: 98%; border: 1px solid #000;"));
                
                print $this->js("var URL = '$muralDeleteURL';", TRUE);
 				
 				print formInput(array(
									"type" 	=> "submit", 
									"id" 	=> "delete_mural", 
									"name" 	=> "delete_mural_image", 
									"value" => __(_("Delete Mural")), 
									"class" => "btn error", 
									"p" 	=> TRUE));
			}
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		print formClose();
	print div(FALSE);