<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<p class="field">
	&raquo; <?php print __("Tags"); ?> <br />	
	<input id="tags" name="tags" value="<?php if(isset($tags)) print $tags; ?>" />
</p>

<?php print $this->js(_lib . _sh . _scripts . _sh . "ajax" . _sh . "tags.js"); ?>
