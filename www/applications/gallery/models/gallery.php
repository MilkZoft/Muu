<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Gallery_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();		
		
		$this->helpers();
				
		$this->table    = "gallery";
		$this->language = whichLanguage(); 
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Image DESC", $search = NULL, $field = NULL, $trash = FALSE) {	
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
		if(!POST("title")) {
			return getAlert("You need to write a title");
		}
				
		if(!POST("category") and POST("ID_Category") === "0") {
			$this->category = 0;
		} else {
			if(POST("category")) {
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
				
				if(!$this->category or $this->category === 0) {
					$dir = "www/lib/files/images/gallery/unknown/";
				} else {
					$data = $this->Db->find($this->category, $this->table);
					
					$dir = "www/lib/files/images/gallery/". $data[0]["Nice"] ."/";
				}
				
				if(!file_exists($dir)) {
					mkdir($dir, 0777); 				
				}
						
				$upload = $this->Files->upload($dir);
				
				if($upload["upload"]) {
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
		$this->Situation   = POST("Situation");
		$this->date1       = now(4);
		$this->date2 	   = now(2);
	}
	
	private function save() {
		if(is_array(FILES("files", "name"))) {
			$filecount = count(FILES("files", "name"));
			
			$this->Files = $this->core("Files");
			
			$i = 0;
			$noImage = 0;
			
			foreach($_FILES["files"]["name"] as $file) {							
				if(FILES("files", "name", $i) !== "") {				
					$this->Files->filename  = FILES("files", "name", $i);
					$this->Files->fileType  = FILES("files", "type", $i);
					$this->Files->fileSize  = FILES("files", "size", $i);
					$this->Files->fileError = FILES("files", "error", $i);
					$this->Files->fileTmp   = FILES("files", "tmp_name", $i);
					
					if(!$this->category or $this->category === 0) {
						$dir = "www/lib/files/images/gallery/unknown/";
					} else {
						$data = $this->Db->find($this->category, $this->table);
						
						$dir = "www/lib/files/images/gallery/". $data[0]["Nice"] ."/";
					}
					
					if(!file_exists($dir)) {
						mkdir($dir, 0777); 				
					}
							
					$upload = $this->Files->upload($dir);
					
					if($upload["upload"]) {
						$this->Images   = $this->core("Images");
						
						$this->original = $this->Images->getResize("original", $dir, $upload["filename"], _minOriginal, _maxOriginal);
						$this->medium   = $this->Images->getResize("medium", $dir, $upload["filename"], _minOriginal, _maxOriginal);
						$this->small    = $this->Images->getResize("small", $dir, $upload["filename"], _minOriginal, _maxOriginal);
					} else {
						return getAlert($upload["message"]);
					}	
					
					$query  = "setImage(". SESSION("ZanUserID") .", $this->category, '$this->title', '$this->nice', '$this->description', '$this->small', ";
					$query .= "'$this->medium', '$this->original', '$this->date1', '$this->date2', '$this->Situation')";
					
					$data = $this->Db->call($query);				
				} else {
					$noImage++;
				}	

				$i++;				
			}	
		} 

		if($noImage === $filecount) {
			return getAlert("Selected Image");
		} else {
			return getAlert("The image has been saved correctly", "success");
		}
	}
	
	private function edit() {
		$query  = "updateImage($this->ID, $this->category, '$this->title', '$this->nice', '$this->description', '$this->small', ";
		$query .= "'$this->medium', '$this->original', '$this->Situation')";
		
		$data = $this->Db->call($query);
							
		if(isset($data[0]["Image_Not_Exists"])) {
			return getAlert("This image not exists");
		}
		
		return getAlert("The image has been edit correctly", "success");
	}
	
	public function getByID($ID, $mode = FALSE) {
		if(!$mode) {	
			$data = $this->Db->call("getImage('$ID')");

			if(!isset($data[0]["ID_Category"])) {
				$data[0]["ID_Category"] = 0;
			}
						
			return $data;
		} else {
			$record = $this->Db->find($ID, $this->table);
			
			if($record) {
				$data["ID"] 		 = $record[0]["ID_Image"];
				$data["Title"]	 	 = $record[0]["Title"];
				$data["Nice"] 		 = $record[0]["Nice"];
				$data["Album"] 		 = $record[0]["Album"];
				$data["Album_Nice"]  = $record[0]["Album_Nice"];
				$data["Description"] = $record[0]["Description"];
				$data["Original"]    = _webURL . _sh . $record[0]["Original"];

				$data["prev"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/prev/#image");
				$data["next"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/next/#image");
				$data["home"] 		 = path("gallery");
				$data["back"] 		 = path("gallery/album/". $data["Album_Nice"]);			
				
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
		if(!$album) {
			return $this->Db->countBySQL("Situation = 'Active'", $this->table);
		} else {
			return $this->Db->countBySQL("Situation = 'Active' AND Album_Nice = '$album'", $this->table);
		}
	}
	
	public function getByAlbum($album = NULL, $limit) {							
		if(!$album) {
			$records = $this->Db->findBySQL("Situation = 'Active',", $this->table, NULL, "ID_Image Desc", $limit);
			
			if($records) { 
				$i = 0;

				foreach($records as $record) {
					$data[$i]["ID_Image"] 	 = $record["ID_Image"];
					$data[$i]["Title"] 		 = $record["Title"];
					$data[$i]["Nice"] 		 = $record["Nice"];
					$data[$i]["Description"] = $record["Description"];
					$data[$i]["Small"] 		 = $record["Small"];
					$data[$i]["Album"] 		 = $record["Album"];
					$data[$i]["Album_Nice"]  = $record["Album_Nice"];
					$data[$i]["Start_Date"]  = $record["Start_Date"];
					$data[$i]["Text_Date"]   = $record["Text_Date"];
					
					$i++;				
				}
			} 
		} else {
			$records = $this->Db->findBySQL("Album_Nice = '$album' AND Situation = 'Active'", NULL, "ID_Image Desc", $limit);
			
			if($records) { 
				$i = 0;
				
				foreach($records as $record) {
					$data[$i]["ID_Image"] 	 = $record["ID_Image"];
					$data[$i]["Title"] 		 = $record["Title"];
					$data[$i]["Nice"] 		 = $record["Nice"];
					$data[$i]["Description"] = $record["Description"];
					$data[$i]["Small"] 		 = $record["Small"];
					$data[$i]["Album"] 		 = $record["Album"];
					$data[$i]["Album_Nice"]  = $record["Album_Nice"];
					$data[$i]["Start_Date"]  = $record["Start_Date"];
					$data[$i]["Text_Date"]   = $record["Text_Date"];
					
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
		$record = $this->Db->findBySQL("ID_Image > '$ID' AND Album_Nice = '$album' AND Situation = 'Active' LIMIT 1", $this->table);
	
		if($record) {
			$data["ID"] 		 = $record[0]["ID_Image"];
			$data["Title"] 		 = $record[0]["Title"];
			$data["Nice"] 		 = $record[0]["Nice"];
			$data["Album"] 		 = $record[0]["Album"];
			$data["Album_Nice"]  = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] 	 = _webURL . _sh . $record[0]["Original"];
			$data["prev"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/prev/#image");
			$data["next"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/next/#image");
			$data["home"] 		 = path("gallery");
			$data["back"] 		 = path("gallery/album/". $data["Album_Nice"]);
		
			return $data;			
		} else {
			return FALSE;
		}
	}
	
	public function getPrev($ID, $album = "none") {
		$record = $this->Db->findBySQL("ID_Image < '$ID' AND Album_Nice = '$album' AND Situation = 'Active' ORDER BY ID_Image Desc LIMIT 1", $this->table);
		
		if($record) {
			$data["ID"] 		 = $record[0]["ID_Image"];
			$data["Title"] 	 	 = $record[0]["Title"];
			$data["Nice"] 		 = $record[0]["Nice"];
			$data["Album"] 		 = $record[0]["Album"];
			$data["Album_Nice"]  = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] 	 = _webURL . _sh . $record[0]["Original"];

			$data["prev"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/prev/#image");
			$data["next"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/next/#image");
			$data["home"] 		 = path("gallery");
			$data["back"] 		 = path("gallery/album/". $data["Album_Nice"]);
		
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function getLast($album = "none") {
		$record = $this->Db->findBySQL("Situation = 'Active' AND Album_Nice = '$album' ORDER BY ID_Image DESC LIMIT 1", $this->table);
		
		if($record) {
			$data["ID"] 		 = $record[0]["ID_Image"];
			$data["Title"] 		 = $record[0]["Title"];
			$data["Nice"] 		 = $record[0]["Nice"];
			$data["Album"] 		 = $record[0]["Album"];
			$data["Album_Nice"]  = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] 	 = _webURL . _sh . $record[0]["Original"];

			$data["prev"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/prev/#image");
			$data["next"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/next/#image");
			$data["home"] 		 = path("gallery");
			$data["back"] 		 = path("gallery/album/". $data["Album_Nice"]);
		
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function getFirst($album = "none") {
		$record = $this->Db->findBySQL("Situation = 'Active' AND Album_Nice = '$album' ORDER BY ID_Image ASC LIMIT 1", $this->table);
		
		if($record) {
			$data["ID"] 		 = $record[0]["ID_Image"];
			$data["Title"] 		 = $record[0]["Title"];
			$data["Nice"] 		 = $record[0]["Nice"];
			$data["Album"] 		 = $record[0]["Album"];
			$data["Album_Nice"]  = $record[0]["Album_Nice"];
			$data["Description"] = $record[0]["Description"];
			$data["Original"] 	 = _webURL . _sh . $record[0]["Original"];

			$data["prev"] 		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/prev/#image");
			$data["next"]  		 = path("gallery/image/". $data["ID"] ."/". $data["Album_Nice"] ."/next/#image");
			$data["home"] 		 = path("gallery");
			$data["back"] 		 = path("gallery/album/". $data["Album_Nice"]);
		
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function getAlbums() {	
		$data = $this->Db->findBySQL("Situation = 'Active' AND Album != 'None' GROUP BY Album", $this->table);	
		
		if($data) {
			return $data;
		} else {
			return FALSE;
		}
	}
	
}