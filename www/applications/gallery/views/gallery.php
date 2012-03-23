<?php if(!defined("_access"))) die("Error: You don't have permission to access here..."); ?>

<div class="full-container">
	<a name="top"></a>

	<p class="center">
		<a href="<?php print path("gallery")); ?>" title="<?php print __(_("Gallery")); ?>"><?php print __(_("Gallery")); ?></a>
	</p>
    
	<div class="total-pics">
		<span><?php print __(_(_("Images")))?>: <?php print $count;?></span>
	</div>
	
	<?php if(isset($album) and $album) { ?>
		<div class="h-link">
			<a id="previous" href="<?php print path("gallery/#top"));?>" title="<?php print __(_("Gallery")); ?>"><?php print __(_("Gallery")); ?></a>
		</div>
	<?php } ?>
	
	<?php if(isset($pagination)) { ?>
		<div class="paginate"><?php print $pagination;?></div>
	<?php } else { ?>
		<div class="paginate"></div>
	<?php } ?>
	
	<div class="clear"></div>
	
	<div id="gallery-content">
		<?php 
			$j = 0;
			$i = 0;

			foreach($pictures as $picture) { 
				if($i === 0) { ?>
					<div class="row">
		<?php 	} 
				
				if($i < 5)  { ?>
					<div class="gallery-img-cont">	
						<?php $link =  path("gallery/image/". $picture["ID_Image"] ."/#image")); ?>
						
						<a href="<?php print $link;?>" title="<?php print $picture["Title"];?>">
							<img id="<?php print $picture["Title"];?>" src="<?php print _webURL . _sh . $picture["Small"];?>" class="imgage-center" />
						</a>
					</div>
		<?php 	} 
				
				$i++;
				
				if($i === 5) { ?>
					</div><div class="clear"></div>
				<?php 
					$i = 0;
					$flag = TRUE;
				} else {
					$flag = FALSE;
				} ?>
				
		<?php } 
			if(!$flag) { ?>
			</div><div class="clear"></div>
	<?php 	} ?>
	</div>
</div>

<div class="clear"></div>

<br/><br/>