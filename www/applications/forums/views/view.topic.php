<?php if(!defined("_access")) die("Error: You don't have permission to access here...");?>

<?php if(!SESSION("ZanUserID")) { ?>
	<div class="twitterButton">
		<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
	</div>
	<div class="clear"></div>
<?php } ?>

<div class="actions">
	<?php if(SESSION("ZanUserID") > 0) { ?>
		<p class="welcome"><?php print __("Welcome to this topic");?>, <a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print SESSION("ZanUser");?>"><?php print SESSION("ZanUser");?></a>. <?php print __("Feel free of reply to the topic");?>.</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . segment(2) . _sh . segment(3) . _sh . "new";?>" title="<?php print __("Reply the topic");?>!"><?php print __("Reply");?>!</a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . segment(2);?>" title="<?php print __("Back to the forum");?>!"><?php print __("Back");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh;?>" title="<?php print __("Forums");?>!"><?php print __("Forums");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print __("Edit Profile");?>"><?php print __("Edit Profile");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "logout" . _sh . "forums";?>" title="<?php print __("Logout");?>"><?php print __("Logout");?></a></li>
			</ul>
		</div>
		
	<?php } else { ?>
		<p class="welcome"><?php print __("Welcome to the forums of");?> <?php print _webName;?>, <?php print __("please login to enjoy the forums or register if you don't have an account");?>.</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . segment(2);?>" title="<?php print __("Back to the forum");?>!"><?php print __("Back");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh;?>" title="<?php print __("Forums");?>!"><?php print __("Forums");?></a></li>
				<li><a class="signIn" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "login" . _sh . "forums";?>" title="<?php print __("Login");?>"><?php print __("Login");?></a></li>
				<li><a class="signUp" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "register" . _sh . "forums";?>" title="<?php print __("Sign up");?>"><?php print __("Sign up");?></a></li>
			</ul>
		</div>
	<?php } ?>
</div>
<div id="wrapper">
	<div class="pagination">
		<?php 
			if(isset($pagination)) {
				print $pagination;
			} 
		?>
	</div>
	<div class="clear"></div>
	<table id="topic">
		<tbody>
			<tr>
				<td class="caption">
					<p class="titleTopic"><?php print $data["topic"][0]["Title"];?></p>
				</td>
			</tr>
			<tr>
				<td class="profile">
					<?php if($data["topic"][0]["Avatar"] !== "") { ?>
						<?php if($data["topic"][0]["Type"] === "Normal") { ?>
							<img src="<?php print _webURL . _sh . $data["topic"][0]["Avatar"];?>" title="<?php print $data["topic"][0]["Username"];?>" /><br />
						<?php } elseif($data["topic"][0]["Type"] === "Twitter") { ?>
							<img src="<?php print $data["topic"][0]["Avatar"];?>" title="<?php print $data["topic"][0]["Username"];?>" /><br />
						<?php } ?>
					<?php } else { ?>
						<img src="<?php print _webURL . _sh . "lib" . _sh . "files" . _sh . "images" . _sh . "users" . _sh . "default.png";?>" title="<?php print $data["topic"][0]["Username"];?>" /><br />
					<?php } ?>
					<div class="userinfo">
						<p><strong><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "profile" . _sh . $data["topic"][0]["ID_User"];?>" title="<?php print $data["topic"][0]["Username"];?>"><?php print $data["topic"][0]["Username"];?></a></strong></p>
						<p><?php print __($data["topic"][0]["Rank"]);?></p>
						<?php if($data["topic"][0]["Country"]) { ?>
							<p><?php print $data["topic"][0]["Country"];?></p>
						<? } ?>
						<?php if($data["topic"][0]["Website"]) { ?>
							<a href="<?php print $data["topic"][0]["Website"];?>" rel="external" title="<?php print $data["topic"][0]["Website"];?>"><?php print __("Website");?></a>
						<? } ?>
					</div>
					<div class="topicInfo2">
						<p><?php print $data["topic"][0]["Text_Date"];?></p>
						<p><?php print $data["topic"][0]["Hour"];?></p>
					</div>	
					<!--<p class="dateTopic"><?php print $data["topic"][0]["Text_Date"];?><br /><?php print $data["topic"][0]["Hour"];?></p>-->
					<div class="clear"></div>
				</td>
			</tr>
			<?php if(SESSION("ZanUserID")) { ?>
				<tr class="actionsTopic">
					<td>
						<ul>
							<?php if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $data["topic"][0]["ID_User"])) { ?>
								<li><a href="<?php print $data["topic"][0]["replyURL"];?>" title="<?php print __("Reply");?>"><?php print __("Reply");?></a></li>
								<li><a title="<?php print __("Edit");?>" onclick="return confirm('<?php print __("Do you want to edit the topic?");?>');" href="<?php print $data["topic"][0]["editURL"];?>"><?php print __("Edit");?></a></li>
								<li><a title="<?php print __("Delete");?>" onclick="return confirm('<?php print __("Do you want to delete the topic?");?>');" href="<?php print $data["topic"][0]["deleteURL"];?>"><?php print __("Delete");?></a></li>
							<?php } elseif(SESSION("ZanUserID")) { ?>
								<li><a href="<?php print $data["topic"][0]["replyURL"];?>" title="<?php print __("Reply");?>"><?php print __("Reply");?></a></li>
							<?php } ?>
						</ul>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td class="topicContent">
					<div class="topicData">
						<p><?php print $data["topic"][0]["Content"];?></p>
						<?php if($data["topic"][0]["Sign"] !== "") { ?>
							<p class="sign"><?php print $data["topic"][0]["Sign"];?></p>
						<?php } ?>
					</div>
				</td>
			</tr>
			<?php 	$i = 0;
					if(is_array($data["replies"])) { 
						foreach($data["replies"] as $reply) { ?>
							<tr class="space">
								<?php $i++; ?>
							</tr>
							<tr>
								<?php if($i === $count) { ?>
									<a name="bottom"></a>
								<?php } ?>
								<a name="<?php print $reply["ID_Post"];?>"></a>
								<td class="profile">
									<?php if($reply["Avatar"] !== "") { ?>
										<?php if($reply["Type"] === "Normal") { ?>
											<img src="<?php print _webURL . _sh . $reply["Avatar"];?>" title="<?php print $reply["Username"];?>" /><br />
										<?php } elseif($reply["Type"] === "Twitter") { ?>
											<img src="<?php print $reply["Avatar"];?>" title="<?php print $reply["Username"];?>" /><br />
										<?php } ?>
									<?php } else { ?>
										<img src="<?php print _webURL . _sh . "lib" . _sh . "files" . _sh . "images" . _sh . "users" . _sh . "default.png";?>" title="<?php print $reply["Username"];?>" /><br />
									<?php } ?>
									<div class="userinfo">
										<p><strong><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "profile" . _sh . $reply["ID_User"];?>" title="<?php print $reply["Username"];?>"><?php print $reply["Username"];?></a></strong></p>
										<p><?php print __($reply["Rank"]);?></p>
										<?php if($reply["Country"]) { ?>
											<p><?php print $reply["Country"];?></p>
										<? } ?>
										<?php if($reply["Website"]) { ?>
											<a href="<?php print $reply["Website"];?>" rel="external" title="<?php print $reply["Website"];?>"><?php print __("Website");?></a>
										<? } ?>
									</div>
									<div class="topicInfo2">
										<p><strong><?php print $reply["Title"];?></strong></p>
										<p><?php print $reply["Text_Date"];?></p>
										<p><?php print $reply["Hour"];?></p>
									</div>	
								</td>
							</tr>
							<?php if(SESSION("ZanUserID")) { ?>
								<tr class="actionsTopic">
									<td>
										<ul>
											<?php if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $reply["ID_User"])) { ?>
												<li><a href="<?php print $data["topic"][0]["replyURL"];?>" title="<?php print __("Reply");?>"><?php print __("Reply");?></a></li>
												<li><a title="<?php print __("Edit");?>" onclick="return confirm('<?php print __("Do you want to edit the reply?");?>');" href="<?php print $reply["editURL"];?>"><?php print __("Edit");?></a></li>
												<li><a title="<?php print __("Delete");?>" onclick="return confirm('<?php print __("Do you want to delete the reply?");?>');" href="<?php print $reply["deleteURL"];?>"><?php print __("Delete");?></a></li>
											<?php } elseif(SESSION("ZanUserID")) { ?>
												<li><a href="<?php print $data["topic"][0]["replyURL"];?>" title="<?php print __("Reply");?>"><?php print __("Reply");?></a></li>
											<?php } ?>
										</ul>
									</td>
								</tr>
							<?php } ?>
							<tr>
								<td class="topicContent">
									<div class="topicData">
										<p><?php print $reply["Content"];?></p>
										<?php if($data["topic"][0]["Sign"] !== "") { ?>
											<p class="sign"><?php print $reply["Sign"];?></p>
										<?php } ?>										
									</div>
								</td>
							</tr>
			<?php 		} 
					} ?>
		</tbody>
	</table>
</div>
<div class="pagination2">
		<?php 
			if(isset($pagination)) {
				print $pagination;
			} 
		?>
</div>
<div class="clear"></div>
<div class="forumsFooter">
	<div class="privileges">
		<p class="footerTitle"><?php print __("Extra information");?>.</p>
		<img src="<?php print $avatar;?>" title="<?php print ((SESSION("ZanUser")) ? SESSION("ZanUser") : __("Sign up, please") . " :)");?>" alt="<?php print __("A user avatar");?>" />
		<?php if(SESSION("ZanUserID")) { ?>
			<?php if(SESSION("ZanUserPrivilege") === "Super Admin") { ?>
				<p class="<?php if(SESSION("ZanUserMethod")) { print "onlineUserInfo2"; } else { print "onlineUserInfo"; } ?>"><?php print __("Hi there!, ");?> <a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print SESSION("ZanUser");?>"><?php print SESSION("ZanUser");?></a>. <br /> <?php print __("Here are your statistics");?>: <br />
					<ul class="userStatistics">
						<li><strong><?php print __("Topics");?>:</strong> <?php print $stats[0]["Topics"];?></li>
						<li><strong><?php print __("Replies");?>:</strong> <?php print $stats[0]["Replies"];?></li>
						<li><strong><?php print __("Visits");?>:</strong> <?php print $stats[0]["Visits"];?></li>
					</ul>
				</p>
				<ul class="lsprivileges2">
					<li><?php print __("You can");?> <a href="<?php print _webBase . _sh . _webLang . _sh . _cpanel . _sh . _forums . _sh . "action" . _sh . "save";?>" title="<?php print __("Create Forums");?>"><?php print __("create");?></a> <?php print __("new forums");?>.</li>
					<li><?php print __("You can create new topics");?>.</li>
					<li><?php print __("You can reply to topics");?>.</li>
					<li><?php print __("You can send private messages");?>.</li>
				</ul>
			<?php } elseif(SESSION("ZanUserPrivilege") === "Member") { ?>
				<p class="<?php if(SESSION("ZanUserMethod")) { print "onlineUserInfo2"; } else { print "onlineUserInfo"; } ?>"><?php print __("Hi there!, ");?> <a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print SESSION("ZanUser");?>"><?php print SESSION("ZanUser");?></a>. <br /> <?php print __("Here are your statistics");?>: <br />
					<ul class="userStatistics">
						<li><strong><?php print __("Topics");?>:</strong> <?php print $stats[0]["Topics"];?></li>
						<li><strong><?php print __("Replies");?>:</strong> <?php print $stats[0]["Replies"];?></li>
						<li><strong><?php print __("Visits");?>:</strong> <?php print $stats[0]["Visits"];?></li>
					</ul>
				</p>
				<ul class="lsprivileges2">
					<li class="noprivilege"><?php print __("You can <strong>NOT</strong> create new forums");?>.</li>
					<li><?php print __("You can create new topics");?>.</li>
					<li><?php print __("You can reply to topics");?>.</li>
					<li><?php print __("You can send private messages");?>.</li>
				</ul>
			<?php } ?>
		<?php } else { ?> 
			<p class="noUserInfo"><?php print __("Hi there!, you should");?> <a class="signIn" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "login" . _sh . "forums";?>" title="<?php print __("Login");?>"><?php print __("login");?></a> <?php print __("to enjoy full access to the forums");?>.
			<br /><?php print __("If you don't have an account, you can create it");?> <a class="signUp" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "register" . _sh . "forums";?>" title="<?php print __("Sign up");?>"><?php print __("here");?></a>.
			</p>
			<ul class="lsprivileges">
				<li class="noprivilege"><?php print __("You can <strong>NOT</strong> create new forums");?>.</li>
				<li class="noprivilege"><?php print __("You can <strong>NOT</strong> create new topics");?>.</li>
				<li class="noprivilege"><?php print __("You can <strong>NOT</strong> reply to topics");?>.</li>
				<li class="noprivilege"><?php print __("You can <strong>NOT</strong> send private messages");?>.</li>
			</ul>
		<?php } ?>
	</div>
	<div class="lastUsers">
		<p class="footerTitle"><?php print __("Last registered users");?>.</p>
		<ol>
		<?php foreach($users as $user) { ?>
			<li><a href="<?php print _webBase . _sh . _webLang . _sh . _users . _sh . "profile" . _sh . $user["ID_User"];?>" title="<?php print $user["Username"];?>"><?php print $user["Username"];?></a></li>
		<?php } ?>
		</ol>
	</div>
	<div class="clear"></div>
</div>
