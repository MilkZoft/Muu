<?php
if(SESSION("ZanUser") and SESSION("ZanUserMethod") === "twitter") {
	//$this->view("form",   "twitter", array("action"   => $action));
	//$this->view("logout", "twitter", array("redirect" => $redirect));
} else {
	$this->view("login", "twitter", array("redirect" => $redirect));
}
