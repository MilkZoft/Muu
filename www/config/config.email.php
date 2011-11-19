<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

/**
 * E-Mail
 */

define("_gUser", "");
define("_gPwd", "");
define("_gSSL", "ssl://smtp.gmail.com");
define("_gPort", 465);
define("_wEmailSend", "webmaster@milkzoft.com");
define("_wEmailLibrary", "PHPMailer");
define("_maxAttempts", 3);
