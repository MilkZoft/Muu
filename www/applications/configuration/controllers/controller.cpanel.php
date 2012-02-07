<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Controller extends ZP_Controller {
		
	public function __construct() {		
		$this->app("cpanel");
		
		$this->application = whichApplication();
		
		$this->CPanel = $this->classes("CPanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("cpanel");
		
		if(!$this->isAdmin) {
			$this->login();
		}
	}
	
	public function index() {
		if($this->isAdmin) {
			redirect("cpanel");
		} else {
			$this->login();
		}
	}
	
	public function edit() {		
		$this->title("Edit");
		
		$this->CSS("forms", "cpanel");
		
		$Model = ucfirst($this->application) ."_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("edit")) {
			$this->vars["alert"] = $this->$Model->cpanel("edit");
		} elseif(POST("cancel")) {
			redirect("cpanel");
		} 
		
		$data = $this->$Model->getByID(1);
	
		if($data) {
			$this->Applications_Model = $this->model("Applications_Model");
			
			$this->vars["themes"]		       = $this->Templates->getThemes($data[0]["Theme"]);
			$this->vars["defaultApplications"] = $this->Applications_Model->getDefaultApplications($data[0]["Application"]);
			$this->vars["data"]				   = $data;
		
			$this->vars["view"] = $this->view("edit", TRUE, $this->application);
			
			$this->template("content", $this->vars);
		} else {
			redirect(path($this->application ."/cpanel/results"));
		}
	}
	
	public function login() {
		$this->title("Login");
		$this->CSS("login", "users");
		
		if(POST("connect")) {	
			$this->Users_Controller = $this->controller("Users_Controller");
			
			$this->Users_Controller->login("cpanel");
		} else {
			$this->vars["URL"]  = getURL();
			$this->vars["view"] = $this->view("login", TRUE, "cpanel");
		}
		
		$this->template("include", $this->vars);
		$this->render("header", "footer");
		
		exit;
	}	
}