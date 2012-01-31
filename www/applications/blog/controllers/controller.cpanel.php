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
			redirect("cpanel");
		} else {
			$this->login();
		}
	}
	
	public function add() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->title("Add");
		
		$this->CSS("forms", "cpanel");
		$this->CSS("categories", "categories");
		
		$this->js("tiny-mce");
		$this->js("insert-html");
		$this->js("show-element");		
		
		$this->Library 	  = $this->classes("Library", "cpanel");
		$this->Categories = $this->classes("Categories", "categories");

		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("save")) {
			$save = $this->$Model->cpanel("save");
			
			$this->vars["alert"] = $save;
		} elseif(POST("cancel")) {
			redirect(_webPath . _cpanel);
		}
		
		$this->vars["application"]	= $this->CPanel->getApplicationID();
		$this->vars["categories"]  	= $this->Categories->getCategories("add");
		$this->vars["categoriesRadio"]  = $this->Categories->getCategories("add", "radio", "parent");
		$this->vars["imagesLibrary"]    = $this->Library->getLibrary("images"); 
		$this->vars["documentsLibrary"] = $this->Library->getLibrary("documents");

		$this->vars["ID"]          	= 0;
		$this->vars["ID_URL"]      	= isset($save["error"]) ? recoverPOST("ID_URL") 	: NULL;
		$this->vars["title"]       	= isset($save["error"]) ? recoverPOST("title")		: NULL;
		$this->vars["content"]     	= isset($save["error"]) ? recoverPOST("content")	: NULL;
		$this->vars["situation"]	= isset($save["error"]) ? recoverPOST("situation")	: NULL;
		$this->vars["comments"]    	= isset($save["error"]) ? recoverPOST("comments")	: NULL;	
		$this->vars["language"]    	= isset($save["error"]) ? recoverPOST("language")	: NULL;
		$this->vars["pwd"]   		= isset($save["error"]) ? recoverPOST("pwd")		: NULL;
		$this->vars["edit"]        	= FALSE;
		$this->vars["action"]		= "save";
		$this->vars["href"] 		= path($this->application . _sh . "cpanel" . _sh . "add" . _sh);
				
		$this->js("actions", $this->application);
		$this->js("tagsinput.min", "cpanel");
		$this->js("jquery-ui.min", "cpanel");
		$this->js("tags", "cpanel");
		
		$this->CSS("tagsinput", "cpanel");
		
		$this->vars["view"] = $this->view("add", TRUE, $this->application);
		
		$this->template("content", $this->vars);
	}
	
	public function delete($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->delete($ID)) {
			redirect(path($this->application . _sh . "cpanel" . _sh . "results" . _sh . "trash"));
		} else {
			redirect(path($this->application . _sh . "cpanel" . _sh . "results"));
		}
	}
	
	public function edit($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if((int) $ID === 0) { 
			redirect(path($this->application . _sh . "cpanel" . _sh . "results"));
		}

		$this->title("Edit");
		
		$this->CSS("forms", "cpanel");
		$this->CSS("misc", "cpanel");
		$this->CSS("categories", "categories");
		
		$this->js("tiny-mce");
		$this->js("insert-html");
		$this->js("show-element");	
		
		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("edit")) {
			$this->vars["alert"] = $this->$Model->cpanel("edit");
		} elseif(POST("cancel")) {
			redirect("cpanel");
		} 
		
		$data = $this->$Model->getByID($ID);
		
		if($data) {
			$this->Library 	  = $this->classes("Library", "cpanel");
			$this->Categories = $this->classes("Categories", "categories");		
		
			$this->vars["ID"]  	     	= recoverPOST("ID", 	   	$data[0]["ID_Post"]);
			$this->vars["title"]       	= recoverPOST("title",    	$data[0]["Title"]);
			$this->vars["ID_URL"]      	= recoverPOST("ID_URL",   	$data[0]["ID_URL"]);
			$this->vars["content"]     	= recoverPOST("content",  	$data[0]["Content"]);
			$this->vars["situation"] 	= recoverPOST("situation",	$data[0]["Situation"]);
			$this->vars["enable_comments"]	= recoverPOST("comments", 	$data[0]["Enable_Comments"]);
			$this->vars["language"]    	= recoverPOST("language", 	$data[0]["Language"]);
			$this->vars["pwd"]   		= recoverPOST("pwd",      	$data[0]["Pwd"]);
			$this->vars["image_medium"]	= $data[0]["Image_Medium"];
			$this->vars["edit"]      	= TRUE;	
			$this->vars["action"]		= "edit";
			$this->vars["href"]		= path($this->application . _sh . "cpanel" . _sh . $this->vars["action"] . _sh . $this->vars["ID"]);	
			$this->vars["muralImage"] 	= $this->$Model->getMuralByID(isLang() ? segment(4) : segment(3));
			$this->vars["muralDeleteURL"] 	= ($this->vars["muralImage"]) ? path($this->application . _sh . "cpanel" . _sh . "delete-mural" . _sh . $this->vars["ID"])  : NULL;
			$this->vars["application"]	= $this->CPanel->getApplicationID($this->application);
			$this->vars["categories"]	= $this->Categories->getCategories("edit");
			$this->vars["categoriesRadio"]  = $this->Categories->getCategories("add", "radio", "parent");
			$this->vars["imagesLibrary"]    = $this->Library->getLibrary("images");
			$this->vars["documentsLibrary"] = $this->Library->getLibrary("documents");
			
			$this->Tags_Model = $this->model("Tags_Model");
			
			$this->vars["tags"] = $this->Tags_Model->getTagsByRecord(3, isLang() ? segment(4) : segment(3), TRUE);
		
			$this->js("actions", "cpanel");
			$this->js("www/lib/scripts/ajax/password.js", TRUE);
			$this->js("tagsinput.min", "cpanel");
			$this->js("jquery-ui.min", "cpanel");
			$this->js("tags", "cpanel");
			
			$this->CSS("tagsinput", "cpanel");	
		
			$this->vars["view"] = $this->view("add", TRUE, $this->application);
			
			$this->template("content", $this->vars);
		} else {
			redirect(path($this->application . _sh. "cpanel" . _sh . "results"));
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
	
	public function restore($ID = 0) { 
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->restore($ID)) {
			redirect(path($this->application . _sh . "cpanel" . _sh . "results" . _sh . "trash"));
		} else {
			redirect(path($this->application . _sh . "cpanel" . _sh . "results"));
		}
	}
	
	public function results() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->title("Manage ". $this->application);
		$this->CSS("results", "cpanel");
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
		
		$total 	    = $this->CPanel_Model->total($trash);
		$thead 	    = $this->CPanel_Model->thead("checkbox, ". getFields($this->application) .", Action", FALSE);
		$pagination = $this->CPanel_Model->getPagination($trash);
		$tFoot 	    = getTFoot($trash);
		
		$this->vars["message"]    = (!$tFoot) ? "Error" : NULL;
		$this->vars["pagination"] = $pagination;
		$this->vars["trash"]  	  = $trash;	
		$this->vars["search"] 	  = getSearch(); 
		$this->vars["table"]      = getTable(__(_("Manage " . ucfirst($this->application))), $thead, $tFoot, $total);					
		$this->vars["view"]       = $this->view("results", TRUE, _cpanel);
		
		$this->template("content", $this->vars);
	}
	
	public function trash($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->trash($ID)) {
			redirect(path($this->application . _sh . "cpanel" . _sh . "results"));
		} else {
			redirect(path($this->application . _sh . "cpanel" . _sh . "add"));
		}
	}
	
	public function upload() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->Library = $this->classes("Library", "cpanel");	
			
		$this->Library->upload();
	}
}
