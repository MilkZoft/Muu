<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();		
		
		$this->helpers();		
		
		$this->table = "works";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Work DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
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
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", NULL, $order, $limit);
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
		if(!POST("title")) {
			return getAlert("You need to write a title");
		} elseif(!POST("description")) {
			return getAlert("You need to write a description");
		} elseif(!ping(POST("URL"))) {
			return getAlert("Invalid URL");
		} elseif(FILES("image", "name") === "" and $action === "save") {
			return getAlert("Selected image");
		} elseif(FILES("preview1", "name") === "" and $action === "save") {
			return getAlert("Selected preview");
		} elseif(FILES("preview2", "name") === "" and $action === "save") {
			return getAlert("Selected preview");
		}				
		
		if(FILES("image", "name") !== "") {
			$upload = $this->upload("image");

			if($upload) {
				$this->image = $upload;
			} else {
				return $this->error;
			}
		} else {
			if($action === "edit") {
				$this->image = "";
			}
		}
		
		if(FILES("preview1", "name") !== "") {
			$upload = $this->upload("preview1");

			if($upload) {
				$this->preview1 = $upload;
			} else {
				return $this->error;
			}
		} else {
			if($action === "edit") {
				$this->preview1 = "";
			}
		}
		
		if(FILES("preview2", "name") !== "") {
			$upload = $this->upload("preview2");

			if($upload) {
				$this->preview2 = $upload;
			} else {
				return $this->error;
			}
		} else {
			if($action === "edit") {
				$this->preview2 = "";
			}
		}
		
		$this->ID 	       = POST("ID_Work");
		$this->title       = POST("title", "decode", "escape");
		$this->nice        = nice($this->title);
		$this->description = POST("description");
		$this->URL         = POST("URL");
		$this->state       = POST("state");
	}
	
	private function save() {
		$data  = array(
					"Title" 	  => $this->title, 
					"Nice"  	  => $this->nice, 
					"Preview1" 	  => $this->preview1, 
					"Preview2" 	  => $this->preview2,
					"Image"		  => $this->image, 
					"URL"		  => $this->URL, 
					"Description" => $this->description, 
					"Situation"   => $this->situation
				);					
	
		$this->Db->insert($this->table, $data);
					
		return getAlert("The work has been saved correctly", "success");	
	}
	
	private function edit() {
		$data = $this->getByID($this->ID);
		
		$data["Title"] = $this->title;
		$data["Slug"]  = $this->slug;
		
		if($this->preview1 !== "") {
			$data["Preview1"] = $this->preview1;
			
			@unlink($data[0]["Preview1"]);
		}
		
		if($this->preview2 !== "") {
			$data["Preview2"] = $this->preview2;
			
			@unlink($data[0]["Preview2"]);
		}
		
		if($this->image !== "") {
			$data["Image"] = $this->image;
			
			@unlink($data[0]["Image"]);
		}
		
		$data["URL"] 		 = $this->URL;
		$data["Description"] = $this->description;
		$data["Situation"]   = $this->situation;
		
		$this->Db->update($this->table, $data, $this->ID);
		
		return getAlert("The work has been edit correctly", "success");
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function upload($file) {
		$this->Files = $this->core("Files");
			
		$this->Files->filename  = FILES($file, "name");
		$this->Files->fileType  = FILES($file, "type");
		$this->Files->fileSize  = FILES($file, "size");
		$this->Files->fileError = FILES($file, "error");
		$this->Files->fileTmp   = FILES($file, "tmp_name");
		
		$dir = "www/lib/files/images/works/";
		
		if(!file_exists($dir)) {
			@mkdir($dir, 0777); 				
		}
				
		$upload = $this->Files->upload($dir);
		
		if($upload["upload"]) {
			return $dir . $upload["filename"];
		} else {
			$this->error = getAlert($upload["message"]);
			
			return FALSE;
		}
	}
}