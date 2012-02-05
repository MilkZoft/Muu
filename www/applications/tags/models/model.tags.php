<?php 
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Tags_Model extends ZP_Model {
				
	public function __construct() {
		$this->Db = $this->db();

		$this->helpers();
		
		$this->language = whichLanguage();
		$this->table 	= "tags";
	}

	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {
		if(!$trash) {
			if(SESSION("ZanUserPrivilege") === _super) { 
				$data = $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave($action) {
		$validations = array(
			"exists"  => array(
							"Slug" 	   => slug(POST("title", "clean")), 
							"Year"	   => date("Y"),
							"Month"	   => date("m"),
							"Day"	   => date("d"),
							"Language" => POST("language")
						),
			"title"   => "required",
			"content" => "required"
		);
		
		$this->categories = POST("categories"); 
		$this->tags	  = POST("tags");
		$this->URL        = PATH("blog/". date("Y")) ."/". date("m") ."/". date("d") ."/". slug(POST("title", "clean"));
		$this->muralExist = POST("mural_exist");
				
		$this->Files = $this->core("Files");
		
		$this->mural = FILES("mural");
		
		if($this->mural["name"] !== "") {
			$dir = "www/lib/files/images/mural/";

			$this->mural = $this->Files->uploadImage($dir, "mural", "mural");
		
			if(is_array($this->mural)) {
				return $this->mural["alert"];
			}
		}
		
		$dir = "www/lib/files/images/blog/";
		
		$this->image = $this->Files->uploadImage($dir, "image", "resize", TRUE, TRUE, FALSE);

		$data = array(
			"ID_User"      => SESSION("ZanUserID"),
			"ID_URL"       => 1,
			"Slug"         => slug(POST("title", "clean")),
			"Content"      => POST("content", "clean"),
			"Author"       => SESSION("ZanUser"),
			"Year"	       => date("Y"),
			"Month"	       => date("m"),
			"Day"	       => date("d"),
			"Image_Small"  => isset($this->image["small"])  ? $this->image["small"]  : NULL,
			"Image_Medium" => isset($this->image["medium"]) ? $this->image["medium"] : NULL,
			"Pwd"	       => (POST("pwd")) ? POST("pwd", "encrypt") : NULL,
			"Start_Date"   => now(4),
			"Text_Date"    => now(2)
		);
	
		$this->Data->ignore(array("categories", "tags", "mural_exists", "mural", "pwd", "category", "language_category", "application", "mural_exist"));

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function getTags($application, $ID) {		
		$query = "	SELECT * FROM ". _dbPfx ."tags WHERE ". _dbPfx ."tags.ID_Tag IN (
        				SELECT ". _dbPfx ."re_tags_applications.ID_Tag FROM ". _dbPfx ."re_tags_applications 
        				WHERE ". _dbPfx ."re_tags_applications.ID_Application = $application AND ". _dbPfx ."re_tags_applications.ID_Tag2Application IN (
            				SELECT ". _dbPfx ."re_tags_records.ID_Tag2Application FROM ". _dbPfx ."re_tags_records WHERE ID_Record = $ID
        				)
    				);";
    	
    	$data = $this->Db->query($query);

		return $data;
	}
	
	public function getTagsByRecord($application, $ID, $formattedData = FALSE) {
		$query = "	SELECT * FROM ". _dbPfx ."tags WHERE ". _dbPfx ."tags.ID_Tag IN (
		        		SELECT ". _dbPfx ."re_tags_applications.ID_Tag FROM ". _dbPfx ."re_tags_applications 
		        		WHERE ". _dbPfx ."re_tags_applications.ID_Application = $application AND ". _dbPfx ."re_tags_applications.ID_Tag2Application IN (
		            		SELECT ". _dbPfx ."re_tags_records.ID_Tag2Application FROM ". _dbPfx ."re_tags_records WHERE ID_Record = $ID
		        		)
		    		);";

		$data = $this->Db->query($query);

		if($data) {
			if($formattedData) {
				foreach($data as $tag) {
					$tags[] = $tag["Title"];
				}
				
				$tags = implode(",", $tags);
				$data = $tags;
			}
		}
				
		return $data;
	}
	
	public function setTagsByRecord($application, $tags, $ID) {	
		if($tags) {
			/*$query = "	DELETE FROM ". _dbPfx ."re_tags_records 
						WHERE ". _dbPfx ."re_tags_records.ID_Record = '$ID' AND ". _dbPfx ."re_tags_records.ID_Tag2Application IN (
							SELECT ". _dbPfx ."re_tags_applications.ID_Tag2Application FROM ". _dbPfx ."re_tags_applications 
							WHERE ID_Application = '$application'
						)";*/
			
			#$this->Db->query($query);
			
			if(!is_array($tags)) {
				$tags = string2Array($tags);
			}
			
			foreach($tags as $tag) {
				$slug = slug(encode($tag));
					
				$seek = $this->Db->findBy("Slug", $slug, "tags");
				
				if(!$seek) {
					if($tag !== "") {
						$data = array(
							"Title" => $tag,
							"Slug" 	=> $slug
						);
					
						$ID_Tag = $this->Db->insert("tags", $data);
					}
				} else {
					$ID_Tag = $seek[0]["ID_Tag"];
				}
				
				$seek = $this->Db->findBySQL("ID_Application = '$application' AND ID_Tag = '$ID_Tag'", "re_tags_applications");
				
				if(!$seek) {
					$data = array(
						"ID_Application" => $application,
						"ID_Tag"		 => $ID_Tag
					);

					$ID_Tag2Application = $this->Db->insert("re_tags_applications", $data);								
				} else {
					$ID_Tag2Application = $seek[0]["ID_Tag2Application"];
				}
				
				$seek = $this->Db->findBySQL("ID_Tag2Application = '$ID_Tag2Application' AND ID_Record = '$ID'", "re_tags_records");
				
				if(!$seek) {
					$data = array(
						"ID_Tag2Application" => $ID_Tag2Application,
						"ID_Record"			 => $ID
					);
					
					$insertID = $this->Db->insert("re_tags_records", $data);							
				}
			}
		} else {
			$query = "	DELETE FROM ". _dbPfx ."re_tags_records 
						WHERE ". _dbPfx ."re_tags_records.ID_Record = '$ID' AND ". _dbPfx ."re_tags_records.ID_Tag2Application IN (
							SELECT ". _dbPfx ."re_tags_applications.ID_Tag2Application FROM ". _dbPfx ."re_tags_applications  
							WHERE ID_Application = '$application' AND ". _dbPfx ."re_tags_applications.ID_Tag2Application
						)";
			
			$this->Db->query($query);
		}

		return TRUE;
	}
	
}