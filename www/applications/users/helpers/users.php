<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function getOnlineUsers() {
	global $Load;
	
	$Db = $Load->core("Db");
	
	$date = time();
	$time = 10;
	$time = $date - $time * 60;
	$IP   = getIP();		
	$user = SESSION("ZanUser");
			
	$Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");
			
	$Db->deleteBySQL("Start_Date < $time", "users_online");

	if($user) {		
		$users = $Db->findBy("User", $user, "users_online");
		
		if(!$users) {		
			$Db->insert("users_online", array("User" => $user, "Start_Date" => $date));	
		} else {		
			$Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");	
		}		
	} else {
		$users = $Db->findBy("IP", $IP, "users_online_anonymous");
								
		if(!$users) {						
			$Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));
		} else {			
			$Db->updateBySQL("users_online", "Start_Date = '$date' WHERE IP = '$IP'");
		}	
	}
}