<?php 
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Tags_Model extends ZP_Model {
				
	public function __construct() {
		$this->Db = $this->db();

		$helpers = array("alerts", "router");
		$this->helper($helpers);
		
		$this->language = whichLanguage();
		$this->table 	= "tags";
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
					
				$this->Db->table("tags");

				$seek = $this->Db->findBy("Slug", $slug);
				
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
				
				$this->Db->table("re_tags_applications");

				$seek = $this->Db->findBySQL("ID_Application = '$application' AND ID_Tag = '$ID_Tag'");
				
				if(!$seek) {
					$data = array(
						"ID_Application" => $application,
						"ID_Tag"		 => $ID_Tag
					);

					$ID_Tag2Application = $this->Db->insert("re_tags_applications", $data);								
				} else {
					$ID_Tag2Application = $seek[0]["ID_Tag2Application"];
				}
					
				$this->Db->table("re_tags_records");

				$seek = $this->Db->findBySQL("ID_Tag2Application = '$ID_Tag2Application' AND ID_Record = '$ID'");
				
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
