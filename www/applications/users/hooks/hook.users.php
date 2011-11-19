<?php
/*
function hookUsersOnline() {
	global $Load;
	
	$Db = $Load->core("Db");
	
	$date = time();
	$time = 10;
	$time = $date - $time * 60;
	$IP   = getIP();		
	$user = SESSION("ZanUser");
			
	$Db->table("users_online_anonymous", "IP, Start_Date");
	$Db->deleteBySQL("Start_Date < $time");
			
	$Db->table("users_online", "User, Date");
	$Db->deleteBySQL("Start_Date < $time");

	if($user !== "") {		
		$Db->table("users_online", "User, Start_Date");
		
		$users = $Db->findBy("User", $user);
		
		if(!$users) {			
			$Db->values("'$user', '$date'");
			$Db->save();						
		} else {			
			$Db->values("Start_Date = '$date' WHERE User = '$user'");
			$Db->save("update");						
		}		
	} else {
		$Db->table("users_online_anonymous", "IP, Start_Date");
		
		$users = $Db->findBy("IP", $IP);
								
		if(!$users) {						
			$Db->values("'$IP', '$date'");
			$Db->save();						
		} else {			
			$Db->values("Start_Date = '$date' WHERE IP = '$IP'");
			$Db->save("update");		
		}	
	}
}*/
