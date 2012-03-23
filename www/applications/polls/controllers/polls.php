<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Polls_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Templates   = $this->core("Templates");
		$this->Polls_Model = $this->model("Polls_Model");
		
		$this->helpers();
		
		$this->application = "polls";
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		redirect(_webBase);
	}
	
	public function last() {	
		$this->config("polls");
		
		$this->Polls_Model = $this->model("Polls_Model");
		
		$data = $this->Polls_Model->getLastPoll();
		
		if($data) {
			$vars["poll"] = $data;			
			
			$this->view("poll", $vars, "polls");
		} else {
			return FALSE;
		}
	}
	
	public function vote() {
		if(!POST("answer")) {
			showAlert("You must select an answer", _webBase);
		}		
		
		$this->Polls_Model->vote();
		
		showAlert("Thanks for your vote", _webBase);
	}
}