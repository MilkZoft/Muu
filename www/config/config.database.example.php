<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

/**
 * Database configuration:
 */
$production = FALSE;

if($production) {
	//Database Settings
	define("_dbController", "mysqli");
	define("_dbHost", "localhost");
	define("_dbUser", ""); 
	define("_dbPwd", "");
	define("_dbName", "");
	define("_dbPort", "5432");
	define("_dbPfx", "muu_");
	
	//NoSQL Settings
	define("_dbNoSQLHost", "localhost");
	define("_dbNoSQLPort", 27017);
	define("_dbNoSQLUser", ""); 
	define("_dbNoSQLPwd", "");
	define("_dbNoSQLDatabase", "");
} else {
	//Database Settings
	define("_dbController", "mysqli");
	define("_dbHost", "localhost");
	define("_dbUser", "YOUR USERNAME"); 
	define("_dbPwd", "YOUR PASSWORD");
	define("_dbName", "YOUR DATABASE");
	define("_dbPort", "5432");
	define("_dbPfx", "muu_");
	
	//NoSQL Settings
	define("_dbNoSQLHost", "localhost");
	define("_dbNoSQLPort", 27017);
	define("_dbNoSQLUser", ""); 
	define("_dbNoSQLPwd", "");
	define("_dbNoSQLDatabase", "");
}
