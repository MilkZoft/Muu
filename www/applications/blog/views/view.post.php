<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } 

if(is_array($post)) {				
	$URL 		= _webBase . _sh . _webLang . _sh . _blog . _sh . $post["Year"] . _sh . $post["Month"] . _sh . $post["Day"] . _sh . $post["Slug"];		
	$categories = NULL;
	$tags		= NULL;
	
	$i = 0;
	
	if(isset($dataCategories) and is_array($dataCategories)) {
		foreach($dataCategories as $category) {
			if($i === count($dataCategories) - 1) {
				$categories .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _category . _sh . $category["Slug"] .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a>';
			} elseif($i === count($dataCategories) - 2) {
				$categories .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _category . _sh . $category["Slug"] .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a> '. __("and") .' ';
			} else {
				$categories .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _category . _sh . $category["Slug"] .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a>, ';
			}
			
			$i++;
		}
	}				
	
	$i = 0;
	
	if(isset($dataTags) and is_array($dataTags)) {								
		foreach($dataTags as $tag) {
			if($i === count($dataTags) - 1) {
				$tags .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _tag . _sh . $tag["Slug"] .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a>';
			} elseif($i === count($dataTags) - 2) {
				$tags .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _tag . _sh . $tag["Slug"] .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a> '. __("and") .' ';
			} else {
				$tags .= '<a href="'. _webBase . _sh . _webLang . _sh . _blog . _sh . _tag . _sh . $tag["Slug"] .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a>, ';
			}
			
			$i++;
		}
	}		

	if($categories) {
		$in = __("in");
	} else {
		$in = NULL;
	}
	
	?>

	<div class="post">
		<div class="post-title">
			<a href="<?php print $URL; ?>" title="<?php print $post["Title"]; ?>">
				<?php print $post["Title"]; ?>
			</a>
		</div>
		
			<div class="post-left">
				<?php print __("Published") . " " . howLong($post["Start_Date"]) . " " . $in . " ". $categories ." " . __("by") . " " . $post["Author"]; ?>
				<br />
				<?php 
					if($tags) {
						print __("Tags") . ": " . $tags; 
					} 
				?>
			</div>
		
		<div class="post-right">
			<?php print getTotal($post["Comments"], "comment", "comments"); ?>
		</div>
		
		<div class="clear"></div>
		
		<div class="post-content">
			<?php print bbCode($post["Content"]); ?>
		</div>
	</div>	
	<?php
}
