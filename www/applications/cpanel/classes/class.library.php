<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Library extends ZP_Load {
	
	public $URL;
	public $event;
	public $eventUpload;
	public $path;
	public $px;
	public $icon;
	public $alt;
	public $extension;
						
	public function __construct() {
		$this->Files = $this->core("Files");
		$this->Applications_Model = $this->model("Applications_Model");
		
		$helpers = array("alerts", "html", "forms", "router");
		$this->helper($helpers);	
		
		$this->application = $this->Applications_Model->getID(segment(2));
	}	

	public function getAction($type, $files = FALSE, $dir = FALSE, $name = FALSE) {	
		if($type === "make") {	
			if(is_dir($dir)) {
				if(!file_exists($dir . slug($name) . _sh)) {
					mkdir($dir . slug($name) . _sh); 				
				}
			} 
			
			return TRUE;			
		} elseif($type === "iDelete") {		
			for($i = 0; $i <= count($files) - 1; $i++) {
				$file = str_replace(_webURL . _sh, "", $files[$i]);
				
				if(file_exists($file)) {
					@unlink($file);
				}
			}								
		} elseif($type === "dDelete") {	
			for($i = 0; $i <= count($files) - 1; $i++) {
				$file       = str_replace(_webURL . _sh, "", $files[$i]);
				$this->icon = $this->Files->getType(str_replace("lib/files/documents/uploaded/", "", $file), TRUE, TRUE, TRUE);
				
				if(file_exists($file)) {
					@unlink($file);
				}
			}
		}
	}
		
	public function getLibrary($type) {
		$this->type = $type;
		$action     = NULL;
		
		if(POST("iDelete") and POST("iLibrary")) {		
			$this->getAction("iDelete", POST("iLibrary"));
		} elseif(POST("dDelete") and POST("dLibrary")) {
			$this->getAction("dDelete", POST("dLibrary"));
		} elseif(POST("iMake")) {						
			$this->getAction("make", FALSE, POST("iDir", "clean"), POST("iDirname", "clean"));
		} elseif(POST("dMake")) {
			$this->getAction("make", FALSE, POST("dDir", "clean"), POST("dDirname", "clean"));
		}
		
		if($type === "images") {
			$this->px   = "i";
			$this->path = "www/lib/files/images/uploaded/";
			$text = __("Images library");
		} elseif($type === "documents") {
			$this->px   = "d";
			$this->path = "www/lib/files/documents/uploaded/";
			$text = __("Documents library");
		}
				
		if(isLang()) {
			$action = segment(1) . _sh . segment(2) . _sh . segment(3);
			$href   = segment(1) . _sh . segment(2) . _sh;
		} else {
			$action = segment(0) . _sh . segment(1) . _sh . segment(2);
			$href   = segment(0) . _sh . segment(1) . _sh;
		}
		
		$URL = _webBase . _sh . _webLang;		
		
		$alert  = "onclick=\"document.getElementById('form-add').target='';";
		$alert .= "document.getElementById('form-add').action='". $URL ."/". $action ."/#". $this->px ."Library';";
		$alert .= "return confirm('". __("Do you want to delete the file?") ."');\""; 		
		
		$event  = "onclick=\"document.getElementById('form-add').target=''; ";
		$event .= "document.getElementById('form-add').action='". $URL . _sh . $action . _sh . "#" . $this->px . "Library';\""; 
		$eventUpload  = "onclick=\"document.getElementById('form-add').target='". $this->px ."Upload';";
		$eventUpload .= "document.getElementById('form-add').action='". _webBase . _sh . _webLang . _sh . $href . "upload" . _sh . strtolower($this->type) ."/#". $this->px ."Library'; javascript:submit();\"";
							
		$HTML = a($this->px . "Library");
		
		if($this->type === "images") {
			$aEvents = "onclick=\"showElement(document.getElementById('". $this->px ."-library'));\" title=\"".__("Click to show or hide")."\" class=\"pointer\"";
		} else {
			$aEvents = "onclick=\"showElement(document.getElementById('". $this->px ."-library1'));\" title=\"".__("Click to show or hide")."\" class=\"pointer\"";
		}
		
		$HTML .= formField($aEvents, $text);		
	
		if($this->type === "images") {
			if(POST("iGo") or POST("iMake") or POST("iDelete")) {
				$HTML .= div($this->px . "-library");			
			} else {
				$HTML .= div($this->px . "-library", "id/class", "no-display");
			}
		} else {
			if(POST("dGo") or POST("dMake") or POST("dDelete")) {
				$HTML .= div($this->px . "-library1");
			} else {
				$HTML .= div($this->px . "-library1", "id/class", "no-display");
			}
		}
		
		$HTML .= div("extra", "class");	
			$selected = NULL;
					
			if(POST($this->px . "Dirbase")) {
				if(POST($this->px . "Dirbase") !== $this->path) {
					$dir = str_replace($this->path, "/", POST($this->px . "Dirbase"));
					
					$selected = '<option value="'. POST($this->px . "Dirbase") .'" selected="selected">'. $dir .'</option>';
				}
			}			
			
			if($type === "images") {
				if(POST("iMake") and POST("iDirname") != "") {
					if(POST("iDirname") !== $this->path) {
						$dir = str_replace($this->path, "/", POST("iDir"));
						
						$selected  = '<option value="'. POST("iDir") . slug(POST("iDirname")) .'/" selected="selected">';
						$selected .= $dir . slug(POST("iDirname")).'/</option>';
					}						
				}
			} elseif($type === "documents") {					
				if(POST("dMake") and POST("dDirname") !== "") {
					if(POST("dDirname") !== $this->path) {
						$dir = str_replace($this->path, "/", POST("dDir"));
						
						$selected  = '<option value="'. POST("dDir") . slug(POST("dDirname")) .'/" selected="selected">';
						$selected .= $dir . slug(POST("dDirname")) .'/</option>';
					}						
				}
			}
							
			$value = (POST($this->px . "Dirbase")) ? POST($this->px . "Dirbase") : $this->path;
			$value = (POST($this->px . "Make"))    ? POST($this->px . "Dir") . slug(POST($this->px . "Dirname")) : $value;
			
			$parts = explode("/", $value);
			
			if(count($parts) > 0) {
				$part = NULL;
				
				for($i = 0; $i <= count($parts) - 1; $i++) {
					$part .= slug($parts[$i]) . "/";	
				}			
				
				$part = str_replace("//", "/", $part);
			}
			
			$attributes = array(
							"name"  => $this->px . "Dir", 
							"value" => $part, 
							"type"  => "hidden"
			);
						
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px . "Px", 
							"value" => $this->px,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px . "Application", 
							"value" => $this->application,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px . "Path", 
							"value" => $this->path,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);					
		
			$part = _webURL . _sh . $part;
			
			if(SESSION("ZanUserPrivilegeID") < 3) {
				$attributes = array(
								"name"  => $this->px . "Dirname", 
								"type"  => "text",								
								"class" => "small-input"
				);
							
				$HTML .= formInput($attributes);			

				$attributes = array(
								"name"   => $this->px . "Make", 
								"value"  => __("Make directory"),
								"type"   => "submit",
								"class"  => "small-submit",
								"events" => $event
				);
				
							
				$HTML .= formInput($attributes);	

				$HTML .= br();
				
				if(count($this->getDirs($this->path)) > 1) {
					$attributes = array(
									"name"   => $this->px . "Dirbase", 
									"class"  => "small-select"
					);
					
					$HTML .= formSelect($attributes, $this->getDirs($this->path), $selected);
					
					$attributes = array(
									"name"   => $this->px . "Go", 
									"value"  => __("Go"),
									"type"   => "submit",
									"class"  => "small-submit",
									"events" => $event
					);
								
					$HTML .= formInput($attributes);
					
					$HTML .= "&nbsp;&nbsp;";
				}
			
				$HTML .= br();			
				$HTML .= small(span("bold", __("The new folders will be created and the files will be uploaded in") . ": ") . $part);
				
				$HTML .= br();
				
				if($type === "images") {
					$HTML .= small(span("bold", __("Support files")) . ": jpg, jpeg, png, gif ".__("and")." bmp.");				
				} elseif($type === "documents") {
					$formats = "csv, doc, docx, exe, pdf, ppt, pptx, rar, xls, xlsx   ".__("and")." zip";
					$HTML   .= small(span("bold", __("Support files")) . ": " . $formats);					
				}
				
				$HTML .= br();		
			}
		
		$HTML .= div(FALSE);
	
		$HTML .= div("library", "class");		
			$HTML .= $this->getFiles($type);
		$HTML .= div(FALSE);								
		
		$HTML .= br();
		
		$HTML .= div($this->px . "-upload-message", TRUE);
			if(SESSION("ZanUserPrivilegeID") < 3) {
				$attributes = array(
								"name"   => $this->px . "Delete", 
								"value"  => __("Delete"),
								"type"   => "submit",
								"class"  => "small-submit float-right",
								"events" => $alert
				);
							
				$HTML .= formInput($attributes);			
			}
			
			$HTML .= formUploadFrame($this->px, $eventUpload);		
		$HTML .= div(FALSE);
		
		return $HTML;
	}
	
	public function upload() {
		if(isLang()) {
			if(segment(3) === "upload" and segment(4) === "images") {		
				$value = (POST("iDirbase")) ? POST("iDirbase") : 'www/lib/files/images/uploaded/';
				$value = (POST("iMake"))    ? POST("iDir") . slug(POST("iDirname")) : $value;
				
				$parts = explode("/", $value);					
			} elseif(segment(3) === "upload" and segment(4) === "documents") {
				$value = (POST("dDirbase")) ? POST("dDirbase") : 'www/lib/files/documents/uploaded/';
				$value = (POST("dMake"))    ? POST("dDir") . slug(POST("dDirname")) : $value;
				
				$parts = explode("/", $value);	
			}
		} else {
			if(segment(2) === "upload" and segment(3) === "images") {		
				$value = (POST("iDirbase")) ? POST("iDirbase") : 'www/lib/files/images/uploaded/';
				$value = (POST("iMake"))    ? POST("iDir") . slug(POST("iDirname")) : $value;
				
				$parts = explode("/", $value);					
			} elseif(segment(2) === "upload" and segment(3) === "documents") {
				$value = (POST("dDirbase")) ? POST("dDirbase") : 'www/lib/files/documents/uploaded/';
				$value = (POST("dMake"))    ? POST("dDir") . slug(POST("dDirname")) : $value;
				
				$parts = explode("/", $value);	
			}
		}
						
		if(count($parts) > 0) {
			$part = NULL;
			
			for($i = 0; $i <= count($parts) - 1; $i++) {
				$part .= slug($parts[$i]) . _sh;	
			}		
					
			$part = str_replace("//", "/", $part);
		}											
		
		if($part !== "") {
			$this->uploading($part);			
		} else {
			$this->uploading($value);								
		}	
	}
	
	public function uploading($dir = FALSE) {
		if(POST("iUpload")) {
			if(FILES("iFile", "name") !== "") {
				$this->Files->filename  = FILES("iFile", "name");
				$this->Files->fileType  = FILES("iFile", "type");
				$this->Files->fileSize  = FILES("iFile", "size");
				$this->Files->fileError = FILES("iFile", "error");
				$this->Files->fileTmp   = FILES("iFile", "tmp_name");
			}						
		} elseif(POST("dUpload")) {		
			if(FILES("dFile", "name") !== "") {
				$this->Files->filename  = FILES("dFile", "name");
				$this->Files->fileType  = FILES("dFile", "type");
				$this->Files->fileSize  = FILES("dFile", "size");
				$this->Files->fileError = FILES("dFile", "error");
				$this->Files->fileTmp   = FILES("dFile", "tmp_name");
			}			
		}			
				
		$parts = explode("/", $dir);

		if(count($parts) > 0) {
			if($parts[3] === "images") {
				$extension = "image";
			} elseif($parts[3] === "documents") {
				$extension = "document";
			}
		}						
		
		if($extension === "image") {			
			@chmod($dir, 0777);
			
			$upload = $this->Files->upload($dir);
			
			if(!$upload["upload"]) {
				if($upload["message"] === "The file size exceed the permited limit") {
					print "<script>window.parent.uploadResponse('1', '". $this->Files->filename ."');</script>";
				} elseif($upload["message"] === "An error has ocurred") {
					print "<script>window.parent.uploadResponse('2', '". $this->Files->filename ."');</script>";
				} elseif($upload["message"] === "The file type is not permited") {
					print "<script>window.parent.uploadResponse('3', '". $this->Files->filename ."');</script>";
				} elseif($upload["message"] === "A problem occurred when trying to upload file") {
					print "<script>window.parent.uploadResponse('4', '". $this->Files->filename ."');</script>";
				} elseif($upload["message"] === "The file already exists") {
					print "<script>window.parent.uploadResponse('5', '". $this->Files->filename ."');</script>";
				}
			} else {
				if($this->Files->fileType !== "image/gif") {
					$this->Images = $this->core("Images");
				
					$original = $this->Images->getResize("original", $dir, $upload["filename"], _minOriginal, _maxOriginal);
					$original = str_replace($dir, "", $original);			
					
					@unlink($dir . $upload["filename"]);
					
					print "<script>window.parent.uploadResponse('6', '". $original ."');</script>";
				} else {
					print "<script>window.parent.uploadResponse('6', '". $upload["filename"] ."');</script>";
				}						
			}
		} elseif($extension === "document") {
			@chmod($dir, 0777);
			
			$upload = $this->Files->upload($dir, "document");
			$icon   = $this->Files->getType($this->Files->filename, TRUE, TRUE, TRUE);
			
			if(is_array($icon)) {
				if($upload["message"] === "The file size exceed the permited limit") {
					print "<script>window.parent.uploadDocumentsResponse('1', '". $this->Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
				} elseif($upload["message"] === "An error has ocurred") {
					print "<script>window.parent.uploadDocumentsResponse('2', '". $this->Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
				} elseif($upload["message"] === "The file type is not permited") {
					print "<script>window.parent.uploadDocumentsResponse('3', '". $this->Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
				} elseif($upload["message"] === "A problem occurred when trying to upload file") {
					print "<script>window.parent.uploadDocumentsResponse('4', '". $this->Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
				} elseif($upload["message"] === "The file already exists") {
					print "<script>window.parent.uploadDocumentsResponse('5', '". $this->Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";							
				} else {
					print "<script>window.parent.uploadDocumentsResponse('6', '". $upload["filename"] ."', '". $icon[0] ."', '". $icon[1] ."');</script>";			
				}
			}
		}								
	}
		
	public function getFiles($type) {
		if($type === "images") { 
			$HTML = openUl("i-add-upload", "add-upload");
		} elseif($type === "documents") { 
			$HTML = openUl("d-add-upload", "add-upload");			
		} 
		
		$path = (POST($this->px . "Dirbase")) ? POST($this->px . "Dirbase") : $this->path;
		$path = (POST($this->px . "Make"))    ? POST($this->px . "Dir") . slug(POST($this->px . "Dirname")) : $path;
		
		$files = $this->getPath($path);
		
		if(is_array($files)) {
			for($i = 0; $i <= count($files) - 1; $i++) {										
				if($type === "images") {
					$img = '\'<img src=\\\''. _webURL . _sh . $path . $files[$i] .'\\\' alt=\\\''. $files[$i] .'\\\' />\'';
					
					if($i < 9) {
						$num = "0" . ($i + 1); 
					} else {
						$num = $i + 1;
					}
					
					unset($attributes);
					
					$attributes = array(
						"name"   => $this->px . "Library[]", 
						"value"  => $path . $files[$i]
					);
					
					$attrs = array(
						"onclick" => "javascript:insertHTML($img);",
						"class"   => "pointer",
						"title"   => __("Insert Image")
					);
					
					$HTML .= li(formCheckbox($attributes) . small($num) .
								a(span("tiny-image tiny-search", "&nbsp;&nbsp;&nbsp;&nbsp;"), _webURL . _sh . $path . $files[$i], FALSE, array("title" => __("Preview image"))) .														
								a(span("tiny-image tiny-add", "&nbsp;&nbsp;&nbsp;&nbsp;") . $files[$i], FALSE, FALSE, $attrs));								
				} elseif($type == "documents") {												
					$icon = $this->Files->getType($files[$i], TRUE, TRUE, TRUE);
					
					$img = '\'<a href=\\\''. _webURL . _sh . $path . $files[$i] .'\\\' title=\\\''.$files[$i].'\\\'><img src=\\\''. $icon[0] .'\\\' alt=\\\''. $files[$i] .'\\\' /></a>\'';
					
					if($i < 9) {
						$num = "0" . ($i + 1); 
					} else {
						$num = $i + 1;
					}
					
					$attributes = array(
						"name"   => $this->px . "Library[]", 
						"value"  => $path . $files[$i]
					);					
															
					unset($attrs);
					
					$attrs = array(
						"title"   => __("Insert file"),
						"class"   => "pointer",
						"onclick" => "javascript:insertHTML($img);"
					);
					
					$HTML .= li(formCheckbox($attributes) . small($num) .
								a(span("tiny-image tiny-file", "&nbsp;&nbsp;&nbsp;&nbsp;"), _webURL . _sh . $path . $files[$i], FALSE, array("title" => __("Download file"))) .
								a(span("tiny-image tiny-add", "&nbsp;&nbsp;&nbsp;&nbsp;") . $files[$i], FALSE, FALSE, $attrs));																															
				}
			}	
		
			$HTML .= closeUl();				
		}
		
		return $HTML;
	}
	
	public function getDirs($dirPath, $i = 1) {
		if($i === 1) {
			unset($this->options);
			
			$this->options[0]["value"]  = $this->path;
			$this->options[0]["option"] = "/";				
		}
			
   		if(is_dir($dirPath)) {			
      		if($dh = opendir($dirPath)) {				
         		while(($file = readdir($dh)) !== FALSE) {					
            		if(is_dir($dirPath . $file . _sh) and $file !== "." and $file !== "..") {
						$dir = $dirPath . $file . _sh;
						
						$this->options[$i]["value"]  = $dir;
						$this->options[$i]["option"] = str_replace($this->path, "/", $dirPath . $file);
						
						$i++;
						
						$this->getDirs($dir, $i);
					}
            	}
         	}
         	
      		closedir($dh);
      	}

		return $this->options;
	}
	
	public function getPath($path, $option = NULL, $types = FALSE) {
		$this->Files = $this->core("Files");
		
		$dir = @dir($path);
		$options = NULL;
		
		if(!$dir) {
			showAlert("Uploads directories does not exists", _webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		while($element = $dir->read()) {			
			$directory = $path . $element . _sh;						
			
			if($element !== "." and $element !== ".." and !is_dir($directory)) { 
				if($element !== _cpanel and $element !== _config) {
					if($types === TRUE) { 
						if($element === $option) {
							$options[] = '<option selected="selected">'. encode($element) .'</option>';					
						} else {
							$options[] = '<option>'. $element .'</option>';
						}
					} else {
						$type = $this->Files->getType($element, TRUE);

						if($this->type === "documents") {
							if($type === "document") {
								$options[] = encode($element);
							}
						} elseif($this->type === "images") {
							if($type === "image") {
								$options[] = encode($element);
							}
						}
					}
				}
			}
		}		
		
		$dir->close();
		
		return $options;
	}
}
