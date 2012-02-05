<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates   = $this->core("Templates");
		$this->Users_Model = $this->model("Users_Model");
		
		$this->helpers();
		
		$this->application = $this->app("users");
		
		$this->Templates->theme(_webTheme);
	}
	
	public function index() {	
		if(SESSION("ZanUserID") > 0) {
			$this->Users_Model->setRank(SESSION("ZanUserID"));
		}
	}
	
	public function logout() {
		if(segment(3)) {
			unsetSessions(path(segment(3)));
		} else {
			unsetSessions(_webBase);
		}		
	}
	
	public function activate($code) {
		if(segment(4)) {
			$from = segment(4);
		} else {
			$from = FALSE;
		}
		
		if(!$code) {
			redirect(_webBase);
		} else {
			$user = $this->Users_Model->activate($code);
			
			if($from === "forums") {
				if(is_array($user)) {
					SESSION("ZanUser", $user[0]["Username"]);
					SESSION("ZanUserPwd", $user[0]["Password"]);
					SESSION("ZanUserGod", $user[0]["God"]);
					SESSION("ZanUserID", $user[0]["ID_User"]);
					SESSION("ZanUserPrivilegeID", $user[0]["ID_Privilege"]);
					SESSION("ZanUserPrivilege", $user[0]["Privilege"]);
					
					redirect(path("users" . _sh . "editprofile" . _sh . "activate"));	
				} else {
					showAlert("An error occurred when attempting to activate your account!", _webBase);
				}
			} else { 
				if($user) {
					showAlert("Your account has been activated correctly!", _webBase);
				} else {
					showAlert("An error occurred when attempting to activate your account!", _webBase);
				}
			}
		}
	}
	
	private function editProfile() {
		if(SESSION("ZanUserID") > 0) {
			$this->js("tiny-mce", NULL, "basic");
			
			$ID = SESSION("ZanUserID");
						
			if(segment(3)) {
				$from = segment(3);
			} else {
				$from = FALSE;
			}
			
			$this->js("tooltip", $this->application);
			$this->js("jquery-ui", $this->application);
			$this->js("editprofile", $this->application);
			
			$this->CSS("profile", $this->application);
			$this->CSS("jquery-ui", $this->application);
			
			if(!isset($_POST["edit"])) {
				$user = $this->Users_Model->getForProfile($ID);
				
				if($user) {
					if($user[1][0]["Twitter"] === "") {
						$twitter = FALSE;
					} else {
						$twitter = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "twitter.png";
					}
					
					if($user[1][0]["Facebook"] === "") {
						$facebook = FALSE;
					} else {
						$facebook = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "facebook.png";
					}
					
					if($user[1][0]["Google"] === "") {
						$google = FALSE;
					} else {
						$google = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "google.png";
					}
					
					if($user[1][0]["Linkedin"] === "") {
						$linkedin = FALSE;
					} else {
						$linkedin = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "linkedin.png";
					}
					
					if($user[0][0]["Avatar"] === "") {
						$avatar = _webURL . _sh . "lib" . _sh . "files" . _sh . "images" . _sh . "users" . _sh . "default.png";
					} else {
						if($user[0][0]["Type"] === "Twitter") {
							$avatar = $user[0][0]["Avatar"];
						} else {
							$avatar = _webURL . _sh . $user[0][0]["Avatar"];
						} 
					}
					
					if($from === "activate") {
						$vars["alert"] = getAlert("Hey! Welcome to your profile, please tell us a little about you", "success");
					}
				
					$vars["ID"]       = $user[0][0]["ID_User"];
					$vars["joinDate"] = date("d/m/Y", $user[0][0]["Start_Date"]);
					$vars["twitter"]  = $twitter;
					$vars["avatar"]   = $avatar;
					$vars["facebook"] = $facebook;
					$vars["linkedin"] = $linkedin;
					$vars["google"]   = $google;
					$vars["user"]     = $user;				
					$vars["action"]   = "send";
					$vars["href"]     = path($this->application . _sh . "editprofile" . _sh);
					$vars["view"]     = $this->view("editprofile", $this->application, TRUE);
				} else {
					$vars["view"] = $this->view("error", $this->application, TRUE);
				}
			} else {
				$user = $this->Users_Model->editProfile();
				
				if($user) {
					if(is_array($user)) {
						if($user[1][0]["Twitter"] === "") {
							$twitter = FALSE;
						} else {
							$twitter = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "twitter.png";
						}
						
						if($user[1][0]["Facebook"] === "") {
							$facebook = FALSE;
						} else {
							$facebook = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "facebook.png";
						}
						
						if($user[1][0]["Google"] === "") {
							$google = FALSE;
						} else {
							$google = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "google.png";
						}
						
						if($user[1][0]["Linkedin"] === "") {
							$linkedin = FALSE;
						} else {
							$linkedin = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "linkedin.png";
						}
						
						if($user[0][0]["Avatar"] === "") {
							$avatar = _webURL . _sh . "lib" . _sh . "files" . _sh . "images" . _sh . "users" . _sh . "default.png";
						} else {
							$avatar = _webURL . _sh . $user[0][0]["Avatar"];
						}
						
						if(isset($user[2]) and is_array($user[2])) {
							$count = count($user[2]);
							if($count === 1) {
								$vars["alert"] = $user[2][0];
							} elseif($count === 2) {
								$vars["alert"] = $user[2][0] . $user[2][1];
							}
						}
						
						$vars["ID"]       = $user[0][0]["ID_User"];
						$vars["joinDate"] = date("d/m/Y", $user[0][0]["Start_Date"]);
						$vars["twitter"]  = $twitter;
						$vars["avatar"]   = $avatar;
						$vars["facebook"] = $facebook;
						$vars["linkedin"] = $linkedin;
						$vars["google"]   = $google;
						$vars["user"]     = $user;				
						$vars["action"]   = "send";
						$vars["href"]     = path($this->application . _sh . "editprofile" . _sh);
						$vars["view"]     = $this->view("editprofile", $this->application, TRUE);					
					}
				} else {
					$vars["view"] = $this->view("error", $this->application, TRUE);
				}			
			}
		} else {
			redirect(_webBase);
		}
		
		$this->template("content", $vars);
	}
	
	public function profile() {
		$user = segment(3);
		
		if(!$user) {
			if(SESSION("ZanUserID")) {
				$user = SESSION("ZanUserID");
			} else {
				redirect(_webBase);
			}
		}
		
		$this->Users_Model->setRank($user);
		
		$this->CSS("profile", $this->application);
		
		$user = $this->Users_Model->getForProfile($user);
				
		if($user) {
			if(!$user[1][0]["Twitter"]) {
				$twitter = FALSE;
			} else {
				$twitter = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "twitter.png";
			}
			
			if(!$user[1][0]["Facebook"]) {
				$facebook = FALSE;
			} else {
				$facebook = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "facebook.png";
			}
			
			if(!$user[1][0]["Google"]) {
				$google = FALSE;
			} else {
				$google = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "google.png";
			}
			
			if(!$user[1][0]["Linkedin"]) {
				$linkedin = FALSE;
			} else {
				$linkedin = _webURL . _sh . "applications" . _sh . "users" . _sh . "views" . _sh . "images" . _sh . "linkedin.png";
			}
			
			if(!$user[0][0]["Avatar"]) {
				$avatar = _webURL . _sh . "lib" . _sh . "files" . _sh . "images" . _sh . "users" . _sh . "default.png";
			} else {
				if($user[0][0]["Type"] === "Twitter") {
					$avatar = $user[0][0]["Avatar"];
				} else {
					$avatar = _webURL . _sh . $user[0][0]["Avatar"];
				} 
			}
			
			$vars["ID"]       = $user[0][0]["ID_User"];
			$vars["joinDate"] = date("d/m/Y", $user[0][0]["Start_Date"]);
			$vars["twitter"]  = $twitter;
			$vars["avatar"]   = $avatar;
			$vars["facebook"] = $facebook;
			$vars["linkedin"] = $linkedin;
			$vars["google"]   = $google;
			$vars["user"]     = $user;				
			$vars["action"]   = "send";
			$vars["view"]     = $this->view("profile", TRUE);
		} else {
			$vars["view"] = $this->view("errorProfile", TRUE);
		}		
		
		$this->template("content", $vars);
	}
	
	public function login($from = "users") {
		if(segment(3)) {
			$from = segment(3);
		} 
		
		if($from === "forums") { 
			$this->CSS("loginforums", TRUE);
		} else { 
			$this->CSS("login", $this->application);
		}
		
		$this->title("Login");
		
		if(POST("connect")) {
			if($this->Users_Model->isAdmin() or $this->Users_Model->isMember()) {
				$user = $this->Users_Model->getUserData();
			} else {
				$user = FALSE;
			}
			
			if($user) {
				SESSION("ZanUser", $user[0]["Username"]);
				SESSION("ZanUserPwd", $user[0]["Password"]);
				SESSION("ZanUserGod", $user[0]["God"]);
				SESSION("ZanUserID", $user[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $user[0]["ID_Privilege"]);
				SESSION("ZanUserPrivilege", $user[0]["Privilege"]);
				
				if($from === "forums") {
					$vars["success"] = TRUE;
					$vars["view"]    = $this->view("login", $vars);
				} else {
					redirect(POST("URL"));
				}
			} elseif($from === "cpanel") {
				showAlert("Incorrect Login", path("cpanel"));
			} else {
				if($from === "forums") { 
					$vars["href"] 		= path("users" . _sh . "login" . _sh . $from);
					$vars["noregister"] = TRUE;
					$vars["alert"] 		= getAlert("Incorrect Login");
					$vars["view"]  		= $this->view("login", $vars);
				} else { 
					$vars["href"] 	= path("users" . _sh . "login");
					$vars["alert"] 	= getAlert("Incorrect Login");
					$vars["view"]  	= $this->view("login", TRUE);
				}		
			}		
		} else {
			if($from === "forums") { 
				$vars["href"] 		= path("users" . _sh . "login" . _sh . $from);
				$vars["noregister"] = TRUE;
				$vars["view"]  		= $this->view("login", $vars);
			} else { 
				$vars["href"] = path("users" . _sh . "login");
				$vars["view"] = $this->view("login", TRUE);
			}
		}
		
		$this->template("content", $vars);
	}
	
	private function recover() {
		if(segment(4)) {
			$from = segment(4);
		} else {
			$from = FALSE;
		}
		
		$this->title("Recover Password");
		$this->CSS("recover", $this->application);
		
		if(POST("change")) {			
			$vars["alert"] 	 = $this->Users_Model->change();
			$vars["tokenID"] = POST("tokenID");
			$vars["view"]  	 = $this->view("recover", TRUE);
		} elseif(POST("recover")) {
			$vars["alert"] = $this->Users_Model->recover();
			$vars["view"]  = $this->view("recover", TRUE);
		} elseif(segment(2) === "recover") {
			$token = segment(3);
			
			$tokenID = $this->Users_Model->isToken($token, "Recover");
			
			if($tokenID > 0) {
				$vars["tokenID"] = $tokenID;
				$vars["view"] 	 = $this->view("recover", TRUE);
			} else {
				redirect(_webBase);
			}
		} else {
			$vars["view"] = $this->view("recover", TRUE);		
		}
		
		$this->template("content", $vars);
	}
	
	public function register() {
		if(segment(3)) {
			$from = segment(3);
		} else {
			$from = FALSE;
		}
		
		if($from === "forums") { 
			$this->CSS("registerforums", $this->application, TRUE);
		} else { 
			$this->CSS("register", $this->application);
		}
		
		$this->title("Register");
				
		if(POST("register")) {
			if($from === "forums") {
				$vars["alert"] = $this->Users_Model->setUser("forums");

				if(is_array($vars["alert"])) {
					$vars["success"] = TRUE;
				}
				
				$vars["href"] = path("users" . _sh . "register" . _sh . $from);
				$vars["view"] = $this->view("register", $this->application, $vars);				
			} else {
				$vars["alert"] = $this->Users_Model->setUser();
				$vars["href"]  = path("users" . _sh . "register");
				$vars["view"]  = $this->view("register", TRUE);
			}
		} else {
			if($from === "forums") { 
				$vars["forums"] = TRUE;
				$vars["href"]   = path("users" . _sh . "register" . _sh . $from);
				$vars["view"]   = $this->view("register", $this->application);
			} else { 
				$vars["href"] = path("users" . _sh . "register");
				$vars["view"] = $this->view("register", $this->application);
			}			
		}
	
		$this->template("content", $vars);
	}
}