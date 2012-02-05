<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<p class="field">
	&raquo; <?php print __(_("Tags")); ?> <br />
		
	<input id="tags" name="tags" value="<?php print isset($tags) ? $tags : NULL; ?>" />
</p>