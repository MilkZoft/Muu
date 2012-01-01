<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Videos_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->helper(array("time", "alerts", "router"));
		
		$this->table       = "videos";
		$this->primaryKey  = $this->Db->table($this->table);
		$this->language    = whichLanguage(); 
		$this->application = whichApplication();
		
		$this->library("youtube", NULL, "videos");
		$this->YouTube = new YouTube;
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Video DESC", $search = NULL, $field = NULL, $trash = FALSE) {	
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Video DESC", $limit);
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
		if((!POST("videos") or is_null(POST("videos"))) and (!POST("URL") or is_null(POST("URL"))) and (!POST("ID") or is_null(POST("ID")))) {
			return getAlert("You need select video o write URL");
		}
		
		$this->URL    	   = POST("URL");
		$this->ID 	  	   = POST("ID");		
		$this->videos 	   = POST("videos");
		$this->title 	   = POST("title");
		$this->description = POST("description");
		$this->date1  	   = now(4);
		$this->date2  	   = now(2);
		$this->situation   = POST("situation");
	}
	
	private function save() {
		if($this->URL and !is_null($this->URL)) {
			$_array = explode("v=", POST("URL", "decode", FALSE));
			
			if($this->find($_array[1])) {
				return getAlert("This video already exists");
			}
			
			$video  = $this->YouTube->getByID($_array[1]);
			
			if($video and is_array($video)) {	
				$values = array(
					"ID_User"     => SESSION("ZanUserID"),
					"ID_YouTube"  => $video["id"],
					"Title"	      => trim(filter(encode($video["title"]), "escape")),
					"Slug" 	      => slug(filter(encode($video["title"]), "escape")),
					"Description" => trim(filter(encode($video["content"]), "escape")),
					"URL"    	  => $this->URL,
					"Start_Date"  => $this->date1,
					"Text_Date"   => $this->date2,
					"Situation"   => $this->situation
				);
				
				$insert = $this->Db->insert($this->table, $values);
				
				if(!$insert) {
					return getAlert("Insert error");
				}
			}
		}
		
		if(($this->videos) and !is_null($this->videos)) {
			foreach($this->videos as $value) {
				
				if(!$this->find($value)) {
					$video = $this->YouTube->getByID($value);
					
					if($video and is_array($video)) {
						$values = array(
							"ID_User"     => SESSION("ZanUserID"),
							"ID_YouTube"  => $video["id"],
							"Title"	      => filter(encode($video["title"]), "escape"),
							"Slug" 	      => slug(filter(encode($video["title"]), "escape")),
							"Description" => filter(encode($video["content"]), "escape"),
							"URL"    	  => $this->URL,
							"Start_Date"  => $this->date1,
							"Text_Date"   => $this->date2,
							"Situation"   => $this->situation
						);
						
						$insert = $this->Db->insert($this->table, $values);
						
						if(!$insert) {
							return getAlert("Insert error");
						}
					}
				}
			}
		}
		
		return getAlert("The video has been saved correctly", "success");
	}
	
	private function edit() {
		if(!$this->title or is_null($this->title)) {
			return getAlert("You need write a title");
		}
		
		$values = array(
			"Title"	      => $this->title,
			"Slug" 	      => slug($this->title),
			"Description" => $this->description,
			"Situation"   => $this->situation
		);
		
		$response = $this->Db->update($this->table, $values, "ID_Video = " . $this->ID);
		
		if($response) {
			return getAlert("The video has been edited correctly", "success");
		} else {
			return getAlert("Edit error");
		}
	}
	
	public function getByUser($user = NULL) {
		return  $this->YouTube->getByUser($user);
	}
	
	public function query($query = NULL) {
		return  $this->YouTube->query($query);
	}
	
	public function search($search) {
		return  $this->YouTube->search($search);
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function getVideos($limit = 10) {		
		$data = $this->Db->findAll($this->table, NULL, "ID_Video DESC", $limit);
		
		return $data;
	}
	
	public function count($limit = 10) {
		$data = $this->Db->countAll($this->table);

		return $data;
	}
	
	public function find($ID = NULL) {
		return ($this->Db->findBY("ID_YouTube", $ID, $this->table)) ? TRUE : FALSE;
	}
}
