<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Gallery_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	
	public function __construct() {
		$this->Db = $this->db();		
		$this->helper(array("time", "alerts", "router"));		
		$this->table      = "gallery";
		$this->primaryKey = $this->Db->table($this->table);
		$this->language   = whichLanguage(); 
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Image DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
		}
				
		if(POST("category") === NULL and POST("ID_Category") === "0") {
			$this->category = 0;
		} else {
			if(POST("category") !== NULL) {
				$this->category = POST("category");
				$categorynice   = nice($this->category);
				
				$data           = $this->Db->call("setCategory('$this->category', '$categorynice', '". getXMLang(_webLang, TRUE) . "', 'Active')");
				$this->category = $data[0]["ID_Category"];
			} else {
				$this->category = POST("ID_Category");
			}
		}
		
		if($action === "edit") {
			if(FILES("file", "name") !== "") {
				
				$this->Files = $this->core("Files");
				
				$this->Files->filename  = FILES("file", "name");
				$this->Files->fileType  = FILES("file", "type");
				$this->Files->fileSize  = FILES("file", "size");
				$this->Files->fileError = FILES("file", "error");
				$this->Files->fileTmp   = FILES("file", "tmp_name");
				
				if($this->category === NULL or $this->category === 0) {
					$dir = _lib . _sh . _files . _sh . _images . _sh . "gallery" . _sh . "unknown" . _sh;
				} else {
					$this->Db->table("categories", "Nice");
					$data = $this->Db->find($this->category);
					
					$dir = _lib . _sh . _files . _sh . _images . _sh . "gallery" . _sh . $data[0]["Nice"] . _sh;
				}
				
				if(!file_exists($dir)) {
					mkdir($dir, 0777); 				
				}
						
				$upload = $this->Files->upload($dir);
				
				if($upload["upload"] === TRUE) {
					$this->Images   = $this->core("Images");
					
					$this->original = $this->Images->getResize("original", $dir, $upload["filename"], _minOriginal, _maxOriginal);
					$this->medium   = $this->Images->getResize("medium", $dir, $upload["filename"], _minOriginal, _maxOriginal);
					$this->small    = $this->Images->getResize("small", $dir, $upload["filename"], _minOriginal, _maxOriginal);
				} else {
					return getAlert($upload["message"]);
				}
			} else {
				if($action === "edit") {
					$this->original = "";
					$this->medium   = "";
					$this->small    = "";
				} else {
					return getAlert("Selected Image");
				}
			}
		}
				
		$this->ID 	       = POST("ID_Image");
		$this->title       = POST("title", "decode", "escape");
		$this->nice        = nice($this->title);
		$this->description = POST("description");
		$this->state       = POST("state");
		$this->date1       = now(4);
		$this->date2 	   = now(2);
		
		
	}
	
	private function save() {
		
		if(is_array(FILES("files", "name"))) {
			$filecount = count(FILES("files", "name"));
			$this->Files = $this->core("Files");
			
			$i = 0;
			$noimage = 0;
			foreach($_FILES["files"]["name"] as $file) {							
				if(FILES("files", "name", $i) !== "") {		
						
					$this->Files->filename  = FILES("files", "name", $i);
					$this->Files->fileType  = FILES("files", "type", $i);
					$this->Files->fileSize  = FILES("files", "size", $i);
					$this->Files->fileError = FILES("files", "error", $i);
					$this->Files->fileTmp   = FILES("files", "tmp_name", $i);
					
					if($this->category === NULL or $this->category === 0) {
						$dir = _lib . _sh . _files . _sh . _images . _sh . "gallery" . _sh . "unknown" . _sh;
					} else {
						$this->Db->table("categories", "Nice");
						$data = $this->Db->find($this->category);
						
						$dir = _lib . _sh . _files . _sh . _images . _sh . "gallery" . _sh . $data[0]["Nice"] . _sh;
					}
					
					if(!file_exists($dir)) {
						mkdir($dir, 0777); 				
					}
							
					$upload = $this->Files->upload($dir);
					
					if($upload["upload"] === TRUE) {
						$this->Images   = $this->core("Images");
						
						$this->original = $this->Images->getResize("original", $dir, $upload["filename"], _minOriginal, _maxOriginal);
						$this->medium   = $this->Images->getResize("medium", $dir, $upload["filename"], _minOriginal, _maxOriginal);
						$this->small    = $this->Images->getResize("small", $dir, $upload["filename"], _minOriginal, _maxOriginal);
					} else {
						return getAlert($upload["message"]);
					}	
					
					$query ="setImage(". SESSION("ZanUserID") .", $this->category, '$this->title', '$this->nice', '$this->description', '$this->small', '$this->medium', '$this->original', '$this->date1', '$this->date2', '$this->state')";
					$data  = $this->Db->call($query);	
								
				} else {
					$noimage++;
				}	
				$i++;				
			}	
		} 

		if($noimage === $filecount) {
			return getAlert("Selected Image");
		} else {
			return getAlert("The image has been saved correctly", "success");
		}
		
		
	}
	
	private function edit() {
		$query = "updateImage($this->ID, $this->category, '$this->title', '$this->nice', '$this->description', '$this->small', '$this->medium', '$this->original', '$this->state')";
		$data  = $this->Db->call($query);
							
		if(isset($data[0]["Image_Not_Exists"])) {
			return getAlert("This image not exists");
		}
		
		return getAlert("The image has been edit correctly", "success");
	}
	
	public function getByID($ID, $mode = FALSE) {
		if($mode === FALSE) {
			
			$data = $this->Db->call("getImage('$ID')");

			if(!isset($data[0]["ID_Category"])) {
				$data[0]["ID_Category"] = 0;
			}
						
			return $data;
			
		} else {
			
			$this->Db->table($this->table);	
			$this->Db->encode(TRUE);	
			$record = $this->Db->find($ID);
			
			if($record) {
				$data["ID"] = $record[0]["ID_Image"];
				$data["Title"] = $record[0]["Title"];
				$data["Nice"] = $record[0]["Nice"];
				$data["Album"] = $record[0]["Album"];
				$data["Album_Nice"] = $record[0]["Album_Nice"];
				$data["Description"] = $record[0]["Description"];
				$data["Original"] = _webURL . _sh . $record[0]["Original"];
				$data["prev"] = _webBase . _sh . _webLang.  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."prev"  . _sh . "#Image";
				$data["next"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."next"  . _sh . "#Image";
				$data["home"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh;
				$data["back"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . "album" . _sh . $data["Album_Nice"];			
				return $data;
				
			} else {
				return false;
			}
		}
	}
	
	public function getCategories() {
		$data = $this->Db->call("getCategoriesByApplication('gallery', '". whichLanguage() ."')");
		
		return $data;	
	}
	
	public function getCount($album = NULL) {
		$this->Db->table($this->table);
		
		if(!$album) {
			return $this->Db->countBySQL("State = 'Active'");
		} else {
			return $this->Db->countBySQL("State = 'Active' AND Album_Nice = '$album'");
		}
	}
	
	public function getByAlbum($album = NULL, $limit) {						
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		
		if(!$album) {
			$records = $this->Db->findBySQL("State = 'Active'", NULL, "ID_Image Desc", $limit);
			if($records) { 
				$i = 0;
				foreach($records as $record) {
					$data[$i]["ID_Image"] = $record["ID_Image"];
					$data[$i]["Title"] = $record["Title"];
					$data[$i]["Nice"] = $record["Nice"];
					$data[$i]["Description"] = $record["Description"];
					$data[$i]["Small"] = $record["Small"];
					$data[$i]["Album"] = $record["Album"];
					$data[$i]["Album_Nice"] = $record["Album_Nice"];
					$data[$i]["Start_Date"] = $record["Start_Date"];
					$data[$i]["Text_Date"] = $record["Text_Date"];
					$i++;				
				}
			} 
		} else {
			
			$records = $this->Db->findBySQL("Album_Nice = '$album' AND State = 'Active'", NULL, "ID_Image Desc", $limit);
			if($records) { 
				$i = 0;
				foreach($records as $record) {
					$data[$i]["ID_Image"] = $record["ID_Image"];
					$data[$i]["Title"] = $record["Title"];
					$data[$i]["Nice"] = $record["Nice"];
					$data[$i]["Description"] = $record["Description"];
					$data[$i]["Small"] = $record["Small"];
					$data[$i]["Album"] = $record["Album"];
					$data[$i]["Album_Nice"] = $record["Album_Nice"];
					$data[$i]["Start_Date"] = $record["Start_Date"];
					$data[$i]["Text_Date"] = $record["Text_Date"];
					$i++;				
				}
			} 
		}
	
		if(isset($data)) {
			return $data;
		} else {
			return FALSE;
		}					
	}
	
	public function getNext($ID, $album = "none") {
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		$record = $this->Db->findBySQL("ID_Image > '$ID' AND Album_Nice = '$album' AND State = 'Active' LIMIT 1");
	
		if($record) {
			$data["ID"] = $record[0]["ID_Image"];
			$data["Title"] = $record[0]["Title"];
			$data["Nice"] = $record[0]["Nice"];
			$data["Album"] = $record[0]["Album"];
			$data["Album_Nice"] = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] = _webURL . _sh . $record[0]["Original"];
			$data["prev"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."prev"  . _sh . "#Image";
			$data["next"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."next"  . _sh . "#Image";
			$data["home"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh;
			$data["back"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . "album" . _sh . $data["Album_Nice"];
		
			return $data;			
		} else {
			return false;
		}
	}
	
	public function getPrev($ID, $album = "none") {
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		$record = $this->Db->findBySQL("ID_Image < '$ID' AND Album_Nice = '$album' AND State = 'Active' ORDER BY ID_Image Desc LIMIT 1");
		#____($record);
		if($record) {
			$data["ID"] = $record[0]["ID_Image"];
			$data["Title"] = $record[0]["Title"];
			$data["Nice"] = $record[0]["Nice"];
			$data["Album"] = $record[0]["Album"];
			$data["Album_Nice"] = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] = _webURL . _sh . $record[0]["Original"];
			$data["prev"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."prev"  . _sh . "#Image";
			$data["next"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."next"  . _sh . "#Image";
			$data["home"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh;
			$data["back"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . "album" . _sh . $data["Album_Nice"];
		
			return $data;
			
		} else {
			return false;
		}

	}
	
	public function getLast($album = "none") {
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		$record = $this->Db->findBySQL("State = 'Active' AND Album_Nice = '$album' ORDER BY ID_Image DESC LIMIT 1");
		
		if($record) {
			$data["ID"] = $record[0]["ID_Image"];
			$data["Title"] = $record[0]["Title"];
			$data["Nice"] = $record[0]["Nice"];
			$data["Album"] = $record[0]["Album"];
			$data["Album_Nice"] = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] = _webURL . _sh . $record[0]["Original"];
			$data["prev"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."prev"  . _sh . "#Image";
			$data["next"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."next"  . _sh . "#Image";
			$data["home"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh;
			$data["back"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . "album" . _sh . $data["Album_Nice"];
		
			return $data;
			
		} else {
			return false;
		}

	}
	
	public function getFirst($album = "none") {
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		$record = $this->Db->findBySQL("State = 'Active' AND Album_Nice = '$album' ORDER BY ID_Image ASC LIMIT 1");
		
		if($record) {
			$data["ID"] = $record[0]["ID_Image"];
			$data["Title"] = $record[0]["Title"];
			$data["Nice"] = $record[0]["Nice"];
			$data["Album"] = $record[0]["Album"];
			$data["Album_Nice"] = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] = _webURL . _sh . $record[0]["Original"];
			$data["prev"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."prev"  . _sh . "#Image";
			$data["next"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . _image . _sh . $data["ID"] . _sh . $data["Album_Nice"] . _sh ."next"  . _sh . "#Image";
			$data["home"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh;
			$data["back"] = _webBase . _sh . _webLang .  _sh . _gallery . _sh . "album" . _sh . $data["Album_Nice"];
		
			return $data;
			
		} else {
			return false;
		}
	}
	
	public function getAlbums() {
		$this->Db->table($this->table);	
		$this->Db->encode(TRUE);	
		$data = $this->Db->findBySQL("State = 'Active' AND Album != 'None' GROUP BY Album", NULL, NULL, NULL);	
		
		if($data) {
			return $data;
		} else {
			return false;
		}
	}
	
}
