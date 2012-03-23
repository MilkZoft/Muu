<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<p class="field">
	<a onclick="showElement(document.getElementById('categories'));" title="<?php print __(_("Click to show or hide")); ?>" class="pointer">
		&raquo; <?php print __(_("Categories")); ?>
	</a>
</p>

<div id="categories">
	<div id="div-categories" class="categories">
		<?php print $categories; ?>
	</div>
	
	<div class="add-categories">
		<p>
			<span style="font-size: 0.8em;"><?php print __(_("New category")); ?></span> <br />
			
			<input id="category" name="category" type="text" class="required" style="width: 95%" /><br />			
			
			<?php print getLanguagesInput(whichLanguage(), "language_category", "select"); ?>
		</p>
		
		<span class="bold"><?php print __(_("Parent category")); ?>:</span>
		
		<div id="div-categories-radio" class="add-categories-wrapper">
			<?php print $categoriesRadio; ?>
		</div>		
		
		<input name="add-category" value="<?php print __(_("Add category")); ?>" type="button" onclick="setCategory();" class="add-category-submit btn btn-info" />		
		
		<input name="application" value="<?php print $application; ?>" id="application" type="hidden" />
	</div>	
</div>

<div class="clear"></div>

<?php print $this->js("www/lib/scripts/ajax/categories.js"); ?>
