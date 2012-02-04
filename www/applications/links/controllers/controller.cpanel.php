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
		$this->application = $this->app("cpanel");
		
		$this->CPanel = $this->classes("CPanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("cpanel");
	}
	
	public function index() {
		if($this->isAdmin) {
			$this->add();
		} else {
			redirect("cpanel");
		}
	}
	
	public function add() {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		$this->title("Add");
				
		$this->CSS("forms", "cpanel");
			
		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("save")) {
			$save = $this->$Model->cpanel("save");

			$this->vars["alert"] = $save;
		} elseif(POST("cancel")) {
			redirect("cpanel");
		}
		
	    $this->vars["ID"]  	       = 0;
		$this->vars["title"]       = isset($save["error"]) ? recoverPOST("title") 		: NULL;
		$this->vars["description"] = isset($save["error"]) ? recoverPOST("description") : NULL;
		$this->vars["URL"]         = isset($save["error"]) ? recoverPOST("URL") 		: NULL;
		$this->vars["follow"] 	   = isset($save["error"]) ? recoverPOST("follow") 		: NULL;
		$this->vars["position"]    = isset($save["error"]) ? recoverPOST("position") 	: NULL;
		$this->vars["situation"]   = isset($save["error"]) ? recoverPOST("state") 		: NULL;
		$this->vars["action"]	   = "save";
		$this->vars["href"]	       = path("links/cpanel/add");

		$this->vars["view"] = $this->view("add", TRUE, $this->application);
		
		$this->template("content", $this->vars);
	}
	
	public function delete($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->delete($ID)) {
			redirect($this->application . _sh . "cpanel" . _sh . "results" . _sh . "trash");
		} else {
			redirect($this->application . _sh . "cpanel" . _sh . "results");
		}	
	}
	
	public function edit($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if((int) $ID === 0) { 
			redirect($this->application . _sh . "cpanel" . _sh . "results");
		}

		$this->title("Edit");
		
		$this->CSS("forms", "cpanel");
		
		$Model = ucfirst($this->application) . "_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("edit")) {
			$this->vars["alert"] = $this->$Model->cpanel("edit");
		} elseif(POST("cancel")) {
			redirect("cpanel");
		} 
		
		$data = $this->$Model->getByID($ID);
		
		if($data) {
			$this->vars["ID"]  	       = recoverPOST("ID", 	        $data[0]["ID_Link"]);
			$this->vars["title"]       = recoverPOST("title",       $data[0]["Title"]);
			$this->vars["description"] = recoverPOST("description", $data[0]["Description"]);
			$this->vars["URL"]         = recoverPOST("URL",         $data[0]["URL"]);
			$this->vars["follow"] 	   = recoverPOST("follow",      $data[0]["Follow"]);
			$this->vars["position"]    = recoverPOST("state",       $data[0]["Position"]);
			$this->vars["situation"]   = recoverPOST("state",       $data[0]["Situation"]);
			$this->vars["edit"]        = TRUE;
			$this->vars["action"]	   = "edit";
			$this->vars["href"]	       = path("links/cpanel/edit/$ID");
		
			$this->vars["view"] = $this->view("add", TRUE, $this->application);
			
			$this->template("content", $this->vars);
		} else {
			redirect($this->application . _sh . "cpanel" . _sh . "results");
		}
	}
	
	public function restore($ID = 0) { 
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->restore($ID)) {
			redirect($this->application . _sh . "cpanel" . _sh . "results" . _sh . "trash");
		} else {
			redirect($this->application . _sh . "cpanel" . _sh . "results");
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
		
		$total 		= $this->CPanel_Model->total($trash);
		$thead 		= $this->CPanel_Model->thead("checkbox, ". getFields($this->application) .", Action", FALSE);
		$pagination = $this->CPanel_Model->getPagination($trash);
		$tFoot 		= getTFoot($trash);
		
		$this->vars["message"]    = (!$tFoot) ? "Error" : NULL;
		$this->vars["pagination"] = $pagination;
		$this->vars["trash"]  	  = $trash;	
		$this->vars["search"] 	  = getSearch(); 
		$this->vars["table"]      = getTable(__(_("Manage ". ucfirst($this->application))), $thead, $tFoot, $total);					
		$this->vars["view"]       = $this->view("results", TRUE, "cpanel");
		
		$this->template("content", $this->vars);
	}
	
	public function trash($ID = 0) {
		if(!$this->isAdmin) {
			$this->login();
		}
		
		if($this->CPanel_Model->trash($ID)) {
			redirect($this->application . _sh . "cpanel" . _sh . "results");
		} else {
			redirect($this->application . _sh . "cpanel" . _sh . "add");
		}
	}
}