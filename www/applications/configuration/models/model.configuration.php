<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Configuration_Model extends ZP_Model {
		
	public function __construct() {
		$this->Db = $this->db();
		
		$helpers = array("alerts", "router", "time", "string", "validations");
		
		$this->helper($helpers);
		
		$this->table = "configuration";

		$this->Data = $this->core("Data");
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
		$this->Db->table($this->table);
		
		if($action === "edit") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all();
		} elseif($action === "edit") {
			return $this->edit();															
		}
	}	
	
	public function all() {
		$this->Db->table($this->table);
	
		return $this->Db->find(1);
	}
	
	public function editOrSave() {
		$validations = array(
			"name" 			=> "required",
			"URL" 			=> "required",
			"email_recieve" => "email?",
			"email_send"	=> "email?",
		);

		$this->data = $this->Data->proccess(NULL, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	public function edit() {
		$this->Db->update($this->table, $this->data, 1);
				
		return getAlert("The configuration has been edited correctly", "success");
	}
	
	public function getByID() { 				
		$data = $this->Db->find(1, $this->table);

		return $data;
	}

	public function getConfig() {
		return $this->getByID();
	}	
}
