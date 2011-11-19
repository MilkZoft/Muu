<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	  = recoverPOST("ID", 	    $data[0]["ID_Application"]);
		$title    = recoverPOST("title",    $data[0]["Title"]);
		$cpanel   = recoverPOST("cpanel",   $data[0]["CPanel"]);
		$adding   = recoverPOST("adding",   $data[0]["Adding"]);
		$defult   = recoverPOST("defult",   $data[0]["BeDefault"]);
		$category = recoverPOST("category", $data[0]["Category"]);
		$comments = recoverPOST("comments", $data[0]["Comments"]);
		$state 	  = recoverPOST("state",    $data[0]["State"]);
		$edit     = TRUE;
		$action	  = "edit";
		$href	  = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh . $ID . _sh;
	} else {
		
		$ID       = 0;
		$title    = recoverPOST("title");
		$cpanel   = recoverPOST("cpanel");
		$adding   = recoverPOST("adding");
		$defult   = recoverPOST("defult");
		$category = recoverPOST("category");
		$comments = recoverPOST("comments");
		$state 	  = recoverPOST("state");
		$edit     = FALSE;
		$action	  = "save";
		$href	  = _webBase . _sh . _webLang . _sh . _cpanel . _sh . segment(2) . _sh . _action . _sh . $action . _sh;
	}
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Add Application"); ?></legend>
			
			<p class="resalt">
				<?php print __(ucfirst(segment(2))); ?>
			</p>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="field">
				&raquo; <?php print __("Title"); ?><br />
				<input id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" class="input required" />
			</p>
			
			<p class="field">
				&raquo; <?php print __("CPanel"); ?><br />
				<select id="cpanel" name="cpanel" size="1" tabindex="5" class="select">
					<option value="Yes" <?php print ($cpanel === "Yes")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Yes"); ?>
					</option>
					<option value="No" <?php print ($cpanel === "No")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("No"); ?>
					</option>
				</select>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Adding"); ?><br />
				<select id="adding" name="adding" size="1" tabindex="5" class="select">
					<option value="Yes" <?php print ($adding === "Yes")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Yes"); ?>
					</option>
					<option value="No" <?php print ($adding === "No")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("No"); ?>
					</option>
				</select>
			</p>
			
			<p class="field">
				&raquo; <?php print __("BeDefault"); ?><br />
				<select id="defult" name="defult" size="1" tabindex="5" class="select">
					<option value="Yes" <?php print ($defult === "Yes")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Yes"); ?>
					</option>
					<option value="No" <?php print ($defult === "No")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("No"); ?>
					</option>
				</select>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Category"); ?><br />
				<select id="category" name="category" size="1" tabindex="5" class="select">
					<option value="Yes" <?php print ($category === "Yes")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Yes"); ?>
					</option>
					<option value="No" <?php print ($category === "No")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("No"); ?>
					</option>
				</select>
			</p>
			
			<p class="field">
				&raquo; <?php print __("Comments"); ?><br />
				<select id="comments" name="comments" size="1" tabindex="5" class="select">
					<option value="Yes" <?php print ($comments === "Yes")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("Yes"); ?>
					</option>
					<option value="No" <?php print ($comments === "No")  ? 'selected="selected"' : NULL; ?>>
						<?php print __("No"); ?>
					</option>
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
				<input id="cancel" name="cancel" value="<?php print __("Cancel"); ?>" type="submit" class="submit cancel" tabindex="6" />
			</p>
			
			<input name="ID_Application" type="hidden" value="<?php print $ID; ?>" />
		</fieldset>
	</form>
</div>
<?php print $this->js("js/add", segment(2));?>
