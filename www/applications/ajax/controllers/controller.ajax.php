<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ajax_Controller extends ZP_Controller {
	
	public function __construct() {}
	
	public function index() {
		if(segment(2) === "setcategory") {
			$this->setCategory();					
		} elseif(segment(2) === "settags") {
			$this->setTags();
		} elseif(segment(2) === "getvideos") {
			$this->getVideos();
		} elseif(segment(2) === "upload") {
			$this->upload();
		} elseif(segment(2) === "removepassword") {
			$this->removePassword();
		}
	}
	
	public function setCategory() {
		die("Si");
		if(POST("category") === NULL) {
			$vars["error"] = __("You need write category");
		} elseif(POST("language_category") === NULL) {
			$vars["error"] = __("You need select language");
		}
		
		if(!isset($vars["error"])) {
			$this->Categories_Model = $this->model("Categories_Model");
			
			$vars["response"] = $this->Categories_Model->save();
		}
		
		print json_encode($vars);
	}
	
	public function setTags() {
		$tags = POST("tags", "decode", "escape");
		
		$tags  = str_replace(", ", ",", $tags);
		$parts = explode(",", $tags);	
		$count = count($parts);
		$vars["response"] = NULL;
		
	}
	
	public function getVideos() {
		$this->Videos_Model = $this->model("Videos_Model");
		
		if(POST("start") and POST("max")) {	
			$vars = $this->Videos_Model->getVideosBySearch($_POST["search"], POST("max"), POST("start"));
		} else {
			$vars = $this->Videos_Model->getVideosBySearch($_POST["search"]);
		}
		
		print json_encode($vars);
	}
	
	public function upload() {
		$headers = getallheaders();
		____($headers);
	}
	
	public function removePassword() {
		
		$this->Blog_Model = $this->model("Blog_Model");
		
		$ID_Post = POST("ID_Post");
		
		$this->Blog_Model->removePassword($ID_Post);
		
		$vars["response"] = "Done";
		
		print json_encode($vars);
	}
}
