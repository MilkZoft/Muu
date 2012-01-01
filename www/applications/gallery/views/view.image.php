<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>


<div class="FullContainer">
	<div class="HLink">
		<a name="Image" href="<?php print $picture["home"] . _top;?>" title="<?=__("Gallery");?>"><?php print __("Gallery");?></a>
	</div>
	<?if($count > 1) { ?>
	<div class="NPLinks">
		<a id="Previous" href="<?php print $picture["prev"];?>" title="<?print __("Previous");?>"><?php print __("Previous");?></a>
		<a id="Next"     href="<?php print $picture["next"];?>" title="<?print __("Next");?>"><?php print __("Next");?></a>
		<br />
	</div>
	<? } ?>
	<div class="Clear"></div>
	
	<div id="GalleryContent">
		<? if($count > 1) { ?>
			<a id="Next" href="<?php print $picture["next"];?>">
				<img class="ImgView" src="<?php print $picture["Original"];?>" alt="<?php print $picture["Title"];?>" />
			</a>
		<? } else { ?>
			<img class="ImgView" src="<?php print $picture["Original"];?>" alt="<?php print $picture["Title"];?>" />
		<? } ?>
	</div>
	
	<div class="ImgDescription">
		<span><?php print $picture["Description"];?></span>
	</div>
	<br/>
	<div class="InfoImg">
		<span class="ImgTitle"><?php print __("Album");?>:</span><br />
		<div class="GeneralLinks">
		<? if($picture["Album"] !== "None") { ?>
			<a href="<?php print $picture["back"] . _sh . _top;?>" title="<?php print $picture["Album"];?>"><?php print $picture["Album"];?></a>
		<? } else { ?>
			<a href="<?php print $picture["home"] . _top;?>" title="<?php print __("None");?>"><?php print __("None");?></a>
		<? } ?>	
		</div>
	</div>
	
</div>

<br/>
<br/>
<br/>
