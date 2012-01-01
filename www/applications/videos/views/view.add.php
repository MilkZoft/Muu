<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Video"]);
		$URL         = recoverPOST("URL",         $data[0]["URL"]);
		$ID_YouTube  = recoverPOST("ID_YouTube",  $data[0]["ID_YouTube"]);
		$title 	     = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$situation 	 = recoverPOST("situation",   $data[0]["Situation"]);
		$edit        = TRUE;
		$action		 = "edit";
	} else {
		$ID          = 0;
		$URL         = recoverPOST("URL");
		$situation 	 = recoverPOST("situation");
		$edit        = FALSE;
		$action		 = "save";
	}
	
	$selected = 'selected="selected"';
	
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Add Video"); ?></legend>
			
			<p class="resalt">
				<?php print __(ucfirst(whichApplication())); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<?php if($action == "save") { ?>
				<p class="field">
					&raquo; <?php print __("URL"); ?>  <?php print "(http://www.youtube.com/watch?v=N_1KfUDB1zU)"; ?><br />
					<input id="URL" name="URL" type="text" value="<?php print $URL; ?>" tabindex="1" class="input required" />
				</p>
				
				<div id="seek">
					<p class="field">
						&raquo; <?php print __("Search"); ?> (<?php print __("YouTube");?>)<br />
						<input name="search" type="text" tabindex="1" class="input required" />
						<input id="hsearch" name="hsearch" type="hidden" />
						
						<p>
							<input type="button" name="inputsearch" id="inputsearch" class="small-submit" value="<?php print __("Search");?>" />
						</p>
					</p>
				</div>
			
				<div id="videos">
					<?php if($videos) { ?>
						<?php foreach($videos["videos"] as $video) { ?>
							<div class="video">
							
								<p class="titleVideo">
									<input type="checkbox" name="videos[]" value="<?php print $video["id"];?>" />
									<a href="#" title="<?php print $video["title"];?>">
										<?php print $video["cut"];?>
									</a>
								</p>
								
								<iframe width="195" height="200" src="http://www.youtube.com/embed/<?php print $video["id"];?>" frameborder="0" allowfullscreen></iframe>
								
							</div>
						<?php } ?>
					<?php } else { ?>
						<p class="noresults">
							<?php print __("There were no results for this search");?>
						</p>
					<?php } ?>
				</div>
				
				<div class="clear"></div>
				
				
					<div class="controls">
						<input type="hidden" name="next" value="<?php print $videos["next"]?>" />
						<?php if($videos["next"]) { ?>
							<input type="button" name="nextresults" id="nextresults" value="<?php print __("Next results");?>" class="small-submit"/>
						<?php } else { ?>
							<input type="button" name="nextresults" id="nextresults" value="<?php print __("Next results");?>" class="no-display small-submit"/>
						<?php } ?>
						<img class="loadgif" src="<?php print $this->themePath; ?>/images/icons/load.gif" alt="loadgif" title="load" />
					</div>
				
				
				<div class="clear"></div>
				
			<?php } else { ?>
				<p class="field">
					&raquo; <?php print __("Title"); ?> <br />
					<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
				</p>
				
				<p class="field">
					&raquo; <?php print __("Description"); ?> <br />
					<textarea id="description" name="description" class="input required"><?php print $description; ?></textarea>
				</p>
				
				<input name="ID" type="hidden" value="<?php print $ID; ?>" />
				
				<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php print $ID_YouTube;?>" frameborder="0" allowfullscreen></iframe>
			<?php } ?>
			
			<p class="field">
				&raquo; <?php print __("State"); ?><br />
				<select id="situation" name="situation" size="1" tabindex="5" class="select">
					<option value="Active" <?php print ($situation === "Active") ? $selected : NULL; ?>>
						<?php print __("Active"); ?>
					</option>
					
					<option value="Inactive" <?php print ($situation === "Inactive") ? $selected : NULL; ?>>
						<?php print __("Inactive"); ?>
					</option>
				</select>
			</p>
			
			<p class="save-cancel">
				<input id="<?php print $action; ?>" name="<?php print $action; ?>" value="<?php print __(ucfirst($action)); ?>" type="submit" class="submit save" tabindex="6" />
				<input id="cancel" name="cancel" value="<?php print __("Cancel"); ?>" type="submit" class="submit cancel" tabindex="6" />
			</p>
		</fieldset>
	</form>
</div>

<?php print $this->js("ajax/search", segment(2));?>
