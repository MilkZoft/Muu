<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<form class="login" action="<?php print _webBase; ?>/<?php print _webLang; ?>/cpanel/login/" method="post">
	<fieldset>
		<legend><?php print __("Login"); ?></legend>
		
		<?php
			if(isset($error) and $error === TRUE) {
				print showError(__("Incorrect Login"));
			}
		?>
		
		<p class="center">
			<?php print __("Authentification"); ?>
		</p>
		
		<p>
			<strong><?php print __("Username"); ?>:</strong><br />
			<input id="username" class="username" name="username" type="text" tabindex="1" />
		</p>	
		
		<p>
			<strong><?php print __("Password"); ?>:</strong><br />
			<input id="password" class="password" name="password" type="password" tabindex="2" />
		</p>	
		
		<p>
			<input id="connect" class="submit" name="connect" type="submit" value="<?php print __("Connect"); ?>" tabindex="3" />
		</p>
		
		<input name="URL" type="hidden" value="<?php print $URL; ?>" />
	</fieldset>
</form>

<div class="login">
	<?php $this->view("twitter", "twitter", array("redirect" => _webBase . _sh . _webLang . _sh . "cpanel")); ?>
</div>

