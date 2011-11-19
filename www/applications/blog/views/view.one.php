<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print '<div id="column">';
	
		if(is_array($post)) {	
			$URL = _webBase . _sh . _webLang . _sh . _blog . _sh;

			if(isset($post["categories"][0]["Title"])) {
				$category = '<span class="new-category">'. repeat("&nbsp;", 20) . a('"'. $post["categories"][0]["Title"] .'"', $URL . _category . _sh . $post["categories"][0]["Slug"]) . '</span> ';
			} else {
				$category = NULL;
			}

			$URL = _webBase . _sh . _webLang . _sh . _blog . _sh . $post["post"]["Year"] . _sh . $post["post"]["Month"] . _sh . $post["post"]["Day"] . _sh;

			print '<div class="new">';
				print $category;
				
				print a(img(_webURL . _sh . _www . _sh . _lib . _sh . _images . _sh . _blog . _sh . "pedro.png", "Pedro Velazquez", "new-image"), $URL . $post["post"]["Slug"]) ."<br />";

				print '<span class="new-title">'. a(cut($post["post"]["Title"], 10), $URL . $post["post"]["Slug"]) .'</span><br />';
				print cut(cleanHTML($post["post"]["Content"]), 16) ." <br /> ". a(__("Read more"), $URL . $post["post"]["Slug"]);
			print '</div>';
		}
		
	print '</div>';