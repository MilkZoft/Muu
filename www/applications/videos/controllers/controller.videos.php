<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Videos_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Templates   = $this->core("Templates");
		$this->Pagination   = $this->core("Pagination");
		$this->Videos_Model = $this->model("Videos_Model");
		
		$this->config("videos");
		$this->helpers();
		
		$this->application = "videos";
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		$this->videos();
	}
	
	public function videos() {
		$this->CSS("videos", $this->application);
		$this->CSS("prettyPhoto", $this->application);
		$this->CSS("pagination");
		
		$this->Videos_Model = $this->model("Videos_Model");
		
		$limit = $this->limit();
		
		$videos = $this->Videos_Model->getVideos($limit);	
		
		if($videos) {			
			$vars["pagination"] = $this->pagination;
			$vars["videos"] 	= $videos;			
			$vars["view"] 		= $this->view("videos", TRUE, $this->application);
		
			$this->template("content", $vars);
		} 
		
		$this->render();
	
	}
	
	private function limit() { 	
		if(isLang()) {
			if(segment(1) === "videos" and segment(2) > 0) {
				$start = (segment(2) * _maxLimitVideos) - _maxLimitVideos;
			} else {
				$start = 0;
			}
		} else {
			if(segment(0) === "videos" and segment(1) > 0) {
				$start = (segment(2) * _maxLimitVideos) - _maxLimitVideos;
			} else {
				$start = 0;
			}
		}		
		
		$limit = $start .", ". _maxLimitVideos;			
		$count = $this->Videos_Model->count();
		$URL   = _webPath . "videos" . _sh;			
		
		if($count > _maxLimitVideos) { 
			$this->pagination = $this->Pagination->paginate($count, _maxLimitVideos, $start, $URL);
		} else {
			$this->pagination = NULL;
		}	

		return $limit;
	}
	
}
