<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div id="feedback" class="grid_9">	
	<form method="post" action="#top" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __(_("Feedback")); ?></legend>
			
			<a name="top"></a>	
			
			<?php print isset($alert) ? $alert : NULL; ?>
			

			<p class="justify" id="info">
				<?php print _webContact; ?>
			</p>
			
			<div class="forms_feedback">
				<p class="field">&raquo; <?php print __(_("Name")); ?><br />
					<input name="name" type="text" class="required" value="<?php print recoverPOST("name"); ?>" tabindex="1" />
				</p>
				
				<p class="field">&raquo; <?php print __(_("E-Mail")); ?><br />
					<input name="email" type="text" class="required" value="<?php print recoverPOST("email"); ?>" tabindex="2" />
				</p>
			
				<p class="field">&raquo; <?php print __(_("Message")); ?><br />
					<textarea id="editor" name="message" class="required" tabindex="3">
						<?php print recoverPOST("message"); ?>
					</textarea>
				</p>
				
				<p>
					<input name="send" type="submit" value="<?php print __(_("Send")); ?>" tabindex="4" class="btn sucess" />
				</p>  
			</div>			
		</fieldset>
	</form>
</div>