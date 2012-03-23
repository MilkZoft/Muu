<?php if(!defined("_access")) die("Error: You don't have permission to access here...")); ?>

<div class="wrapper">

<?php 
	if(!isset($success)) { 
?>
		<div class="login">
			<form class="form-login" action="<?php print $href;?>" method="post">
				<fieldset>
					<legend><?php print __(_("Login")); ?></legend>
				
					<?php
						if(isset($alert)) {
							print $alert;
						}
					?>
				
					<p class="center">
						<?php print __(_("Authentification")); ?>
					</p>
				
					<p>
						<strong><?php print __(_("Username")); ?>:</strong><br />
						
						<input id="username" class="username" name="username" type="text" tabindex="1" />
					</p>	
				
					<p>
						<strong><?php print __(_("Password")); ?>:</strong><br />
					
						<input id="password" class="password" name="password" type="password" tabindex="2" />
					</p>	
				
					<p>
						<input id="connect" class="submit" name="connect" type="submit" value="<?php print __(_("Connect")); ?>" tabindex="3" />
					</p>

					<p>
					<?php 
						if(!isset($noRegister)) { 
					?>
							<a tabindex="4" href="<?php print path("users/recover/"); ?>" title="<?php print __(_("Lost your password?")); ?>">
								<?php print __(_("Lost your password?")); ?>
							</a>
						
							<a tabindex="5" href="<?php print path("users/register"); ?>" title="<?php print __(_("Register")); ?>">
								<?php print __(_("Register")); ?>
							</a>
					<?php 
						} else { 
					?>
							<a tabindex="4" href="<?php print path("users/recover/forums"); ?>" title="<?php print __(_("Lost your password?")); ?>">
								<?php print __(_("Lost your password?")); ?>
							</a>
					<?php 
						} 
					?>
				</p>
			</fieldset>
		</form>
	</div>
	
<?php } else { ?>
	<div class="lightLogin">
		<p class="alert good">
			<?php print __(_("You have been authentified correctly!"));?>
		</p>
		
		<p class="additional">
			<?php print __(_("Click on the close button below, or out of the box, to enjoy the forums!"));?>
		</p>
	</div>
<? } ?>
</div>
