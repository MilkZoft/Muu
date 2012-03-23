<?php
$HTML = NULL;
$flag = FALSE;

if(is_array($data)) { 
	foreach($data as $ad) {
		if((int) count($data) === 1) { 
			$HTML = a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"]));
		} else {
			if((int) $ad["Principal"] === 1) {
				if(!$flag) {
					$flag = TRUE;
					
					$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array(
																						"title" => $ad["Title"], 
																						"class" => "ads principal", 
																						"style" => "text-align: center;"));
				} else {
					$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"], "class" => "ads"));
				}
			} else {
				$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"], "class" => "ads"));
			}
		}

		$position = strtolower($ad["Position"]);
	}
	
	print '	<div id="'. $position .'-ads" class="div-ads">
				'. $HTML . '
			</div>';
}
