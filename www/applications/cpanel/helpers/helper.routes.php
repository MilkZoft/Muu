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
	$path  	= path(whichApplication());
	
	if(segments() > 0) {
		for($i = 0; $i <= segments() - 1; $i++) {
			if(!$flag) {
				if(segments() === 6) {
					$flag  = TRUE;
					
					$HTML  = a(__(_("Home")), PATH("cpanel"))																			. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(2)))), $path . segment(2)) 															. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(3)))), $path . segment(2) . _sh . segment(3)) 										. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(4)))), $path . segment(2) . _sh . segment(3) . _sh . segment(4))  					. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(5)))), $path . segment(2) . _sh . segment(3) . _sh . segment(4) . _sh . segment(5));	
				} elseif(segments() === 5) {
					$flag  = TRUE;
					
					$HTML  = a(__(_("Home"), path("cpanel")))																		    . $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(2)))), $path . segment(2)) 															. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(3)))), $path . segment(2) . _sh . segment(3)) 										. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(4)))), $path . segment(2) . _sh . segment(3) . _sh . segment(4));
				} elseif(segments() === 4) {
					$flag  = TRUE;				
					
					$HTML  = a(__(_("Home")), path("cpanel"))	 																		. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(1)))), $path . "cpanel")															. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(3)))), $path . segment(2) . _sh . segment(3));
				} elseif(segments() === 3) {
					$flag  = TRUE;						
					
					$HTML  = a(__(_("Home")), path("cpanel"))					 														. $rsaquo;
					$HTML .= a(__(_(ucfirst(segment(1)))), $path . segment(3));
				} elseif(segments() === 2) {
					$flag  = TRUE;
					
					$HTML  = a(__(_("Home")), path("cpanel"));
				} else {
					$HTML  = a(__(_("Home")), path("cpanel"));
				}
			}
		}
	}
	
	return $HTML;
}
