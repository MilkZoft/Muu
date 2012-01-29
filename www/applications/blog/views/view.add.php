<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(ucfirst(whichApplication())), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(	"name" 	=> "title", 
									"class" => "span14 required", 
									"field" => __("Title"), 
									"p" 	=> TRUE, 
									"value" => ($action === "edit") ? $title : recoverPOST("title")
			));

			print formTextarea(array(	"id" 	=> "editor", 
									 	"name" 	=> "content", 
									 	"class" => "span14",
									 	"style" => "height: 400px;", 
									 	"field" => __("Content"), 
									 	"p" 	=> TRUE, 
									 	"value" => ($action === "edit") ? $content : recoverPOST("content")
			));

			$vars["application"]     = isset($application)     ? $application 	  : NULL;
			$vars["categories"]      = isset($categories) 	   ? $categories   	  : NULL;
			$vars["categoriesRadio"] = isset($categoriesRadio) ? $categoriesRadio : NULL;
				
			$this->view("categories", $vars, "categories");

			print isset($imagesLibrary)    ? $imagesLibrary    : NULL;
			print isset($documentsLibrary) ? $documentsLibrary : NULL;
				
			if(isset($tags)) {
				$var["tags"] = $tags;
			
				$this->view("tags", $var, "tags");
			} else { 
				$this->view("tags", NULL, "tags");
			}
			
			print formField(NULL, __("Languages") ."<br />". getLanguageRadios($language));

			$options = array(
				0 => array("value" => 1, "option" => __("Yes"), "selected" => TRUE),
				1 => array("value" => 0, "option" => __("No"))
			);

			print formSelect(array("name" => "enable_comments", "p" => TRUE, "field" => __("Enable Comments")), $options);				
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array("name" => "situation", "p" => TRUE, "field" => __("Situation")), $options);
			
						
			if(!isset($pwd)) { 
				print formInput(array("name" => "pwd", "class" => "span14", "field" => __("Password"), "p" => TRUE, "value" => $pwd));	
			} else { 
				print formField(NULL, __("Password") ."<br />");
				print formInput(array("id" => "lock", "class" => "lock", "type" => "button"));
	
							
				print formInput(array("id" => "password", "type" => "hidden", "value" => $pwd));
			}
			
			print div("addflag", "class");
			print div(FALSE); 		

			print formInput(array("type" => "file", "name" => "image", "field" => __("Image for this post"), "p" => TRUE));

			if(isset($image_medium) and !is_null($image_medium)) {
				print img(_webURL . _sh . $image_medium);
			}
			
			print formInput(array("type" => "file", "name" => "mural", "field" => __("Mural image") ." (". _muralSize .")", "p" => TRUE));
	
			if(isset($muralImage) and is_array($muralImage)) {
				print formInput(array("type" => "hidden", "name" => "mural_exist", "class" => "span14", "field" => __("Current mural image"), "p" => TRUE));
				
				print img(_webURL . _sh . $muralImage[0]["Image"], NULL, NULL, array("style" => "width: 98%; border: 1px solid #000;"));
                
                print '	<script type="text/javascript">
                    		var URL = \''. $muralDeleteURL .'\';
                		</script>';
 				
 				print formInput(array("type" => "submit", "id" => "delete_mural", "name" => "delete_mural_image", "value" => __("Delete Mural"), "class" => "btn error", "p" => TRUE));
			}
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "id_post"));
		print formClose();
	print div(FALSE);
