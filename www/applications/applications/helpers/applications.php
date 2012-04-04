<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}


function getApplicationsArray($applications = array()) {
	global $Load;
	
	$Applications_Model = $Load->Model("Applications_Model");

	if(is_array($applications) and !empty($applications)) {
		$i = 0;

		foreach($applications as $application) {
			if(is_numeric($application)) {
				$apps[$i]["option"] = __(_($Applications_Model->getApplication($application)));
				$apps[$i]["value"]  = $application;
			}
			
			$i++;
		}
	} elseif(is_array($applications) and empty($applications)) {
		$applications = $Applications_Model->getApplications();	
		
		$i = 0;
		if(is_array($applications)) {
			foreach($applications as $application) {
				$apps[$i]["option"] = __(_($application["Title"]));
				$apps[$i]["value"]  = $application["ID_Application"];
				$i++;
			}
		}
	} elseif(!is_array($applications)) {		
		if(is_numeric($applications)) {
			$apps[0]["option"] = __(_($Applications_Model->getApplication($applications)));
			$apps[0]["value"]  = $applications;
		}
	} else {
		return FALSE;
	}
	
	return $apps;	
}
