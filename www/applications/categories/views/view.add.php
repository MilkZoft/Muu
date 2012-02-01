<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	
	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;
	
			if($apps and $appsCategories) {
				print '<table id="categories">';
					print '<tr>';
						print '<th>Categorías</th>';
						
						foreach($apps as $app) {
							print '<th>'. $app["option"] .'</th>';
						}

					print '</tr>';
					
					$temp = NULL;

					foreach($appsCategories as $appsCategory) {			
						if($temp !== $appsCategory["ID_Category"]) {
							if(!is_null($temp)) { 
								print "</tr>"; 
							}
							
							print "<tr>";
								print '<td>'. $appsCategory["Title"] .'</td>';

								foreach($apps as $app) {
									if($app["value"] === $appsCategory["App"]) {
										print '<td>'. __(_("Yes")) .'</td>';
									} else {
										print '<td>'. __(_("No")) .'</td>';
									}
								}
						} else {
							foreach($apps as $app) {
									if($app["value"] == $appsCategory["App"]) {
										print '<td>'. __(_("Yes")) .'</td>';
									} else {
										print '<td>'. __(_("No")) .'</td>';
									}
								}
						}	
								
						$temp = $appsCategory["ID_Category"];
					}
										
				print '</table>';
			}
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);