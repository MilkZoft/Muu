<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Default_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Templates = $this->core("Templates");
				
		$helpers = array("router", "security", "sessions");
		$this->helper($helpers);
		
		$this->application = "default";
		
		$this->Scaffold = $this->core("Scaffold");
		
		$this->Templates->theme(_webTheme);
	}
	
	public function blog() {
		if(POST("save")) {
			$values = array(
				"Nice"   	=> slug(POST("title", FALSE, "clean")),
				"Author" 	=> "Carlos Santana",
				"Text_Date" => "Sábado, 14 de septiembre de 2011",
				"Year"		=> "2011",
				"Month"		=> "09",
				"Day"		=> "14"
			);

			$validations = array(
				"Title"	  => "required",
				"Content" => "required"
			);
			
			$this->Scaffold->validations($validations);
			$this->Scaffold->values($values);
			$this->Scaffold->save();
		} else {
			$this->Scaffold->table("blog");
			
			$hide = "Nice, Author, Text_Date, Year, Month, Day, Image_Small, Image_Medium";
			$this->Scaffold->hide($hide);

			$languages = getLanguages(TRUE);
			
			$options = array(
				"Enable_Comments" 	=> 	array(
											"type" 	  	=> 	"select", 
											"options"	=> 	array(
																"Yes", 
																"No"
															)
										),

				"Language"			=> 	array(
											"type"		=>	"radio",
											"options"	=>	array(
																$languages
															)
										),

				"Pwd"				=> 	array(
											"type"		=> "password"
										),

				"State" 			=> 	array(
											"type" 	  	=> 	"select", 
											"options"	=> 	array(
																"Active", 
																"Inactive"
															)
										),
			);

			$this->Scaffold->options($options);
			$this->Scaffold->make();	
		}
	}
	
	public function index() {		
		if(whichLanguage() === "English") {
			$this->view("home", $this->application);
		} else {
			$this->view("inicio", $this->application);
		}
	}
}
