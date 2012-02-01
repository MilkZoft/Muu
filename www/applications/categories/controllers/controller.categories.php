<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Categories_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates  = $this->core("Templates");
		
		$this->helpers();
		
		$this->application = "categories";
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		redirect(_webBase);
	}
	
	public function getCategories($type = "checkbox", $name = "categories") {
		$this->Categories = $this->classes("Categories", $this->application);
		
		$data = $this->Categories_Model->categories();
		
		if($data) {
			return $this->Categories->build($data, NULL, $type, $name, NULL, NULL, 0);
		}		
	}
}
