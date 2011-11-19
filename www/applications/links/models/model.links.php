<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Links_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->helper("router");
		
		$this->table = "links";

		$this->Data = $this->core("Data");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Link DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
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
				$data = $this->Db->findBySQL("ID_User = '".$_SESSION["ZanAdminID"]."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
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
		$validations = array(
			"title" => "required",
			"URL"   => "ping",
		);

		$data = array(
			"ID_User" => SESSION("ZanUserID")
		);
				
		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
		if($this->Db->insert($this->table, $this->data)) {
			return getAlert("The link has been saved correctly", "success");	
		}
		
		return getAlert("Insert error");
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert("The link has been edit correctly", "success");
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}

}
