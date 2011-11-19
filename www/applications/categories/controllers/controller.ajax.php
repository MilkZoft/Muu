<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ajax_Controller extends ZP_Controller {
	
	public function __construct() {}
		
	public function setCategory() {
		if(!POST("category")) {
			$vars["error"] = __("You need write category");
		} elseif(!POST("language")) {
			$vars["error"] = __("You need select language");
		}
		
		if(!isset($vars["error"])) {
			$this->Categories_Model = $this->model("Categories_Model");
			
			$vars["response"] = $this->Categories_Model->save();
		}
		
		print json_encode($vars);
	}

}