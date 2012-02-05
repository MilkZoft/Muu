<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>


<div class="full-container">
	<div class="h-link">
		<a name="image" href="<?php print $picture["home"];?>/#top" title="<?php print __(_("Gallery")); ?>"><?php print __(_("Gallery")); ?></a>
	</div>

	<?php
		if($count > 1) { 
	?>
			<div class="np-links">
				<a id="previous" href="<?php print $picture["prev"];?>" title="<?print __(_("Previous")); ?>"><?php print __(_("Previous")); ?></a>
				<a id="next" href="<?php print $picture["next"];?>" title="<?print __(_("Next")); ?>"><?php print __(_("Next")); ?></a>
				<br />
			</div>
	<?php 
		} 
	?>
	
	<div class="clear"></div>
	
	<div id="gallery-content">
	<?php 
		if($count > 1) { 
	?>
			<a id="next" href="<?php print $picture["next"];?>">
				<img class="images-view" src="<?php print $picture["Original"];?>" alt="<?php print $picture["Title"];?>" />
			</a>
	<?php 
		} else { 
	?>
			<img class="images-view" src="<?php print $picture["Original"];?>" alt="<?php print $picture["Title"];?>" />
	<?php 
		} 
	?>
	</div>
	
	<div class="images-description">
		<span><?php print $picture["Description"];?></span>
	</div>
	
	<br/>
	
	<div class="info-images">
		<span class="images-title"><?php print __(_("Album")); ?>:</span><br />
		
		<div class="general-links">
		<?php 
			if($picture["Album"] !== "None") { 
		?>
				<a href="<?php print $picture["back"] . "/#top";?>" title="<?php print $picture["Album"];?>"><?php print $picture["Album"];?></a>
		<?php 	
			} else {
		?>
			<a href="<?php print $picture["home"] ."/";?>" title="<?php print __(_("None")); ?>"><?php print __(_("None")); ?></a>
		<?php 
			} 
		?>	
		</div>
	</div>
</div>

<br/><br/><br/>