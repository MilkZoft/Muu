<?php
/**
* Access from index.php:
*/
if(!defined("_access")) {
    die("Error: You don't have permission to access here...");
}

/**
* General
*/
$config["wURL"]         = "http://localhost/MuuCMS";
$config["wName"]        = "MuuCMS";
$config["wTheme"]       = "zanphp";
$config["wSituation"]   = "Active";
$config["wLanguage"]    = "Spanish";
$config["wLang"]        = "es";
$config["application"]  = "blog";

/**
* General
*/
define("_autoRender", TRUE);
define("_domain", FALSE);
define("_modRewrite", FALSE);
define("_translation", "gettext");
define("_sh", "/");
define("_dot", ".");
define("_PHP", ".php");
define("_favicon", "favicon.ico");

/**
* Credits
*/
define("_ZanPHP", "ZanPHP");

/**
* Security:
*/
define("_secretKey", "_eh{Ll&}`<6Y\mg1Qw(;;|C3N9/7*HTpd7SK8t/[}R[vW2)vsPgBLRP2u(C|4]%m_");
define("_super", "Super Admin");