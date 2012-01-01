<?php
$HTML = NULL;
$flag = FALSE;

if(is_array($data)) {
	foreach($data as $ad) {
		if((int) $ad["Principal"] === 1) {
			if(!$flag) {
				$flag = TRUE;
				
				$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"], "class" => "ads principal"));
			} else {
				$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"], "class" => "ads"));
			}
		} else {
			$HTML .= a(img(_webURL . _sh . $ad["Banner"]), $ad["URL"], TRUE, array("title" => $ad["Title"], "class" => "ads"));
		}
	}
	
	print $HTML;
}
