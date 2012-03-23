<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>

<div id="home">
	<p class="resalt">
		<?php print __("Home"); ?>
	</p>
	
	<?php
		print $lastPosts;
		print $lastPages;
		print $lastLinks;
		print $lastUsers;		
	?>	
</div>
