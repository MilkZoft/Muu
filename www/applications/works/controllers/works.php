<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Controller extends ZP_Controller {
	
	private $effect = FALSE;
	
	public function __construct() {		
		$this->Templates   = $this->core("Templates");
		$this->Gallery_Model = $this->model("Works_Model");
		
		$this->application = "works";
		$this->Pagination = $this->core("Pagination");
		$this->Templates->theme(_webTheme);
		$this->CSS("style", $this->application);
	}
	
	public function index() {
		if(segment(2) === "image" and segment(3) > 0 and segment(4) !== "" and segment(5) === "prev") {		
			$this->getPrev();			
		} elseif(segment(2) === "image" and segment(3) > 0 and segment(4) !== "" and segment(5) === "next") {	
			$this->getNext();		
		} elseif(segment(2) === "image" and segment(3) > 0) {
			$this->showImage();			
		} elseif(segment(2) === "album" and segment(3) !== "")	{		
			$this->showAlbum();			
		} elseif(segment(2) === "album" and segment(3) !== "" and segment(4) === _page and segment(5) > 0) {		
			$this->showAlbum();		
		} elseif(segment(2) === "albums" and segment(3) === _page and segment(4) > 0) {		
			$this->showGallery();
			$this->showAlbums();		
		} else {			
			$this->showGallery();
			#if($this->effect === FALSE) $this->showAlbums();			
		}	
	}
	
	public function showGallery() {		
		
		$this->paginate = NULL;
		
		if(segment(2) === _page and segment(3) > 0) $this->page = segment(3);
		else $this->page = 0;
										
		$this->end = 15;	

		if($this->page == 0) $this->start = 0; else $this->start = ($this->page * $this->end) - $this->end;
		$this->limit = $this->start.", ".$this->end;
		$this->URL   = _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh . _page . _sh;					
		$this->count = $this->Gallery_Model->getCount();
		
						
		if($this->count > $this->end) {
			 $this->paginate = $this->Pagination->paginate($this->count, _maxLimitGallery, $this->start, $this->URL);
		}		
		
		$data = $this->Gallery_Model->getByAlbum(FALSE, $this->limit);
	
		if($data === FALSE) {				
			redirect(_webBase);	
		//Agregar comparación para ver si hay efectos activos, de mientras la quitaré.		
		} else {										
			
			if(isset($this->paginate)) $vars["pagination"] = $this->paginate;
			
			$vars["count"] = $this->count;
			$vars["pictures"] = $data;
			$vars["view"]   = $this->view("gallery", $this->application, TRUE);
			$this->template("content", $vars);
			
			$this->Render();
		}				
	}
	
	public function showImage() {		
					
		$data = $this->Gallery_Model->getByID(segment(3), TRUE);
	
		if(!$data) {
			redirect(_webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery);
		}
		
		if($data["Album"] !== "None") {
			$this->count = $this->Gallery_Model->getCount($data["Album_Nice"]);
		} else {
			$this->count = $this->Gallery_Model->getCount();
		}
					
		//Código para comentarios:
		/*
		if(isset($_POST["publishComment"])) {
			$this->Set("Comment");
		}
		 
		if($this->Users_Model->isMember()) {
			$vars["publish"] = TRUE;
		}
		
		if(isset($error) and is_array($error)) {
			$vars["error"] = $error;
		}
		
		$comments = $this->Gallery_Model->getComments($this->record["ID"]);
		if($comments == FALSE) $vars["comments"] = FALSE;
		else $vars["comments"] = $comments;		
		*/
			
		$vars["count"]   = $this->count;
		$vars["picture"] = $data;
					
		if(_webGalleryComments === TRUE) {
			$vars["view"][0]  = $this->view("image", $this->application, TRUE);
			$vars["view"][1] = $this->view("comments", $this->application, TRUE);
		} else {
			$vars["view"]   = $this->view("image", $this->application, TRUE);			
		}

		$this->template("content", $vars);
		$this->Render();
		
	}
	
}
