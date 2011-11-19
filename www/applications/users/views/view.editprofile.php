<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="editProfile">
	<form id="editUserProfile" action="<?php print $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<p class="center2"><?php print __("Edit Profile"); ?></p>
		
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<div id="box" class="set2 important">
				<p class="title main"><?php print __("Profile");?></p>
				
				<div class="avatar">
					<div id="avatar"><img src="<?php print $avatar;?>" title="<?php print $user[0][0]["Username"];?>" alt="<?php print $user[0][0]["Username"];?>" /></div><br />
					<div class="buttons">
					<?php if(SESSION("ZanUserMethod") !== "twitter") { ?>
						<input class="upAvatar" value="<?php print __("Upload");?>" type="button" />
					<?php } ?>
					<input class="editData" name="<?php print _webLang;?>" value="<?php print __("Edit Profile");?>" type="button" />
					</div>
				</div>
				<?php if(SESSION("ZanUserMethod") !== "twitter") { ?>
					<input id="file" name="file" type="file" onchange="doUpload();" />
				<?php } else { ?>
					<input id="userTwitter" name="userTwitter" value="Yes" type="hidden" />
				<?php } ?>
				
				<div class="social">
					<?php if($twitter) { ?>
						<a class="sn" id="twitter" rel="external" href="http://twitter.com/<?php print $user[1][0]["Twitter"];?>" title="<?php print $user[1][0]["Twitter"];?>"><img src="<?php print $twitter;?>" alt="twitter.com"/></a>
					<?php } ?>
					<?php if($facebook) { ?>
						<a class="sn" id="facebook" rel="external" href="http://facebook.com/<?php print $user[1][0]["Facebook"];?>" title="<?php print $user[1][0]["Facebook"];?>"><img src="<?php print $facebook;?>" alt="facebook.com"/></a>
					<?php } ?>
					<?php if($linkedin) { ?>
						<a class="sn" id="linkedin" rel="external" href="http://linkedin.com/<?php print $user[1][0]["Linkedin"];?>" title="<?php print $user[1][0]["Linkedin"];?>"><img src="<?php print $linkedin;?>" alt="linkedin.com"/></a>
					<?php } ?>
					<?php if($google) { ?>
						<a class="sn" id="google" href="http://plus.google.com/<?php print $user[1][0]["Google"];?>/about" rel="external" title="<?php print $user[1][0]["Google"];?>"><img src="<?php print $google;?>" alt="plus.google.com"/></a>
					<?php } ?>
				</div>
				<div class="clear"></div>
				<div class="wrapper">
					<div class="blocktitle maintop"><?php print __("Main Information");?></div>
					<div class="information principal">
						<div id="mainhide">
							<p><strong><?php print __("User");?>:</strong> <?php print $user[0][0]["Username"];?></p>
							<p><strong <?php print ((!$user[0][0]["Email"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Email");?>:</strong> <?php print $user[0][0]["Email"];?></p>
							<p><strong><?php print __("Rank");?>:</strong> <?php print __($user[0][0]["Rank"]);?></p>
							<p><strong><?php print __("Join Date");?>:</strong> <?php print $joinDate;?></p>
							<p class="website"><strong <?php print ((!$user[0][0]["Website"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Website");?>:</strong> <a <?php print ((!$user[0][0]["Website"]) ? 'style="display:none;" class="remove"' : null);?> href="<?php print $user[0][0]["Website"];?>" id="website"><?php print __("Go");?></a></p>
							
						</div>
					</div>
					
					<div class="blocktitle private"><?php print __("Personal Information");?></div>
					<div class="information personal">
						<div id="personalhide">
								<p class="name"><strong <?php print ((!$user[1][0]["Name"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Name");?>:</strong> <span id="name"><?php print $user[1][0]["Name"];?></span></p>
								<p class="gender"><strong <?php print ((!$user[1][0]["Gender"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Gender");?>:</strong> <span id="gender"><?php print __($user[1][0]["Gender"]);?></span></p>
								<p class="birthday"><strong <?php print ((!$user[1][0]["Birthday"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Birthday");?>:</strong> <span id="birthday"><?php print $user[1][0]["Birthday"];?></span></p>
								<p class="company"><strong <?php print ((!$user[1][0]["Company"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Company");?>:</strong> <span id="company"><?php print $user[1][0]["Company"];?></span></p>
								<p class="telephone"><strong <?php print ((!$user[1][0]["Phone"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Telephone");?>:</strong> <span id="telephone"><?php print $user[1][0]["Phone"];?></span></p>
						</div>
					</div>
					
					<div class="blocktitle stats"><?php print __("User Statistics");?></div>
					<div class="information statistics">
						<div id="statshide">
							<p><strong><?php print __("Messages");?>:</strong> <?php print $user[0][0]["Messages"];?></p>
							<p><strong><?php print __("Recieve Messages");?>:</strong> <?php print __($user[0][0]["Recieve_Messages"]);?></p>
							<p><strong><?php print __("Comments");?>:</strong> <?php print $user[0][0]["Comments"];?></p>
							<p><strong><?php print __("Subscribed");?>:</strong> <?php print $user[0][0]["Subscribed"];?></p>
						</div>
					</div>
					
					<?php 
						if($user[1][0]["Country"] === "" and $user[1][0]["District"] === "" and $user[1][0]["Town"] === "") {
							$showLocation = FALSE;
						} else {
							$showLocation = TRUE;
						}
					?>
					
					<div id="location" <?php print ((!$showLocation) ? 'style="display:none;"' : null);?> class="blocktitle location"><?php print __("User Location");?></div>
					<div class="information ubication">
						<div id="ubihide">
							<p class="country"><strong <?php print ((!$user[1][0]["Country"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Country");?>:</strong> <span id="country"><?php print $user[1][0]["Country"];?></span></p>
							<p class="district"><strong <?php print ((!$user[1][0]["District"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("District");?>:</strong> <span id="district"><?php print $user[1][0]["District"];?></span></p>
							<p class="town"><strong <?php print ((!$user[1][0]["Town"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Town");?>:</strong> <span id="town"><?php print $user[1][0]["Town"];?></span></p>
						</div>					
					</div>
					
					<?php 
						if($user[0][0]["Sign"] === "") {
							$showOther = FALSE;
						} else {
							$showOther = TRUE;
						}
					?>
					<div id="other" <?php print ((!$showOther) ? 'style="display:none;"' : null);?> class="blocktitle other"><?php print __("Social Information");?></div>
					<div class="information socialmedia">
						<div id="socialhide">
							<p class="sign"><strong <?php print ((!$user[0][0]["Sign"]) ? 'style="display:none;" class="remove"' : null);?>><?php print __("Sign");?>:</strong></p>
							<div id="sign"><?php print $user[0][0]["Sign"];?></div>
							<div id="sclntw">
								<p class="twitter"><strong>Twitter:</strong></p>
								<p class="facebook"><strong>Facebook:</strong></p>
								<p class="linkedin"><strong>LinkedIn:</strong></p>
								<p class="google"><strong>Google:</strong></p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
						
			<input class="removable" name="website" type="hidden" value="<?php print $user[0][0]["Website"];?>" />
			<input class="removable" name="twitter" type="hidden" value="<?php print $user[1][0]["Twitter"];?>" />
			<input class="removable" name="facebook" type="hidden" value="<?php print $user[1][0]["Facebook"];?>" />
			<input class="removable" name="linkedin" type="hidden" value="<?php print $user[1][0]["Linkedin"];?>" />
			<input class="removable" name="google" type="hidden" value="<?php print $user[1][0]["Google"];?>" />
			<input class="removable" name="name" type="hidden" value="<?php print $user[1][0]["Name"];?>" />
			<input class="removable" name="gender" type="hidden" value="<?php print $user[1][0]["Gender"];?>" />
			<input class="removable" name="birthday" type="hidden" value="<?php print $user[1][0]["Birthday"];?>" />
			<input class="removable" name="company" type="hidden" value="<?php print $user[1][0]["Company"];?>" />
			<input class="removable" name="country" type="hidden" value="<?php print $user[1][0]["Country"];?>" />
			<input class="removable" name="district" type="hidden" value="<?php print $user[1][0]["District"];?>" />
			<input class="removable" name="town" type="hidden" value="<?php print $user[1][0]["Town"];?>" />
			<input class="removable" name="telephone" type="hidden" value="<?php print $user[1][0]["Phone"];?>" />
			<input class="removable" name="sign" type="hidden" value="<?php print $user[0][0]["Sign"];?>" />
			<input name="ID_User" type="hidden" value="<?php print $ID;?>" />
		</fieldset>
	</form>
</div>
