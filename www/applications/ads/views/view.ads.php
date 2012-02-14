<?php
$HTML = NULL;
$flag = FALSE;

if(is_array($data)) {
	foreach($data as $ad) {
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

		$position = strtolower($ad["Position"]);

		if($ad["Position"] === "Top") {
			$size = "960px;";
		}
	}
	
	print '	<div id="'. $position .'-ads" class="div-ads" style="width: '. $size .' margin: 0 auto;">
				'. $HTML . '
			</div>';
}
