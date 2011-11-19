<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
<div id="sidebar">
	<strong><?php print __("Applications"); ?></strong>
	
	<ul>
		<?php
			$li[] = '<strong><a href="' . _webBase . _sh . _webLang . _sh . _cpanel . '" title="' . __("Home") . '">' . __("Home") . '</a></strong>';
			
			print li($li);
			
			if(isset($applications)) {
				print li($applications);
			}
			
			$li[]["item"] = '<strong><a href="' . _webBase . _sh . _webLang . _sh . _cpanel .'/logout" title="' . __("Logout") . '">' . __("Logout") . '</a></strong>';
			
			print li($li);
		?>
	</ul>
</div>
