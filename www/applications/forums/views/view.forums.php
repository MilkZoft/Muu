<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php if(!SESSION("ZanUserID")) { ?>
	<div class="twitterButton">
		<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
	</div>
	<div class="clear"></div>
<?php } ?>

<div class="actions">
	<?php if(SESSION("ZanUserID") > 0) { ?>
		<p class="welcome"><?php print __("Welcome to the forums of");?> <?php print _webName;?>, <a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print SESSION("ZanUser");?>"><?php print SESSION("ZanUser");?></a>!</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print __("Edit Profile");?>"><?php print __("Edit Profile");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "logout" . _sh . "forums";?>" title="<?php print __("Logout");?>"><?php print __("Logout");?></a></li>
			</ul>
		</div>
	<?php } else { ?>
		<p class="welcome"><?php print __("Welcome to the forums of");?> <?php print _webName;?>, <?php print __("please login to enjoy the forums or register if you don't have an account");?>.</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a class="signIn" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "login" . _sh . "forums";?>" title="<?php print __("Login");?>"><?php print __("Login");?></a></li>
				<li><a class="signUp" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "register" . _sh . "forums";?>" title="<?php print __("Sign up");?>"><?php print __("Sign up");?></a></li>
			</ul>
		</div>
	<?php } ?>
</div>
<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php print __("Forums");?></span>
		</caption>
		<thead>
			<tr>
				<th class="first"><?php print __("Forum");?></th>
				<th class="second"><?php print __("Last Message");?></th>
				<th class="third"><?php print __("Topics");?></th>
				<th class="fourth"><?php print __("Messages");?></th>
			<?php if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { ?>
				<th class="fifth"><?php print __("Actions");?></th>
			<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php $j = 0; foreach($forums as $forum) { ?>
				<tr class="rows <?php if($j % 2 === 0) { print "odd"; } else { print "even"; }?>">
					<td class="first">
						<span class="forumTitle2">
							<a title="<?php print $forum["Title"];?>" href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . $forum["Nice"];?>"><?php print $forum["Title"];?></a>
						</span>
						<br />
						<div class="forumDesc"><?php print $forum["Description"];?></div>
					</td>
					<td class="second">
						<?php if($forum["Last_Date"] === NULL) { ?>
							<span class="postDate"><?php print $forum["Last_Reply"];?></span>
						<?php } else { ?>
							<span class="forumTitle"><a title="<?php print $forum["Last_Reply_Title"];?>" href="<?php print $forum["Last_URL"];?>"><?php print $forum["Last_Reply_Title"];?></a></span><span class="postAuthor"> <?php print __("written by");?> <a title="<?php print $forum["Last_Reply_Author"]?>" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "profile" . _sh . $forum["Last_Reply_Author_ID"];?>"><?php print $forum["Last_Reply_Author"]?></a>.</span>
							<br />
							<span class="postDate"><?php print howLong($forum["Last_Date2"]);?></span>
						<?php } ?>
					</td>
					<td class="third"><span class="forumNumbers"><?php print $forum["Topics"];?></span></td>
					<td class="fourth"><span class="forumNumbers"><?php print $forum["Replies"];?></span></td>
				<?php if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { ?>
					<td class="fifth">
						<div class="actionbutton"><a title="<?php print __("Edit ");?>"onclick="return confirm('<?php print __("Do you want to edit the forum?");?>');" href="<?php print $forum["editURL"];?>" class="ui-icon ui-icon-pencil"><span class="hide">Edit</span></a></div>
						<div class="actionbutton"><a title="<?php print __("Delete");?>" onclick="return confirm('<?php print __("Do you want to delete the forum?");?>');" href="<?php print $forum["deleteURL"];?>" class="ui-icon ui-icon-trash"></a><span class="hide">Delete</span></div>
					</td>
				<?php } ?>
				</tr>
			<?php $j++; } ?>
		</tbody>		
	</table>
</div>	
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
