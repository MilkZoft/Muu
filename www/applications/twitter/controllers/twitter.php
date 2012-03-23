<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Twitter_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Twitter_Model = $this->model("Twitter_Model");
		$this->Twitter_Api   = $this->library("Twitter", NULL, TRUE);
		$this->application   = "twitter";
	}
	
	public function index() {	
		if(segment(2)) {
			switch (segment(2)) {
				case "gettoken" : $this->token();  break;
				case "login"    : $this->login();  break;
				case "logout"   : $this->logout(); break;
				case "account"  : $this->account(); break;
			}
		} else {
			$this->login();
		}
	}
	
	private function login() {
		$this->Twitter_Api->login(POST("redirect"));
	}
	
	private function logout() {
		$this->Twitter_Api->logout(POST("redirect"));
	}
	
	private function token() {
		$token = $this->Twitter_Api->getAccess();
	}
	
	private function account() {
		$this->Twitter_Model->account();
	}
	
	private function tweets() {
		$this->Twitter_Model->tweets();
	}
	
	private function mentions() {
		$this->Twitter_Model->mentions();
	}
	
	private function messages() {
		$this->Twitter_Model->messages();
	}
	
	private function timeline() {
		$this->Twitter_Model->timeline();
	}
	
	private function followers() {
		$this->Twitter_Model->followers();
	}
	
	private function tweet() {
		$this->Twitter_Model->tweet("Hi, I am MuuCMS :)");
	}
	
	private function setMessage() {
		$this->Twitter_Model->setMessage(array("text" => "Hello!", "screen_name" => "zanphp"));
	}
}