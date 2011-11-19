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
			
		$URL 		= _webBase . _sh . _webLang . _sh . _blog . _sh . $post["Year"] . _sh . $post["Month"] . _sh . $post["Day"] . _sh . $post["Slug"];	
		$categories = NULL;
		$tags		= NULL;
			
		$i = 0;
			
		if(isset($dataCategories) and is_array($dataCategories)) {
			foreach($dataCategories as $category) {
				if($i === count($dataCategories) - 1) {
					$categories .= a($category["Title"], _webPath . _blog . _sh . _category . _sh . $category["Slug"], FALSE, array("title" => $category["Title"]));
				} elseif($i === count($dataCategories) - 2) {
					$categories .= a($category["Title"], _webPath . _blog . _sh . _category . _sh . $category["Slug"], FALSE, array("title" => $category["Title"])) ." ". __("and") ." ";
				} else {
					$categories .= a($category["Title"], _webPath . _blog . _sh . _category . _sh . $category["Slug"], FALSE, array("title" => $category["Title"])) . ", ";
				}
				
				$i++;
			}
		}				
		
		$i = 0;
		
		if(isset($dataTags) and is_array($dataTags)) {								
			foreach($dataTags as $tag) {
				if($i === count($dataTags) - 1) {
					$tags .= a($tag["Title"], _webPath . _blog . _sh . _tag . _sh . $tag["Slug"], FALSE, array("title" => $tag["Title"]));
				} elseif($i === count($dataTags) - 2) {
					$tags .= a($tag["Title"], _webPath . _blog . _sh . _tag . _sh . $tag["Slug"], FALSE, array("title" => $tag["Title"])) . " ". __("and") ." ";
				} else {
					$tags .= a($tag["Title"], _webPath . _blog . _sh . _tag . _sh . $tag["Slug"], FALSE, array("title" => $tag["Title"])) . ", ";
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
			$lock = img(_webURL . _sh . _lock, __("Private"));
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
				<?php print __("Published") ." ". howLong($post["Start_Date"]) ." ". $in ." ". $categories ." ". __("by") ." ". $post["Author"]; ?>
				<br />
				<?php 
					if($tags) {
						print __("Tags") .": ". $tags; 
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