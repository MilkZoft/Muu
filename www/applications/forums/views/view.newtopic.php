<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php if(!isset($success)) { ?> 
	
	<div class="newTopic">
		<form id="formNewTopic" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
				<?php if($action === "save") { ?>
					<legend><?php print __("New Topic"); ?>
				<?php } else { ?>
					<legend><?php print __("Edit Topic"); ?>
				<?php } ?>
		
				<?php print isset($alert) ? $alert : NULL; ?>
				
				<p class="field">
					&raquo; <?php print __("Title"); ?><br />
					<input class="input" id="title" name="title" type="text" value="<?php print $title; ?>" tabindex="1" />
				</p>
						
				<p class="field">
					&raquo; <?php print __("Content"); ?><br />
					<textarea id="editor" name="content" tabindex="2" class="textarea"><?php print $content; ?></textarea>
				</p>
				
			<?php if(SESSION("ZanUserMethod") and SESSION("ZanUserMethod") === "twitter") { ?>
				<p class="checkTwitter">
					<input type="checkbox" value="Yes" name="tweet"  checked="checked"/>  <?php print __("Post in Twitter");?>
				</p>
			<?php } ?>
			
				<p class="field">
					<input class="input button"  id="<?php print $action;?>" name="doAction" value="<?php print __(ucfirst($action)) . " " . __("Topic");?>" type="submit" tabindex="3" />
					<input class="input button"  id="cancel" name="cancel" value="<?php print __("Cancel");?>" type="submit" tabindex="4" />
				</p>
				
				<input name="ID_Forum" type="hidden" value="<?php print $ID; ?>" />
				<input name="URL"      type="hidden" value="<?php print $hrefURL; ?>" />
				
				<?php if($action === "edit") { ?>
					<input name="ID_Post" type="hidden" value="<?php print $ID_Post; ?>" />
				<?php } ?>
				
		</form>
	</div>

<?php } else { ?>
	<div class="newTopic">
		<?php 
			if($action === "save") {
				if($success > 0) { 
					print showAlert("The new topic has been saved correctly", $href);
				} elseif($success === 0) {
					print showAlert("You need to wait 25 seconds to create a new topic", $hrefE);
				} else { 
					print showAlert("Ooops an unexpected problem has ocurred", "reload");
				}
			} else { 
				if($success > 0) { 
					print showAlert("The topic has been edited correctly", $href);
				} else { 
					print showAlert("Ooops an unexpected problem has ocurred", "reload");
				}
			}
		?>
	</div>

<?php } ?>

