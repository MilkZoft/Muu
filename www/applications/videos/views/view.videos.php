<?php if(!defined("_access")) die("Error: You don't have permission to access here...");  ?>
		
<a name="top"></a>
<div id="video-block" class="videos">
	<div id="video-list">
		<?php 
			foreach($videos as $video) {				
				if(strlen($video["Title"]) > 30) {
					$title = encode(substr($video["Title"],0 , 30) . "...");
				} else {
					$title = encode($video["Title"]);
				}
				
				print '	
				<div class="video">
					<div class="img-video">
						<img width="180" height="140" src="http://img.youtube.com/vi/'. $video["ID_YouTube"] .'/hqdefault.jpg" class="img-video no-border">
					</div>
					
					<div class="video-info">
						<a href="http://www.youtube.com/watch?v='. $video["ID_YouTube"] .'" rel="prettyPhoto" title="'. $title .'">
							<span class="video-title">'. $title .'</span>
						</a>
					</div>				
				</div>'; 
			}	
		?>
		<div class="clear"></div>
	</div>
	
	<div class="clear"></div>
	
	<br /><br />
	<?php print $pagination; ?>	
</div>
	
<div class="clear"></div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
</script>	
