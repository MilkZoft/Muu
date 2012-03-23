<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Comments_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	
	public function __construct() {
		$this->Db = $this->db();

		$helpers = array("alerts", "router", "time", "string");
		
		$this->helper($helpers);
		
		$this->language = whichLanguage();
		$this->table 	= "comments";
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		$this->Db->table($this->table);
		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
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
	
	public function getCommentsByRecord($idApplication, $idRecord) {
		$this->Db->table($this->table);
		$this->Db->encode(TRUE);
		$data = $this->Db->call("getComments($idApplication, $idRecord)");
		
		return $data;
	}
	
	public function saveComments() {
		
		$this->ID_Application = POST("ID_Application");
		$this->ID_Record      = POST("ID_Record");
		$this->comment        = POST("comment", "clean", FALSE);
		$this->email          = POST("email");
		$this->website        = POST("website");
		$this->name 	      = (SESSION("ZanUser"))   ? NULL                       : POST("name");
		$this->username       = (SESSION("ZanUser"))   ? SESSION("ZanUser")         : NULL;
		$this->ID_User        = (SESSION("ZanUserID")) ? (int) SESSION("ZanUserID") : 0;
		$this->state          = "Active";
		$this->date1          = now(4);
		$this->date2 	      = now(2);
		$this->year		      = date("Y");
		$this->month	      = date("m");
		$this->day		      = date("d");
		$this->URL            = POST("URL");

		if($this->ID_Application === "3") {
						
			if($this->comment === NULL) {
				return getAlert("Empty Comment");
			}
			
			if(isSPAM($this->comment) === TRUE) {
				return getAlert("STOP, SPAM");
			}
			
			if(isVulgar($this->comment) === TRUE) {
				return getAlert("STOP, The Comment is Vulgar");
			}
			
			if(isInjection($this->comment) === TRUE) {
				return getAlert("STOP, Injection");
			} else {
				cleanHTML($this->comment);
			}
			
			if($this->ID_User > 0) {			
				$this->Db->table($this->table);
				$repost = $this->Db->findBySQL("Comment = '$this->comment' AND Year = '$this->year' AND Month = '$this->month' AND Day = '$this->day' AND Name = '$this->name'");
			
				if(is_array($repost)) {
					return getAlert("This Comment has been posted yet");
				}
					
				$fields  = "ID_User, Username, Comment, Start_Date, Text_Date, Year, Month, Day, State";				
				$values  = "'$this->ID_User', '$this->username', '$this->comment', '$this->date1', '$this->date2', '$this->year', '$this->month', '$this->day', '$this->state'";
				$this->Db->table($this->table, $fields);
				$this->Db->values($values);
				$this->insertID1 = $this->Db->save();
						
				$fields  = "ID_Application, ID_Comment";				
				$values  = "'3', '$this->insertID1'";
				$this->Db->table("comments2applications", $fields);
				$this->Db->values($values);
				$this->insertID2 = $this->Db->save();		
									
				$fields  = "ID_Comment2Application, ID_Record";				
				$values  = "'$this->insertID2', '$this->ID_Record'";
				$this->Db->table("comments2records", $fields);
				$this->Db->values($values);
				$this->insertID3 = $this->Db->save();
					
			} else {
				$this->Db->table($this->table);
				$repost = $this->Db->findBySQL("ID_User = '$this->ID_User' AND Comment = '$this->comment' AND Year = '$this->year' AND Month = '$this->month' AND Day = '$this->day'");
			
				if(is_array($repost)) {
					return getAlert("This Comment has been posted yet");
				}
				
				if($this->name === NULL) {
					return getAlert("Empty Name");
				}
				
				if(isVulgar($this->name) === TRUE) {
					return getAlert("STOP, Vulgar Name");
				}
			
				if(isInjection($this->name) === TRUE) {
					return getAlert("STOP, Injection");
				} else {
					cleanHTML($this->comment);
				}
				
				if($this->email === NULL) {
					return getAlert("Empty Email");
				}
					
				if(isEmail($this->email) === FALSE) {
					return getAlert("Invalid Email");
				}
						
				if(isset($this->website) and ping($this->website) === FALSE) {
					if(isInjection($this->website) === TRUE) {
						return getAlert("STOP, Injection");
					} else {
						cleanHTML($this->website);
					}
					
					return getAlert("Invalid Website");
				}
				
				$fields  = "ID_User, Comment, Start_Date, Text_Date, Year, Month, Day, Name, Email, Website, State";				
				$values  = "'$this->ID_User', '$this->comment', '$this->date1', '$this->date2', '$this->year', '$this->month', '$this->day', '$this->name', '$this->email', '$this->website', '$this->state'";
				$this->Db->table($this->table, $fields);
				$this->Db->values($values);
				$this->insertID1 = $this->Db->save();
						
				$fields  = "ID_Application, ID_Comment";				
				$values  = "'3', '$this->insertID1'";
				$this->Db->table("comments2applications", $fields);
				$this->Db->values($values);
				$this->insertID2 = $this->Db->save();		
									
				$fields  = "ID_Comment2Application, ID_Record";				
				$values  = "'$this->insertID2', '$this->ID_Record'";
				$this->Db->table("comments2records", $fields);
				$this->Db->values($values);
				$this->insertID3 = $this->Db->save();
			}	 
			
			if($this->insertID1 === "rollback" or $this->insertID2 === "rollback" or $this->insertID3 === "rollback") {					
				$this->Db->rollBack();
				
				return getAlert("Insert error");
			} else {
			$this->Db->commit();
				
			return getAlert("The comment has been saved correctly", "success");
			}
		}
	}
	
	
	
	
	private function all($trash, $order, $limit) {
		$this->Db->table($this->table);
		
		if($trash === FALSE) {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBySQL("State != 'Deleted'", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '".$_SESSION["ZanAdminID"]."' AND State != 'Deleted'", NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("State", "Deleted", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND State = 'Deleted'", NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave($action) {
		if(POST("title") === NULL) {
			return getAlert("You need to write a title");
		} elseif(POST("content") === NULL) {
			return getAlert("You need to write a content");
		}

		$this->title      = POST("title");
		$this->nice       = nice(POST("title", "clean"));
		$this->language   = POST("language");
		$this->ID 	      = POST("ID_Post");
		$this->ID_URL     = POST("ID_URL");
		$this->author     = SESSION("ZanUser");
		$this->content    = POST("content", "decode", FALSE);
		$this->state      = POST("state");
		$this->date1      = now(4);
		$this->date2 	  = now(2);				
		$this->comments   = POST("comments");		
		$this->year		  = date("Y");
		$this->month	  = date("m");
		$this->day		  = date("d");
		$this->password   = (POST("password")) ? POST("password", "encrypt") : NULL;
		$this->categories = POST("categories");
		$this->tags		  = POST("tags");
		$this->URL        = _webBase . _sh . _webLang . _sh . _blog . _sh . $this->year . _sh . $this->month . _sh . $this->day . _sh . $this->nice;
		
		if($action === "save") {
			$this->Db->table($this->table);
					
			$data = $this->Db->findBySQL("Nice = '$this->nice' AND Year = '$this->year' AND Month = '$this->month' AND Day = '$this->day' AND Language = '$this->language'");
			
			if($data) {
				return getAlert("This post already exists");
			}		
		}
		
		$this->Files = $this->core("Files");
		
		$dir = _lib . _sh . _files . _sh . _images . _sh . _mural . _sh;
		$this->mural = $this->Files->uploadImage($dir, "mural", "mural");
		
		$dir = _lib . _sh . _files . _sh . _images . _sh . _blog . _sh;
		$this->image = $this->Files->uploadImage($dir, "image", "resize", TRUE, TRUE, FALSE);
		
		if(is_array($this->mural)) {
			return $this->mural["alert"];
		}
	}
	
	private function save() {				
		$this->Db->table("url", "URL");
		$this->Db->values("'$this->URL'");		
		
		$insertID1 = $this->Db->save();
		
		if(is_array($this->image)) {
			$small  = $this->image["small"];
			$medium = $this->image["medium"];
		} else {
			$small  = NULL;
			$medium = NULL;
		}
		
		$fields  = "ID_User, ID_URL, Title, Nice, Content, Author, Start_Date, Text_Date, Year, Month, Day, Image_Small, Image_Medium, ";
		$fields .= "Enable_Comments, Language, Pwd, State";					
		$values  = "'". SESSION("ZanUserID") ."', '$insertID1', '$this->title', '$this->nice', '$this->content', '$this->author', '$this->date1', ";
		$values .= "'$this->date2', '$this->year', '$this->month', '$this->day', '$small', '$medium', '$this->comments', ";
		$values .= "'$this->language', '$this->password', '$this->state'";
		
		$this->Db->table($this->table, $fields);
		$this->Db->values($values);
		
		$insertID2 = $this->Db->save();
		
		if($this->mural) {
			$fields = "ID_Post, Title, URL, Image";
			$values = "'$insertID2', '$this->title', '$this->URL', '$this->mural'";
			
			$this->Db->table("mural", $fields);
			$this->Db->values($values);
			$this->Db->save();
		}
		
		if(is_array($this->categories)) {
			$this->Db->table("categories2applications");
			
			foreach($this->categories as $category) {
				$categories[] = $this->Db->findBy("ID_Category", $category);
			}
			
			$this->Db->table("categories2records", "ID_Category2Application, ID_Record");
			
			foreach($categories as $category) {				
				$this->Db->values("'" . $category[0]["ID_Category2Application"] ."', '$insertID2'");
				
				$insertID3 = $this->Db->save();
			}
		}	
		
		if(is_array($this->tags)) {
			foreach($this->tags as $tag) {
				$this->Db->table("tags", "Title, Nice");				
				$this->Db->values("'". decode($tag) ."', '". nice($tag) ."'");
				
				$insertID4 = $this->Db->save();								
										
				$this->Db->table("tags2applications", "ID_Application, ID_Tag");
				$this->Db->values("'3', '$insertID4'");
				
				$insertID5 = $this->Db->save();

				$this->Db->table("tags2records", "ID_Tag2Application, ID_Record");
				$this->Db->values("'$insertID5', '$insertID2'");
				
				$insertID6 = $this->Db->save();
			}		
		}
		
		if($insertID1 === "rollback" or $insertID2 === "rollback") {					
			$this->Db->rollBack();
			
			return getAlert("Insert error");
		} else {
			$this->Db->commit();
			
			return getAlert("The post has been saved correctly", "success", $this->URL);
		}		
	}
	
	private function edit() {
		$this->Db->table($this->table);
		
		$this->Db->table("url", "URL");
		$this->Db->values("'$this->URL'");
		
		$this->Db->save($this->ID_URL);
		
		$this->Db->table($this->table);
		
		$values  = "ID_URL = '$this->ID_URL', Title = '$this->title', Nice = '$this->nice', Content = '$this->content', Start_Date = '$this->date1', ";
		$values .= "Text_Date = '$this->date2', Year = '$this->year', Month = '$this->month', Day = '$this->day', Enable_Comments = '$this->comments', "; 
		$values .= "Language = '$this->language', Pwd = '$this->password', State = '$this->state'";
		
		$this->Db->values($values);								
		$this->Db->save($this->ID);
		
		return getAlert("The post has been edited correctly", "success", $this->URL);
	}
	
	private function search($search, $field) {
		$this->CPanel_Model = $this->model("Cpanel_Model");
		
		return $this->Cpanel_Model->getSearch(getDecode($search), $field, _tLinks);		
	}
	
	
	public function getNotifications($application = 3) {
		$data = $this->Db->call("getComments($application, 0)");
		
		if($data) {
			return count($data);
		}
		
		return 0;
	}
	
}
