<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function porlet($porlet, $content) {
	$skin = _webURL . "/www/lib/themes/cpanel";
	
	$HTML  = '	<div class="box">
					&nbsp; <span class="bold grey">'. $porlet .'</span> <span class="float-right bold small grey">X</span>';

				if($type === "list" and is_array($content)) {
					$HTML .= char("\t", 4) . openUl() . char("\n"); 
					
					foreach($content as $list) {
						$HTML .= char("\t", 5) . $list . char("\n");
					}
				
					$HTML .= char("\t", 4) . closeUl() . char("\n"); 
				} else { 
					$HTML .= char("\t", 4) . $content . char("\n"); 
				} 

	$HTML .= '</div><br />';
	
	return $HTML;
}