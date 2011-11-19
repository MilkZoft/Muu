<?php
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Categories extends ZP_Load {						
	
	public $HTML = NULL;

	public function __construct() {
		$this->helper(array("array", "forms", "html", "string"));
	}
	
	public function getCategories($action = "add", $type = "checkbox", $name = "categories") { 
		if($action === "add") {
			$this->Categories_Model = $this->model("Categories_Model");
		
			$data = $this->Categories_Model->categories();

			if($data) {
				$HTML = $this->build($data, NULL, $type, $name);	
			} else {
				return FALSE;
			}
		
			unset($this->HTML);
		
			return $HTML;
		} elseif($action === "edit") {
			$this->Categories_Model = $this->model("Categories_Model");
		
			$categories = $this->Categories_Model->categories();
			$data       = $this->Categories_Model->getCategoriesByRecord("3", (isLang()) ? segment(4) : segment(3));
			
			if($data) {
				$i = 0;

				foreach($categories as $category) {				
					foreach($data as $category_match) {
						if($category["ID_Category"] === $category_match["ID_Category"]) {
							$categories[$i]["checked"] = TRUE;
						}
					}
				
					$i++;
				}
			}	
				
			$data = $categories;
				
			if($data) {
				$HTML = $this->build($data, NULL, $type, $name);	
			} else {
				return FALSE;
			}
		
			unset($this->HTML);
		
			return $HTML;
		}
		
	}
	
	public function parents($categories, $ID) {
		foreach($categories as $category) {
			if(isset($category["Situation"]) and $category["Situation"] === "Active" and $category["ID_Parent"] === $ID) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	public function build($categories, $ID = NULL, $type = "checkbox", $name = "categories", $class = NULL, $parent = 0, $URL = NULL, $hide = FALSE) {		
		if(is_null($ID)) {	
			if($name === "parent") {
				$this->HTML = NULL;
			}
			
			if(!is_null($class)) { 
				$this->HTML .= openUl(NULL, "categories-list"); 
			} else { 
				$this->HTML .= openUl();
			}
			
			$i = 0;
			
			if(is_array($categories)) {
				foreach($categories as $category) {
					if(is_array($category)) {	
						if(isset($category["Situation"]) and $category["Situation"] === "Active" and (int) $category["ID_Parent"] === 0) { 
							$title = $category["Title"];
							
							if($type === "radio") {
								if($name === "parent" and $i === 0) {
									$input = formInput(array("name" => $name, "type" => "radio", "value" => 0));
									$link  = repeat("&nbsp;", 1) . a(span("bold", __("Principal")), FALSE, FALSE, array("title" => __("Principal")));

									$this->HTML .= li($input . $link);

									$i++;
								}
								
								$attrs = array(
									"text"     => getLanguage($category["Language"], TRUE), 
									"name"     => $name, 
									"value"    => $category["ID_Category"], 
									"position" => "right"
								);

								$input = formRadio($attrs);
								$link  = repeat("&nbsp;", 1) . a(span("bold", $title), FALSE, FALSE, array("title" => $title));
								
								$this->HTML .= li($input . $link, TRUE);

									if($this->parents($categories, $category["ID_Category"])) { 
										$this->build($categories, $category["ID_Category"], $type, $name); 
									} 
								
								$this->HTML .= li(FALSE);			
							} elseif($type === "checkbox") {
								if(isset($category["checked"]) and $category["checked"]) {
									$check = TRUE; 
								} elseif((int) $category["ID_Category"] === $parent) {
									$check = TRUE; 
								} else {
									$check = FALSE;
								}
								
								$attrs = array(
									"id" 	   => $name, 
									"text" 	   => getLanguage($category["Language"], TRUE), 
									"name" 	   => $name . "[]", 
									"value"    => $category["ID_Category"], 
									"position" => "right",
									"checked"  => $check
								);
						
								$input = formCheckbox($attrs);
								$link  = repeat("&nbsp;", 1) . a(span("bold", $title), FALSE, FALSE, array("title" => $title));
								
								$this->HTML .= li($input . $link, TRUE);
								
									if($this->parents($categories, $category["ID_Category"])) { 
										$this->build($categories, $category["ID_Category"], $type, $name); 
									} 
								
								$this->HTML .= li(FALSE);	
							} else {
								$link = repeat("&nbsp;", 1) . a($title, $URL . $category["Slug"], FALSE, array("title" => $title));
								
								$this->HTML .= li($link, TRUE);
								
									if($this->parents($categories, $category["ID_Category"])) { 
										$this->build($categories, $category["ID_Category"], $type, $name); 
									} 
								
								$this->HTML .= li(FALSE);
							}
						} 
					}				
				}
			}
			
			$this->HTML .= closeUl();
		} else {
			$this->HTML .= openUl();
			
			foreach($categories as $category) {					
				if($category["Situation"] === "Active" and $category["ID_Parent"] === $ID) {
					$title = $category["Title"];

					if($type === "radio") {
						if(!$hide) { 
							if(isset($category["checked"]) and $category["checked"]) {
								$check = TRUE; 
							} elseif((int) $category["ID_Category"] === $parent) {
								$check = TRUE; 
							} else {
								$check = FALSE;
							}
							
							$attrs = array(
								"id"	   => $name,
								"text"     => getLanguage($category["Language"], TRUE), 
								"name"     => $name, 
								"value"    => $category["ID_Category"], 
								"position" => "right",
								"checked"  => $check
							);

							$input = formRadio($attrs);
							$link  = repeat("&nbsp;", 1) . a($title, FALSE, FALSE, array("title" => $title));
							
							$this->HTML .= li($input . $link, TRUE);	
								
								if($this->parents($categories, $category["ID_Category"]) === TRUE) { 
									$this->build($categories, $category["ID_Category"], $type, $name); 
								}
								
							$this->HTML .= li(FALSE);																		
						} else {
							$link = repeat("&nbsp;", 1) . a($title, FALSE, FALSE, array("title" => $title));

							$this->HTML .= li(repeat("&nbsp;", 6) . getLanguage($category["Language"], TRUE) . $link);
							
								if($this->parents($categories, $category["ID_Category"]) === TRUE) { 
									$this->build($categories, $category["ID_Category"], $type); 
								}
							
							$this->HTML .= li(FALSE);
						}
					} elseif($type === "checkbox") {
						if(isset($category["checked"]) and $category["checked"]) {
							$check = TRUE; 
						} elseif((int) $category["ID_Category"] === $parent) {
							$check = TRUE; 
						} else {
							$check = FALSE;
						}
						
						$attrs = array(
							"id"	   => $name,
							"text"     => getLanguage($category["Language"], TRUE), 
							"name"     => $name . "[]", 
							"value"    => $category["ID_Category"], 
							"position" => "right",
							"checked"  => $check
						);

						$input = formCheckbox($attrs);
						$link  = a($title, FALSE, FALSE, array("title" => $title));
						
						$this->HTML .= li($input . $link, TRUE);	
							
							if($this->parents($categories, $category["ID_Category"])) { 
								$this->build($categories, $category["ID_Category"], $type); 
							}
							
						$this->HTML .= li(FALSE);
					} else {
						$link = a($title, $URL . $category["Slug"], FALSE, array("title" => $title));
						
						$this->HTML .= li($link, TRUE);
						
							if($this->parents($categories, $category["ID_Category"])) { 
								$this->build($categories, $category["ID_Category"], $type); 
							} 
						
						$this->HTML .= li(FALSE);
					}
				}
			}
		}
		
		$this->HTML .= closeUl();
		
		return $this->HTML;
	}

}	
