<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Controller extends ZP_Controller {
	
	private $vars = array();
	
	public function __construct() {		
		$this->app("cpanel");
		
		$this->application = whichApplication();
		
		$this->CPanel = $this->classes("CPanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme(_cpanel);
		
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
		
		$this->CSS("forms", _cpanel);
		$this->CSS("misc", _cpanel);
		$this->CSS("categories", "categories");
		
		$this->js("tiny-mce");
		$this->js("insert-html");
		$this->js("show-element");	
		
		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("edit")) {
			$this->vars["alert"] = $this->$Model->cpanel("edit");
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		} 
		
		$data = $this->$Model->getByID(1);
	
		if($data) {
			$this->Library 	  = $this->classes("Library", _cpanel);
			$this->Categories = $this->classes("Categories", "categories");
			$this->Applications_Model = $this->model("Applications_Model");

			$this->vars["themes"]		       = $this->Templates->getThemes($data[0]["Theme"]);
			$this->vars["defaultApplications"] = $this->Applications_Model->getDefaultApplications($data[0]["Application"]);

			$this->vars["name"]         = recoverPOST("name", 		 $data[0]["Name"]);
			$this->vars["sloganEn"]     = recoverPOST("slogan_en",   $data[0]["Slogan_English"]);
			$this->vars["sloganEs"]     = recoverPOST("slogan_es",	 $data[0]["Slogan_Spanish"]);
			$this->vars["sloganFr"]     = recoverPOST("slogan_fr",   $data[0]["Slogan_French"]);
			$this->vars["sloganPt"]     = recoverPOST("slogan_pt",   $data[0]["Slogan_Portuguese"]);
			$this->vars["URL"]	 	    = recoverPOST("URL", 		 $data[0]["URL"]);
			$this->vars["language"]     = recoverPOST("language", 	 $data[0]["Language"]);
			$this->vars["theme"]	    = recoverPOST("theme", 	  	 $data[0]["Theme"]);
			$this->vars["gallery"]	    = recoverPOST("gallery", 	 $data[0]["Gallery"]);
			$this->vars["validation"]   = recoverPOST("validation",  $data[0]["Validation"]);
			$this->vars["application"]  = recoverPOST("application", $data[0]["Application"]);
			$this->vars["message"]	    = recoverPOST("message",     $data[0]["Message"]);
			$this->vars["activation"]   = recoverPOST("activation",  $data[0]["Activation"]);
			$this->vars["emailRecieve"] = recoverPOST("email1", 	 $data[0]["Email_Recieve"]);
			$this->vars["emailSend"]    = recoverPOST("email2", 	 $data[0]["Email_Send"]);
			$this->vars["situation"]    = recoverPOST("situation",   $data[0]["Situation"]);
			$this->vars["edit"]         = TRUE;	
			$this->vars["action"]	    = "edit";
			$this->vars["href"]		    = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . _edit . _sh;
		
			$this->vars["view"] = $this->view("edit", TRUE, $this->application);
			
			$this->template("content", $this->vars);
		} else {
			redirect(_webBase. _sh. _webLang. _sh. $this->application. _sh. _cpanel . _sh . _results);
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
			$this->vars["view"] = $this->view("login", TRUE, _cpanel);
		}
		
		$this->template("include", $this->vars);
		
		$this->render("header", "footer");
		
		exit;
	}	
}
