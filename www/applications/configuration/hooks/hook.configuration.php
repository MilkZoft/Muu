<?php
function hookConfiguration() {
	global $Load;
	
	$Configuration_Model = $Load->model("Configuration_Model");
	
	$data = $Configuration_Model->getByID();
	
	return is_array($data) ? $data[0] : FALSE;
}

$config = hookConfiguration();

if($config) {
	define("_webName", $config["Name"]);
	define("_webLanguage", $config["Language"]);
	
	if(whichLanguage() === "Spanish") {
		define("_webSlogan", $config["Slogan_Spanish"]);
	} elseif(whichLanguage() === "English") {
		define("_webSlogan", $config["Slogan_English"]);
	} elseif(whichLanguage() === "French") {
		define("_webSlogan", $config["Slogan_French"]);
	} elseif(whichLanguage() === "Portuguese") {
		define("_webSlogan", $config["Slogan_Portuguese"]);
	}
	
	define("_webURL", $config["URL"]);
	define("_webTheme", $config["Theme"]);
	define("_webState", $config["State"]);
	define("_webMessage", $config["Message"]);
	define("_webValidation", $config["Validation"]);
	define("_webEmailRecieve", $config["Email_Recieve"]);
	define("_webEmailSend", $config["Email_Send"]);
	define("_webActivation", $config["Activation"]);
	define("_webLang", whichLanguage(FALSE));
	define("_defaultApplication", $config["Application"]);
	
	if(_modRewrite === FALSE) {
		define("_webBase", _webURL . _sh . _index);
	} else {
		define("_webBase", _webURL);
	}
} else {
	die("You need to set up the basic configuration");
}