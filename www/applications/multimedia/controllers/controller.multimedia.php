<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Controller extends ZP_Controller {
	
	private $pagination = NULL;
	
	public function __construct() {		
		$this->application = $this->app("blog");
		$this->config($this->application);
		$this->config("applications");
		
		$this->Templates  = $this->core("Templates");
		
		$this->Blog_Model = $this->model("Blog_Model");
		$this->Tags_Model = $this->model("Tags_Model");
				
		$this->helpers();
				
		$this->journal = FALSE;
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		if(segment(2) === "category" and segment(3) !== "page") {
			$this->category();					
		} elseif(segment(2) === "tag" and segment(3)) {
			$this->tag();
		} elseif(isYear(segment(2)) and isMonth(segment(3)) and isDay(segment(4)) and segment(5) and segment(5) !== "page") { 
			$this->slug();
		} elseif(isYear(segment(2)) and isMonth(segment(3)) and isDay(segment(4))) { 
			$this->day();
		} elseif(isYear(segment(2)) and isMonth(segment(3))) {
			$this->month();
		} elseif(isYear(segment(2))) {
			$this->year();
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
		$this->CSS("videos", "videos");
		$this->CSS("prettyPhoto", "videos");		
		$this->CSS("pagination");						
		
		$data = $this->Blog_Model->getPosts(_maxLimitJournal, FALSE);
			
		if($data) {				
			$vars["posts"] = $data;
			$vars["view"]  = $this->view("journal", TRUE);			
	
			$this->template("content", $vars);
		} 
	}
	
	private function day() {
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("day");		
		$data  = $this->Blog_Model->getByDate($limit, segment(2), segment(3), segment(4));	
	
		if($data) {
			$this->title("Blog - ". segment(2) ."/". segment(3) ."/". segment(4));
			
			$vars["posts"] 	    = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]  	    = $this->view("posts", TRUE);
			
			$this->template("content", $vars);			
		} else {
			$this->template("error404");
		}
	}
	
	private function month() {
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("month");	
		$data  = $this->Blog_Model->getByDate($limit, segment(2), segment(3));	

		if($data) {
			$this->title("Blog - ". segment(2) ."/". segment(3));
			
			$vars["posts"] 	    = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]  	    = $this->view("posts", TRUE);
			
			$this->template("content", $vars);			
		} else {
			$vars["error"] = __("There is not a publications in this month");
			$vars["view"]  = $this->view("error404", TRUE);
			
			$this->template("content", $vars);
		}
	}
	
	private function year() {
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("year");	
		$data  = $this->Blog_Model->getByDate($limit, segment(2));	

		if($data) {
			$this->title("Blog - ". segment(2));
			
			$vars["posts"] 	    = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("posts", TRUE);
			
			$this->template("content", $vars);			
		} else {
			$this->template("error404");
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
			
			$this->template("content", $vars);
		} else {
			$this->template("error404");
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
			
			$this->template("content", $vars);		
		} else {
			$this->template("error404");
		}
	}
	
	private function slug() {	
		$this->Comments_Model = $this->model("Comments_Model");
		
		$this->CSS("posts", $this->application);
		$this->CSS("comments", $this->application);
				
		if(POST("post-comment")) {
			$alert = $this->Comments_Model->saveComments();
		} else {
			$alert = FALSE;
		}
		
		$data = $this->Blog_Model->getPost(segment(5), segment(2), segment(3), segment(4));
		
		$year  = (isYear(segment(2)))  ? segment(2) : NULL;
		$month = (isMonth(segment(3))) ? segment(3) : NULL;
		$day   = (isDay(segment(4)))   ? segment(4) : NULL; 
		$URL   = path("blog/$year/$month/$day/". segment(5));
		
		$vars["alert"]          = $alert;
		$vars["ID_Post"]        = $data[0]["post"][0]["ID_Post"];
		$vars["dataTags"] 	= $data[0]["tags"];
		$vars["post"] 		= $data[0]["post"][0];
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
					showAlert("Incorrect password", _webBase . _sh . _webLang . _sh . _blog);
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
			
			$this->template("content", $vars);
		} else {
			$this->template("error404");
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
			
			$this->template("content", $vars);
		} else {
			$post  = __("Welcome to") . " ";
			$post .= a(_webName, _webBase) . " ";
			$post .= __("this is your first post, going to your") . " ";
			$post .= a(__("Control Panel"), path("cpanel")) ." ";
			$post .= __("and when you add a new post this post will be disappear automatically, enjoy it!");				
			
			$vars["hello"]    =  __("Hello World");
			$vars["date"]     = now(1);
			$vars["post"]     = $post;
			$vars["comments"] = __("No Comments");				
			$vars["view"]  	  = $this->view("zero", TRUE);
			
			$this->template("content", $vars);				
		}
	}
	
	private function limit($type = "posts") { 
		$start = 0;

		if($type === "posts") {
			if(isLang()) {
				if(segment(2) === "page" and segment(3) > 0) {
					$start = (segment(3) * _maxLimit) - _maxLimit;
				} 	
			} else {
				if(segment(1) === "page" and segment(2) > 0) {
					$start = (segment(2) * _maxLimit) - _maxLimit;
				} 
			}		
			
			$limit = $start .", ". _maxLimit;			
			$count = $this->Blog_Model->count();
			$URL   = path("blog/page/");		
		} elseif($type === "categories") {
			if(isLang()) { 
				if(segment(2) === "category" and segment(3) !== "page" and segment(4) === "page" and segment(5) > 0) {
					$start = (segment(5) * _maxLimit) - _maxLimit;
				} 		
			} else {
				if(segment(1) === "category" and segment(2) !== "page" and segment(3) === "page" and segment(4) > 0) {
					$start = (segment(4) * _maxLimit) - _maxLimit;
				}
			}	
			
			$limit = $start .", ". _maxLimit;		
			$URL   = path("blog/category/". segment(3) ."/page");					
			$count = $this->Blog_Model->count("categories");			
		} elseif($type === "day") {
			if(isLang()) {
				if(isYear(segment(2)) and isMonth(segment(3)) and isDay(segment(4)) and segment(5) === "page" and segment(6) > 0) {
					$start = (segment(6) * _maxLimit) - _maxLimit;
				}			
			} else {
				if(isYear(segment(1)) and isMonth(segment(2)) and isDay(segment(3)) and segment(4) === "page" and segment(5) > 0) {
					$start = (segment(5) * _maxLimit) - _maxLimit;
				}
			}
			
			$limit = $start .", ". _maxLimit;	
			$count = $this->Blog_Model->count("posts");
			$URL   = path("blog/". segment(2) ."/". segment(3) ."/". segment(4) ."/page/");			
		} elseif($type === "month") {
			if(isLang()) {
				if(isYear(segment(2)) and isMonth(segment(3)) and segment(4) === "page" and segment(5) > 0) {
					$start = (segment(5) * _maxLimit) - _maxLimit;
				}			
			} else {
				if(isYear(segment(1)) and isMonth(segment(2)) and segment(3) === "page" and segment(4) > 0) {
					$start = (segment(4) * _maxLimit) - _maxLimit;
				}
			}
		
			$limit = $start .", ". _maxLimit;			
			$count = $this->Blog_Model->count("posts");
			$URL   = path("blog/". segment(2) ."/". segment(3) ."/page/");		
		} elseif($type === "year") {
			if(isLang()) {
				if(isYear(segment(2)) and segment(3) === "page" and segment(4) > 0) {
					$start = (segment(4) * _maxLimit) - _maxLimit;
				}			
			} else {
				if(isYear(segment(1)) and segment(2) === "page" and segment(3) > 0) {
					$start = (segment(3) * _maxLimit) - _maxLimit;
				}
			}
		
			$limit = $start .", ". _maxLimit;			
			$count = $this->Blog_Model->count("posts");
			$URL   = path("blog/". segment(2) ."/page/");			
		} elseif($type === "tag") {
			if(isLang()) {
				if(segment(2) === "tag" and segment(3) and segment(4) === "page" and segment(5) > 0) {
					$start = (segment(5) * _maxLimit) - _maxLimit;
				}
			} else {
				if(segment(1) === "tag" and segment(2) and segment(3) === "page" and segment(4) > 0) {
					$start = (segment(4) * _maxLimit) - _maxLimit;
				}
			}
			
			$limit = $start .", ". _maxLimit;
			$count = $this->Blog_Model->count("tag");
			$URL   = path("blog/tag/". segment(3) ."/page/");
		}
		
		if($count > _maxLimit) { 
			$this->pagination = paginate($count, _maxLimit, $start, $URL);
		} else {
			$this->pagination = NULL;
		}	
		
		return $limit;
	}
}