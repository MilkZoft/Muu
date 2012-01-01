<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ads_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	
	public function __construct() {
		$this->Db = $this->db();

		$helpers = array("alerts", "time", "string", "security");
		
		$this->helper($helpers);
	
		$this->table = "ads";

		$this->Data = $this->core("Data");
		
		$this->config("applications");
		$this->config("images");
	}

	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		$this->Db->table($this->table);
		
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
		$this->Db->table($this->table);
		
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
			"title" => "required",
			"URL"   => "ping"
		);

		$data = array(
			"ID_User"	 => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"End_Date"	 => now(4) + 2419200
		);

		if($action === "edit") {
			$this->Data->ignore("banner");
		}

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}

		if(FILES("image", "name")) {
			$dir = _www . _sh . _lib . _sh . _files . _sh . _images . _sh . _ads . _sh;
			
			$this->Files = $this->core("Files");										
			
			$this->data["Banner"] = $this->Files->uploadImage($dir, "image", "normal");
			
			if(!$this->data["Banner"]) {
				return getAlert("Upload error"); 
			}
		} else {
			if(is_null($this->data["code"])) {
				return getAlert("You need to upload an image or write the ad code");
			}
		}		
	}
	
	private function save() {
		$this->Db->table($this->table);
		
		if($this->data["Principal"] > 0) {		
			if($this->Db->findBySQL("Position = '". $this->data["Position"] ."' AND Principal = 1")) {
				$this->Db->values("Principal = 0 WHERE Position = '". $this->data["Position"] ."'");
				$this->Db->save(FALSE);
			}
		}
		
		$this->Db->insert($this->table, $this->data);
					
		return getAlert("The ad has been saved correctly", "success");	
	}
	
	private function edit() {		
		$this->Db->table($this->table);
		
		if($this->data["Principal"] > 0) {		
			if($this->Db->findBySQL("Position = '$this->position' AND Principal = 1")) {
				$this->Db->values("Principal = 0 WHERE Position = '". $this->data["Position"] ."'");
				$this->Db->save(FALSE);
			}
		}
		
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert("The ad has been edited correctly", "success", $this->URL);
	}
	
	private function search($search, $field) {
		$this->CPanel_Model = $this->model("Cpanel_Model");
		
		return $this->Cpanel_Model->getSearch($search, $field, $this->table);		
	}
	
	public function getByID($ID) {
		$this->Db->table($this->table);
		$data = $this->Db->find($ID);
		
		return $data;
	}
	
	public function getAds($position = NULL) {		
		$this->Db->table($this->table);
				
		$data = $this->Db->findBySQL("Position = '$position' AND Situation = 'Active'");
		
		return $data;
	}
	
	public function click($ID) {
		$this->Db->table($this->table);
		
		if($ID > 0) {
			$this->Db->values("Clicks = (Clicks) + 1");			
			$this->Db->save($ID);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
}
