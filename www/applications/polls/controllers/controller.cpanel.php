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
	}
	
	public function index() {
		if($this->isAdmin) {
			$this->home();
		} else {
			$this->login();
		}
	}
	
	public function add() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->title("Add");
		
		$this->js("add", "polls");	
		
		$this->CSS("forms", _cpanel);
		
		$this->Library = $this->classes("Library", _cpanel);
				
		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("save")) {
			$this->vars["alert"] = $this->$Model->cpanel("save");
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		$this->vars["ID"]        = 0;
		$this->vars["title"]     = recoverPOST("title");
		$this->vars["answers"]   = NULL;
		$this->vars["type"] 	 = recoverPOST("type");
		$this->vars["situation"] = recoverPOST("state");
		$this->vars["edit"]      = FALSE;
		$this->vars["action"]	 = "save";
		$this->vars["href"]		 = _webPath . _polls . _sh . _cpanel . _sh . "add";

		$this->vars["view"] = $this->view("add", TRUE, $this->application);
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function delete($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->delete($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results . _sh . _trash);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		}	
	}
	
	public function edit($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if((int) $ID === 0) { 
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		}

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
		
		$data = $this->$Model->getByID($ID);
		
		if($data) {
			$this->Library 	  = $this->classes("Library", _cpanel);
			$this->Categories = $this->classes("Categories", "categories");
			
			$this->vars["ID"]  	     = recoverPOST("ID", 	    $data[0]["ID_Poll"]);
			$this->vars["title"]     = recoverPOST("title",     $data[0]["Title"]);
			$this->vars["answers"]   = recoverPOST("answers",   $data[1]);
			$this->vars["type"] 	 = recoverPOST("type",      $data[0]["Type"]);
			$this->vars["situation"] = recoverPOST("state",     $data[0]["State"]);
			$this->vars["edit"]      = TRUE;
			$this->vars["action"]	 = "edit";
			$this->vars["href"]		 = _webPath . _polls . _sh . _cpanel . _sh . "edit" . _sh . $ID;
		
			$this->vars["view"] = $this->view("add", TRUE, $this->application);
			
			$this->template("content", $this->vars);
			
			$this->render();
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
	
	public function restore($ID = 0) { 
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->restore($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results . _sh . _trash);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		}
	}
	
	public function results() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->title("Manage ". $this->application);
		$this->CSS("results", _cpanel);
		$this->CSS("pagination");
		$this->js("checkbox");
		
		$this->helper("inflect");		
		
		if(isLang()) {
			if(segment(4) === "trash") {
				$trash = TRUE;
			} else {
				$trash = FALSE;
			}
		} else {
			if(segment(3) === "trash") {
				$trash = TRUE;
			} else {
				$trash = FALSE;
			}
		}
				
		$total 		= $this->CPanel_Model->total($trash, "record", "records");
		$thead 		= $this->CPanel_Model->thead("checkbox, ". getFields($this->application) .", Action", FALSE);
		$pagination = $this->CPanel_Model->getPagination($trash);
		$tFoot 		= getTFoot($trash);
		
		$this->vars["message"]    = (!$tFoot) ? "Error" : NULL;
		$this->vars["pagination"] = $pagination;
		$this->vars["trash"]  	  = $trash;	
		$this->vars["search"] 	  = getSearch(); 
		$this->vars["table"]      = getTable(__("Manage " . ucfirst($this->application)), $thead, $tFoot, $total);					
		$this->vars["view"]       = $this->view("results", TRUE, _cpanel);
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function trash($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->trash($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _add);
		}
	}
	
	public function upload() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->Library = $this->classes("Library", _cpanel);	
			
		$this->Library->upload();
	}
	
}
