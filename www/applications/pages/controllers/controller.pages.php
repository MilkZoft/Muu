<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Pages_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Templates   = $this->core("Templates");
		$this->Pages_Model = $this->model("Pages_Model");

		$this->helpers();
		
		$this->application = $this->app("pages");
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		$this->CSS("style", $this->application);
		
		if(isLang() and segment(2)) {
			if(segment(2) === "hospedaje") {
				$this->getView(segment(2));
			} elseif(segment(2) === "souvenirs") {
				$this->getView(segment(2));
			} elseif(segment(2) === "tours") {
				$this->getView(segment(2));
			} elseif(segment(2) === "ubicacion") {
				$this->getView(segment(2));
			} else {
				$this->getBySlug(segment(2));
			}
		} elseif(!isLang() and segment(1)) {
			$this->getBySlug(segment(1));		
		} else {
			$this->getByDefault();			
		}		
	}
	private function getView($view = NULL) {
		$view         = segment(2);
		$vars["view"] = $this->view("$view", TRUE);
		$this->template("content", $vars);			
	}
		
	private function getBySlug($slug = NULL) {		
		if($slug) {
			$data = $this->Pages_Model->getBySlug($slug);	

			if($data) {
				if($data[0]["ID_Translation"] > 0) {
					$translation = $this->Pages_Model->getTranslation($data["ID_Parent"]);
				} else {
					$translation = FALSE;
				}
			} else {
				redirect();
			}
		} else {
			$data = $this->Pages_Model->getByDefault();
			
			if($data[0]["ID_Translation"] > 0) {
				$translation = $this->Pages_Model->getParent($data[0]["ID_Translation"]);
			} else {
				$translation = FALSE;
			}
		}
		
		$this->title($data[0]["Title"]);		
		
		if(is_array($data)) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE);
			
			$this->template("content", $vars);			
		} else {
			$this->template("error404");
		}
	}
	
	private function getByDefault() {		
		$data = $this->Pages_Model->getByDefault();		
		
		$this->title($data[0]["Title"]);
		
		if(is_array($data)) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE);
			
			$this->template("content", $vars);
		} else {
			$this->template("error404");
		}
	}
}
