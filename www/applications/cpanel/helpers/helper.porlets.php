<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function porlet($porlet, $content, $type = "list", $float = "left") {
	$skin = _webURL . _sh . _www . _sh . _lib . _sh . _themes . _sh . _cpanel;
	
	$HTML = '<div class="box">';
	
	if($float === "left") { 
		$HTML .= '<div class="float-left">'; 
	} else { 
		$HTML .= '<div class="float-right">';
	}
	
	$HTML .= '<div class="box-top">';
	$HTML .= '	<img src="' . $skin . '/images/box-border-top-left.gif" alt="corner left top" class="float-left" />'; 
	$HTML .= '	<img src="' . $skin . '/images/arrow-grey.gif" alt="Arrow" />';
	$HTML .= '		&nbsp; <span class="bold grey">' . $porlet . '</span>';
	$HTML .= ' 	<img src="' . $skin . '/images/box-border-top-right.gif" alt="corner left top" class="float-right" />';
	$HTML .= '</div>';
			
	$HTML .= '<div class="box-content">';
	$HTML .= '	<div class="box-content-close">';
	$HTML .= '		<div class="box-content-wrapper">';
		
	if($type === "list" and is_array($content)) {
		$HTML .= char("\t", 4) . openUl() . char("\n"); 
		
		foreach($content as $list) {
			$HTML .= char("\t", 5) . $list . char("\n");
		}
	
		$HTML .= char("\t", 4) . closeUl() . char("\n"); 
	} else { 
		$HTML .= char("\t", 4) . $content . char("\n"); 
	} 
		
	$HTML .= '		</div>';
	$HTML .= '	</div>';
	$HTML .= '</div>';
			
	$HTML .= '	<div class="box-bottom">'; 														
	$HTML .= '		<img src="' . $skin . '/images/box-border-bottom-left.gif" alt="corner left bottom" class="float-left" />';
	$HTML .= '		<img src="' . $skin . '/images/box-border-bottom-right.gif" alt="corner right bottom" class="float-right" />';
	$HTML .= '	</div>';
	$HTML .= '</div>';
	
	if($float === "right") { 
		$HTML .= '<div class="clear"></div>';
	}
	
	$HTML .= '</div>';
	
	return $HTML;
}