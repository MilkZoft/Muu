<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Controller extends ZP_Controller {
	
	private $pagination = NULL;
	
	public function __construct() {
		$this->config("forums");
		$this->Templates    = $this->core("Templates");
		$this->Pagination   = $this->core("Pagination");
		$this->Forums_Model = $this->model("Forums_Model");
		
		$helpers = array("router", "security", "sessions", "time");
		$this->helper($helpers);
		
		$this->application = "forums";
		
		$this->CSS("colorbox", $this->application);
		$this->CSS("style", $this->application);
		$this->js("jquery.colorbox-min", $this->application);
		$this->js("users", $this->application);
		$this->js("actions", $this->application);
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {
		$this->title("Forums");
	
		if(SESSION("ZanUserID") > 0) {
			$this->Forums_Model->setRank(SESSION("ZanUserID"));
		}
		
		if(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0 and segment(4) === "new") {
			$this->setReply();
		} elseif(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0 and segment(4) === "edit" and segment(5) > 0) {
			$this->setReply();
		} elseif(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0 and segment(4) === "edit") {
			$this->setTopic();
		} elseif(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0 and segment(4) === "delete" and segment(5) > 0) {
			$this->deleteReply();
		} elseif(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0 and segment(4) === "delete") {
			$this->deleteTopic();
		} elseif(!is_numeric(segment(2)) and segment(3) !== "new" and segment(3) > 0) {	
			$this->getByTopic();
		} elseif(segment(3) === "new") {
			$this->setTopic();
		} elseif(segment(2) !== FALSE) {
			$this->getByForum();			
		} else {
			$this->getByDefault();			
		}		
	}
	
	private function getByDefault() {
		$language = whichLanguage(segment(0));
		$data   = $this->Forums_Model->getByDefault($language);
				
		if($data) {
			$visit  = $this->Forums_Model->addUserVisit();
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
			$users  = $this->Forums_Model->getLastUsers();
			
			$vars["users"]  = $users;		
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
			$vars["URL"]	= _webBase . _sh . _webLang . _sh . $this->application;
			$vars["view"]   = $this->view("forums", $this->application, TRUE);
			$this->template("content", $vars);			
		} else {
			redirect(_webBase);
		}
		
		$this->render();		
	}
	
	private function getByForum() {
		$nice = segment(2);
		$language = whichLanguage(segment(0));
		$data = $this->Forums_Model->getByForum($nice, $language);
			
		if($data) {
			$visit  = $this->Forums_Model->addUserVisit();
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
			$users  = $this->Forums_Model->getLastUsers();
			
			$vars["users"]  = $users;		
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
			$vars["forum"]  = $data[0];
			$vars["topics"] = $data[1];
			$vars["URL"]	= _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice;
			$vars["view"]   = $this->view("forum", $this->application, TRUE);
			
			$this->template("content", $vars);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . "forums");
		}
		
		$this->render();
	}

	private function getByTopic() {		
		$ID = segment(3);
		$forum = segment(2);
		
		if(segment(4) === _page and segment(5) > 0) {
			$page = segment(5);
		} else {
			$page = 0;
		}
							
		$end = _maxLimit;	
		if($page === 0) {
			$start = 0; 
		} else { 
			$start = ($page * $end) - $end;
		}
		
		$limit = $start .", ". $end;
		$URL   = _webBase . _sh . _webLang . _sh . _forums . _sh . $forum . _sh . $ID . _sh . _page . _sh;
		
		$data = $this->Forums_Model->getByTopic($ID, $limit);
		
		if(!$data["replies"] and $page > 1) {
			redirect(_webBase . _sh . _webLang . _sh . _forums . _sh . $forum . _sh . $ID . _sh);
		}
		
		$count = $this->Forums_Model->countRepliesByTopic($ID);
		
		if($count > $end) {
			 $pagination = $this->Pagination->paginate($count, _maxLimit, $start, $URL);
		}
		
		if($data["topic"]) {		
			$this->Forums_Model->addVisit($ID);
			
			$visit  = $this->Forums_Model->addUserVisit();
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
			$users  = $this->Forums_Model->getLastUsers();
			
			$vars["users"]  = $users;		
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
				
			if(isset($pagination)) {
				$vars["pagination"] = $pagination;
			}
			
			$vars["count"] = $count;
			$vars["data"]  = $data;

			if($page > 0) {
				$vars["URL"]	= _webBase . _sh . _webLang . _sh . $this->application . _sh . $forum . _sh . $ID . _sh . _page . _sh . $page;
			} else {
				$vars["URL"]	= _webBase . _sh . _webLang . _sh . $this->application . _sh . $forum . _sh . $ID;
			}
			$vars["view"]  = $this->view("topic", $this->application, TRUE);
				
			$this->template("content", $vars);
			
		} else {
			redirect(_webBase . _sh . _webLang . _sh . "forums" . _sh . segment(2));
		}
		
		$this->render();
	}
	
	private function setTopic() {
		$nice = segment(2);
		$language = whichLanguage(segment(0));
		if(segment(4)) {
			$action = "edit";
			$ID     = segment(3);
		} else { 
			$action = "save";
		}
		
		if(SESSION("ZanUserID") > 0) {
			$this->js("tiny-mce", NULL, "basic");
			$this->js("validations", $this->application);
			
			if(POST("cancel")) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh);
			}
			
			if(!POST("doAction")) {
				if($action === "save") {
					$forum = $this->Forums_Model->getIDByForum($nice, $language);
				} elseif($action === "edit") {
					$forum = $this->Forums_Model->getTopicByID($ID);
					$vars["ID_Post"] = $ID;
				}
				
				if($forum) {
					$vars["ID"]       = $forum[0]["ID_Forum"];
					$vars["title"]    = (isset($forum[0]["Title"])) ? $forum[0]["Title"] : "";
					$vars["content"]  = (isset($forum[0]["Content"])) ? $forum[0]["Content"] : "";
					$vars["action"]   = $action;
					$vars["hrefURL"]  =  _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh;
					
					if($action === "save") {
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . "new";
					} else {
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . $ID . _sh . "edit";
					}
					$vars["view"]    = $this->view("newtopic", $this->application, TRUE);
					
					$this->template("content", $vars);
				}
			} else {
				if(!POST("title")) {
					$alert = getAlert("You must to write a title");
				} elseif(isEmptyTiny(POST("content", "decode", FALSE))) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("title")) < 4) {
					$alert = getAlert("You must to write a valid title");
				} elseif(!POST("content")) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("content")) < 4) {
					$alert = getAlert("You must to write a valid content");
				} elseif(isInjection(POST("content", "decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isVulgar(strtolower(POST("title")))) {
					$alert = getAlert("The title is vulgar");
				} elseif(isVulgar(strtolower(POST("content")))) {
					$alert = getAlert("The content is vulgar");
				} elseif(isSPAM(POST("content"))) {
					$alert = getAlert("The content has spam");
				} 
				
				if(isset($alert)) {
					$vars["alert"]   = $alert;
					$vars["ID"]      = POST("ID_Forum");
					$vars["title"]   = POST("title");
					$vars["content"] = cleanTiny(POST("content", "decode", FALSE));
					$vars["action"]  = $action;
					$vars["hrefURL"] =  _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh;
					if($action === "save") {
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . "new";
					} else {
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . $ID . _sh . "edit";
					}
					$vars["view"]    = $this->view("newtopic", $this->application, TRUE);
					
					$this->template("content", $vars);
				} else {
					
					if($action === "save") {
						$success = $this->Forums_Model->setTopic();
						if($success > 0) {
							$topic = $this->Forums_Model->addUserTopic();
							$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . $success . _sh;
						}
					} elseif($action === "edit") { 
						$success = $this->Forums_Model->editTopic();
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh . $ID . _sh;
					}
									
					$vars["success"] = $success;
					$vars["action"]  = $action;
					$vars["hrefE"]   = _webBase . _sh . _webLang . _sh . $this->application . _sh . $nice;
					$vars["view"]    = $this->view("newtopic", $this->application, TRUE);
					
					$this->template("content", $vars);
				}
				
			}
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . $nice . _sh);
		}
		
		$this->render();
	}
	
	private function setReply() {
		$ID_Topic = segment(3);
		
		if(segment(4) === "edit") {
			$action = "edit";
			$ID_Reply = segment(5);
		} elseif(segment(4) === "new") { 
			$action = "save";
		}
		
		if(segment(6) > 0) {
			$page = segment(6);
		} else {
			$page = 1;
		}
			
		if(SESSION("ZanUserID") > 0) {
			$this->js("tiny-mce", NULL, "basic");
			$this->js("validations", $this->application);
			
			if(POST("cancel")) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . segment(3) . _sh);
			}
			
			if(!POST("doAction")) {
				if($action === "save") {
					$topic = $this->Forums_Model->getTopicByID($ID_Topic);
				} elseif($action === "edit") {
					$topic = $this->Forums_Model->getTopicByID($ID_Reply);
				}
				
				if($topic) {
					$vars["ID_Post"]  = $topic[0]["ID_Post"];
					$vars["ID_Forum"] = $topic[0]["ID_Forum"];
					
					
					if($action === "save") {
						$vars["title"]   = "Re: " . $topic[0]["Title"];
						$vars["content"] = "";
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . "new";
						$vars["hrefURL"] = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh;
					} elseif($action === "edit") {
						$vars["title"]    = $topic[0]["Title"];
						$vars["content"]  = $topic[0]["Content"];
						$vars["ID_Topic"] = $topic[0]["ID_Parent"];
						$vars["hrefURL"]  = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . _page . _sh . $page;
						$vars["href"]     = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . "edit" . _sh . $ID_Reply . _sh . $page;
					}
					
					$vars["action"]  = $action;					
					
					$vars["view"]    = $this->view("reply", $this->application, TRUE);
					
					$this->template("content", $vars);
				}
			} else {
				if(!POST("title")) {
					$alert = getAlert("You must to write a title");
				} elseif(isEmptyTiny(POST("content", "decode", FALSE))) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("title")) < 4) {
					$alert = getAlert("You must to write a valid title");
				} elseif(!POST("content")) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("content")) < 4) {
					$alert = getAlert("You must to write a valid content");
				} elseif(isInjection(POST("content", "decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isEmptyTiny(POST("content","decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isVulgar(strtolower(POST("title")))) {
					$alert = getAlert("The title is vulgar");
				} elseif(isVulgar(strtolower(POST("content")))) {
					$alert = getAlert("The content is vulgar");
				} elseif(isSPAM(POST("content"))) {
					$alert = getAlert("The content has spam");
				} 
				
				if(isset($alert)) {
					$vars["alert"]   = $alert;
					$vars["ID_Post"]  = POST("ID_Post");
					$vars["ID_Forum"] = POST("ID_Forum");
					$vars["title"]    = POST("title");
					$vars["content"]  = cleanTiny(POST("content", "decode", FALSE));
					$vars["action"]   = $action;
					
					if($action === "save") {
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . "new";
						$vars["hrefURL"] = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh;
					} elseif($action === "edit") {
						$vars["ID_Topic"] = POST("ID_Topic");
						$vars["href"]    = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . "edit" . _sh . $ID_Reply . _sh . $page;
						$vars["hrefURL"] = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . _page . _sh . $page;
					}
					$vars["view"]    = $this->view("reply", $this->application, TRUE);
					
					$this->template("content", $vars);
				} else {
					
					if($action === "save") {
						$success = $this->Forums_Model->setReply();
						if($success > 0) {
							$page = $this->Forums_Model->getPage($ID_Topic);
							$reply = $this->Forums_Model->addUserReply();
						} else {
							$page = 1;
						}
					} elseif($action === "edit") {
						$success = $this->Forums_Model->editReply();
					}
					
					
					$vars["success"] = $success;
					$vars["action"]  = $action;
					if($action === "save") {
						$vars["href"] = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . _page . _sh . $page . _sh . "#bottom";
					} elseif($action === "edit") {
						$vars["href"] = _webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . $ID_Topic . _sh . _page . _sh . $page;
					}
					
					$vars["view"]    = $this->view("reply", $this->application, TRUE);
					
					$this->template("content", $vars);
				}
			}
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . segment(3) . _sh);
		}
		
		$this->render();
	}
	
	private function deleteTopic() {
		$ID = segment(3);
		
		if(SESSION("ZanUserID")) {
			$delete = $this->Forums_Model->deleteTopic($ID);
			
			if($delete) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh);
			} else {
				//Código para mostrar la alerta, en un futuro.
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh);
			}	
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh);
		}
	}
	
	private function deleteReply() {
		$ID = segment(5);
		if(segment(6) > 0) {
			$page = segment(6);
		} else { 
			$page = 1;
		}
		
		if(SESSION("ZanUserID")) {
			$delete = $this->Forums_Model->deleteReply($ID);
			
			if($delete) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh . segment(3) . _sh . _page . _sh . $page);
			} else {
				//Código para mostrar la alerta, en un futuro.
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh);
			}	
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . segment(2) . _sh);
		}
	}

}
