<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->config("email");
		
		$this->Email = $this->core("Email");
		$this->Email->setLibrary(_wEmailLibrary);
		
		$this->Email->fromName  = decode(_webName);
		$this->Email->fromEmail = _webEmailSend;
		
		$helpers = array("alerts", "router", "validations", "time");
		$this->helper($helpers);
		
		$this->table = "feedback";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Feedback DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Feedback DESC", $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {
		if($trash === FALSE) {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '" . SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	public function read($ID = false, $state = "Read") {
		if($ID) {
			$this->Db->table($this->table);
			$this->Db->values("Situation = '$state'");								
			$this->Db->save($ID);
		}
	}
	
	public function getByID($ID) {
		$this->Db->table($this->table);
		$data = $this->Db->find($ID);
		
		return $data;
	}
	
	public function send() {
		if(POST("name") === NULL) {
			return getAlert("You need to write your name");
		} elseif(!isEmail(POST("email"))) {
			return getAlert("Invalid E-Mail");
		} elseif(POST("message") === NULL) {
			return getAlert("You need to write a message");
		}
		
		$values = array(
			"Name"   	 => POST("name"),
			"Email"   	 => POST("email"),
			"Company"	 => "",
			"Phone" 	 => "",
			"Subject"  	 => "",
			"Message" 	 => POST("message", "decode", FALSE),
			"Start_Date" => now(4),
			"Text_Date"  => now(2)
		);
		
		$insert = $this->Db->insert($this->table, $values);
			
		if(!$insert) {
			return getAlert("Insert error");
		}

		$this->sendMail();
		
		$this->sendResponse();			
		
		return getAlert("Your message has been sent successfully, we will contact you as soon as possible, thank you very much!", "success");
	}
	
	private function sendResponse() {
		$this->Email->email	  = POST("email");
		$this->Email->subject = __("Automatic response") . " - " . decode(_webName);
		$this->Email->message = 	'
									<p>'. __("Your message has been sent successfully, we will contact you as soon as possible, thank you very much!") .'</p>							
									<p><a href="' . _webBase . '" title="' . decode(_webName) . '">' . decode(_webName) . '</p>									
									';
		$this->Email->send();
	}
	
	private function sendMail() {
		$this->Email->email	  = _webEmailSend;
		$this->Email->subject = __("New Message") . " - " . decode(_webName);
		$this->Email->message = 	'
									<p>'. __("Message") .'</p>									
									<p><strong>'. __("Name") .':</strong> <br /> '    . POST("name")    . '</p>									
									<p><strong>'. __("Email") .':</strong> <br /> '   . POST("email")   . '</p>									
									<p><strong>'. __("Company") .':</strong> <br /> ' . POST("company") . '</p>									
									<p><strong>'. decode( __("Phone")) .':</strong> <br /> '   . POST("phone")   . '</p>									
									<p><strong>'. __("Subject") .':</strong> <br /> ' . POST("subject") . '</p>									
									<p><strong>'. __("Message") .':</strong> <br /> ' . POST("message", "decode", FALSE) . '</p>									
									';
		$this->Email->send();
		
	}
	
	public function getNotifications() {
		$data = $this->Db->call("getFeedbackNotifications()");
		
		if($data) {
			return count($data);
		}
		
		return 0;
	}
}
