<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Image"]);
		$title       = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$category 	 = recoverPOST("category",    $data[0]["Album"]);
		$ID_Category = recoverPOST("ID_Category", $data[0]["ID_Category"]);
		$medium      = recoverPOST("medium",      $data[0]["Medium"]);
		$state 	     = recoverPOST("state",       $data[0]["State"]);
		$edit        = TRUE;
		$action	     = "edit";
		$href	     = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh . $ID;
	} else {
	    $ID  	     = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$category 	 = recoverPOST("category");
		$ID_Category = recoverPOST("ID_Category");
		$medium 	 = recoverPOST("medium");
		$state 	     = recoverPOST("state");
		$action	     = "save";
		$href	     = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action;
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Add Image"); ?></legend>
			
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
				<textarea id="description" name="description" type="text" tabindex="2" class="input"><?php print $description;?></textarea>
			</p>
			
			<?php if($medium != NULL) { ?>
				<p class="field">
					<img src="<?php print _webURL . _sh . $medium;?>" title="<?php print $title; ?>" alt="<?php print $title; ?>"/>
				</p>
			<?php } ?>
			
			<?php if($action === "save") { ?>
			
				<p class="field">
					&raquo; <?php print __("Image"); ?><br />
					<input id="file" name="files[]" type="file" tabindex="4" class="addImg input required" />
					<span id="addImg">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</p>
				<div class="clear"></div>
			
			<?php } else { ?>
			
				<p class="field">
					&raquo; <?php print __("Image"); ?><br />
					<input id="file" name="file" type="file" tabindex="4" class="input required" />
				</p>
							
			<?php } ?>
			
			<p class="field">
				&raquo; <?php print __("Album") . " ("  . __("Write a album or select") . ")";?><br />
				<input id="category" name="category" type="text" value="" tabindex="4" class="input" />
			</p>
	
			<p class="field">
				<select id="ID_Category" name="ID_Category" size="1" tabindex="5" class="select">
					<option value="0"><?php print __("Select Album"); ?></option>
					<?php if(is_array($categories)) { ?>
						<?php foreach($categories as $cat) { ?>
							<?php if($ID_Category === $cat["ID_Category"]) { ?>
								<option value="<?php print $cat["ID_Category"]?>" selected="selected"><?php print $cat["Title"]; ?></option>
							<?php } else { ?>
								<option value="<?php print $cat["ID_Category"]?>"><?php print $cat["Title"]; ?></option>
							<?php } ?>
							
						<?php } ?>
					<? } ?>
					
				</select>
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
			
			<input name="ID_Image" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>
