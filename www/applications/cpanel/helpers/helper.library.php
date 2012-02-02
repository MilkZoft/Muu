<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function getAction($type, $files = FALSE, $dir = FALSE, $name = FALSE) {	
	global $Load;
	
	$Load->helper("router");
	
	$Files = $Load->core("Files");
	$Applications_Model = $Load->model("Applications_Model");
	
	$application = $Applications_Model->getID(segment(2));
	
	if($type === "make") {	
		if(is_dir($dir)) {
			if(!file_exists($dir . $data($name) . _sh)) {
				mkdir($dir . $data($name) . _sh); 				
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
			$icon = $Files->getType(str_replace("lib/files/documents/uploaded/", "", $file), TRUE, TRUE, TRUE);
			
			if(file_exists($file)) {
				unlink($file);
			}
		}
	}
}
	
function getLibrary($type) {
	global $Load;
	
	$Load->helper("router");
	
	$Files = $Load->core("Files");
	$Applications_Model = $Load->model("Applications_Model");
	
	$application = $Applications_Model->getID(segment(2));
	
	$type   = $type;
	$action = NULL;
	
	if(POST("iDelete") and POST("iLibrary")) {
		getAction("iDelete", POST("iLibrary"));
	} elseif(POST("dDelete") and POST("dLibrary")) {
		getAction("dDelete", POST("dLibrary"));
	} elseif(POST("iMake")) {
		getAction("Make", FALSE, POST("iDir"), POST("iDirname"));
	} elseif(POST("dMake")) {
		getAction("Make", FALSE, POST("dDir"), POST("dDirname"));
	}
	
	if($type === "images") {
		$px   = "i";
		$text = __(_("Images library"));
		$path = "lib/files/images/uploaded/";
	} elseif($type === "documents") {
		$px   = "d";
		$text = __(_("Documents library"));
		$path = "lib/files/documents/uploaded/";
	}
			
	if(segment(4) === "edit") {
		$action = segment(3) . _sh . segment(4) . _sh . segment(5);	
	} elseif(segment(3) === "add") {
		$action = segment(3);	
	}						
	
	$URL = path(whichApplication() . "/cpanel/";	
	
	$alert  = 'onclick="document.getElementById(\''. ucfirst(whichApplication()) .'\').target=\'\';';
	$alert .= 'document.getElementById(\''. ucfirst(whichApplication()) .'\').action=\''. $URL .'/'. $action .'/#'. $px .'Library\';';
	$alert .= 'return confirm(\''. __("Do you want to delete the file?") .'\');"'; 		
	
	$event 		  = "onclick=\"document.getElementById('". ucfirst(whichApplication()) ."').target=''; ";
	$event 		 .= "document.getElementById('". ucfirst(whichApplication()) ."').action='". $URL . _sh . $action . _sh ."#". $px . "Library';\""; 
	$eventUpload  = "onclick=\"document.getElementById('". ucfirst(whichApplication()) ."').target='". $px ."Upload';";
	$eventUpload .= "document.getElementById('". ucfirst(whichApplication()) ."').action='". path("/cpanel/upload/library/". strtolower($type) ."/#". $px ."Library") ."';";
	$eventUpload .= "javascript:submit();\"";
						
	$HTML = '<a name="'. $px .'Library">';
	
	if($type === "images") {
		$anchorEvents = "onclick=\"showElement(document.getElementById('". $px ."-library'));\" title=\"". __(_("Click to show or hide")) ."\" class=\"pointer\"";
	} else {
		$anchorEvents = "onclick=\"showElement(document.getElementById('". $px ."-library1'));\" title=\"". __(_("Click to show or hide")) ."\" class=\"pointer\"";
	}
	
	$HTML .= '<p class="field">';
	$HTML .= '	<a '. $anchorEvents .'>&raquo; '. $text .'</a>';
	$HTML .= '</p>';
	
	if($type === "images") {
		if(POST("iGo") or POST("iMake") or POST("iDelete")) {
			$HTML .= '<div id="'. $px .'-library">';
		} else {
			$HTML .= '<div id="'. $px .'-library" class="no-display">';
		}
	} else {
		if(POST("dGo") or POST("dMake") or POST("dDelete")) {
			$HTML .= '<div id="'. $px .'-library1">';
		} else {
			$HTML .= '<div id="'. $px .'-library" class="no-display">';
		}
	}
	
	$HTML .= '<div class="extra">';
								
	if(POST($px . "Dirbase")) {
		if(POST($px . "Dirbase"] !== $path) {
			$dir = str_replace($path, "/", POST($px . "Dirbase"));
			
			$selected = '<option value="'. POST($px . "Dirbase") .'" selected="selected">'. $dir .'</option>';
		}
	}			
			
	if($type === "images") {
		if(POST("iMake") and POST("iDirname") !== "") {
			if(POST("iDirname") !== $path) {
				$dir = str_replace($path, "/", POST("iDir"));
				
				$selected  = '<option value="'. POST("iDir") . nice(POST("iDirname")).'/" selected="selected">';
				$selected .= $dir . nice(POST("iDirname")) .'/</option>';
			}						
		}
	} elseif($type === "documents") {					
		if(POST("dMake") and POST("dDirname") !== "") {
			if(POST("dDirname") !== $path) {
				$dir = str_replace($this->path, "/", POST("dDir"));
				
				$selected  = '<option value="'. POST("dDir") . nice(POST("dDirname")) .'/" selected="selected">';
				$selected .= $dir . nice(POST("dDirname")) .'/</option>';
			}						
		}
	}
			
	if(count(getDirs($path)) > 1) {
		$HTML .= '<select name="'. $px .'Dirbase" class="input" size="1">'. getDirs($path) .'</select>';
		$HTML .= '<input name="'. $px .'Go" type="submit" value="'. __(_("Go")) .'" class="input" '. $event .' /><br /><br />';
	}
		
	$value = (POST($px . "Dirbase")) ? POST($px . "Dirbase") : $path;
	$value = (POST($px . "Make")) 	 ? POST($px . "Dir") . nice(POST($px . "Dirname")) : $value;
	
	$parts = explode("/", $value);
	
	if(count($parts) > 0) {
		$part = NULL;
		
		for($i = 0; $i <= count($parts) - 1; $i++) {
			$part .= nice($parts[$i]) . "/";	
		}			
		
		$part = str_replace("//", "/", $part);
	}
			
	$HTML .= '<input name="'. $px .'Dir" type="hidden" value="'. $part .'" />';
	$HTML .= '<input name="'. $px .'Px" type="hidden" value="'. $px .'" />';
	$HTML .= '<input name="'. $px .'Application" type="hidden" value="'. $application .'" />';
	$HTML .= '<input name="'. $px .'Path" type="hidden" value="'. $path .'" />';
	
	$part = _webURL . _sh . $part;
	
	if(SESSION("ZanUserPrivilegeID") < 3) {
		$HTML .= '<input name="'. $px .'Dirname" type="text" class="input" />';
		$HTML .= '<input name="'. $px .'Make" type="submit" value="'. __(_("Make directory")) .'" '. $event .' /> <br />';
		$HTML .= '<span class="small bold">'. __(_("The new folders will be created and the files will be uploaded in:")) .'</span><br />';
		$HTML .= $part . '<br />';
	
		if($type === "images") {
			$HTML .= '<span class="small bold">'. __(_("Support files")) .': jpg, jpeg, png, gif '. __(_("and")) .' bmp.</span>';
		} elseif($type === "Documents") {
			$formats = "csv, doc, docx, exe, pdf, ppt, pptx, rar, xls, xlsx   ". __(_("and")) ." zip";
			$HTML .= '<span class="small bold">'. __(_("Support files")) .': '. $formats;
		}
		
		$HTML .= '<br />';		
	}
	
	$HTML .= '</div>';

	$HTML .= '<div class="images-library">';		
	$HTML .= 	getFiles($type);
	$HTML .= '</div>';
	
	$HTML .= '<br />';
	
	$HTML .= '<div id="'. $px .'-upload-message"></div>';
	
	if(SESSION("ZanUserPrivilegeID") < 3) {
		$HTML .= '<input name="" type="submit" value="'. __(_("Delete")) .'" class="submit float-right" '. $alert .' />';		
	}
	
	$HTML .= '<input type="file" name="'. $px .'File" /> ';
	$HTML .= '<input type="submit" name="'. $px .'Upload" value="'. __(_("Upload")) .'" '. $events .' /><br />';
	$HTML .= '<iframe name="'. $px .'Upload" class="no-display"></iframe>';
	$HTML .= '</div>';
	
	return $HTML;
}

function uploading($dir = FALSE) {
	if(POST("iUpload")) {
		if(FILES("iFile", "name") !== "") {
			$Files->filename  = FILES("iFile", "name");
			$Files->fileType  = FILES("iFile", "type");
			$Files->fileSize  = FILES("iFile", "size");
			$Files->fileError = FILES("iFile", "error");
			$Files->fileTmp   = FILES("iFile", "tmp_name");
		}						
	} elseif(POST("dUpload")) {			
		if(FILES("dFile", "name") !== "") {
			$Files->filename  = FILES("dFile", "name");
			$Files->fileType  = FILES("dFile", "type");
			$Files->fileSize  = FILES("dFile", "size");
			$Files->fileError = FILES("dFile", "error");
			$Files->fileTmp   = FILES("dFile", "tmp_name");
		}			
	}			
			
	$parts = explode("/", $dir);
	
	if(count($parts) > 0) {
		if($parts[2] === "images") {
			$extension = "Image";
		} elseif($parts[2] === "documents") {
			$extension = "Document";
		}
	}						

	if($extension === "Image") {			
		@chmod($dir, 0777);
		
		$upload = $Files->upload($dir);
		
		if($upload === 2) {
			print "<script>window.parent.uploadResponse('1', '". $Files->filename ."');</script>";
		} elseif($upload === 3) {
			print "<script>window.parent.uploadResponse('2', '". $Files->filename ."');</script>";
		} elseif($upload === 4) {
			print "<script>window.parent.uploadResponse('3', '". $Files->filename ."');</script>";
		} elseif($upload === 5) {
			print "<script>window.parent.uploadResponse('4', '". $Files->filename ."');</script>";
		} elseif($upload === 6) {
			print "<script>window.parent.uploadResponse('5', '". $Files->filename ."');</script>";
		} else {
			$Images = $core("images");
			
			$original = $Images->getResize("Original", $dir, $upload, _minOriginal, _maxOriginal, FALSE, FALSE);
			$original = str_replace($dir, "", $original);
			
			print "<script>window.parent.uploadResponse('6', '". $original ."');</script>";			
		}
	} elseif($extension === "Document") {
		@chmod($dir, 0777);
		
		$upload = $Files->upload($dir, "Document");
		$icon   = $Files->getType($Files->filename, TRUE, TRUE, TRUE);
					
		if($upload === 2) {
			print "<script>window.parent.uploadDocumentsResponse('1', '". $Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
		} elseif($upload === 3) {
			print "<script>window.parent.uploadDocumentsResponse('2', '". $Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
		} elseif($upload === 4) {
			print "<script>window.parent.uploadDocumentsResponse('3', '". $Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
		} elseif($upload === 5) {
			print "<script>window.parent.uploadDocumentsResponse('4', '". $Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
		} elseif($upload === 6) {
			print "<script>window.parent.uploadDocumentsResponse('5', '". $Files->filename ."', '". $icon[0] ."', '". $icon[1] ."');</script>";
		} else {
			print "<script>window.parent.uploadDocumentsResponse('6', '". $upload ."', '". $icon[0] ."', '".$icon[1]."');</script>";			
		}
	}								
}
	
function getFiles($type) {
	if($type === "images") { 
		$HTML = '<ul id="i-add-upload" class="add-upload">';
	} elseif($type === "documents") { 
		$HTML = '<ul id="d-add-upload" class="dd-upload">';			
	} 
	
	$path = (POST($px . "Dirbase")) ? POST($px . "Dirbase"] : $path;
	$path = (POST($px . "Make"))    ? POST($px . "Dir"] . nice(POST($px . "Dirname")) : $path;
	
	$files = getPath($path);
							
	if(is_array($files)) {
		for($i = 0; $i <= count($files) - 1; $i++) {										
			if($type == "images") {
				$HTML = '\'<img src=\\\''. _webURL . _sh . $path . $files[$i] .'\\\' alt=\\\''. $files[$i] .'\\\' />\'';
				
				if($i < 9) {
					$num = "0" . ($i + 1); 
				} else {
					$num = $i + 1;
				}
				
				$HTML .= '	<li>
								<input name="'. $px .'Library[]" value="'. $path . $files[$i] .'" /> <span class="small">'. $num .'</span>
								
								<a href="'. _webURL . _sh . $path . $files[$i] .'" title="'. __(_("Preview image")) .'">
									'. span("tiny-image tiny-search", "&nbsp;&nbsp;&nbsp;&nbsp;") .'
								</a>
								
								<a href="'.$files[$i] .'" title="'. __(_("Insert image")) .'" class="pointer" onclick="javascript:insertHTML('. $HTML .');">
									'. span("tiny-image tiny-add", "&nbsp;&nbsp;&nbsp;&nbsp;") .'
								</a>
							</li>';
			} elseif($type == "documents") {												
				$icon = $Files->getType($files[$i], TRUE, TRUE, TRUE);
				$HTML  = '\'<a href=\\\''. _webURL . _sh . $path . $files[$i] .'\\\' title=\\\''. $files[$i] .'\\\'>';
				$HTML .= '<img src=\\\''. $icon[0] .'\\\' alt=\\\''. $files[$i] .'\\\' /></a>\'';
				
				if($i < 9) {
					$num = "0" . ($i + 1); 
				} else {
					$num = $i + 1;
				}

				$HTML .= '	<li>
								<input name="'. $px .'Library[]" value="'. $path . $files[$i] .'" type="checkbox" /> <span class="small">'. $num .'</span>

								<a href="'. _webURL . _sh . $path . $files[$i] .'" title="'. __(_("Download file")) .'">
									'. span("tiny-image tiny-file", "&nbsp;&nbsp;&nbsp;&nbsp;") .'
								</a>
								
								<a href="'.$files[$i] .'" title="'. __("Insert file") .'" class="pointer" onclick="javascript:insertHTML('. $HTML .');">
									'. span("tiny-image tiny-add", "&nbsp;&nbsp;&nbsp;&nbsp;") .'
								</a>
							</li>';																															
			}
		}	
	
		$HTML .= '</ul>'
	}
	
	return $HTML;
}

function getDirs($dirPath, $i = 1) {
	if($i === 1) {
		unset($options);
		
		$options[0] = '<option value="'. $path .'">/</option>';				
	}
		
	if(is_dir($dirPath)) {			
		if($dh = opendir($dirPath)) {				
			while(($file = readdir($dh)) !== FALSE) {					
				if(is_dir($dirPath . $file . _sh) and $file !== "." and $file !== "..") {
					$dir = $dirPath . $file . _sh;
					
					$options[$i] .= '<option value="'. $dir .'">'. str_replace($path, "/", $dirPath . $file) .'</option>';					
					$i++;
					
					getDirs($dir, $i);
				}
			}
		}
		
		closedir($dh);
	}
	
	return $option;
}

function getPath($path, $element = NULL, $type = FALSE) {
	$Files   = $core("Files");
	$dir     = @dir($path);
	$records = NULL;

	if(!$dir) {
		redirect("cpanel");
	}
	
	while($element = $dir->read()) {			
		$directory = $path . $element . _sh;						

		if($element !== "." and $element !== ".." and !is_dir($directory)) {
			if($element !== "cpanel" and $element !== "config") {
				if($type) {
					if($element === $element) {
						$records[] = '<option selected="selected">'. encode($element) .'</option>';					
					} else {
						$records[] = '<option>'. $element .'</option>';
					}
				} else {
					$extension2 = $Files->getType($element, TRUE);
					
					if($type === "documents") {
						if($extension2 === "Document") {
							$records[] = encode($element);
						}
					} elseif($type === "images") {
						if($extension2 === "Image") {
							$records[] = encode($element);
						}
					}
				}
			}
		}
	}		
	
	$dir->close();
	
	return $records;
}