<div class="form_login_twitter">
	<form class="form_login_twitter" action="<?php print _webBase . _sh . _webLang . _sh . "twitter" . _sh . "logout";?>" method="post">
		<input type="hidden" name="redirect" value="<?php print $redirect;?>" />
		<input name="login" type="submit" value="<?php print _("logout");?>" />
	</form>
</div>

