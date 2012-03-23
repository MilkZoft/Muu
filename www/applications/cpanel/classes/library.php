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
		
		$this->helper(array("alerts", "html", "forms", "router"));	
		
		$this->application = $this->Applications_Model->getID(whichApplication());
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
			$text = __(_("Images library"));
		} elseif($type === "documents") {
			$this->px   = "d";
			$this->path = "www/lib/files/documents/uploaded/";
			$text = __(_("Documents library"));
		}
				
		$action = segment(0, isLang()) . _sh . segment(1, isLang()) . _sh . segment(2, isLang());
		$href   = segment(0, isLang()) . _sh . segment(1, isLang());
		
		$URL = path();
		
		$alert  = "onclick=\"document.getElementById('form-add').target='';";
		$alert .= "document.getElementById('form-add').action='". $URL . $action ."/#". $this->px ."Library';";
		$alert .= "return confirm('". __(_("Do you want to delete the file?")) ."');\""; 		
		
		$event  = "onclick=\"document.getElementById('form-add').target=''; ";
		$event .= "document.getElementById('form-add').action='". $URL . $action . _sh ."#". $this->px ."Library';\""; 
		
		$path   = path($href ."/upload/". strtolower($this->type) ."/#". $this->px ."Library");
		$target = "document.getElementById('form-add').target='". $this->px ."Upload'; ";
		$action = "document.getElementById('form-add').action='". $path ."'; ";
		$submit = "javascript:submit(); ";

		$eventUpload = 'onclick="'. $target . $action . $submit .'"';

		$HTML = a($this->px ."Library");
		
		if($this->type === "images") {
			$aEvents = "onclick=\"showElement(document.getElementById('". $this->px ."-library'));\" title=\"". __(_("Click to show or hide")) ."\" class=\"pointer\"";
		} else {
			$aEvents = "onclick=\"showElement(document.getElementById('". $this->px ."-library1'));\" title=\"".__(_("Click to show or hide")) ."\" class=\"pointer\"";
		}
		
		$HTML .= formField($aEvents, $text);		
	
		if($this->type === "images") {
			if(POST("iGo") or POST("iMake") or POST("iDelete")) {
				$HTML .= div($this->px ."-library");			
			} else {
				$HTML .= div($this->px ."-library", "id/class", "no-display");
			}
		} else {
			if(POST("dGo") or POST("dMake") or POST("dDelete")) {
				$HTML .= div($this->px ."-library1");
			} else {
				$HTML .= div($this->px ."-library1", "id/class", "no-display");
			}
		}
		
		$HTML .= div("extra", "class");	
			$selected = NULL;
					
			if(POST($this->px ."Dirbase")) {
				if(POST($this->px ."Dirbase") !== $this->path) {
					$dir = str_replace($this->path, "/", POST($this->px ."Dirbase"));
					
					$selected = '<option value="'. POST($this->px ."Dirbase") .'" selected="selected">'. $dir .'</option>';
				}
			}			
			
			if($type === "images") {
				if(POST("iMake") and POST("iDirname") != "") {
					if(POST("iDirname") !== $this->path) {
						$dir = str_replace($this->path, "/", POST("iDir"));
						
						$selected  = '<option value="'. POST("iDir") . slug(POST("iDirname")) .'/" selected="selected">';
						$selected .= $dir . slug(POST("iDirname")) .'/</option>';
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
				
			$value = (POST($this->px ."Dirbase")) ? POST($this->px ."Dirbase") : $this->path;
			$value = (POST($this->px ."Make"))    ? POST($this->px ."Dir") . slug(POST($this->px ."Dirname")) : $value;
			
			$parts = explode("/", $value);
			
			if(count($parts) > 0) {
				$part = NULL;
				
				for($i = 0; $i <= count($parts) - 1; $i++) {
					$part .= slug($parts[$i]) ."/";	
				}			
				
				$part = str_replace("//", "/", $part);
			}
			
			$attributes = array(
							"name"  => $this->px ."Dir", 
							"value" => $part, 
							"type"  => "hidden"
			);
						
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px ."Px", 
							"value" => $this->px,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px ."Application", 
							"value" => $this->application,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);

			$attributes = array(
							"name"  => $this->px ."Path", 
							"value" => $this->path,
							"type"  => "hidden"
			);
			
			$HTML .= formInput($attributes);					
			
			if(SESSION("ZanUserPrivilegeID") < 3) {
				$attributes = array(
								"name"  => $this->px ."Dirname", 
								"type"  => "text",								
								"class" => "required"
				);
							
				$HTML .= formInput($attributes);			

				$attributes = array(
								"name"   => $this->px ."Make", 
								"value"  => __(_("Make directory")),
								"type"   => "submit",
								"class"  => "btn btn-info",
								"events" => $event
				);	
				
				$HTML .= formInput($attributes);	
				
				if(count($this->getDirs($this->path)) > 1) {
					$attributes = array(
									"name"   => $this->px . "Dirbase", 
									"class"  => "required"
					);
					
					$HTML .= formSelect($attributes, $this->getDirs($this->path), $selected);
					
					$attributes = array(
									"name"   => $this->px . "Go", 
									"value"  => __(_("Go")),
									"type"   => "submit",
									"class"  => "btn btn-warning",
									"events" => $event
					);
								
					$HTML .= formInput($attributes);
					
					$HTML .= br();
				} else {
					$HTML .= br();
				}
			
				$HTML .= small(span("bold", __(_("The new folders will be created and the files will be uploaded in")) .": ") . $part);
				
				$HTML .= br();
				
				if($type === "images") {
					$HTML .= small(span("bold", __(_("Support files"))) .": jpg, jpeg, png, gif ". __(_("and")) ." bmp.");				
				} elseif($type === "documents") {
					$formats = "csv, doc, docx, exe, pdf, ppt, pptx, rar, xls, xlsx ". __(_("and")) ." zip";
					$HTML   .= small(span("bold", __(_("Support files"))) .": ". $formats);					
				}
				
				$HTML .= "<br />";		
			}
		
		$HTML .= div(FALSE);
	
		$HTML .= div("library", "class");		
			$HTML .= $this->getFiles($type);
		$HTML .= div(FALSE);								
		
		$HTML .= div($this->px ."-upload-message", TRUE);
			$HTML .= formUploadFrame($this->px, $eventUpload);

			if(SESSION("ZanUserPrivilegeID") < 3) {
				$attributes = array(
								"name"   => $this->px ."Delete", 
								"value"  => __(_("Delete")),
								"type"   => "submit",
								"class"  => "btn btn-danger",
								"events" => $alert
				);
							
				$HTML .= formInput($attributes);			
			}
				
		$HTML .= div(FALSE);
		
		return $HTML;
	}
	
	public function upload() {
		if(segment(2, isLang()) === "upload" and segment(3, isLang()) === "images") {		
			$value = (POST("iDirbase")) ? POST("iDirbase") : 'www/lib/files/images/uploaded/';
			$value = (POST("iMake"))    ? POST("iDir") . slug(POST("iDirname")) : $value;
			
			$parts = explode("/", $value);					
		} elseif(segment(2, isLang()) === "upload" and segment(3, isLang()) === "documents") {
			$value = (POST("dDirbase")) ? POST("dDirbase") : 'www/lib/files/documents/uploaded/';
			$value = (POST("dMake"))    ? POST("dDir") . slug(POST("dDirname")) : $value;
			
			$parts = explode("/", $value);	
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
					
					print "<script>uploadResponse('6', '". $original ."');</script>";
				} else {
					print "<script>uploadResponse('6', '". $upload["filename"] ."');</script>";
				}						
			}
		} elseif($extension === "document") {
			@chmod($dir, 0777);
			
			$upload = $this->Files->upload($dir, "document");
			$file   = $this->Files->getFileInformation();
					
			if(is_array($file["icon"])) {
				if($upload["message"] === "The file size exceed the permited limit") {
					print "<script>window.parent.uploadDocumentsResponse('1', '". $this->Files->filename ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";
				} elseif($upload["message"] === "An error has ocurred") {
					print "<script>window.parent.uploadDocumentsResponse('2', '". $this->Files->filename ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";
				} elseif($upload["message"] === "The file type is not permited") {
					print "<script>window.parent.uploadDocumentsResponse('3', '". $this->Files->filename ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";
				} elseif($upload["message"] === "A problem occurred when trying to upload file") {
					print "<script>window.parent.uploadDocumentsResponse('4', '". $this->Files->filename ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";
				} elseif($upload["message"] === "The file already exists") {
					print "<script>window.parent.uploadDocumentsResponse('5', '". $this->Files->filename ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";							
				} else { 
					print "<script>window.parent.uploadDocumentsResponse('6', '". $upload["filename"] ."', '". $file["icon"][0] ."', '". $file["icon"][1] ."');</script>";			
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
						"title"   => __(_("Insert Image"))
					);
					
					$HTML .= li(formCheckbox($attributes) ." ". small($num) .
								a(span("tiny-image tiny-search", "&nbsp;&nbsp;&nbsp;&nbsp;"), _webURL . _sh . $path . $files[$i], FALSE, array("title" => __(_("Preview image")))) .														
								a(span("tiny-image tiny-add", "&nbsp;&nbsp;&nbsp;&nbsp;") . $files[$i], FALSE, FALSE, $attrs));								
				} elseif($type == "documents") {												
					$file = $this->Files->getFileInformation($files[$i]);
					
					$img = '\'<a href=\\\''. _webURL . _sh . $path . $files[$i] .'\\\' title=\\\''.$files[$i].'\\\'><img src=\\\''. $file["icon"][0] .'\\\' alt=\\\''. $files[$i] .'\\\' /></a>\'';
					
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
						"title"   => __(_("Insert file")),
						"class"   => "pointer",
						"onclick" => "javascript:insertHTML($img);"
					);
					
					$span  = span("tiny-image tiny-file", "&nbsp;&nbsp;&nbsp;&nbsp;");

					$HTML .= li(formCheckbox($attributes) ." ". small($num) .
								a($span, _webURL . _sh . $path . $files[$i], FALSE, array("title" => __(_("Download file")))).
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
			showAlert("Uploads directories does not exists", path("cpanel"));
		}
		
		while($element = $dir->read()) {			
			$directory = $path . $element . _sh;						
			
			if($element !== "." and $element !== ".." and !is_dir($directory)) { 
				if($element !== "cpanel" and $element !== "config") {
					if($types) { 
						if($element === $option) {
							$options[] = '<option selected="selected">'. encode($element) .'</option>';					
						} else {
							$options[] = '<option>'. $element .'</option>';
						}
					} else {
						$file = $this->Files->getFileInformation($element);

						if($this->type === "documents") {
							if($file["type"] === "document") {
								$options[] = encode($element);
							}
						} elseif($this->type === "images") {
							if($file["type"] === "image") {
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