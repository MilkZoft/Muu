<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();

		$this->helpers();
		
		$this->language = whichLanguage();
		$this->table 	= "blog";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
	
	private function all($trash, $order, $limit) {
		if(!$trash) {
			if(SESSION("ZanUserPrivilege") === _super) { 
				$data = $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
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
	
	private function editOrSave($action) {
		$validations = array(
			"exists"  => array(
							"Slug" 	   => slug(POST("title", "clean")), 
							"Year"	   => date("Y"),
							"Month"	   => date("m"),
							"Day"	   => date("d"),
							"Language" => POST("language")
						),
			"title"   => "required",
			"content" => "required"
		);
		
		$this->categories = POST("categories"); 
		$this->tags	  = POST("tags");
		$this->URL        = PATH("blog/". date("Y")) ."/". date("m") ."/". date("d") ."/". slug(POST("title", "clean"));
		$this->muralExist = POST("mural_exist");
				
		$this->Files = $this->core("Files");
		
		$this->mural = FILES("mural");
		
		if($this->mural["name"] !== "") {
			$dir = "www/lib/files/images/mural/";

			$this->mural = $this->Files->uploadImage($dir, "mural", "mural");
		
			if(is_array($this->mural)) {
				return $this->mural["alert"];
			}
		}
		
		$dir = "www/lib/files/images/blog/";
		
		$this->image = $this->Files->uploadImage($dir, "image", "resize", TRUE, TRUE, FALSE);

		$data = array(
			"ID_User"      => SESSION("ZanUserID"),
			"ID_URL"       => 1,
			"Slug"         => slug(POST("title", "clean")),
			"Content"      => POST("content", "clean"),
			"Author"       => SESSION("ZanUser"),
			"Year"	       => date("Y"),
			"Month"	       => date("m"),
			"Day"	       => date("d"),
			"Image_Small"  => isset($this->image["small"])  ? $this->image["small"]  : NULL,
			"Image_Medium" => isset($this->image["medium"]) ? $this->image["medium"] : NULL,
			"Pwd"	       => (POST("pwd")) ? POST("pwd", "encrypt") : NULL,
			"Start_Date"   => now(4),
			"Text_Date"    => now(2)
		);
	
		$this->Data->ignore(array("categories", "tags", "mural_exists", "mural", "pwd", "category", "language_category", "application", "mural_exist"));

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {			
		$insertID1 = $this->Db->insert("url", array("URL" => $this->URL));
		$insertID2 = $this->Db->insert($this->table, $this->data);
		
		if(isset($this->mural["name"]) and $this->mural["name"] !== "") {			
			$this->Db->insert("mural", array("ID_Post" => $insertID2, "Title" => POST("title"), "URL" => $this->URL, "Image" => $this->mural));
		}
		
		if(is_array($this->categories)) {
			$this->Db->select("ID_Category2Application");
			$this->Db->whereIn("ID_Category", $this->categories);

			$categories = $this->Db->get("re_categories_applications");
			
			for($i = 0; $i <= count($categories) - 1; $i++) {
				$categories[$i]["ID_Record"] = $insertID2;
			}
			
			$this->Db->insertBatch("re_categories_records", $categories);
		}
				
		$this->Tags_Model = $this->model("Tags_Model");
		
		$insert = $this->Tags_Model->setTagsByRecord(3, $this->tags, $insertID2);

		if($insertID1 === "rollback" or $insertID2 === "rollback") {					
			$this->Db->rollBack();
			
			return array("error" => TRUE, "alert" => getAlert("Insert error"));
		} else {
			$this->Db->commit();
			
			if(SESSION("ZanUserMethod") === "twitter") {
				$this->Twitter_Model = $this->model("Twitter_Model");
				
				$this->Twitter_Model->publish('"'. $this->title .'"', $this->URL);
			}
			
			return getAlert("The post has been saved correctly", "success", $this->URL);
		}		
	}
	
	private function edit() {	
		$this->update("url", array("URL" => $this->URL), POST("ID_URL"));		
		
		$this->Db->update($this->table, $this->data, POST("ID"));				
		
		$purge = $this->Db->deleteBySQL("ID_Record = '". POST("ID") ."'", "re_categories_records");

		if(is_array($this->categories)) {						
			foreach($this->categories as $category) {
				$categories[] = $this->Db->findBy("ID_Category", $category, "re_categories_applications");
			}						
			
			foreach($categories as $category) {
				$category = $category[0]["ID_Category2Application"];
				$exist    = $this->Db->findBySQL("ID_Category2Application = '$category' AND ID_Record = '". POST("ID") ."'", "re_categories_records");
				
				if(!$exist) {
					$data = array(
							"ID_Category2Application" => $category,
							"ID_Record"		  => POST("ID")
						);
						
					$insert = $this->Db->insert($this->table, $data);					
				}
			}
		}
		
		$this->Tags_Model = $this->model("Tags_Model");
		
		$this->Tags_Model->setTagsByRecord(3, $this->tags, POST("ID"));
	
		if(!is_array($this->mural) and !$this->muralExist) {
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->data["Title"],
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
		
			$this->Db->insert("mural", $values);	
		} elseif(!is_array($this->mural) and $this->muralExist) {
			unlink($this->muralExist);
						
			$this->Db->deleteBy("ID_Post", POST("ID"), "mural");
			
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->title,
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
			
			$this->Db->insert("mural", $values);	
		}
		
		return getAlert("The post has been edited correctly", "success", $this->URL);
	}
	
	private function search($search, $field) {
		if($search and $field) {
			if($field === "ID") {
				$data = $this->Db->find($search, $this->table);	
			} else {
				$data = $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);
			}
		} else {
			return FALSE;
		}
		
		return $data;
	}
	
	public function count($type = "posts") {					
		if(isLang()) {
			$year  = isYear(segment(1))  ? segment(1) : FALSE;
			$month = isMonth(segment(2)) ? segment(2) : FALSE;
			$day   = isDay(segment(3))   ? segment(3) : FALSE;
		} else {
			$year  = isYear(segment(0))  ? segment(0) : FALSE;
			$month = isMonth(segment(1)) ? segment(1) : FALSE;
			$day   = isDay(segment(2))   ? segment(2) : FALSE;			
		}

		if($type === "posts") {									
			if($year and $month and $day) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table);
			} elseif($year and $month) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Situation = 'Active'", $this->table);
			} elseif($year) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Situation = 'Active'", $this->table);
			} else {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table);
			}
		} elseif($type === "comments") {
			$count = 0;
		} elseif($type === "tag") {
			$data = $this->getByTag(segment(3));
			
			$count = count($data);
		} elseif($type === "categories") {
			$data = $this->getByCategory(segment(3));
			
			$count = count($data);
		}
		
		return isset($count) ? $count : 0;
	}
	
	public function getArchive() {				
		$data = $this->Db->findFirst($this->table);
		
		if($data) {
			$date["year"]  = $data[0]["Year"];
			$date["month"] = $data[0]["Month"];
			
			return $date;
		} else {
			return FALSE;
		}
	}
	
	public function getMural($limit) {		
		$data = $this->Db->findAll("mural", NULL, "ID_Post DESC", $limit);
		
		return $data;
	}
	
	public function getMuralByID($ID_Post) {				
		$data = $this->Db->findBy("ID_Post", $ID_Post, "mural");
	
		return $data;
	}
	
	
	public function getPosts($limit) {			
		$posts = $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, NULL, "ID_Post DESC", $limit);
		
		if($posts) {
			$i = 0;
			
			$this->Tags_Model 	= $this->model("Tags_Model");
			$this->Categories_Model = $this->model("Categories_Model");
			
			foreach($posts as $post) {
				$tags 	    = $this->Tags_Model->getTags(3, $post["ID_Post"]);
				$categories = $this->Categories_Model->getCategoriesByRecord(3, $post["ID_Post"]);
				
				$data[$i]["post"] 	= $post;
				$data[$i]["tags"] 	= $tags;
				$data[$i]["categories"] = $categories;
				$i++;
			}
			
			return $data;
		}	
		
		return FALSE;
	}
	
	public function getPost($slug, $year, $month, $day) {		
		$post = $this->Db->findBySQL("Slug = '$slug' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table);
		
		if($post) {			
			$values = "Views = (Views) + 1";
			
			$this->Db->values($values);								
			$this->Db->save($post[0]["ID_Post"]);			
			
			$this->Tags_Model 	= $this->model("Tags_Model");
			$this->Categories_Model = $this->model("Categories_Model");
			$this->Comments_Model   = $this->model("Comments_Model");
			
			$tags 	    = $this->Tags_Model->getTags(3, $post[0]["ID_Post"]);
			$categories = $this->Categories_Model->getCategoriesByRecord(3, $post[0]["ID_Post"]);
			$comments   = $this->Comments_Model->getCommentsByRecord(3, $post[0]["ID_Post"]);
		
			$data[0]["post"]       = $post;
			$data[0]["tags"]       = $tags;
			$data[0]["categories"] = $categories;
			$data[0]["comments"]   = $comments;
									
			return $data;
		}		
		
		return FALSE;
	}
	
	public function getByCategory($category, $limit = FALSE) {
		if($limit) {
			$limit = "LIMIT ". $limit;
		} else {
			$limit = NULL;
		}
		
		$posts = $this->Db->query("SELECT * FROM ". _dbPfx ."blog WHERE ". _dbPfx ."blog.ID_Post IN (
									SELECT ". _dbPfx ."re_categories_records.ID_Record FROM ". _dbPfx ."re_categories_records WHERE ". _dbPfx ."re_categories_records.ID_Category2Application IN (
										SELECT ". _dbPfx ."re_categories_applications.ID_Category2Application FROM ". _dbPfx ."re_categories_applications WHERE ". _dbPfx ."re_categories_applications.ID_Application = 3 AND  ". _dbPfx ."re_categories_applications.ID_Category IN (
											SELECT ". _dbPfx ."categories.ID_Category FROM ". _dbPfx ."categories WHERE Slug = '$category'
										)
									)
								 ) ORDER BY ID_Post DESC $limit");

		if($posts) {
			$i = 0;
			
			$this->Tags_Model 	= $this->model("Tags_Model");
			$this->Categories_Model = $this->model("Categories_Model");
			
			foreach($posts as $post) {
				$tags 	    = $this->Tags_Model->getTags(3, $post["ID_Post"]);
				$categories = $this->Categories_Model->getCategoriesByRecord(3, $post["ID_Post"]);
				
				$data[$i]["post"] 	= $post;
				$data[$i]["tags"] 	= $tags;
				$data[$i]["categories"] = $categories;
				$i++;
			}
			
			return $data;
		}
		
		return FALSE;
	}
	
	public function getByDate($limit, $year = FALSE, $month = FALSE, $day = FALSE) {		
		if($year and $month and $day) {
			$posts = $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table, NULL, "ID_Post DESC", $limit);
		} elseif($year and $month) {
			$posts = $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Situation = 'Active'", $this->table, NULL, "ID_Post DESC", $limit);
		} elseif($year) {
			$posts = $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Situation = 'Active'", $this->table, NULL, "ID_Post DESC", $limit);
		}
		
		if($posts) {
			$i = 0;
			
			$this->Tags_Model 	    = $this->model("Tags_Model");
			$this->Categories_Model = $this->model("Categories_Model");
			
			foreach($posts as $post) {
				$tags 	    = $this->Tags_Model->getTags(3, $post["ID_Post"]);
				$categories = $this->Categories_Model->getCategoriesByRecord(3, $post["ID_Post"]);
				
				$data[$i]["post"] 	    = $post;
				$data[$i]["tags"]    	= $tags;
				$data[$i]["categories"] = $categories;
				$i++;
			}
			
			return $data;
		}
		
		return FALSE;	
	}
	
	public function getByID($ID) {			
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function getByTag($tag, $limit = FALSE) {
		if($limit) {
			$limit = "LIMIT ". $limit;
		} else {
			$limit = NULL;
		}
				
		$query = "	SELECT * FROM ". _dbPfx ."blog WHERE ". _dbPfx ."blog.ID_Post IN (
						SELECT ". _dbPfx ."re_tags_records.ID_Record FROM ". _dbPfx ."re_tags_records WHERE ". _dbPfx ."re_tags_records.ID_Tag2Application IN (
							SELECT ". _dbPfx ."re_tags_applications.ID_Tag2Application FROM ". _dbPfx ."re_tags_applications 
							WHERE ". _dbPfx ."re_tags_applications.ID_Application = 3 AND  ". _dbPfx ."re_tags_applications.ID_Tag IN (
								SELECT ". _dbPfx ."tags.ID_Tag FROM ". _dbPfx ."tags WHERE Slug = '$tag'
							)
						)
					) ORDER BY ID_Post DESC $limit";
	
		$posts = $this->Db->query($query);

		if($posts) {
			$i = 0;
			
			$this->Tags_Model 		= $this->model("Tags_Model");
			$this->Categories_Model = $this->model("Categories_Model");
			
			foreach($posts as $post) {
				$tags 	    = $this->Tags_Model->getTags(3, $post["ID_Post"]);
				$categories = $this->Categories_Model->getCategoriesByRecord(3, $post["ID_Post"]);
				
				$data[$i]["post"] 		= $post;
				$data[$i]["tags"] 		= $tags;
				$data[$i]["categories"] = $categories;
				$i++;
			}
			
			return $data;
		}
		
		return FALSE;	
	}
	
	public function deleteMural() {
		$this->ID_Post = POST("ID_Post");
		$this->mural   = POST("muralExist");
	
		unlink($this->mural);
					
		$this->Db->deleteBy("ID_Post", $this->ID_Post, "mural");
	}
	
	public function removePassword($ID) {
		$this->Db->update($this->table, array("Pwd" => ""), $ID);		
	}
	
}
