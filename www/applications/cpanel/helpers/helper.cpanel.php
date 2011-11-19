<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function getCheckbox($ID, $disabled = NULL) {
	return '<input id="records" name="records[]" value="'. $ID .'" type="checkbox" '.$disabled.'/>';	
}

function getTable($caption, $thead, $tFoot, $total, $comments = FALSE, $app = FALSE) {
	$colspan = count($thead);
	
	$HTML  = '	<table id="results" class="results">
					<caption class="caption">
						<span class="bold">' . $caption . '</span>
					</caption>
					
					<thead>
						<tr>';
	
						for($i = 0; $i <= count($thead) - 1; $i++) {
							$HTML .= '<th>' . $thead[$i] . '</th>';
						}
	
	$HTML .= '			</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="' . $colspan . '">
								<span class="bold">' . __("Total") . ':</span> ' . $total . '
							</td>
						</tr>
					</tfoot>		  
		
					<tbody>';
			
					if($tFoot) {
						foreach($tFoot as $column) {                    	
							$HTML .= '<tr style="background-color: '. $column["i"] .'">';
							
							if(isset($column["checkbox"])) {
								$HTML .= '<td class="center">'. $column["checkbox"] .'</td>';
							}
							
							if(isset($column["ID"])) { 
								$HTML .= '<td class="center">'. $column["ID"] .'</td>';
							}
														
							if(isset($column["Username"])) { 
								$HTML .= '<td class="center">'. $column["Username"] .'</td>';
							}
							
							if(isset($column["Question"])) { 
								$HTML .= '<td class="center">'. $column["Question"] .'</td>';
							}
							
							if(isset($column["Name"])) { 
								$HTML .= '<td>'. $column["Name"] .'</td>';
							}
							
							if(isset($column["Email"])) { 
								$HTML .= '<td class="center">'. $column["Email"] .'</td>';							
							}
							
							if(isset($column["Company"])) { 
								$HTML .= '<td class="center">'. $column["Company"] .'</td>';
							}
							
							if(isset($column["Country"])) { 
								$HTML .= '<td class="center">'. $column["Country"] .'</td>';
							}
							
							if(isset($column["District"])) { 
								$HTML .= '<td class="center">'. $column["District"] .'</td>';							
							}
							
							if(isset($column["Subject"])) {
								$HTML .= '<td>'. $column["Subject"] .'</td>';
							}
							
							if(isset($column["Small"])) { 
								$HTML .= '<td class="center"><img src="'. $column["Small"] .'" /></td>';	
							}
							
							if(isset($column["Title"])) {
								$title = cut($column["Title"], 4, "text");	
								$HTML .= '<td>'. $title .'</td>';
							}
			
							if(isset($column["Application"])) { 
								$HTML .= '<td>'. $column["Application"] .'</td>';
							}
									
							if(isset($column["Controller"])) { 
								$HTML .= '<td class="center">'. __($column["Controller"]) .'</td>';
							}
							
							if(isset($column["Model"])) { 
								$HTML .= '<td class="center">'. __($column["Model"]).'</td>';
							}
							
							if(isset($column["CPanel"])) { 
								$HTML .= '<td class="center">'. __($column["CPanel"]).'</td>';
							}
							
							if(isset($column["Adding"])) { 
								$HTML .= '<td class="center">'. __($column["Adding"]).'</td>';
							}
							
							if(isset($column["Author"])) { 
								$HTML .= '<td class="center">'. $column["Author"] .'</td>';
							}
							
							if(isset($column["Sponsor"])) { 
								$HTML .= '<td>'. $column["Sponsor"] .'</td>';
							}
							
							if(isset($column["URL"])) {
								$HTML .= '<td class="center">
											<a rel="external" title="'. $column["Title"] .'" href="'. $column["URL"] .'">'. cut($column["URL"], 35, "word") .'</a>
										  </td>';
								$HTML .= '<td class="center">'. __($column["Category"]) .'</td>';
							}
							
							if(isset($column["Clicks"])) { 
								$HTML .= '<td class="center">'. $column["Clicks"] .'</td>';
							}
							
							if(isset($column["Size"])) { 
								$HTML .= '<td class="center">'. $column["Size"] .'</td>';							
							}
							
							if(isset($column["Email_From"])) { 
								$HTML .= '<td class="center">'. $column["Email_From"] .'</td>';
							}
							
							if(isset($column["Text_Date"])) { 
								$HTML .= '<td class="center">'. $column["Text_Date"] .'</td>';
							}
							
							if(isset($column["Website"])) { 
								$HTML .= '<td class="center">'. $column["Website"] .'</td>';
							}
							
							if(isset($column["BeDefault"])) { 
								$HTML .= '<td class="center">'. __($column["BeDefault"]) .'</td>';
								$HTML .= '<td class="center">'. __($column["Category"]) .'</td>';
							}
							
							if(isset($column["Comments"])) { 
								$HTML .= '<td class="center">'. __($column["Comments"]) .'</td>';
							}
							
							if(isset($column["Subscribed"])) { 
								$HTML .= '<td class="center">'. __($column["Subscribed"]) .'</td>';
							}
							
							if(isset($column["Position"])) {
								$HTML .= '<td class="center">'. __($column["Position"]) .'</td>';
							}
							
							if(isset($column["Image"])) { 
								$HTML .= '<td class="center">'. $column["Album"] .'</td>';
								
								$HTML .= '
										<td class="center">
											<a href="' . $column["Image"] . '" title="Banner" class="image-lightbox">
												' . __("view image") . '
											</a>
										</td>';
							}
							
							if(isset($column["Preview"])) {
								
								$HTML .= '
										<td class="center">
											<a href="' . $column["Preview"] . '" title="Banner" class="work-lightbox">
												' . __("view image") . '
											</a>
										</td>';
								
								$HTML .= '
										<td class="center">
											<a href="' . $column["Preview1"] . '" title="Banner" class="work-lightbox">
												' . __("view image") . '
											</a>
										</td>';
								
								$HTML .= '
										<td class="center">
											<a href="' . $column["Preview2"] . '" title="Banner" class="work-lightbox">
												' . __("view image") . '
											</a>
										</td>';
							}
							
							if(isset($column["Views"])) { 
								$HTML .= '<td class="center">'. $column["Views"] .'</td>';																					                    
							}
							
							if(isset($column["Language"])) { 
								$HTML .= '<td class="center">'. getLanguage($column["Language"], TRUE) .'</td>';
							}
							
							if(isset($column["Banner"])) {
								$HTML .= '
								<td class="center">
									<a href="' . _webURL . _sh . $column["Banner"] . '" title="Banner" class="banner-lightbox">
										' . __("view banner") . '
									</a>
								</td>';
							}
							
							if(isset($column["Principal"])) { 
								if($column["Principal"]) {
									$HTML .= '<td class="center">'. __("Yes") .'</td>';
								} else {
									$HTML .= '<td class="center">'. __("No") .'</td>';
								}
							}
							
							if(isset($column["Description"])) { 
								$HTML .= '<td class="center">'. $column["Description"] .'</td>';
							}
							
							if(isset($column["Follow"])) { 
								$HTML .= '<td class="center">'. __($column["Follow"]).'</td>';
							}
							
							if(isset($column["Time"])) { 
								$HTML .= '<td class="center">'. seconds($column["Time"]) .'</td>';
							}
							
							if(isset($column["Privilege"])) { 
								$HTML .= '<td class="center">'. $column["Privilege"] .'</td>';
							}
							
							if(isset($column["Type"])) { 
								$HTML .= '<td class="center">'. __($column["Type"]) .'</td>';
							}
							
							if(isset($column["Topics"])) { 
								$HTML .= '<td class="center">'. __($column["Topics"]) .'</td>';
							}
							
							if(isset($column["Replies"])) { 
								$HTML .= '<td class="center">'. __($column["Replies"]) .'</td>';
							}
							
							if(isset($column["ID_YouTube"])) {
								$HTML .= '
								<td class="center">
									<a href="http://www.youtube.com/watch?v='. $column["ID_YouTube"] .'" class="video-lightbox" title="'. $title .'">
										'. __("view video") .'
									</a>
								</td>';
							}
							
							if(isset($column["Situation"])) { 
								$HTML .= '<td class="center">'. __($column["Situation"]) .'</td>';
							}		
														
							if(isset($column["Action"])) { 
								$HTML .= '<td class="center">'. $column["Action"] .'</td>';
							}
						}
					}
	$HTML .= ' 						</tr>                     
					</tbody>            
				</table>
		
				<div class="table-options" style="position: relative; z-index: 1; margin-bottom: 25px;">
					&nbsp;'. __("Select") .': 
					<a onclick="checkAll(\'records\')" class="pointer" title="'. __("All") .'">'. __("All") .'</a> 
					<a onclick="unCheckAll(\'records\')" class="pointer" title="'. __("None") .'">'. __("None") .'</a><br />';
					
					if(segment(3) === "trash") { 
						$HTML .= '	&nbsp;<input name="restore" value="'. __("Restore") .'" type="submit" class="small-input" />
									&nbsp;<input name="delete" value="'. __("Delete") .'" type="submit" class="small-input" />';
					} elseif($comments === TRUE) { 
						$HTML .= '	&nbsp;<input name="deleteComments" value="'. __("Delete") .'" type="submit" class="small-input" />';
					} else { 
						$HTML .= '	&nbsp;<input name="trash" value="'. __("Send to trash") .'" type="submit" class="small-input" />';
					}
					
	$HTML .= '	</div>';
	
	return $HTML;
}

function getTFoot($trash) {
	global $Load;
	
	$CPanel_Model = $Load->model("CPanel_Model");
	
	$application = whichApplication();
	
	if($application) {
		$colors[0] = _color1;
		$colors[1] = _color2;
		$colors[2] = _color3;
		$colors[3] = _color4;
		$colors[4] = _color5;		
		$i = 0;
		$a = 0;
		$j = 2;		
	}	
	
	$data  = $CPanel_Model->records($trash);
	$tFoot = array();
	
	if($data) {		
		foreach($data as $record) {			
			if($record["Situation"] === "Deleted") {
				$color  = $colors[$j];
			} else {
				$color  = $colors[$i];
			}		

			if($application === "ads") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Ad"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Ad"]);
				}

				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Ad"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Ad"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Position",  $record["Position"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Banner", 	  $record["Banner"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Principal", $record["Principal"], 	  	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);
			} elseif($application === "applications") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Application"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Application"]);
				}

				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Application"]), $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		      $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Application"],      	  	  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  		      $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "CPanel",    $record["CPanel"], 	  	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Adding",    $record["Adding"], 	  	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "BeDefault", $record["BeDefault"], 	  	  		  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Comments",  $record["Comments"], 	  	              $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Category",  $record["Category"], 	  	              $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			  $tFoot);
			} elseif($application === "blog") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Post"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Post"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Post"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Post"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Author", 	  $record["Author"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",  $record["Language"],    	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "pages") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Page"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Page"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Page"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Page"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",  $record["Language"],    	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Principal", $record["Principal"],   	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "links") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Link"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Link"]);
				}	
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Link"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Link"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "URL",       $record["URL"],    	      		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Category",  $record["Position"],   	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "videos") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Video"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Video"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",   getCheckbox($record["ID_Video"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		   $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		   $record["ID_Video"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	   $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID_YouTube", $record["ID_YouTube"],    	      	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",     $action, 			      	  		$tFoot);	
			} elseif($application === "feedback") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Feedback"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Feedback"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Feedback"]),	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Feedback"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Name", 	  $record["Name"], 	  	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Email",     $record["Email"],    	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Subject",   $record["Subject"],    	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Text_Date", $record["Text_Date"],    	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "gallery") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Image"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Image"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Image"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Image"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Album",     $record["Album"],    	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Image",     _webURL . _sh . $record["Original"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	   			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "polls") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Poll"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Poll"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Poll"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Poll"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Type",      $record["Type"],    	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "users") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_User"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_User"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_User"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_User"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Username",  $record["Username"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Email", 	  $record["Email"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);
			} elseif($application === "works") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Work"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Work"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Work"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Work"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview",   _webURL . _sh . $record["Image"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview1",  _webURL . _sh . $record["Preview1"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview2",  _webURL . _sh . $record["Preview2"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);
			} elseif($application === "comments") {
				
				$Applications_Model = $Load->model("Applications_Model");
				$Application = $Applications_Model->getApplication($record["ID_Application"]);
				
				$Users_Model = $Load->model("Users_Model");
				$result      = $Users_Model->getUsername($record["ID_User"]);
				
				if($result === FALSE) {
					$Username = $record["Name"];
				} else {
					$Username  = $result["Username"];
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Comment"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		    $color, 				  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		    $record["ID_Comment"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Application", $Application, 	      	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID_Element",  $record["ID_Element"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Username",    $Username, 	      	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Comment",     $record["Comment"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", 	$record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",      $action, 			      			$tFoot);	
			} elseif($application === "forums") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Forum"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Forum"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  	getCheckbox($record["ID_Forum"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  	$color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  	$record["ID_Forum"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  	$record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Topics", 		$record["Topics"],   	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Replies", 	$record["Replies"],   	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation",	$record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    	$action, 			      	  		$tFoot);	
			} elseif($application === "categories") {
				
				$Applications_Model    = $Load->model("Applications_Model");
				$ID_Application        = $Applications_Model->getApplicationByCategory($record["ID_Category"]);
				$record["Application"] = $Applications_Model->getApplication($ID_Application);
				
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Category"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Category"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",    getCheckbox($record["ID_Category"]), $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		    $color, 					  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		    $record["ID_Category"],      	  	 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	    $record["Title"], 	  	  			 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Application", $record["Application"],    	  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",    $record["Language"],    	  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", 	$record["Situation"], 	  		     $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",      $action, 			      	  		 $tFoot);	
			} 

			if($i == 1) {
				$i = 0;
			} else {
				$i++;
			} 
			
			$a++;
			
			if($j == 3) {
				$j = 2; 
			} else {
				$j++;
			}
		}
		
	} else {
		if($application !== "comments") {
			redirect(_webBase . _sh . _webLang ._sh . $application . _sh . _cpanel . _sh .  _add);
		} else {
			return FALSE;
		}
	}
	
	return $tFoot;	
}

function getFields($application) {
	if($application === "ads") {
		return "ID_Ad, Title, Position, Banner, Principal, Situation";
	} elseif($application === "applications") {
		return "ID, Title, CPanel, Adding, BeDefault, Category, Comments, Situation";
	} elseif($application === "blog") {
		return "ID, Title, Author, Language, Situation";
	} elseif($application === "categories") {
		return "ID, Title, Application, Language, Situation";
	} elseif($application === "gallery") {
		return "ID, Title, Album, Image, Situation";
	} elseif($application === "pages") {
		return "ID, Title, Language, Principal, Situation";
	} elseif($application === "links") {
		return "ID, Title, Url, Category, Situation";
	} elseif($application === "videos") {
		return "ID, Title, Video, Situation";
	} elseif($application === "feedback") {
		return "ID, Name, Email, Subject, Date, Situation";
	} elseif($application === "users") {
		return "ID, Username, Email, Situation";
	} elseif($application === "polls") {
		return "ID, Title, Type, Situation";
	} elseif($application === "comments") {
		return "ID, Application, ID_Element, Username, Comment, Situation";
	} elseif($application === "forums") {
		return "ID, Title, Topics, Replies, Situation";
	} elseif($application === "works") {
		return "ID, Title, Image, Preview1, Preview2, Situation";
	}
	
}

function getSearch() {
	global $Load;
	
	$Load->helper("forms");
	$Load->helper("html");

	$application = whichApplication();
	
	if($application === "users") {
		$field = "username";
		$name  = __("Username");
	} else {
		$field = "title";
		$name  = __("Title");			
	}
	
	$fields = array(
		0 => array(
				"field"    => "ID",   
				"name"     => "ID",  
				"selected" => FALSE
			), 
		1 => array(
				"field"    => $field, 
				"name"     => $name, 
				"selected" => TRUE
			)
	);

	$HTML  = formOpen(_webBase . _sh . _webLang . _sh . segment(1) . _sh . _cpanel . _sh . _results, "form-results-search");
	$HTML .= br();
	$HTML .= bold(" ". __("Search") . ":", FALSE);

	$attributes = array(
		"p" => FALSE,
		"name" => "search",
		"class" => "small-input"
	);

	$HTML .= formInput($attributes);

	$HTML .= bold(" ". __("Field") .":", FALSE);
	
	$i = 0;		

	foreach($fields as $field) {
		$fields[$i]["value"]    = $field["field"];
		$fields[$i]["option"]   = $field["name"];
		$fields[$i]["selected"] = $field["selected"];
		
		$i++;
	}
	
	$HTML .= formSelect(array("name" => "field", "class" => "small-input"), $fields);
	
	$HTML .= bold(__("Order") . ":", FALSE);
	
	$options[0]["value"]    = "ASC";
	$options[0]["option"]   = __("Ascending");
	$options[0]["selected"] = TRUE;
	$options[1]["value"]    = "DESC";
	$options[1]["option"]   = __("Descending");
	$options[1]["selected"] = FALSE;
	
	$HTML .= formSelect(array("name" => "order", "class" => "small-input"), $options);
	$HTML .= formInput(array("name" => "seek", "type" => "submit", "value" => __("Seek")));	
	
	return $HTML;
}
