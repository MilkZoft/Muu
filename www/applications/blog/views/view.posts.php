<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {		
	foreach($posts as $post) {			
		if(isset($post["post"])) {
			$dataTags 		= $post["tags"];
			$dataCategories = $post["categories"];
			$post 			= array_shift($post);
		}
			
		$URL 		= path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);	
		$categories = NULL;
		$tags		= NULL;
			
		$i = 0;
			
		if(isset($dataCategories) and is_array($dataCategories)) {
			foreach($dataCategories as $category) {
				if($i === count($dataCategories) - 1) {
					$categories .= a($category["Title"], path("blog/category/". $category["Slug"]), FALSE, array("title" => $category["Title"]));
				} elseif($i === count($dataCategories) - 2) {
					$categories .= a($category["Title"], path("blog/category/". $category["Slug"]), FALSE, array("title" => $category["Title"])) ." "; 
					$categories .= __(_("and")) ." ";
				} else {
					$categories .= a($category["Title"], path("blog/category/". $category["Slug"]), FALSE, array("title" => $category["Title"])) . ", ";
				}
				
				$i++;
			}
		}				
		
		$i = 0;
		
		if(isset($dataTags) and is_array($dataTags)) {								
			foreach($dataTags as $tag) {
				if($i === count($dataTags) - 1) {
					$tags .= a($tag["Title"], path("blog/tag/". $tag["Slug"]), FALSE, array("title" => $tag["Title"]));
				} elseif($i === count($dataTags) - 2) {
					$tags .= a($tag["Title"], path("blog/tag/". $tag["Slug"]), FALSE, array("title" => $tag["Title"])) . " ". __(_("and")) ." ";
				} else {
					$tags .= a($tag["Title"], path("blog/tag/". $tag["Slug"]), FALSE, array("title" => $tag["Title"])) . ", ";
				}
				
				$i++;
			}
		}		
	
		if($categories) {
			$in = __("in");
		} else {
			$in = NULL;
		}
		
		if(strlen($post["Pwd"]) === 40) { 
			$lock = img(_webURL . _sh . _lock, array("alt" => __("Private"), "class" => "no-border"));
		} else {
			$lock = NULL;
		}
		
		?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php print $URL; ?>" title="<?php print $post["Title"]; ?>">
					<?php print $lock . $post["Title"]; ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php print __(_("Published")) ." ". howLong($post["Start_Date"]) ." ". $in ." ". $categories ." ". __(_("by")) ." ". $post["Author"]; ?>
				<br />
				<?php 
					if($tags) {
						print __(_("Tags")) .": ". $tags; 
					} 
				?>
			</div>
			
			<div class="post-right">
				<?php 
					if($post["Enable_Comments"]) {
						print getTotal($post["Comments"], "comment", "comments"); 
					}
				?>
			</div>
			
			<div class="clear"></div>
			
			<div class="post-content">
				<?php print bbCode(pagebreak($post["Content"], $URL)); ?>
			</div>
		</div>	
		<div class="clear"></div>
		<?php
	}
}
	
if(isset($pagination)) {
	print $pagination;
}