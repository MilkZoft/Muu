<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Links_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates   = $this->core("Templates");
		
		$this->application = "links";
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		redirect(_webBase);
	}
}
