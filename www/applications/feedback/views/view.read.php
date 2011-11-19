<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if($data) {
		$ID      = $data[0]["ID_Feedback"];
		$name    = $data[0]["Name"];
		$email   = $data[0]["Email"];
		$company = $data[0]["Company"];
		$phone   = $data[0]["Phone"];
		$subject = $data[0]["Subject"];
		$message = $data[0]["Message"];
		$date    = $data[0]["Text_Date"];
		$state   = $data[0]["Situation"];
		$back    = _webBase. _sh. _webLang. _sh. whichApplication() . _sh. _cpanel . _sh . _results;
	} else {
		redirect(_webBase. _sh. _webLang. _sh. whichApplication() . _sh. _cpanel . _sh . _results);
	}
?>

<div class="add-form">
	<p class="field">
		<strong><?php print __("Name"); ?></strong><br />
		<p><?php print $name;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Email"); ?></strong><br />
		<p><?php print $email;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Date"); ?></strong><br />
		<p><?php print $date;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Subject"); ?></strong><br />
		<p><?php print $subject;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Phone"); ?></strong><br />
		<p><?php print $phone;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Company"); ?></strong><br />
		<p><?php print $company;?></p>
	</p>
	
	<p class="field">
		<strong><?php print __("Message"); ?></strong><br />
		<p><?php print $message;?></p>
	</p>
	
	<p>
		<a href="<?php print $back;?>" title="<?php print __(whichApplication());?>"><?php print __("Back");?></a>
	</p>
</div>
