<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->config("email");
		
		$this->Email = $this->core("Email");
		$this->Email->setLibrary(_wEmailLibrary);
		
		$this->Email->fromName  = _webName;
		$this->Email->fromEmail = _webEmailSend;
		
		$this->helpers();
		
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
		if(!$trash) {
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
	
	public function read($ID = false, $situation = "Read") {
		if($ID) {
			$this->Db->update($this->table, array("Situation" => $situation), $ID);
		}
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function send() {
		if(!POST("name")) {
			return getAlert("You need to write your name");
		} elseif(!isEmail(POST("email"))) {
			return getAlert("Invalid E-Mail");
		} elseif(!POST("message")) {
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
		$this->Email->subject = __(_("Automatic response")) . " - " . decode(_webName);
		$this->Email->message = 	'
									<p>'. __(_("Your message has been sent successfully, we will contact you as soon as possible, thank you very much!")) .'</p>							
									<p><a href="' . _webBase . '" title="' . decode(_webName) . '">' . decode(_webName) . '</p>									
									';
		$this->Email->send();
	}
	
	private function sendMail() {
		$this->Email->email	  = _webEmailSend;
		$this->Email->subject = __(_("New Message")) ." - ". decode(_webName);
		$this->Email->message = 	'
									<p>'. __(_("Message")) .'</p>									
									<p><strong>'. __(_("Name")) .':</strong> <br /> '    . POST("name")    . '</p>									
									<p><strong>'. __(_("Email")) .':</strong> <br /> '   . POST("email")   . '</p>									
									<p><strong>'. __(_("Company")) .':</strong> <br /> ' . POST("company") . '</p>									
									<p><strong>'. __(_("Phone")) .':</strong> <br /> '   . POST("phone")   . '</p>									
									<p><strong>'. __(_("Subject")) .':</strong> <br /> ' . POST("subject") . '</p>									
									<p><strong>'. __(_("Message")) .':</strong> <br /> ' . POST("message", "decode", FALSE) . '</p>									
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
