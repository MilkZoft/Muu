<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Forum"]);
		$title       = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$language    = recoverPOST("language",    $data[0]["Language"]);
		$state 	     = recoverPOST("state",       $data[0]["State"]);
		$edit        = TRUE;
		$action		 = "edit";
		$href		 = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh . $ID . _sh;
	} else {
		$ID          = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$language    = recoverPOST("language");
		$state 	     = recoverPOST("state");
		$edit        = FALSE;
		$action		 = "save";
		$href		 = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh;
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Add Page"); ?></legend>
			
			<p class="resalt">
				<?php print __(ucfirst(segment(2))); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="field">
				&raquo; <?php print __("Title"); ?><br />
				<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
			</p>
					
			<p class="field">
				&raquo; <?php print __("Description"); ?><br />
				<textarea id="description" name="description" tabindex="2" class="textarea description"><?php print $description; ?></textarea>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Language"); ?> <br />
				<?php
					if(_Spanish === TRUE) {
						if($language === "Spanish") {
							$check = ' checked="checked"'; 
						} else {
							$check = NULL;
						}
				
						if($edit === FALSE) {
							$check = ' checked="checked"'; ;
						}
						
						print '<input id="language" name="language" type="radio" value="Spanish" tabindex="3"'. $check.' /> '. getLanguage("Spanish", TRUE) .'';
					}
					
					if(_English === TRUE) {
						if($language === "English") {
							$check = ' checked="checked"'; 
						} else {
							$check = NULL;
						}
						
						print '<input id="language" name="language" type="radio" value="English" tabindex="3"'. $check.' /> '. getLanguage("English", TRUE) .'';	
					}
						
					if(_French === TRUE) {
						if($language === "French") {
							$check = ' checked="checked"'; 
						} else {
							$check = NULL;
						}
						
						print '<input id="language" name="language" type="radio" value="French" tabindex="3"'. $check.' /> '. getLanguage("French", TRUE) .'';
					}
						
					if(_Portuguese === TRUE) {
						if($language === "Portuguese") {
							$check = TRUE; 
						} else {
							$check = FALSE;
						}
						
						print '<input id="language" name="language" type="radio" value="Portuguese" tabindex="3"'. $check.' /> '. getLanguage("Portuguese", TRUE) .'';
					}
				?>		
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
				<input id="<?php print $action; ?>" name="<?php print $action; ?>" value="<?php print __(ucfirst($action)); ?>" type="submit" class="submit save" tabindex="8" />
				<input id="cancel" name="cancel" value="<?php print __("Cancel"); ?>" type="submit" class="submit cancel" tabindex="8" />
			</p>
			
			<input name="ID_Forum" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>
