<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Twitter_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->core("Db");
		$this->Twitter_Api   = $this->library("Twitter", NULL, TRUE);
	}
	
	public function account() {
		return $this->Twitter_Api->account();
	}
	
	public function tweets() {
		return $this->Twitter_Api->tweets();
	}
	
	public function mentions() {
		return $this->Twitter_Api->mentions();
	}
	
	public function messages() {
		return $this->Twitter_Api->messages();
	}
	
	public function timeline() {
		return $this->Twitter_Api->timeline();
	}
	
	public function followers() {
		return $this->Twitter_Api->followers();
	}
	
	public function tweet($tweet) {
		return $this->Twitter_Api->tweet(utf8_encode($tweet));
	}
	
	public function getAcount($username) {
		return $this->Twitter_Api->getAcount($username);
	}
	
	public function getAvatar($username) {
		return $this->Twitter_Api->getAvatar($username);
	}
	
	public function publish($title = "", $URL = "") {
		if($title !== "" and $URL !== "") {
			if(strlen($title) > 104) {
				$_title = substr($title, 0, 101);
				$_title = $_title . "...";  
				$title  = $_title;
			}
			
			return $this->tweet($title . " " . $URL);
		}
	}
	
	public function setMessage($text = "", $name = "") {
		if(is_array($text)) {
			return $this->Twitter_Api->setMessage($text);
		} elseif($text !== "" and $screen_name !== "") {
			return $this->Twitter_Api->setMessage(array("text" => $text, "screen_name" => $name));
		} else {
			return FALSE;
		}
	}
	
	public function saveUser($user) {		
		$exist = $this->exist($user->screen_name);
		
		if(!$exist) {
			$this->helper("time");
			$date         = now(4);
			$imageProfile = str_replace("normal", "bigger", $user->profile_image_url);
			
			if($user->url === NULL) {
				$website = "http://twitter.com/" . $user->screen_name;
			} else {
				$website = $user->url;
			}
			
			$fields = "Username, Website, Avatar, Rank, Start_Date, Type";
			$values = "'$user->screen_name', '$website', '$imageProfile', 'Beginner', '$date', 'Twitter'";
				
			$this->Db->table("users", $fields);
			$this->Db->values($values);		
			
			$insertID = $this->Db->save();
			
			$fields = "ID_User, Name, Twitter";
			$values = "'$insertID', '$user->name', '$user->screen_name'";
			
			$this->Db->table("users_information", $fields);
			$this->Db->values($values);
			$this->Db->save();
			
			$this->Twitter_Api->welcome();
			
			return $this->exist($user->screen_name);
		} else {
			return $exist;
		}
	}
	
	public function exist($username) {
		$this->Db->table("users", "ID_User, Privilege");
		$result = $this->Db->findBySQL("Username = '$username' AND Type = 'Twitter'");
		
		if($result) {
			return $result[0];
		} else {
			return FALSE;
		}
	}
}
