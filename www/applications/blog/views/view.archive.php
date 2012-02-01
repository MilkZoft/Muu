<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); 		
	print $css;
	
	$firstYear  = (int) $date["year"];
	$firstMonth = (int) $date["month"];
	
	$lastYear   = (int) date("Y");
	$lastMonth  = (int) date("m");
?>

	<div id="blog-archive">
		<ul>
			<p class="center bold"><?php print __(_("Archive")); ?></p>
			<?php
				for($i = $lastYear; $i >= $firstYear; $i--) {
					if($i === $lastYear) {
						for($j = $lastMonth; $j >= $firstMonth; $j--) {
							if($j <= 9) {
								$m = "0$j";
							} else {
								$m = $j;
							}
							
							?>
								<li>
									&raquo; <a href="<?php print path("blog/$i/$m/"); ?>" title="<?php print month($m) . ' ' . $i; ?>"><?php print month($m) . ' ' . $i; ?></a>
								</li>
							<?php
						}										
					} else {
						for($j = 12; $j >= $firstMonth; $j--) {
							if($j <= 9) {
								$m = "0$j";
							} else {
								$m = $j;
							}							
							
							?>
								<li>
									&raquo; <a href="<?php print path("blog/$i/$m/"); ?>" title="<?php print month($m) . ' ' . $i; ?>"><?php print month($m) . ' ' . $i; ?></a>
								</li>
							<?php
						}
					}
				}
			?>
		</ul>
	</div>