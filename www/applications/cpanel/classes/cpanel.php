<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel extends ZP_Load {
	
	public function __construct() {}
	
	public function load() {	
		$this->config("cpanel");
		
		$this->helper("routes", "cpanel");
		$this->helper("cpanel", "cpanel");
					
		$this->Users_Model		  = $this->model("Users_Model");
		$this->Applications_Model = $this->model("Applications_Model");
		$this->Comments_Model     = $this->model("Comments_Model");		
		$this->Feedback_Model     = $this->model("Feedback_Model");	
				
		$this->isAdmin = $this->Users_Model->isAdmin(TRUE);
	
		$this->vars["isAdmin"] = $this->isAdmin;
				
		return $this->isAdmin;
	}
	
	public function getApplicationID($application = NULL) {
		if(is_null($application)) {
			$application = whichApplication();
		}
		
		return $this->Applications_Model->getID($application);
	}
	
	public function notifications() {
		$this->vars["online"]  				 = $this->Users_Model->online();
		$this->vars["registered"]			 = $this->Users_Model->registered();
		$this->vars["lastUser"]				 = $this->Users_Model->last();
		$this->vars["applications"] 		 = $this->Applications_Model->getList();
		$this->vars["commentsNotifications"] = $this->Comments_Model->getNotifications();
		$this->vars["feedbackNotifications"] = $this->Feedback_Model->getNotifications();
		$this->vars["galleryNotifications"]  = $this->Comments_Model->getNotifications(9);	
		
		return $this->vars;
	}
	
}