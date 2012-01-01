<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php if($albums) { ?>
	<p class="Center"><?php print __("Albums");?></p>
	<ul id="Albums" class="jcarousel-skin-tango">
		<?php foreach($albums as $album) { ?>
				<?php $link = _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh . "album" . _sh . $album["Album_Nice"] . _sh . _top; ?>
				<li>
					<a href="<?php print $link;?>" title="<?php print $album["Title"];?>">
						<span class="albumLinks"><?php print $album["Album"];?></span><br />
						<img src="<?php print _webURL . _sh . $album["Small"];?>">
					</a>				
				</li>
		<?php } ?>
	</ul>

	<br/>
	<br/>

<?php } else { ?>

<?php } ?>
