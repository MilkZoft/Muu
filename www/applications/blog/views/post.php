<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } 

if(is_array($post)) {				
	$URL 		= path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);		
	$categories = NULL;
	$tags		= NULL;
	
	$i = 0;
	
	if(isset($dataCategories) and is_array($dataCategories)) {
		foreach($dataCategories as $category) {
			if($i === count($dataCategories) - 1) {
				$categories .= '<a href="'. path("blog/category/". $category["Slug"]) .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a>';
			} elseif($i === count($dataCategories) - 2) {
				$categories .= '<a href="'. path("blog/category/". $category["Slug"]) .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a> '; 
				$categories .= __(_("and")) .' ';
			} else {
				$categories .= '<a href="'. path("blog/category/". $category["Slug"]) .'" title="'. $category["Title"] .'">'. $category["Title"] .'</a>, ';
			}
			
			$i++;
		}
	}				
	
	$i = 0;
	
	if(isset($dataTags) and is_array($dataTags)) {								
		foreach($dataTags as $tag) {
			if($i === count($dataTags) - 1) {
				$tags .= '<a href="'. path("blog/tag/". $tag["Slug"]) .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a>';
			} elseif($i === count($dataTags) - 2) {
				$tags .= '<a href="'. path("blog/tag/". $tag["Slug"]) .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a> '. __(_("and")) .' ';
			} else {
				$tags .= '<a href="'. path("blog/tag/". $tag["Slug"]) .'" title="'. $tag["Title"] .'">'. $tag["Title"] .'</a>, ';
			}
			
			$i++;
		}
	}		

	if($categories) {
		$in = __(_("in"));
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
			<?php print __(_("Published")) . " " . howLong($post["Start_Date"]) . " " . $in . " ". $categories ." " . __(_("by")) . " " . $post["Author"]; ?>
			<br />
			<?php 
				if($tags) {
					print __(_("Tags")) . ": " . $tags; 
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