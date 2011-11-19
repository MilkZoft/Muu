<?php 
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Categories_Model extends ZP_Model {
	
	private $data = FALSE;
	
	public function __construct() {
		$this->Db = $this->db();

		$helpers = array("alerts", "router");
		$this->helper($helpers);
		
		$this->language = whichLanguage();
		$this->table 	= "categories";
	}
	
	
	public function cpanel($action, $limit = NULL, $order = "ID_Category DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		$this->Db->table($this->table);
		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
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
				$data = $this->Db->findBySQL("State != 'Deleted'", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '".$_SESSION["ZanAdminID"]."' AND State != 'Deleted'", NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("State", "Deleted", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND State = 'Deleted'", NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave() {
		if(!POST("title")) {
			return getAlert("You need to write a title");
		}
		
		$this->title 	 = POST("title");
		$this->situation = POST("situation");
	}
		
	private function edit() {
		$this->Db->table($this->table);
		
		$this->Db->values("Title = '$this->title', Type = '$this->type', State = '$this->state'");								
		$this->Db->save($this->ID);
		
		$this->Db->table("polls_answers");
		$this->Db->deleteBySQL("ID_Poll = '$this->ID'");
		
		$this->Db->table("polls_answers", "ID_Poll, Answer");
		
		foreach($this->answers as $key => $answer) {
			if($answer !== "") {
				$this->Db->values("'$this->ID', '$answer'");
				$this->Db->save();
			}
		}
		
		return getAlert("The poll has been edit correctly", "success");
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function getCategoriesByRecord($application, $ID) {		
		$query = "	SELECT * FROM muu_categories WHERE ". _dbPfx ."categories.ID_Category IN (
        				SELECT ". _dbPfx ."re_categories_applications.ID_Category FROM ". _dbPfx ."re_categories_applications 
        					WHERE ". _dbPfx ."re_categories_applications.ID_Application = $application AND ". _dbPfx ."re_categories_applications.ID_Category2Application IN (
            					SELECT ". _dbPfx ."re_categories_records.ID_Category2Application FROM ". _dbPfx ."re_categories_records WHERE ID_Record = $ID
        					)

    				);";

		$data = $this->Db->query($query);

		return $data;
	}
	
	public function getCategoriesByApplication($application, $language) {		
		
		//PROCEDURE
		$query = "SELECT ID_Application FROM muu_applications WHERE Slug = '$application'";
 
		$ID_Application = $this->Db->query($query);
		$ID_Application = $ID_Application[0]["ID_Application"];
		
		$query = 
		"SELECT muu_categories.ID_Category, Title, Slug, Language, Situation 
		FROM muu_categories
		INNER JOIN muu_re_categories_applications ON muu_categories.ID_Category = muu_re_categories_applications.ID_Category
		WHERE muu_re_categories_applications.ID_Application = '$ID_Application' AND muu_categories.Language = '$language' ORDER BY ID_Category DESC;";
		
		$this->data = $this->Db->query($query);
		//END PROCEDURE
		//$data = $this->Db->call("getCategoriesByApp('blog', 'Spanish')");
			
		return $this->data;
	}
	
	
	public function categories() {			
		$query = "SELECT ". _dbPfx ."re_categories_applications.ID_Category, ID_Application, ID_Parent, Title, Slug, Language, Situation 
										FROM ". _dbPfx ."re_categories_applications     
										INNER JOIN ". _dbPfx ."categories ON muu_categories.ID_Category = ". _dbPfx ."re_categories_applications.ID_Category ORDER BY Title";		

		$this->data = $this->Db->query($query);					

		return $this->data;
	}
	

	public function getSomeCategories($lastID = NULL, $language) {			
		
		if(!is_null($lastID)) {
			$lastID = "AND muu_categories.ID_Category > $lastID";
		}
			
		$query = 
		"SELECT DISTINCT (muu_re_categories_applications.ID_Application) AS App, muu_categories.ID_Category, muu_categories.Title, muu_categories.Situation
		FROM muu_categories, muu_re_categories_applications
		WHERE muu_categories.ID_Category = muu_re_categories_applications.ID_Category
		AND Language = '$language' $lastID ORDER BY ID_Category"; 		

		$this->data = $this->Db->query($query);					
		
		$temp = NULL;
		$i = 0;
		foreach($this->data as $category) {
			if($temp !== $category["ID_Category"]) {
				$categories[$i]["ID_Category"] = $category["ID_Category"];
				$categories[$i]["Title"]       = $category["Title"];
				$categories[$i]["Situation"]   = $category["Situation"];
				$categories[$i]["Apps"][]      = $category["App"];
			} else {
				$categories[$i]["ID_Category"] = $category["ID_Category"];
				$categories[$i]["Title"]       = $category["Title"];
				$categories[$i]["Situation"]   = $category["Situation"];
				$categories[$i]["Apps"][]      = $category["App"];
			}
			
			$temp = $category["ID_Category"];
			$i++;
		}
		____($categories);
		return $this->data;
	}

	
	public function save() {
		$this->Categories = $this->classes("categories", "categories");
		
		$title	 	 = POST("category", "decode", "escape");	
		$language 	 = POST("language");
		$application = POST("application");
		$parent		 = (POST("parent")) ? (int) POST("parent") : 0;
		$slug 		 = slug(POST("category", "clean"));
		$reload   	 = (POST("Reload")) ? TRUE : FALSE;
		$founds		 = 0;
		$records	 = 0;		

		if(strlen($title) > 2) {			
			$data = $this->Db->findBy("ID_Application", $application, "re_categories_applications", "ID_Category");
			
			if($data) {
				foreach($data as $categories) {
					$category = $this->Db->find($categories["ID_Category"], $this->table);
					
					if((int) $category[0]["ID_Parent"] === $parent and $category[0]["Slug"] === $slug and $category[0]["Language"] === $language) {
						$founds++;
					} else {
						$records++;
					}
				}					
			}
			
			if($founds === 0) {			
				$data = array(
					"ID_Parent" => $parent,
					"Title"		=> $title,
					"Slug"		=> $slug,
					"Language"	=> $language
				);

				if($parent > 0) {
					$_data = $this->Db->find($parent, $this->table);
						
					if($_data) {
						if($_data[0]["Language"] === $language) { 
							$insertID = $this->Db->insert($this->table, $data);
						} else {
							return FALSE;
						}
					}
				} else {
					$insertID = $this->Db->insert($this->table, $data);					
				}
				
				$data = array(
					"ID_Application" => $application,
					"ID_Category"	 => $insertID
				);

				$this->Db->insert("re_categories_applications", $data);		
				
				$data = $this->Db->findBy("ID_Application", $application, "re_categories_applications", "ID_Category");	
				
				if($data) {
					$i = 0;
					
					foreach($data as $categories) {
						$category = $this->Db->find($categories["ID_Category"], $this->table);
						
						if((int) $category[0]["ID_Category"] === $insertID) {
							$return[$i] 		   = $category[0];
							$return[$i]["checked"] = TRUE;
						} else {
							$return[$i] 		   = $category[0];
							$return[$i]["checked"] = FALSE;						
						}
						
						$i++;
					}
				} else {
					$return = FALSE;
				}
				
				if($return) {
					unset($categories);
					
					$categories["c1"] = $this->Categories->build($return, NULL, "checkbox", "categories", NULL, $insertID);
					$categories["c2"] = $this->Categories->build($return, NULL, "radio", "parent", NULL, $insertID);
					
					return $categories;
				}
			} else {
				$data = $this->Db->findBy("ID_Application", $application, "re_categories_applications");	
			
				if($data) {
					foreach($data as $categories) {
						$category = $this->Db->find($categories["ID_Category"], $this->table);
						
						$return[] = $category[0];
					}
				}

				if($return) {
					unset($categories);
					
					$categories["c1"] = $this->Categories->build($return);										
					$categories["c2"] = $this->Categories->build($return, NULL, "radio", "parent");
					
					return $categories;
				}
			}			
		} 
	}
	
}
