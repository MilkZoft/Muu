<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print '<div id="column">';
		if(is_array($post)) {	
			$URL = path("blog");

			if(isset($post["categories"][0]["Title"])) {
				$category  = '<span class="new-category">'. repeat("&nbsp;", 20); 
				$category .= a('"'. $post["categories"][0]["Title"] .'"', $URL . "category" . _sh . $post["categories"][0]["Slug"]) . '</span> ';
			} else {
				$category = NULL;
			}

			$URL = path("blog/". $post["post"]["Year"] ."/". $post["post"]["Month"] ."/". $post["post"]["Day"];

			print '<div class="new">';
				print $category;
			
				print '<span class="new-title">'. a(cut($post["post"]["Title"], 10), $URL . $post["post"]["Slug"]) .'</span><br />';
				print cut(cleanHTML($post["post"]["Content"]), 16) ." <br /> ". a(__("Read more"), $URL . $post["post"]["Slug"]);
			print '</div>';
		}
		
	print '</div>';