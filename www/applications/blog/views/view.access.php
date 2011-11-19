<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div id="blog-access">
	<form class="blog-access" action="" method="post">
		<fieldset>
			<legend><?php print __("Private post"); ?></legend>
			
			<p>
				<strong><?php print __("Post password"); ?></strong><br />
				<input name="password" type="password" class="input" />				
			</p>
			
			<p>
				<input name="access" type="submit" value="<?php print __("Access"); ?>" class="submit" />
			</p>
			
			<input name="pwd" type="hidden" value="<?php print $password; ?>" />
		</fieldset>
	</form>
</div>
