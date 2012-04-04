<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Applications_Model extends ZP_Model {
		
	public function __construct() {
		$this->Db = $this->db();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		$this->Users_Model  = $this->model("Users_Model");
		
		$this->helpers();
		
		$this->table = "applications";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Application DESC", $search = NULL, $field = NULL, $trash = FALSE) {	
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
				$data = $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave() {
		if(!POST("title")) {
			return getAlert("You need to write a title");
		}

		$this->ID 	     = POST("ID_Application");
		$this->title     = POST("title", "decode", "escape");
		$this->slug      = slug($this->title);
		$this->cpanel    = POST("cpanel");
		$this->adding    = POST("adding");
		$this->defult    = POST("defult");
		$this->category  = POST("category");
		$this->comments  = POST("comments");
		$this->situation = POST("Situation");
	}
	
	private function save() {
		$fields  = "Title, Slug, CPanel, Adding, BeDefault, Category, Comments, Situation";					
		$values  = "'$this->title', '$this->slug','$this->cpanel', '$this->adding', '$this->defult', '$this->category', '$this->comments', '$this->situation'";
		
		$this->Db->table($this->table, $fields);
		$this->Db->values($values);
		
		$ID_Application = $this->Db->save();
		
		if(is_numeric($ID_Application)) {
			return getAlert("The Application has been saved correctly", "success");
		}
		
		return getAlert("Insert error");
	}
	
	private function edit() {
		$this->Db->table($this->table);
		
		$values  = "Title = '$this->title', Slug = '$this->slug', CPanel = '$this->cpanel', Adding = '$this->adding',";
		$values .= "BeDefault = '$this->defult', Category = '$this->category', Comments = '$this->comments', Situation = '$this->situation'";
		
		$this->Db->values($values);								
		$this->Db->save($this->ID);
		
		return getAlert("The Application has been edit correctly", "success");
	}
	
	public function getList() {		
		$data = $this->Db->findAll($this->table);

		$list  = NULL;		
		
		if($data) { 
			foreach($data as $application) { 
				if($application["Situation"] === "Active") {
					if($application["CPanel"]) {
						$title = __(_($application["Title"]));
						
						if($this->Users_Model->isAllow("view", $application["Title"])) {	
							if($application["Slug"] === "configuration") {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . _sh . "cpanel" . _sh . "edit")));															
							} else {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . _sh . "cpanel" . _sh . "results")));
							}
							
							$list[count($list) - 1]["Class"] = FALSE;								
									
							if($application["Adding"]) {
								$adding = __(_("Add"));
								
								$li[0]["item"] = a($adding, path($application["Slug"] . _sh . "cpanel" . _sh . "add"));
								
								$i = count($list);			
														
								$list[$i]["item"]  = openUl();							
								
								$count = $this->CPanel_Model->deletedRecords($application["Slug"]);		
											
								if($count > 0) {	
									$span  = span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;");
									$span .= span("bold italic blue", __(_("Trash")) ." ($count)");
									
									$li[$i]["item"] = a($span, path($application["Slug"] ."/cpanel/results/trash", FALSE, array("title" => __(_("In trash")) .": ". $count)));
									
									$i = count($list) - 1;
									
									$list[$i]["item"] .= li($li);
									
									unset($li);	
								} else {
									$list[$i]["item"] .= li($li);
								}
															
								$list[$i]["item"] .= closeUl();
								$list[$i]["class"] = "no-list-style";	
									
								unset($li);								
							}																																		
						}
					}							
				}
			}
		}
		
		return $list;		
	}	
			
	public function getApplication($ID) {
		$application = $this->Db->find($ID, $this->table);
	
		return $application[0]["Title"];
	}
	
	public function getID($title) {		
		$applications = $this->Db->findBy("Title", $title, $this->table);

		return (is_array($applications)) ? $applications[0]["ID_Application"] : FALSE;
	}	
	
	public function getApplications() {
		return $this->Db->findBy("Situation", "Active", $this->table);
	}
	
	public function getDefaultApplications($default = FALSE) {	
		$applications = $this->Db->findBySQL("BeDefault = 1 AND Situation = 'Active'", $this->table);
		
		$i = 0;
		
		foreach($applications as $application) {
			if($application["Slug"] === $default) {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = TRUE;
			} else {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = FALSE;
			}
				
			$i++;
		}
				
		return $options;		
	}	

	public function getApplicationByCategory($ID) {		
		$this->data = $this->Db->query("SELECT muu_categories2applications.ID_Application FROM muu_categories2applications WHERE muu_categories2applications.ID_Category = '$ID'");

		return $this->data[0]["ID_Application"];
	}
	
	public function getByID($ID) {		
		return $this->Db->find($ID, $this->table);
	}
}