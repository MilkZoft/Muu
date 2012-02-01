<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<script type="text/javascript">
	$(function() {
		$('#slides').slides({
			preload: true,
			preloadImage: 'img/loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true
		});
	});
</script>

<div id="slides">
	<div class="slides_container">
	<?php
		if(is_array($mural)) {				
			foreach($mural as $post) {
	?>
				<div class="mural-image">
					<img src="<?php print _webURL . _sh . $post["Image"]; ?>" class="no-border">
				
					<div class="mural-info">
						<a href="<?php print $post["URL"]; ?>" title="<?php print $post["Title"]; ?>">
							<span class="mural-title"><?php print $post["Title"]; ?></span>
						</a>
					</div>					
				</div>
	<?php      			
			}
		}
	?>		
	</div>
	
	<a href="#" class="prev"><img src="<?php print _webURL; ?>/www/lib/images/slides/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
	<a href="#" class="next"><img src="<?php print _webURL; ?>/www/lib/images/slides/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
</div>
&nbsp;