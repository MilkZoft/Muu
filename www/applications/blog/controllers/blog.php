<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->application = $this->app("blog");
		$this->config($this->application);
		
		$this->Templates  = $this->core("Templates");
		
		$this->Blog_Model = $this->model("Blog_Model");
		$this->Tags_Model = $this->model("Tags_Model");
				
		$this->helpers();
				
		$this->journal = FALSE;
		
		$this->Templates->theme();
	}
	
	public function index($year = NULL, $month = NULL, $day = NULL, $slug = NULL) {
		if(isYear($year) and isMonth($month) and isDay($day) and $slug and $slug !== "page") {
			$this->slug($year, $month, $day, $slug);
		} elseif(isYear($year) and isMonth($month) and isDay($day)) { 
			$this->getPosts($year, $month, $day);
		} elseif(isYear($year) and isMonth($month)) {
			$this->getPosts($year, $month);
		} elseif(isYear($year)) {
			$this->getPosts($year);
		} else {
			if($this->journal and !segment(1)) { 
				$this->journal();
			} else { 
				$this->last();
			}
		}
	}
	
	public function archive() {		
		$this->CSS("archive", TRUE);
		
		$date = $this->Blog_Model->getArchive();		
		
		if($date) {
			$vars["css"]  = "";
			$vars["date"] = $date;
			
			$this->view("archive", $vars, $this->application);
		}				
		
		return FALSE;
	}
	
	public function mural($limit = 10) {
		$this->CSS("mural", $this->application, TRUE);
		$this->CSS("slides", NULL, TRUE);
	
		$data = $this->Blog_Model->getMural($limit);

		if($data) {
			$vars["mural"] = $data;				
			
			$this->view("mural", $vars, $this->application);
		} else {
			return FALSE;
		}
	}
	
	private function journal() {
		$this->title("Journal");
		$this->CSS("posts", $this->application);
		$this->CSS("journal", $this->application);
		$this->CSS("pagination");						
		
		$data = $this->Blog_Model->getPosts(_maxLimitJournal, FALSE);
			
		if($data) {				
			$vars["posts"] = $data;
			$vars["view"]  = $this->view("journal", TRUE);			
	
			$this->render("content", $vars);
		} 
	}
	
	private function getPosts($year = NULL, $month = NULL, $day = NULL) {
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		if($day) {
			$limit = $this->limit("day");		
		} elseif($month) {
			$limit = $this->limit("day");
		} else {
			$limit = $this->limit("year");
		}

		$data = $this->Blog_Model->getByDate($limit, $year, $month, $day);	
	
		if($data) {
			$this->title("Blog - ". $year ."/". $month ."/". $day);
			
			$vars["posts"] 	    = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]  	    = $this->view("posts", TRUE);
			
			$this->render("content", $vars);			
		} else {
			$this->render("error404");
		}
	}
	
	public function getLastPostByCategory($category) {
		$data = $this->Blog_Model->getByCategory($category, 1);

		if($data) {
			$vars["post"] = $data[0];

			$this->view("one", $vars, "blog");
		}
	}
	
	public function category() {
		$this->title(ucfirst(segment(3)));
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		if(isLang()) {
			$category = segment(3);	
		} else {
			$category = segment(2);
		} 			
		
		$limit = $this->limit("categories");
		$data  = $this->Blog_Model->getByCategory(segment(3), $limit);
		
		if($data) {								
			$vars["posts"]      = $data;
			$vars["pagination"] = $this->pagination;
			
			if($category === "politica") {
				$vars["view"] = $this->view("politica", TRUE);
			} else {
				$vars["view"] = $this->view("posts", TRUE);
			}
			
			$this->render("content", $vars);
		} else {
			$this->render("error404");
		}
	}
	
	public function tag($tag) {
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("tag");	
		$data  = $this->Blog_Model->getByTag($tag, $limit[0], $limit[1]);
		
		if($data) {
			$vars["posts"] 	    = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]  	    = $this->view("posts", TRUE);
			
			$this->render("content", $vars);		
		} else {
			$this->render("error404");
		}
	}
	
	private function slug($year = NULL, $month = NULL, $day = NULL, $slug = NULL) {	
		$this->Comments_Model = $this->model("Comments_Model");
		
		$this->CSS("posts", $this->application);
		$this->CSS("comments", $this->application);
				
		$alert = (POST("post-comment")) ? $this->Comments_Model->saveComments() : FALSE;
		
		$data = $this->Blog_Model->getPost($year, $month, $day, $slug);
		
		$URL   = path("blog/$year/$month/$day/". segment(5));
		
		$vars["alert"]          = $alert;
		$vars["ID_Post"]        = $data[0]["post"][0]["ID_Post"];
		$vars["dataTags"] 		= $data[0]["tags"];
		$vars["post"] 			= $data[0]["post"][0];
		$vars["dataCategories"] = $data[0]["categories"];
		$vars["dataComments"] 	= $data[0]["comments"];
		$vars["URL"] 	        = $URL;					
		
		if($data) {	
			$this->title(decode($data[0]["post"][0]["Title"]));
			
			if($data[0]["post"][0]["Pwd"] === "") {			
				$vars["view"][0] = $this->view("post", TRUE);		
					
				if($data[0]["post"][0]["Enable_Comments"]) {	
					$vars["view"][1] = $this->view("comments", TRUE);
				}
			} elseif(POST("access")) {
				if(POST("password", "encrypt") === POST("pwd")) {
					if(!SESSION("access-id")) {
						SESSION("access-id", $data[0]["post"][0]["ID_Post"]);					
					} else {
						SESSION("access-id", $data[0]["post"][0]["ID_Post"]);
					}
					
					redirect($URL);
				} else {
					showAlert("Incorrect password", "blog");
				}				
			} elseif(!SESSION("access-id") and strlen($data[0]["post"][0]["Pwd"]) === 40 and !POST("access")) {
				$vars["password"] = $data[0]["post"][0]["Pwd"];
				$vars["view"] 	  = $this->view("access", TRUE);
			} elseif(SESSION("access-id") === $data[0]["post"][0]["ID_Post"]) {
				$vars["view"][0] = $this->view("post", TRUE);		
					
				if($data[0]["post"][0]["Enable_Comments"] === "Yes") {	
					$vars["view"][1] = $this->view("comments", TRUE);
				}
			} elseif(SESSION("access-id") and SESSION("access-id") !== $data[0]["post"][0]["ID_Post"]) {
				$vars["password"] = $data[0]["post"][0]["Pwd"];
				$vars["view"] 	  = $this->view("access", TRUE);						
			}
			
			$this->render("content", $vars);
		} else {
			$this->render("error404");
		}
	}
	
	private function last() {
		$this->title("Blog");
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Blog_Model->getPosts($limit);
		
		if($data) {			
			$vars["posts"]      = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("posts", TRUE);
			
			$this->render("content", $vars);
		} else {
			$post  = __("Welcome to") ." ";
			$post .= a(get("webName"), get("webBase")) ." ";
			$post .= __("this is your first post, going to your") ." ";
			$post .= a(__("Control Panel"), path("cpanel")) ." ";
			$post .= __("and when you add a new post this post will be disappear automatically, enjoy it!");				
				
			$vars["hello"]    =  __("Hello World");
			$vars["date"]     = now(1);
			$vars["post"]     = $post;
			$vars["comments"] = __("No Comments");				
			$vars["view"]  	  = $this->view("zero", TRUE);
			
			$this->render("content", $vars);		
		} 
	}
	
	private function limit($type = "posts") { 
		$start = 0;
		$count = $this->Blog_Model->count("posts");

		if($type === "posts") {
			if(segment(1, isLang()) === "page" and segment(2, isLang()) > 0) { 
				$start = (segment(2, isLang()) * _maxLimit) - _maxLimit;
			} 
							
			$URL   = path("blog/page/");		
		} elseif($type === "categories") {
			if(segment(1, isLang()) === "category" and segment(2, isLang()) !== "page" and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4) * _maxLimit) - _maxLimit;
			}
			
			$URL   = path("blog/category/". segment(3, isLang()) ."/page");					
			$count = $this->Blog_Model->count("categories");			
		} elseif($type === "day") {
			if(isYear(segment(1, isLang())) and isMonth(segment(2, isLang())) and isDay(segment(3, isLang())) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5) * _maxLimit) - _maxLimit;
			}
				
			$URL = path("blog/". segment(2, isLang()) ."/". segment(3, isLang()) ."/". segment(4, isLang()) ."/page/");			
		} elseif($type === "month") {
			if(isYear(segment(1, isLang())) and isMonth(segment(2, isLang())) and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4) * _maxLimit) - _maxLimit;
			}
			
			$URL = path("blog/". segment(2, isLang()) ."/". segment(3, isLang()) ."/page/");		
		} elseif($type === "year") {
			if(isYear(segment(1, isLang())) and segment(2, isLang()) === "page" and segment(3, isLang()) > 0) {
				$start = (segment(3, isLang()) * _maxLimit) - _maxLimit;
			}
			
			$URL = path("blog/". segment(2) ."/page/");			
		} elseif($type === "tag") {	
			if(segment(1, isLang()) === "tag" and segment(2, isLang()) and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4, isLang()) * _maxLimit) - _maxLimit;
			}
			
			$count = $this->Blog_Model->count("tag");
			$URL   = path("blog/tag/". segment(2, isLang()) ."/page/");
		}

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;
		
		return $limit;
	}
}