			

			<div id="pages" class="grid_9">
				<a name="top"></a>
				
				<p>
					<?php print $content; ?>
				</p>
				
				<?php
					if(isset($actions)) {
						?>
							<div class="actions"><?php print $actions; ?></div>
							<div class="clear"></div>
						<?php
					}
				?>
			</div>
