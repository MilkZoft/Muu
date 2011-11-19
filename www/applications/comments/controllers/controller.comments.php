C<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Comments_Controller extends ZP_Controller {
	
	private $pagination = NULL;
	
	public function __construct() {		
		$this->Templates  = $this->core("Templates");		
		$this->Comments_Model = $this->model("Comments_Model");
		
		$helpers = array("router", "time");
		$this->helper($helpers);
		
		$this->application = "comments";	
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		
	}
	
}
