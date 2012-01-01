<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Work"]);
		$title       = htmlentities(recoverPOST("title", $data[0]["Title"]));
		$description = recoverPOST("description", $data[0]["Description"]);
		$URL         = recoverPOST("URL",         $data[0]["URL"]);
		$image 	     = recoverPOST("image",       $data[0]["Image"]);
		$preview1 	 = recoverPOST("preview1",    $data[0]["Preview1"]);
		$preview2 	 = recoverPOST("preview2",    $data[0]["Preview2"]);
		$state 	     = recoverPOST("state",       $data[0]["State"]);
		$edit        = TRUE;
		$action	     = "edit";
		$href	     = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh . $ID;
	} else {
	    $ID  	     = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$URL         = recoverPOST("URL");
		$state 	     = recoverPOST("state");
		$image 	     = NULL;
		$preview1 	 = NULL;
		$preview2 	 = NULL;
		$action	     = "save";
		$href	     = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action;
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Add Work"); ?></legend>
			
			<p class="resalt">
				<?php print __(ucfirst(segment(2))); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="field">
				&raquo; <?php print __("Title"); ?><br />
				<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
			</p>
			
			<p class="field">
				&raquo; <?php print __("URL"); ?><br />
				<input name="URL" type="text" value="<?php print $URL; ?>" tabindex="4" class="input required" />
			</p>
		
			<p class="field">
				&raquo; <?php print __("Description"); ?><br />
				<textarea id="editor" name="description" tabindex="2" class="textarea"><?php print $description; ?></textarea>
			</p>
			
			<p class="field">
			
				&raquo; <?php print __("Image"); ?><br />
				<input id="file1" name="image" type="file" tabindex="4" class="input required" />
				 
				<?php if($image != NULL) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $image;?>">
						<?php print __("view image");?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Preview"); ?> 1<br />
				<input id="file2" name="preview1" type="file" tabindex="4" class="input required" />
				
				<?php if($preview1 != NULL) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $preview1;?>">
						<?php print __("view image");?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Preview"); ?> 2<br />
				<input id="file3" name="preview2" type="file" tabindex="4" class="input required" />
				<?php if($preview2 != NULL) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $preview2;?>">
						<?php print __("view image");?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __("State"); ?><br />
				<select id="state" name="state" size="1" tabindex="5" class="select">
					<option value="Active" <?php print ($state === "Active")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Active"); ?>
					</option>
					<option value="Inactive" <?php print ($state === "Inactive")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Inactive"); ?>
					</option>
				</select>
			</p>
			
			<p class="save-cancel">
				<input id="<?php print $action; ?>" name="<?php print $action; ?>" value="<?php print __(ucfirst($action)); ?>" type="submit" class="submit save" tabindex="6" />
				<input id="cancel" name="cancel" value="<?php print __("Cancel"); ?>" type="submit" class="submit cancel" tabindex="7" />
			</p>
			
			<input name="ID_Work" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>

<?php print $this->js("lib/scripts/js/droparea.js");?>
<?php print $this->js("droparea", segment(2));?>
<?php $this->CSS("style", segment(2), TRUE);?>
