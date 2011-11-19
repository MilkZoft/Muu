<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

ob_start(); 
session_start(); 

define("_dir", dirname(__FILE__));

if(file_exists(_dir . "/config/config.basics.php") and file_exists(_dir . "/config/config.core.php")) { 
	include "config/config.basics.php";
	include "config/config.core.php";
} else { 
	die("Error: config.basics.php or config.core.php doesn't exists");
}

include _corePath . "/classes/class.load.php";
include _corePath . "/classes/class.controller.php";
include _corePath . "/classes/class.model.php";

$Load = new ZP_Load(); 

$helpers = array("debugging", "i18n", "router", "benchmark", "string", "sessions", "security");

$Load->helper($helpers);

$Configuration_Model = $Load->model("Configuration_Model");

$data = $Configuration_Model->getConfig();

if(is_array($data)) {
	define("_webLanguage", 	      $data[0]["Language"]);

	if(whichLanguage() === _webLanguage) { 
		define("_webLang", $data[0]["Lang"]);
	} else {
		define("_webLang", getXMLang(whichLanguage(), FALSE));
	}

	define("_webName", 		      $data[0]["Name"]);
	define("_webSlogan", 	      $data[0]["Slogan_" . _webLanguage]);
	define("_webURL", 		      $data[0]["URL"]);
	define("_webTheme", 	      $data[0]["Theme"]);
	define("_webGallery", 	      $data[0]["Gallery"]);
	define("_webValidation",      $data[0]["Validation"]);
	define("_webMessage",         $data[0]["Message"]);
	define("_webActivation",      $data[0]["Activation"]);
	define("_webEmailRecieve", 	  $data[0]["Email_Recieve"]);
	define("_webEmailSend",    	  $data[0]["Email_Send"]);
	define("_webSituation",    	  $data[0]["Situation"]);
	define("_defaultApplication", $data[0]["Application"]);

	if(!_modRewrite) {
		define("_webBase", _webURL . _sh . _index);
	} else {
		define("_webBase", _webURL);
	}
} else {
	define("_webURL", 		 	  $config["wURL"]);
	define("_webName", 		 	  $config["wName"]);
	define("_webTheme", 	 	  $config["wTheme"]);
	define("_webSituation",  	  $config["wSituation"]);
	define("_webLanguage",   	  $config["wLanguage"]);
	define("_webLang", 		 	  $config["wLang"]);
	define("_defaultApplication", $config["application"]);
	define("_webEmailSend",  	  _wEmailSend);
	
	if(!_modRewrite) {
		define("_webBase", _wURL . _sh . _index);
	} else {
		define("_webBase", _wURL);
	}
}

define("_webPath", _webBase . _sh . _webLang . _sh);

if(_translation === "gettext") {
	$Load->library("class.gettext", "gettext");
	$Load->library("class.streams", "gettext");
	$Load->config("languages");
	
	$languageFile = _dir . _sh . _lib . _sh . _languages . _sh . _gettext . _sh . _sh . _language . _dot . strtolower(whichLanguage()) . _dot . _mo;

	if(file_exists($languageFile)) {
		$Gettext_Reader = new Gettext_Reader($languageFile);
		
		$Gettext_Reader->load_tables();
	}
}

benchMarkStart();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Content-type: text/html; charset=utf-8");

error_reporting(E_ALL);

if(!version_compare(PHP_VERSION, "5.1.0", ">=")) {
	die("ZanPHP needs PHP 5.1.X or higher to run.");
}

execute();

#print benchMarkEnd();
