<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	private $error;
	
	public function __construct() {
		$this->Db = $this->db();		
		$this->helper(array("time", "alerts", "router"));		
		$this->table      = "works";
		$this->primaryKey = $this->Db->table($this->table);
		$this->language   = whichLanguage(); 
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Work DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
		if($trash === FALSE) {
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
	
	private function editOrSave($action) {
		$helpers = array("alerts", "time", "validations");
		
		$this->helper($helpers);
		
		if(POST("title") === NULL) {
			return getAlert("You need to write a title");
		} elseif(POST("description") === NULL) {
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
		
		$fields  = "Title, Nice, Preview1, Preview2, Image, URL, Description, State";					
		$values  = "'$this->title', '$this->nice', '$this->preview1', '$this->preview2', '$this->image',";
		$values .= "'$this->URL', '$this->description', '$this->state'";
		
		$this->Db->table($this->table, $fields);
		$this->Db->values($values);
		
		$this->Db->save();
					
		return getAlert("The work has been saved correctly", "success");	
	}
	
	private function edit() {
		$data = $this->getByID($this->ID);
		
		$this->Db->table($this->table);
		$values = "Title = '$this->title', Nice = '$this->nice', ";
		
		if($this->preview1 != "") {
			$values .= "Preview1 = '$this->preview1', ";
			@unlink($data[0]["Preview1"]);
		}
		
		if($this->preview2 != "") {
			$values .= "Preview2 = '$this->preview2', ";
			@unlink($data[0]["Preview2"]);
		}
		
		if($this->image != "") {
			$values .= "Image = '$this->image', ";
			@unlink($data[0]["Image"]);
		}
		
		$values .= "URL = '$this->URL', Description = '$this->description', State = '$this->state'";
		
		$this->Db->values($values);								
		$this->Db->save($this->ID);
		
		return getAlert("The work has been edit correctly", "success");
	}
	
	public function getByID($ID, $mode = FALSE) {
		$this->Db->table($this->table);
		$data = $this->Db->find($ID);
		
		return $data;
	}
	
	public function upload($file) {
		$this->Files = $this->core("Files");
			
		$this->Files->filename  = FILES($file, "name");
		$this->Files->fileType  = FILES($file, "type");
		$this->Files->fileSize  = FILES($file, "size");
		$this->Files->fileError = FILES($file, "error");
		$this->Files->fileTmp   = FILES($file, "tmp_name");
		
		$dir = _lib . _sh . _files . _sh . _images . _sh . "works" . _sh;
		
		if(!file_exists($dir)) {
			@mkdir($dir, 0777); 				
		}
				
		$upload = $this->Files->upload($dir);
		
		if($upload["upload"] === TRUE) {
			return $dir  . $upload["filename"];
		} else {
			$this->error = getAlert($upload["message"]);
			return FALSE;
		}
	}
}
