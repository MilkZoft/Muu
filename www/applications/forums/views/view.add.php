<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Forum"]);
		$title       = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$language    = recoverPOST("language",    $data[0]["Language"]);
		$state 	     = recoverPOST("state",       $data[0]["State"]);
		$edit        = TRUE;
		$action	     = "edit";
		$href        = path($this->application . _sh . "cpanel" . _sh . "edit" . _sh . $ID);		
	} else {
		$ID          = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$language    = recoverPOST("language");
		$state 	     = recoverPOST("state");
		$edit        = FALSE;
		$action	     = "save";
		$href	     = path($this->application . _sh . "cpanel" . _sh . "add" . _sh);
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __(_("Add Page")); ?></legend>
			
			<p class="resalt">
				<?php print __(_(ucfirst(whichApplication()))); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="field">
				&raquo; <?php print __(_("Title")); ?><br />
				<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="required" />
			</p>
					
			<p class="field">
				&raquo; <?php print __(_("Description")); ?><br />
				<textarea id="description" name="description" tabindex="2" class="textarea description"><?php print $description; ?></textarea>
			</p>
			
			<?php print formField(NULL, __(_("Languages")) ."<br />". getLanguageRadios($language)); ?>		
			
			<p class="field">
				&raquo; <?php print __(_("Situation")); ?><br />
				<select id="state" name="situation" size="1" tabindex="4" class="select">
					<option value="Active" <?php print ($situation === "Active")  ? 'selected="selected"' : NULL; ?>>
						<?php print __(_("Active")); ?>
					</option>
					<option value="Inactive" <?php print ($situation === "Inactive")  ? 'selected="selected"' : NULL; ?>>
						<?php print __(_("Inactive")); ?>
					</option>
				</select>
			</p>
						
			<p class="save-cancel">
				<input id="<?php print $action; ?>" name="<?php print $action; ?>" value="<?php print __(_(ucfirst($action))); ?>" type="submit" class="submit save" tabindex="8" />
				<input id="cancel" name="cancel" value="<?php print __(_("Cancel")); ?>" type="submit" class="submit cancel" tabindex="8" />
			</p>
			
			<input name="ID_Forum" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>