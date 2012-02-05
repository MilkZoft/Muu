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
		$situation 	 = recoverPOST("state",       $data[0]["Situation"]);
		$edit        = TRUE;
		$action	     = "edit";
		$href	     = path($this->application . _sh . "cpanel" . _sh . "edit" . _sh . $ID);
	} else {
	    $ID  	     = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$URL         = recoverPOST("URL");
		$situation   = recoverPOST("situation");
		$image 	     = NULL;
		$preview1 	 = NULL;
		$preview2 	 = NULL;
		$action	     = "save";
		$href	     = path($this->application . _sh . "cpanel" . _sh . "add" . _sh);
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __(_("Add Work")); ?></legend>
			
			<p class="resalt">
				<?php print __(_(ucfirst(whichApplication()))); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="field">
				&raquo; <?php print __(_("Title")); ?><br />
				<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
			</p>
			
			<p class="field">
				&raquo; <?php print __(_("URL")); ?><br />
				<input name="URL" type="text" value="<?php print $URL; ?>" tabindex="4" class="input required" />
			</p>
		
			<p class="field">
				&raquo; <?php print __(_("Description")); ?><br />
				<textarea id="editor" name="description" tabindex="2" class="textarea"><?php print $description; ?></textarea>
			</p>
			
			<p class="field">
			
				&raquo; <?php print __(_("Image")); ?><br />
				<input id="file1" name="image" type="file" tabindex="4" class="input required" />
				 
				<?php if($image) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $image;?>">
						<?php print __(_("Preview")); ?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __(_("Preview")); ?> 1<br />
				<input id="file2" name="preview1" type="file" tabindex="4" class="input required" />
				
				<?php if($preview1) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $preview1;?>">
						<?php print __(_("Preview")) ;?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __(_("Preview")); ?> 2<br />
				<input id="file3" name="preview2" type="file" tabindex="4" class="input required" />
				<?php if($preview2) { ?>
					<a class="work-lightbox" title="<?php print $title; ?>" href="<?php print _webURL . _sh . $preview2;?>">
						<?php print __(_("Preview"));?>
					</a>
				<?php } ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __(_("Situation")); ?><br />
				<select id="situation" name="situation" size="1" tabindex="5" class="select">
					<option value="Active" <?php print ($situation === "Active")  ? 'selected="selected"' : NULL; ?>>
						<?php print __(_("Active")); ?>
					</option>
					<option value="Inactive" <?php print ($situation === "Inactive")  ? 'selected="selected"' : NULL; ?>>
						<?php print __(_("Inactive")); ?>
					</option>
				</select>
			</p>
			
			<p class="save-cancel">
				<input id="<?php print $action; ?>" name="<?php print $action; ?>" value="<?php print __(_(ucfirst($action))); ?>" type="submit" class="submit save" tabindex="6" />
				<input id="cancel" name="cancel" value="<?php print __(_("Cancel")); ?>" type="submit" class="submit cancel" tabindex="7" />
			</p>
			
			<input name="ID_Work" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>

<?php 
	print $this->js("lib/scripts/js/droparea.js");
	print $this->js("droparea", "works");
	
	$this->CSS("style", segment(2), TRUE);