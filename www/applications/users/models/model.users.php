<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Model extends ZP_Model {

	public function __construct() {
		$this->Db = $this->db();
		
		$this->config("email");
		
		$this->Email = $this->core("Email");

		$this->Email->setLibrary(_wEmailLibrary);
		
		$this->Email->fromName  = _webName;
		$this->Email->fromEmail = _webEmailSend;
		
		$this->helpers();

		$this->Data = $this->core("Data");

		$this->table = "users";
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
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
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanuserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave() {
		$validations = array(
			"username" => "required",
			"email"	   => "email?",
			"pwd"	   => "length:6"
		);

		if((int) POST("privilege") === 1) {
			$privilege = "Super Admin";
		} elseif((int) POST("privielge") === 2) {
			$privilege = "Admin";
		} elseif((int) POST("privilege") === 3) {
			$privilege = "Moderator";
 		} else {
 			$privilege = "Member";
 		}
		
		$data = array(
			"Pwd"		 => encrypt(POST("pwd")),
			"Start_Date" => now(4),
			"Code"		 => code(),
			"Privilege"  => $privilege
		);

		$this->Data->ignore(array("pwd", "pwd2"));

		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
		$insertID = $this->Db->insert($this->table, $this->data);

		$data = array(
					"ID_User" => $insertID,
					"Name" 	  => POST("username")
		);

		$this->Db->insert("users_information", $data);

		$data = array(
					"ID_Privilege" => POST("privilege"),
					"ID_User"	   => $insertID
		);

		$this->Db->insert("re_privileges_users", $data);

		return getAlert("The user has been saved correctly", "success");	
	}
	
	private function edit() {
		//FALTA EDICIÓN
		
		return getAlert("The user has been edit correctly", "success");
	}
	
	public function activate($code) {
		$this->Db->table($this->table);
		$data = $this->Db->findBySQL("Code = '$code' AND Situation = 'Inactive'");
		
		if($data) {
			$this->Db->values("Situation = 'Active'");
			$this->Db->save($data[0]["ID_User"]);

			return $data;			
		} else {
			$actived = $this->Db->findBySQL("Code = '$code' AND Situation = 'Active'");
			if($actived) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	public function change() {
		if(POST("change")) {
			$tokenID   = POST("tokenID");
			$password1 = POST("password1", "decode-encrypt");
			$password2 = POST("password2", "decode-encrypt");
			
			if(POST("password1") === "" or POST("password2") === "") {
				return getAlert("You need to write the two passwords");
			} elseif(strlen(POST("password1")) < 6 or strlen(POST("password2")) < 6) {
				return getAlert("Your password must contain at least 6 characters");
			} elseif($password1 === $password2) {
				$this->Db->table("tokens");
				
				$data = $this->Db->find($tokenID);

				$this->Db->values("Situation = 'Inactive'");
				$this->Db->save($data[0]["ID_Token"]);
					
				if(!$data) {
					showAlert("Invalid Token");
				} else {		
					$this->Db->table("users");
					
					$this->Db->values("Pwd = '$password1'");
					$this->Db->save($data[0]["ID_User"]);
					
					showAlert("Your password has been changed successfully!", _webBase);
				}
			} else {
				return getAlert("The two passwords do not match");
			}
		} else {
			redirect(_webBase);
		}
	}
	
	public function isAdmin($sessions = FALSE) {
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");	
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}
		
		$this->Db->table($this->table);
	
		$data = $this->Db->findBySQL("Username = '$username' AND Pwd = '$password' AND Privilege != 'Member'");
		
		if($data) {
			return TRUE;
		} else {		
			return FALSE;
		}	
	}
	
	public function isMember($sessions = FALSE) {
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");						
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}
		
		$this->Db->table($this->table);
		
		$data = $this->Db->findBySQL("Username = '$username' AND Pwd = '$password' AND Situation = 'Active'");
		
		if($data) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function getUserData($sessions = FALSE) {		
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");						
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}
		
		$this->Db->table($this->table);
		
		$data = $this->Db->findBySQL("Username = '$username' AND Pwd = '$password' AND Situation = 'Active'");	
		
		$user = FALSE;
		
		if($data) {
			$user[0]["ID_User"]  = $data[0]["ID_User"];
			$user[0]["Username"] = $data[0]["Username"];
			$user[0]["Password"] = $data[0]["Pwd"];
			$user[0]["God"]	     = $data[0]["God"];
			
			$this->Db->table("re_privileges_users", "ID_Privilege, ID_User");
			
			$data = $this->Db->findBy("ID_User", $user[0]["ID_User"]);
			 
			if($data) {	
				$this->Db->table("privileges", "ID_Privilege, Privilege");
				
				$data = $this->Db->find($data[0]["ID_Privilege"]);
			
				$user[0]["ID_Privilege"] = $data[0]["ID_Privilege"];
				$user[0]["Privilege"]    = $data[0]["Privilege"];
			} else {
				return FALSE;
			}
		}
			
		return $user;
	}

	public function getOnlineUsers() {	
		$date = time();
		$time = 10;
		$time = $date - $time * 60;
		$IP   = getIP();		
		$user = SESSION("ZanUser");
				
		$this->Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");
		$this->Db->deleteBySQL("Start_Date < $time", "users_online");

		if($user !== "") {		
			$users = $this->Db->findBy("User", $user, "users_online");
			
			if(!$users) {			
				$this->Db->insert("users_online", array("User" => $user, "Start_Date" => $date));
			} else {			
				$this->Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");						
			}		
		} else {
			$users = $this->Db->findBy("IP", $IP, "users_online_anonymous");
									
			if(!$users) {						
				$this->Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));	
			} else {			
				$this->Db->updateBySQL("users_online_anonymous", "Start_Date = '$date' WHERE IP = '$IP'");		
			}	
		}
	}
	
	public function isAllow($permission = "view", $application = NULL) {			
		if(SESSION("ZanUserPrivilegeID") and !SESSION("ZanUserApplication")) {	
			$this->Applications_Model = $this->model("Applications_Model");
			
			if(is_null($application)) {
				$application = whichApplication();		
			}
			
			$privilegeID   = SESSION("ZanUserPrivilegeID");
			$applicationID = $this->Applications_Model->getID($application);
			
			if($this->getPermissions($privilegeID, $applicationID, $permission)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
	
	public function getPermissions($ID_Privilege, $ID_Application, $permission) {		
		$data = $this->Db->findBySQL("ID_Privilege = '$ID_Privilege' AND ID_Application = '$ID_Application'", "re_permissions_privileges");

		if($permission === "add") { 
			return ($data[0]["Adding"])   ? TRUE : FALSE;
		} elseif($permission === "delete") {
			return ($data[0]["Deleting"]) ? TRUE : FALSE;
		} elseif($permission === "edit") {
			return ($data[0]["Editing"])  ? TRUE : FALSE;
		} elseif($permission === "view") {
			return ($data[0]["Viewing"])  ? TRUE : FALSE;
		}
	}
	
	public function recover() {		
		if(POST("recover")) {
			$username = POST("username");
			$email	  = POST("email");
			
			if($username or isEmail($email)) {
				if($username) {
					$data = $this->Db->findBy("Username", $username, $this->table);
				
					if(!$data) {
						return getAlert("This user does not exists in our database");
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;
						
						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens");
						
						if(!$data) {
							$data = array(
										"ID_User" 	 => $userID,
										"Token"		 => $token,
										"Start_Date" => $startDate,
										"End_Date"	 => $endDate
									);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email		= $email;
							$this->Email->subject	= __(_("Recover Password")) ." - ". _webName;
							$this->Email->message	= 	'
														<p>'. __(_("To recover your password, you need to access here")) .'.</p>
														<p>
															'. __(_("You need access to this link:")).' 
															<a href="'. path("users/recover/$token") .'">'. __(_("Recover Password")) .'</a>
														</p>
														';
							$this->Email->send();							
						} else {
							return getAlert("You can not apply for two password resets in less than 24 hours");
						}
					}
				} elseif(isEmail($email)) {
					$data = $this->Db->findBy("Email", $email, $this->table);
					
					if(!$data) {
						return getAlert("This e-mail does not exists in our database");
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;
						
						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens");
						
						if(!$data) {
							$data = array(
										"ID_User" 	 => $userID,
										"Token"		 => $token,
										"Start_Date" => $startDate,
										"End_Date"	 => $endDate
									);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email		= $email;
							$this->Email->subject	= __(_("Recover Password")) ." - ". _webName;
							$this->Email->message	= 	'
														<p>'. __(_("To recover your password, you need to access here")) .'.</p>
														<p>'. __(_("You need access to this link:")) .' 
														<a href="' . path("users/recover/$token") .'">'. __(_("Recover Password")) .'</a></p>
														';
							$this->Email->send();							
						} else {
							return getAlert("You can not apply for two password resets in less than 24 hours");
						}
					}					
				}
				
				return getAlert("We will send you an e-mail so you can recover your password", "Success");
			} else {
				return getAlert("You must enter a username or e-mail at least");					
			}					
		} else {
			return FALSE;
		}
	}
	
	public function setUser($mode = FALSE) {		
		if(isset($_POST["register"])) {	
			$username = trim(POST("username"));
			$password = (POST("password") != "") ? POST("password", "decode-encrypt") : NULL;
			$email	  = POST("email");

			if(!$username) {
				return getAlert("You need to write a username");
			} elseif(strlen($username) < 5) {
				return getAlert("You need to write a username");
			} elseif(strlen($password) < 6) {
				return getAlert("Invalid password");
			} elseif(!isEmail($email)) {
				return getAlert("Invalid e-mail");
			}
			
			$data = $this->Db->findBy("Username", $username, $this->table);
		
			if($data) {
				return getAlert("This user already exists");
			}
			
			$data = $this->Db->findBy("Email", $email, $this->table);
			
			if($data) {
				return getAlert("This e-mail already exists");
			}
			
			$startDate = now(4);
			$code 	   = code();
			$situation = "Inactive";
			
			$values = array(
				"Username"   => $username,
				"Pwd"        => $password,
				"Email"      => $email,
				"Start_Date" => $startDate,
				"Code"       => $code,
				"Situation"  => $situation
			);
			
			$ID_User = $this->Db->insert($this->table, $values);
			
			if($ID_User) {
				$ID_User_Information = $this->Db->insert("users_information", array("ID_User" => $ID_User));

				$this->Db->insert("re_privileges_users", array("ID_Privilege" => "4", "ID_User" => $ID_User));
				
				$this->Email->email   = $email;
				$this->Email->subject = __(_("Account Activation")) ." - ". _webName;
				
				if($mode === "forums") { 
					$this->Email->message	= 	'
						<p>'. __(_("Your account has been created")) .'</p>
						<p>'. __(_("You need access to this link:")) .' 
							<a href="'. path("users/activate/$code/forums") .'">'. __(_("Activate account")) .'</a>
						</p>
					';
				} else {
					$this->Email->message	= 	'
						<p>'. __(_("Your account has been created")) .'</p>
						<p>'. __(_("You need access to this link:")) .' 
							<a href="'path("users/activate/$code") .'">'. __(_("Activate account")) .'</a>
						</p>
					';
				}
				
				$this->Email->send();

				if($mode === "forums") {
					$result["message"] = __(_("The account has been created correctly, we will send you an e-mail so you can activate your account"));		
					
					return $result;
				} else {
					return getAlert("The account has been created correctly, we will send you an e-mail so you can activate your account", "success");
				}
			} else {
				return getAlert("Insert error");
			}
		} else {
			return FALSE;
		}
	}
	
	public function last() {
		$last = $this->Db->findLast($this->table);
		
		return ($last) ? $last[0] : NULL;
	}
	
	public function registered() {		
		$registered = $this->Db->countAll($this->table);
		
		return $registered;
	}
	
	public function online($all = TRUE) {		
		$registered = $this->Db->countAll("users_online");
		
		$anonymous = $this->Db->countAll("users_online_anonymous");
		
		$total = $registered + $anonymous;
		
		return ($all) ? $total : $anonymous;	
	}	
	
	public function isToken($token = FALSE, $action = NULL) {
		if($token and isset($action)) {
			$data = $this->Db->findBySQL("Token = '$token' AND Action = '$action' AND Situation = 'Active'", "tokens");
			
			if(!$data) {
				showAlert("Invalid Token");
			} else {
				return $data[0]["ID_Token"];
			}
		} else {
			showAlert("Invalid Token");
		}
	}
	
	public function getByID($ID) {
		$data = $this->Db->call("getUser($ID)");
		
		return $data;
	}
	
	public function getForProfile($ID) {	
		$data[0] = $this->Db->find($ID, $this->table);
		
		if(!$data[0]) {
			return FALSE;
		}
		
		$data[1] = $this->Db->findBySQL("ID_User = '$ID'", "users_information", $this->table);
		
		if(!$data[1]) {
			return FALSE;
		}
		
		return $data;
	}
	
	public function getPrivileges() {	
		$data = $this->Db->findAll("privileges");
		
		return $data;	
	}
	
	public function editProfile() {
		if(POST("edit")) {
			if(POST("website")) {
				if(POST("website") !== "http://") {
					if(!ping(POST("website"))) {
						$alert = getAlert("Invalid URL");
					}
				} else {
					$website = "";
				}
			}
		
			$ID = POST("ID_User");

			if(isset($alert)) {
				$website = "";
			} else {
				if(POST("website") !== "http://") {
					$website = POST("website", "decode", "escape");
				}
			}
			
			$name     = POST("name", "decode", "escape");
			$gender   = POST("gender", "decode", "escape");
			$birthday = POST("birthday", "decode", "escape");
			$company  = POST("company", "decode", "escape");
			$country  = POST("country", "decode", "escape");
			$district = POST("district", "decode", "escape");
			$town     = POST("town", "decode", "escape");
			$twitter  = POST("twitter", "decode", "escape");
			$facebook = POST("facebook", "decode", "escape");
			$linkedin = POST("linkedin", "decode", "escape");
			$google   = POST("google", "decode", "escape");
			$phone    = POST("telephone", "decode", "escape");
			$sign     = POST("sign", "decode", FALSE);
						
			if(!POST("userTwitter")) {
				$actualAvatar = $this->Db->find($ID, $this->table);
			
				if(FILES("file", "name") !== "") {
					$this->Files = $this->core("Files");
					
					$this->Files->filename  = FILES("file", "name");
					$this->Files->fileType  = FILES("file", "type");
					$this->Files->fileSize  = FILES("file", "size");
					$this->Files->fileError = FILES("file", "error");
					$this->Files->fileTmp   = FILES("file", "tmp_name");
					
					$dir = "www/lib/files/images/users/";
								
					if(!file_exists($dir)) {
						mkdir($dir, 0777); 				
					}
					
					if($actualAvatar[0]["Avatar"] !== "") {
						@unlink($actualAvatar[0]["Avatar"]);
					}
							
					$upload = $this->Files->upload($dir);
					
					if($upload["upload"]) {
						$this->Images = $this->core("Images");
						
						$avatar = $this->Images->getResize("mini", $dir, $upload["filename"], _minOriginal, _maxOriginal);
						
						@unlink($dir . $upload["filename"]);
					} else {
						$alert2 = getAlert($upload["message"]);
					}
				} else {
					$avatar = "";
				}
			
			
				if(isset($alert2)) {
					$avatar = "";
				} 
			} else {
				$avatar = "";
			}
				
			if($avatar === "") {
				$this->Db->update($this->table, array("Website" => $website, "Sign" => $sign), $ID);
				
				if($update) {
					$data[0] = $this->Db->find($ID, $this->table);
				} else {
					return FALSE;
				}
			} else {
				$this->Db->update($this->table, array("Website" => $website, "Sign" => $sign, "Avatar" => $avatar), $ID);
				
				if($update) {
					$data[0] = $this->Db->find($ID, $this->table);
				} else {
					return FALSE;
				}
			}
						
			$userInfo = $this->Db->findBySQL("ID_User = '$ID'", "users_information");

			$ID2 = $userinfo[0]["ID_User"];
			
			$data = array(
						"Name" 	   => $name,
						"Phone"    => $phone, 
						"Company"  => $company, 
						"Gender"   => $gender, 
						"Birthday" => $birthday, 
						"Country"  => $country, 
						"District" => $district, 
						"Town" 	   => $town, 
						"Facebook" => $facebook, 
						"Twitter"  => $twitter, 
						"Linkedin" => $linkedin, 
						"Google"   => $google
					);

			$update = $this->Db->update("users_information", $data, $ID2);
			
			if($update) {
				$data[1] = $this->Db->find($ID2, "users_information");
			} else {
				return FALSE;
			}
			
			if($data) {
				$success = TRUE;

				if(isset($alert)) {
					$data[2][] = $alert;
					
					$success = FALSE;
				}
				
				if(isset($alert2)) {
					$data[2][] = $alert2;
					
					$success = FALSE;
				}

				if($success === TRUE) {
					$data[2][0] = getAlert("Your profile has been edited correctly", "success");
				}

				return $data;
			} else {
				return FALSE;
			}
			
		} else { 
			return FALSE;
		}
	}
	
	public function setRank($ID_User, $rank = FALSE) {
		$ranks[0]  = "Beginner";
		$ranks[1]  = "Advanced Beginner";
		$ranks[2]  = "Member";
		$ranks[3]  = "Full Member";
		$ranks[4]  = "Silver Member";
		$ranks[5]  = "Gold Member";
		$ranks[6]  = "Platinum Member";
		$ranks[7]  = "God of the Forum";
		$ranks[8]  = "Moderator";
		$ranks[9]  = "Administrator";
		$ranks[10] = "Super Administrator";
			
		if(!$rank) {
			$user = $this->Db->find($ID_User, "users");
			
			$normalPoints = $user[0]["Topics"] + $user[0]["Replies"];
			$visitPoints  = $user[0]["Visits"] / 50;
			$points  	  = intval($normalPoints + $visitPoints);
			$actualRank   = $user[0]["Rank"];
			
			if($points === 0) {
				$points = 1;
			}
			
			if($actualRank !== "Super Administrator" and $actualRank !== "Administrator" and $actualRank !== "Moderator") {
				switch($points) {
					case ($points < 50): 
						if($actualRank !== $ranks[0]) {
							$this->Db->update($this->table, array("Rank" => $ranks[0], $ID_User));
						}
					break;
					
					case ($points >= 50 and $points < 100):
						if($actualRank !== $ranks[1]) {
							$this->Db->update($this->table, array("Rank" => $ranks[1], $ID_User));
						}
					break;
					
					case ($points >= 100 and $points < 200):
						if($actualRank !== $ranks[2]) {
							$this->Db->update($this->table, array("Rank" => $ranks[2], $ID_User));
						}
					break;
					
					case ($points >= 200 and $points < 350):
						if($actualRank !== $ranks[3]) {
							$this->Db->update($this->table, array("Rank" => $ranks[3], $ID_User));
						}
					break;
					
					case ($points >= 200 and $points < 350):
						if($actualRank !== $ranks[4]) {
							$this->Db->update($this->table, array("Rank" => $ranks[4], $ID_User));
						}
					break;
					
					case ($points >= 350 and $points < 550):
						if($actualRank !== $ranks[5]) {
							$this->Db->update($this->table, array("Rank" => $ranks[5], $ID_User));
						}
					break;
					
					case ($points >= 550 and $points < 800):
						if($actualRank !== $ranks[6]) {
							$this->Db->update($this->table, array("Rank" => $ranks[6], $ID_User));
						}
					break;
					
					case ($points >= 1000):
						if($actualRank !== $ranks[7]) {
							$this->Db->update($this->table, array("Rank" => $ranks[7], $ID_User));
						}
					break;
				}
			}
		} else {
			$this->Db->update($this->table, array("Rank" => $ranks[$rank], $ID_User));
		}		
	}
}