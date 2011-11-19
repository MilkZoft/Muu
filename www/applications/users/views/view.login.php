<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="wrapper">
<?php if(!isset($success)) { ?>
	<div class="login">
		<form class="form-login" action="<?php print $href;?>" method="post">
			<fieldset>
				<legend><?php print __("Login"); ?></legend>
				
				<?php
					if(isset($alert)) {
						print $alert;
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

				<p>
					
					<?php if(!isset($noregister)) { ?>
						<a tabindex="4" href="<?php print _webBase . _sh . _webLang; ?>/users/recover/" title="<?php print __("Lost your password?"); ?>"><?php print __("Lost your password?"); ?></a>
						<a tabindex="5" href="<?php print _webBase . _sh . _webLang; ?>/users/register" title="<?php print __("Register"); ?>"><?php print __("Register"); ?></a>
					<?php } else { ?>
						<a tabindex="4" href="<?php print _webBase . _sh . _webLang; ?>/users/recover/forums" title="<?php print __("Lost your password?"); ?>"><?php print __("Lost your password?"); ?></a>
					<?php } ?>
				</p>
			</fieldset>
		</form>
	</div>
	
<?php } else { ?>
	<div class="lightLogin">
		<p class="alert good">
			<?php print __("You have been authentified correctly!");?>
		</p>
		<p class="additional">
			<?php print __("Click on the close button below, or out of the box, to enjoy the forums!");?>
		</p>
	</div>
<? } ?>
</div>
