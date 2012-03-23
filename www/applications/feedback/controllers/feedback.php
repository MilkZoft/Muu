<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Feedback_Model = $this->model("Feedback_Model");
		$this->Templates 	  = $this->core("Templates");
		
		$this->application = "feedback";
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		$this->feedback();
	}
	
	private function feedback() {
		$this->CSS("feedback", $this->application);
		$this->js("tiny-mce", NULL, "basic");
		$this->title("Feedback");
		
		if(POST("send")) {						
			$this->vars["alert"] = $this->Feedback_Model->send();
			$this->vars["view"]  = $this->view("send", TRUE);
			
			$this->template("content", $this->vars);
		} else {
			$this->vars["view"] = $this->view("send", TRUE);
			$this->template("content", $this->vars);		
		}
	}
}
