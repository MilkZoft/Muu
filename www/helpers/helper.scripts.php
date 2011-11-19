<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function getScript($js, $application = NULL, $extra = NULL, $getJs = FALSE, $external = FALSE) {
	$HTML = NULL;

	if(file_exists($js) and !$external) {	
		return loadScript($js);
	} else {
		if($external) {
			return loadScript($js, $application, TRUE);
		} elseif(isset($application)) {
			return loadScript($js, $application);
		} else {
			if($js === "jquery") {
				return loadScript("www/lib/scripts/js/jquery.js");
			} elseif($js === "checkbox") {
				$HTML  = '	<script type="text/javascript">
								function checkAll(idForm) {
									$("form input:checkbox").attr("checked", "checked");
								}
						
								function unCheckAll(idForm) {
									$("form input:checkbox").removeAttr("checked");
								}
							</script>';	
			} elseif($js === "external") {
				$HTML = '	<script type="text/javascript">
								$(document).ready(function() { 
									$(function() {
										$(\'a[rel*=external]\').click(function() {
											window.open(this.href);
											return false;
										});
									});
								});
							</script>				
							
							<noscript><p class="NoDisplay">'. __("Disable Javascript") .'</p></noscript>';		
			} elseif($js === "nivo-slider") {
					$HTML .= loadScript("www/lib/scripts/js/nivo-slider/nivo-slider.js");
					$HTML .= '	<link rel="stylesheet" href="'. _webURL .'/www/lib/scripts/js/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
								<link rel="stylesheet" href="'. _webURL .'/www/lib/scripts/js/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
								
								<script type="text/javascript">
									$(window).load(function() {
										$(\'#slider\').nivoSlider();
									});	
								</script>													
					';			
			} elseif($js === "show-element") {
				$HTML  = '	<script type="text/javascript">
								function showElement(obj) {
									if(obj.className == "no-display") {
										obj.className = "display";
									} else {
										obj.className = "no-display";
									}
								}
							</script>';
			} elseif($js === "tiny-mce") {
				$HTML  = loadScript("www/lib/scripts/js/tiny_mce/tiny_mce.js"); 
				$HTML .= '<script type="text/javascript">';
				
				if($extra === "class") {
					$HTML .= '		
									tinyMCE.init({
										mode : "textareas",
										editor_selector : "editor",
										editor_deselector : "noeditor",
										theme : "simple"
									});
							';
				} elseif($extra !== "basic") {
					$HTML .= '			
									tinyMCE.init({
										mode : "exact",
										elements : "editor",
										theme : "advanced",
										skin : "o2k7",
										cleanup: true,
										plugins : "videos,advcode,safari,pagebreak,style,advhr,advimage,advlink,emotions,preview,media,fullscreen,template,inlinepopups,advimage,media,paste",              
										theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,videos,image,advcode,|,forecolor,|,charmap,|,pastetext,pasteword,pastetext,fullscreen,pagebreak,preview",
										theme_advanced_buttons2 : "",
										theme_advanced_buttons3 : "",
										theme_advanced_toolbar_location : "top",
										theme_advanced_toolbar_align : "left",
										theme_advanced_statusbar_location : "bottom",
										theme_advanced_resizing : false,
										convert_urls : false,                    
										content_CSS : "css/content.css",               
										external_link_list_url : "lists/link_list.js",
										external_image_list_url : "lists/image_list.js",
										media_external_list_url : "lists/media_list.js"
									});
							';	
				} else {
					$HTML .= '		
									tinyMCE.init({
										mode : "exact",
										elements : "editor",
										theme : "simple",
										editor_selector : "mceSimple"
									});
							';	
				}				
				
				$HTML .= '	function insertHTML(content) {
								parent.tinyMCE.execCommand(\'mceInsertContent\', false, content);
							}
						</script>';
			} elseif($js === "upload") {
					$iPx   = (POST("iPx"))            ? POST("iPx")                                                  : 'i';
					$iPath = (POST("iPath"))          ? POST("iPath")                                                : 'www/lib/files/images/uploaded/';
					$iPath = (POST($iPx . "Dirbase")) ? POST($iPx . "Dirbase")                                       : $iPath;
					$iPath = (POST($iPx . "Make"))    ? POST($iPx . "Dir") . nice(POST($iPx . "Dirname")) . _sh 	 : $iPath;				
						
					$dPx   = (POST("dPx"))   ? POST("dPx")   : "d";
					$dPath = (POST("dPath")) ? POST("dPath") : "www/lib/files/documents/uploaded/";
					
					$dPath = (POST($dPx . "Dirbase")) ? POST($dPx . "Dirbase")                                       : $dPath;
					$dPath = (POST($dPx . "Make"))    ? POST($dPx . "Dir") . nice(POST($dPx . "Dirname")) . _sh 	 : $dPath;
					
					$application = isLang() ? ucfirst(segment(1)) : ucfirst(segment(0));
					?>
						<script type="text/javascript">
						<!-- 
							function uploadResponse(state, file) {
								var path, insert, ok, error, form, message; 
								
								path = '<?php print _webURL . _sh . $iPath;?>' + file;
								HTML = '\'<img src=\\\'' + path + '\\\' alt=\\\'' + file + '\\\' />\'';
								insert = '<li><input name="iLibrary[]" type="checkbox" value="' + path + '" /><span class="small">00<' + '/span>';
								insert = insert + '<a href="' + path + '" rel="external" title="<?php print __("Preview"); ?>"><span class="tiny-image tiny-search">&nbsp;&nbsp;&nbsp;&nbsp;</span><' + '/a>';
								insert = insert + '<a class="pointer" onclick="javascript:insertHTML(' + HTML + ');" title="<?php print __("Insert image"); ?>"><span class="tiny-image tiny-add">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;';
								insert = insert + '<span class="bold">' + file + '<' + '/span><' + '/a><' + '/li>';						
								
								if(state == 1) {
									message = '<?php print __("The file size exceed the permited limit"); ?>';
								}
								
								if(state == 2) {
									message = '<?php print __("An error has ocurred"); ?>';
								}
								
								if(state == 3) {
									message = '<?php print __("The file type is not permited"); ?>';
								}
								
								if(state == 4) {
									message = '<?php print __("A problem occurred when trying to upload file"); ?>';
								}
								
								if(state == 5) {
									message = '<?php print __("The file already exists"); ?>';
								}
								
								if(state == 6) {
									message = '<?php print __("Successfully uploaded file"); ?>';
									document.getElementById('i-add-upload').innerHTML = insert + document.getElementById('i-add-upload').innerHTML;
								}
								
								document.getElementById('i-upload-message').innerHTML = message;
							}												
							
							function uploadDocumentsResponse(dState, dFile, dIcon, dAlt) {
								var dPath, dInsert, dOk, dError, dForm, dMessage, dHTML;
								
								dPath = '<?php print _webURL . _sh . $dPath; ?>' + dFile;					
								dHTML = '\'<a href=\\\'' + dPath + '\\\' title=\\\'' + dFile + '\\\'><img src=\\\'' + dIcon + '\\\' alt=\\\'' + dAlt + '\\\' /></a>\'';
								
								dInsert = '<li><input name="dLibrary[]" type="checkbox" value="' + dPath + '" />';
								dInsert = dInsert + '<span class="small">00<' + '/span><a href="' + dPath + '" title="<?php print __("Download file"); ?>">';
								dInsert = dInsert + '<span class="tiny-image tiny-file">&nbsp;&nbsp;&nbsp;&nbsp;</span><' + '/a>';
								dInsert = dInsert + '<a class="pointer" onclick="javascript:insertHTML(' + dHTML + ');" title="<?php print __("Insert file"); ?>">';
								dInsert = dInsert + '<span class="tiny-image tiny-add">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
								dInsert = dInsert + '<span class="bold">' + dFile + '<' + '/span><' + '/a><' + '/li>';								
						
								if(dState == 1) {
									message = '<?php print __("The file size exceed the permited limit"); ?>';
								}
								
								if(dState == 2) {
									message = '<?php print __("An error has ocurred"); ?>';
								}
								
								if(dState == 3) {
									message = '<?php print __("The file type is not permited"); ?>';
								}
								
								if(dState == 4) {
									message = '<?php print __("A problem occurred when trying to upload file"); ?>';
								}
								
								if(dState == 5) {
									message = '<?php print __("The file already exists"); ?>';
								}								
								
								if(dState == 6) {
									message = '<?php print __("Successfully uploaded file"); ?>';
									document.getElementById('d-add-upload').innerHTML = dInsert + document.getElementById('d-add-upload').innerHTML;
								}
								
								document.getElementById('d-upload-message').innerHTML = message;
							}
						 -->
						</script>
						
						<noscript><p class="no-display"><?php print __("Disable Javascript"); ?></p></noscript>
					
					<?php
					return NULL;				
				}
			
			return $HTML;
		}
	}
}
