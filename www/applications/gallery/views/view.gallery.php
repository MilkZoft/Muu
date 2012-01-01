<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="FullContainer">

	<a name="top"></a>
	<p class="Center"><a href="<?php print _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh;?>" title="<?php print __("Gallery");?>"><?php print __("Gallery");?></a></p>
    
	<div class="TotalPics">
		<span>Total de Fotos: <?php print $count;?></span>
	</div>
	
	<?php if(isset($album) and $album === TRUE) { ?>
		<div class="HLink">
			<a id="Previous" href="<?php print _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh . _top;?>" title="<?php print __("Gallery");?>"><?php print __("Gallery");?></a>
		</div>
	<?php } ?>
	
	<?php if(isset($pagination)) { ?>
		<div class="Paginate"><?php print $pagination;?></div>
	<?php } else { ?>
		<div class="Paginate"></div>
	<?php } ?>
	
	<div class="Clear"></div>
	
	<div id="GalleryContent">
		<?php 
			$j = 0;
			$i = 0;
			foreach($pictures as $picture) { 
				if($i === 0) { ?>
					<div class="Row">
				<?php } 
				if($i < 5)  { ?>
					<div class="GalleryImgCont">	
						<?php $link =  _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh . _image . _sh . $picture["ID_Image"] . _sh . "#Image"; ?>
						<a href="<?php print $link;?>" title="<?php print $picture["Title"];?>">
							<img id="<?php print $picture["Title"];?>" src="<?php print _webURL . _sh . $picture["Small"];?>" class="ImgCenter" />
						</a>
					</div>
				<?php } 
				$i++;
				
				if($i === 5) { ?>
					</div><div class="Clear"></div>
				<?php 
					$i = 0;
					$flag = TRUE;
				} else {
					$flag = FALSE;
				} ?>
				
		<?php } 
			if($flag === FALSE) { ?>
			</div><div class="Clear"></div>
		<?php } ?>
	</div>
</div>
<div class="Clear"></div>
<br/><br/>

