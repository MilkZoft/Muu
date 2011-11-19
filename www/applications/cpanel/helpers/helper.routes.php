<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function routePath() {
	$flag  	= FALSE;		
	$rsaquo = " &rsaquo;&rsaquo; ";
	$path  	= _webBase. _sh . _webLang . _sh . whichApplication() . _sh;
	
	if(segments() > 0) {
		for($i = 0; $i <= segments() - 1; $i++) {
			if($flag === FALSE) {
				if(segments() === 6) {
					$flag  = TRUE;
					
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel)															. $rsaquo;
					$HTML .= a(__(ucfirst(segment(2))), $path . segment(2)) 															. $rsaquo;
					$HTML .= a(__(ucfirst(segment(3))), $path . segment(2) . _sh . segment(3)) 										. $rsaquo;
					$HTML .= a(__(ucfirst(segment(4))), $path . segment(2) . _sh . segment(3) . _sh . segment(4))  					. $rsaquo;
					$HTML .= a(__(ucfirst(segment(5))), $path . segment(2) . _sh . segment(3) . _sh . segment(4) . _sh . segment(5));	
				} elseif(segments() === 5) {
					$flag  = TRUE;
					
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel)															. $rsaquo;
					$HTML .= a(__(ucfirst(segment(2))), $path . segment(2)) 															. $rsaquo;
					$HTML .= a(__(ucfirst(segment(3))), $path . segment(2) . _sh . segment(3)) 										. $rsaquo;
					$HTML .= a(__(ucfirst(segment(4))), $path . segment(2) . _sh . segment(3) . _sh . segment(4));
				} elseif(segments() === 4) {
					$flag  = TRUE;				
					
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel) 														. $rsaquo;
					$HTML .= a(__(ucfirst(segment(1))), $path . _cpanel) 															. $rsaquo;
					$HTML .= a(__(ucfirst(segment(3))), $path . segment(2) . _sh . segment(3));
				} elseif(segments() === 3) {
					$flag  = TRUE;						
					
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel) 														. $rsaquo;
					$HTML .= a(__(ucfirst(segment(1))), $path . segment(3));
				} elseif(segments() === 2) {
					$flag  = TRUE;
					
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel);
				} else {
					$HTML  = a(__("Home"), _webBase. _sh . _webLang . _sh . _cpanel);
				}
			}
		}
	}
	
	return $HTML;
}
