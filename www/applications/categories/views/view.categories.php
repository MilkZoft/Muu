<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<p class="field">
	<a onclick="showElement(document.getElementById('categories'));" title="<?php print __("Click to show or hide"); ?>" class="pointer">&raquo; <?php print __("Categories"); ?></a>
</p>

<div id="categories">
	<div id="div-categories" class="categories">
		<?php print $categories; ?>
	</div>
	
	<div class="add-categories">
		<p>
			<?php print __("New category"); ?> <br />
			<input id="category" name="category" type="text" class="small-input" style="width: 97%" /><br />			
			<?php
				if(_Spanish) {
					print '<input name="language_category" value="Spanish" type="radio" checked="checked"/> '. getLanguage("Spanish", TRUE);
				}
				
				if(_English) {
					print '<input name="language_category" value="English" type="radio" /> '. getLanguage("English", TRUE);
				}
				
				if(_French) {
					print '<input name="language_category" value="French" type="radio" /> '. getLanguage("French", TRUE);
				}
				
				if(_Portuguese) {
					print '<input name="language_category" value="Portuguese" type="radio" /> '. getLanguage("Portuguese", TRUE);
				}
			?>
		</p>
		
		<span class="bold small"><?php print __("Parent category"); ?>:</span>
		
		<div id="div-categories-radio" class="add-categories-wrapper">
			<?php print $categoriesRadio; ?>
		</div>		
		
		<input name="add-category" value="<?php print __("Add category"); ?>" type="button" onclick="setCategory();" class="add-category-submit" />		
		
		<input name="application" value="<?php print $application; ?>" id="application" type="hidden" />
	</div>	
</div>

<div class="clear"></div>

<?php print $this->js(_www . _sh . _lib . _sh . _scripts . _sh . "ajax" . _sh . "categories.js"); ?>
