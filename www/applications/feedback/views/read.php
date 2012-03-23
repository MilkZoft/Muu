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
		$back    = path(whichApplication() . _sh . "cpanel" . _sh . "results");
	} else {
		redirect(path(whichApplication() . _sh . "cpanel" . _sh . "results"));
	}
?>

<div class="add-form">
	<p class="field">
		<strong><?php print __(_("Name")); ?></strong><br />
		<?php print $name;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Email")); ?></strong><br />
		<?php print $email;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Date")); ?></strong><br />
		<?php print $date;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Subject")); ?></strong><br />
		<?php print $subject;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Phone")); ?></strong><br />
		<?php print $phone;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Company")); ?></strong><br />
		<?php print $company;?>
	</p>
	
	<p class="field">
		<strong><?php print __(_("Message")); ?></strong><br />
		<?php print $message;?>
	</p>
	
	<p>
		<a href="<?php print $back;?>" title="<?php print __(_("Back")); ?>"><?php print __(_("Back"));?></a>
	</p>
</div>