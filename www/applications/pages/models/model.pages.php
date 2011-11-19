<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Pages_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->helper(array("time", "alerts", "router"));
		
		$this->table    = "pages";
		$this->language = whichLanguage(); 

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave() {
		$validations = array(
			"exists"  => array(
							"Slug" 	   => slug(POST("title", "clean")), 
							"Language" => POST("language")
						),
			"title"   => "required",
			"content" => "required"
		);

		$data = array(
			"ID_User"	 => SESSION("ZanUserID"),
			"Slug"    	 => slug(POST("title", "clean")),
			"Content" 	 => POST("content", "clean"),
			"Start_Date" => now(4),
			"Text_Date"	 => now(2)
		);
		
		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
		
		return FALSE;
	}
	
	private function save() {
		if(POST("principal") > 0) {
			$this->Db->update($this->table, array("Principal" => 0), "Language = '". POST("language") ."'");
		}
		
		$this->Db->insert($this->table, $this->data);
		
		return getAlert("The page has been saved correctly", "success");
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID")); 
			
		return getAlert("The page has been edit correctly", "success");
	}
	
	public function getByDefault() {
		$data = $this->Db->findBySQL("Language = '$this->language' AND Principal = 1 AND Situation = 'Active'");
			
		return $data;
	}
		
	public function getParent($ID, $invert = FALSE) {				
		if($ID === 0) {
			return false;
		}
				
		if(!$invert) {
			$data = $this->Db->find($ID);
		} else {
			$data = $this->Db->findBy("ID_Translation", $ID, NULL, "Language ASC, Title", NULL);
		}
		
		return $data;
	}		
	
	public function getBySlug($slug) {		
		$data = $this->Db->findBySQL("Slug = '$slug' AND Language = '$this->language' AND Situation = 'Active'");

		return $data;
	}
	
	public function getID($slug) {		
		$data = $this->Db->findBy("Slug", $slug);
		
		return (is_array($data)) ? $data[0][$this->primaryKey] : FALSE;
	}
	
	public function getByID($ID) {
		$this->Db->table($this->table);
		
		$data = $this->Db->find($ID);
		
		return $data;
	}
}
