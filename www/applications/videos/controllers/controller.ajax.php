<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ajax_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->application  = whichApplication();
		$this->Videos_Model = $this->model("Videos_Model");
	}
	
	public function index() {
		redirect();
	}
	
	public function next($next = FALSE) {
		if(!$next) {
			$next = POST("next");
		}

		if($next) {			
			$vars["response"] = $this->Videos_Model->query($next);
		} else {
			$vars["response"] = FALSE;
		}
		
		print json($vars);
	}
	
	public function search($search = FALSE) {
		if(!$search) {
			$search = POST("search");
		}
		
		if($search) {
			$vars["response"] = $this->Videos_Model->search($search);
		} else {
			$vars["response"] = FALSE;
		}
		
		print json($vars);
	}
}