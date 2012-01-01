<?php if(!defined("_access")) die("Error: You don't have permission to access here...");  ?>
		
<div id="menu-videos">
    <ul>
        <li><a id="a-v-block1" class="menu-block-active" href="javascript:showDiv('a-v-block1', 'v-block1', 'menu-videos', 'menu-videos')"><img src="<?php print _webURL; ?>/www/lib/images/icons/blog/tv.png" /> Canal 11</a></li>
        <li><a id="a-v-block2" class="menu-block-active" href="javascript:showDiv('a-v-block2', 'v-block2', 'menu-videos', 'menu-videos')"><img src="<?php print _webURL; ?>/www/lib/images/icons/blog/videos.png" /> Videos</a></li>
        <li><a id="a-v-block3" class="menu-block-active" href="javascript:showDiv('a-v-block3', 'v-block3', 'menu-videos', 'menu-videos')"><img src="<?php print _webURL; ?>/www/lib/images/icons/blog/radio.png" /> Radio</a></li>
        <li><a id="a-v-block4" class="menu-block-active" href="javascript:showDiv('a-v-block4', 'v-block4', 'menu-videos', 'menu-videos')"><img src="<?php print _webURL; ?>/www/lib/images/icons/blog/diputados.png" /> Congreso de Colima</a></li>
   </ul>
</div>

<div id="v-block1" class="videos menu-videos video-block">
	<object type="application/x-shockwave-flash" height="400" width="930" id="live_embed_player_flash" 
	data="http://es.justin.tv/widgets/live_embed_player.swf?channel=visiononce" bgcolor="#000000">
	<param name="allowFullScreen" value="true" />
	<param name="allowScriptAccess" value="always" />
	<param name="allowNetworking" value="all" />
	<param name="movie" value="http://es.justin.tv/widgets/live_embed_player.swf" />
	<param name="flashvars" value="hostname=es.justin.tv&channel=visiononce&auto_play=false&start_volume=25" />
	</object>
</div>

<div id="v-block2" class="videos menu-videos no-display">
	<a name="top"></a>
	<div id="video-block" class="videos">
		<div id="video-list">
			<?php 
				if(is_array($videos)) {
					foreach($videos as $video) {				
						if(strlen($video["Title"]) > 30) {
							$title = substr($video["Title"], 0 , 30) . "...";
						} else {
							$title = $video["Title"];
						}
						
						print '	
						<div class="video">
							<div class="img-video">
								<img style="width: 180px; height: 140px;" src="http://img.youtube.com/vi/'. $video["ID_YouTube"] .'/hqdefault.jpg" class="img-video no-border">
							</div>
							
							<div class="video-info">
								<a href="http://www.youtube.com/watch?v='. $video["ID_YouTube"] .'" rel="prettyPhoto" title="'. $title .'">
									<span class="video-title">'. $title .'</span>
								</a>
							</div>
						
						</div> &nbsp;'; 
					}	
				}
			?>			
			<div class="clear"></div>
			
			<p class="center">
				<a href="<?php print _webPath . "videos"; ?>" title="<?php print __("See more videos"); ?>"><?php print __("See more videos"); ?></a>
			</p>
		</div>
		
		<div class="clear"></div>
	</div>
		
	<div class="clear"></div>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$("a[rel^='prettyPhoto']").prettyPhoto();
		});
	</script>	
</div>

<div id="v-block3" class="videos no-display menu-videos">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="930" height="400" id="utv149500">
    	<param name="flashvars" value="autoplay=true&amp;brand=embed&amp;cid=4157412&amp;locale=en_US"/>
        <param name="allowfullscreen" value="true"/>
        <param name="allowscriptaccess" value="always"/>
        <param name="movie" value="http://www.ustream.tv/flash/live/1/4157412?v3=1"/>
        <embed flashvars="autoplay=false&amp;brand=embed&amp;cid=4157412&amp;locale=en_US" width="930" height="400" allowfullscreen="true" allowscriptaccess="always" id="utv149500" name="utv_n_5025" src="http://www.ustream.tv/flash/live/1/4157412?v3=1" type="application/x-shockwave-flash" />
	</object>
</div>

<div id="v-block4" class="videos menu-videos no-display">
	<object type="application/x-shockwave-flash" height="400" width="930" id="live_embed_player_flash" data="http://www.justin.tv/widgets/live_embed_player.swf?channel=congresocol" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" />
	<param name="allowNetworking" value="all" />
	<param name="movie" value="http://www.justin.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="channel=congresocol&auto_play=false&start_volume=25" />
	</object>
</div>

<div class="clear"></div>
