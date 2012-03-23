<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here..."));
}
?>

<form class="recover" action="<?php print _webBase; ?>/<?php print _webLang; ?>/users/recover" method="post">
	<fieldset>
		<legend><?php print __(_("Recover")); ?></legend>
		
		<?php
			if(isset($alert)) {
				print $alert;
			}

			if(isset($tokenID)) {
				?>
					<p class="center">
						<strong><?php print __(_("Change your Password")); ?></strong>
					</p>
															
					<p>
						<strong><?php print __(_("New Password")); ?>:</strong><br />
						<input id="password" class="password" name="password1" type="password" tabindex="1" />
					</p>	

					<p>
						<strong><?php print __(_("Confirm Password")); ?>:</strong><br />
						<input id="password" class="password" name="password2" type="password" tabindex="1" />
					</p>					
							
					<p>
						<input class="submit" name="change" type="submit" value="<?php print __(_("Change Password")); ?>" tabindex="2" />
					</p>
					
					<input name="tokenID" type="hidden" value="<?php print $tokenID; ?>" />
				<?php
			} else {
				?>
					<p class="center">
						<strong><?php print __(_("Recover Password")); ?></strong>
					</p>
					
					<p>
						<?php print __(_("To recover your password, please enter your username or your e-mail")); ?>
					</p>
					
					<p>
						<strong><?php print __(_("Username")); ?>:</strong><br />
						<input id="username" class="username" name="username" type="text" value="<?php print recoverPOST("username")); ?>" tabindex="1" />
					</p>	
							
					<p>
						<strong><?php print __(_("E-Mail")); ?>:</strong><br />
						<input id="email" class="email" name="email" type="text" value="<?php print recoverPOST("email")); ?>" tabindex="3" />
					</p>
					
					<p>
						<input class="submit" name="recover" type="submit" value="<?php print __(_("Recover")); ?>" tabindex="4" />
					</p>
				<?php
			}
		?>
	</fieldset>
</form>