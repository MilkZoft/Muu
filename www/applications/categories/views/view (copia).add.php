<?php 

if(!defined("_access")) die("Error: You don't have permission to access here..."); 
____($apps);
if(isset($data)) {		
	$ID  	     = recoverPOST("ID", 	     $data[0]["ID_Category"]);		
	$ID_Parente  = recoverPOST("ID_Partent", $data[0]["ID_Parent"]);
	$title       = recoverPOST("title",    $data[0]["Title"]);
	$language    = recoverPOST("language", $data[0]["Language"]);
	$state 	     = recoverPOST("state",    $data[0]["State"]);
	$edit        = TRUE;	
	$action		 = "edit";
	$href		 = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh . $ID . _sh;
} else {
	$ID          = 0;
	$ID_Parente  = recoverPOST("ID_Partent");
	$title       = recoverPOST("title");
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
				<?php print $categories ?>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Title"); ?><br />
				<input name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
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
						
						print '<input id="language" name="language" type="radio" value="English" tabindex="3" /> '. getLanguage("English", TRUE) .'';	
					}
						
					if(_French === TRUE) {
						if($language === "French") {
							$check = ' checked="checked"'; 
						} else {
							$check = NULL;
						}
						
						print '<input id="language" name="language" type="radio" value="French" tabindex="3" /> '. getLanguage("French", TRUE) .'';
					}
						
					if(_Portuguese === TRUE) {
						if($language === "Portuguese") {
							$check = TRUE; 
						} else {
							$check = FALSE;
						}
						
						print '<input id="language" name="language" type="radio" value="Portuguese" tabindex="3" /> '. getLanguage("Portuguese", TRUE) .'';
					}
				?>		
			</p>		
			
			<p class="field">
				&raquo; <?php print __("State"); ?><br />
				<select name="state" size="1" tabindex="5" class="select">
					<option value="Active" <?php print ($state === "Active")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Active"); ?>
					</option>
					<option value="Inactive" <?php print ($state === "Inactive")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Inactive"); ?>
					</option>
				</select>
			</p>
			
			<p class="save-cancel">
				<input name="<?php print $action; ?>" value="<?php print __(ucfirst($action)); ?>" type="submit" class="submit save" tabindex="9" onclick="document.getElementById('form-add').target=''; document.getElementById('form-add').action='<?php print $href; ?>';" />
				&nbsp;
				<input name="cancel" value="<?php print __("Cancel"); ?>" type="submit" class="submit cancel" tabindex="10" />
			</p>
			
			<input name="ID_Post" type="hidden" value="<?php print $ID; ?>" />
			<input name="ID_URL" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>
