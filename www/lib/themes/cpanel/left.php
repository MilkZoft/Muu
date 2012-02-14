<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
<div id="sidebar">
	<strong><?php print __(_("Applications")); ?></strong>
	
	<ul>
		<?php
			$li[] = '<strong><a href="'. path("cpanel") .'" title="'. __(_("Home")) .'">'. __(_("Home")) .'</a></strong>';
			
			print li($li);
			
			if(isset($applications)) {
				print li($applications);
			}
			
			$li[]["item"] = '<strong><a href="'. path("cpanel") .'/logout" title="'. __(_("Logout")) .'">'. __(_("Logout")) .'</a></strong>';
			
			print li($li);
		?>
	</ul>
</div>