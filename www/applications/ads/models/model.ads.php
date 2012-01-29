<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ads_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->helpers();
	
		$this->table = "ads";

		$this->Data = $this->core("Data");
		
		$this->config("applications");
		$this->config("images");
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
			$dir = "www/lib/files/images/ads/";
			
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
		if($search and $field) {
			if($field === "ID") {
				$data = $this->Db->find($search, $this->table);	
			} else {
				$data = $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);
			}
		} else {
			return FALSE;
		}
		
		return $data;		
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function getAds($position = NULL) {				
		$data = $this->Db->findBySQL("Position = '$position' AND Situation = 'Active'", $this->table);
		
		return $data;
	}
	
	public function click($ID) {		
		if($ID > 0) {
			$this->Db->values("Clicks = (Clicks) + 1");			
			$this->Db->save($ID);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
}