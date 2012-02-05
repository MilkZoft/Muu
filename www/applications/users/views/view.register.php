<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here..."));
}
?>

<?php if(!isset($success)) { ?>

	<form class="register" action="<?php print $href;?>" method="post">
		<fieldset>
			<legend><?php print __(_("Register")); ?></legend>
			
			<?php
				if(isset($alert)) {
					print $alert;
				}
			?>
			
			<p class="center">
				<?php print __(_("Register")); ?>
			</p>
			
			<p>
				<strong><?php print __(_("Username")); ?>:</strong><br />
				<input id="username" class="username" name="username" type="text" value="<?php print recoverPOST("username")); ?>" tabindex="1" />
			</p>	
			
			<p>
				<strong><?php print __(_("Password")); ?>:</strong><br />
				<input id="password" class="password" name="password" type="password" value="<?php print recoverPOST("password")); ?>" tabindex="2" />
			</p>
			
			<p>
				<strong><?php print __(_("E-Mail")); ?>:</strong><br />
				<input id="email" class="email" name="email" type="text" value="<?php print recoverPOST("email")); ?>" tabindex="3" />
			</p>
			
			<p>
				<input class="submit" name="register" type="submit" value="<?php print __(_("Register")); ?>" tabindex="4" />
			</p>
		</fieldset>
	</form>

<?php } else { ?>
	<div class="lightRegister">
		<p class="alert good">
			<?php print $alert["message"] . "!";?>
		</p>
		<p class="additional">
			<?php print __(_("Click on the close button below, or out of the box, to return to the forums")) . "!";?>
		</p>
	</div>
<?php } ?>
