<div class="form_login_twitter">
	<form class="form_login_twitter" action="<?php print path("twitter/logout") ;?>" method="post">
		<input type="hidden" name="redirect" value="<?php print $redirect;?>" />
		<input name="login" type="submit" value="<?php print __(_("Logout"));?>" />
	</form>
</div>

