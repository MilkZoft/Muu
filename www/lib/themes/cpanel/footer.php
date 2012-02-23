			<div class="clear"></div>
			
			<br />
			
            <div id="footer">
            	<p>&copy; <?php print __(_("All rights reserved")); ?> - MuuCMS v.1.0 - 2012 - <?php print __(_("Powered by")); ?> <a href="http://www.milkzoft.com" title="MilkZoft">MilkZoft</a></p>
            </div>
        </div>
		
		<?php
			$this->js("upload");
			$this->js("www/lib/scripts/js/main.js");
			
			print $this->getJs();
		?>
    </body>
</html>
