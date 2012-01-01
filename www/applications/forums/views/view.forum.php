<?php if(!defined("_access")) die("Error: You don't have permission to access here...");?>

<?php if(!SESSION("ZanUserID")) { ?>
	<div class="twitterButton">
		<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
	</div>
	<div class="clear"></div>
<?php } ?>

<div class="actions">
	<?php if(SESSION("ZanUserID") > 0) { ?>
		<p class="welcome"><?php print __("Welcome to the forum");?>, <?php print $forum["Forum_Title"];?>, <a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile";?>" title="<?php print SESSION("ZanUser");?>"><?php print SESSION("ZanUser");?></a>. <?php print __("Feel free of generate new topics");?>.</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . $forum["Forum_Nice"] . _sh . "new";?>" title="<?php print __("Post a topic");?>"><?php print __("New topic");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh;?>" title="<?php print __("Back");?>!"><?php print __("Forums");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "editprofile" . _sh;?>" title="<?php print __("Edit Profile");?>"><?php print __("Edit Profile");?></a></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "logout" . _sh . "forums";?>" title="<?php print __("Logout");?>"><?php print __("Logout");?></a></li>
			</ul>
		</div>
	<?php } else { ?>
		<p class="welcome"><?php print __("Welcome to the forums of");?> <?php print _webName;?>, <?php print __("please login to enjoy the forums or register if you don't have an account");?>.</p>
		<div class="options">
			<ul>
				<li class="main"><?php print __("Options");?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh;?>" title="<?php print __("Back");?>!"><?php print __("Forums");?></a></li>
				<li><a class="signIn" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "login" . _sh . "forums";?>" title="<?php print __("Login");?>"><?php print __("Login");?></a></li>
				<li><a class="signUp" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "register" . _sh . "forums";?>" title="<?php print __("Sign up");?>"><?php print __("Sign up");?></a></li>
			</ul>
		</div>
	<?php } ?>
</div>
<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php print $forum["Forum_Title"];?></span>
		</caption>
		<thead>
			<tr>
				<th class="first"><?php print __("Topic") . "/" . __("Author");?></th>
				<th class="second"><?php print __("Last Message");?></th>
				<th class="third"><?php print __("Replies");?></th>
				<th class="fourth"><?php print __("Visits");?></th>
			<?php if(SESSION("ZanUserID")) { ?>
				<th class="fifth"><?php print __("Actions");?></th>
			<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($topics !== FALSE) {
				$j = 0; 
				foreach($topics as $topic) { ?>
					<tr class="rows <?php if($j % 2 === 0) { print "odd"; } else { print "even"; }?>">
						<td class="first">
							<span class="forumTitle">
								<a title="<?php print $topic["Title"];?>" href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . segment(2) . _sh . $topic["ID"];?>"><?php print $topic["Title"];?></a>
							</span>
							<br />
							<div class="forumDesc"><a title="<?php print $topic["Author"]?>" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "profile" . _sh . $topic["Author_ID"];?>"><?php print $topic["Author"]?></a></div>
						</td>
						<td class="second">
							<?php if($topic["Count"] === 0) { ?>
								<span class="postDate"><?php print $topic["Last_Reply"];?></span>
							<?php } else { ?>
								<span class="forumTitle"><a title="<?php print $topic["Last_Title"];?>" href="<?php print $topic["Last_URL"];?>"><?php print $topic["Last_Title"];?></a></span><span class="postAuthor"> <?php print __("written by");?> <a title="<?php print $topic["Last_Author"]?>" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "profile" . _sh . $topic["Last_Author_ID"];?>"><?php print $topic["Last_Author"]?></a>.</span>
								<br />
								<span class="postDate"><?php print howLong($topic["Last_Start"]);?></span>
							<?php } ?>
						</td>
						<td class="third"><span class="forumNumbers"><?php print $topic["Count"];?></span></td>
						<td class="fourth"><span class="forumNumbers"><?php print $topic["Visits"];?></span></td>
					<?php if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $topic["Author_ID"])) { ?>
						<td class="fifth">
							<div class="actionbutton"><a title="<?php print __("Edit");?>" onclick="return confirm('<?php print __("Do you want to edit the topic?");?>');" href="<?php print $topic["editURL"];?>" class="ui-icon ui-icon-pencil"><span class="hide">Edit</span></a></div>
							<div class="actionbutton"><a title="<?php print __("Delete");?>" onclick="return confirm('<?php print __("Do you want to delete the topic?");?>');" href="<?php print $topic["deleteURL"];?>" class="ui-icon ui-icon-trash"></a><span class="hide">Delete</span></div>
						</td>
					<?php } elseif(SESSION("ZanUserID")) { ?>
						<td class="fifth">
							<div class="actionbutton"><a href="<?php print $topic["replyURL"];?>" title="<?php print __("Reply");?>" class="ui-icon ui-icon-arrowreturnthick-1-w"></a><span class="hide">Reply</span></div>
							<div class="actionbutton"><a href="<?php print $topic["topicURL"];?>" title="<?php print __("New topic");?>" class="ui-icon ui-icon-plusthick"></a><span class="hide">Topic</span></div>
						</td>
					<?php } ?>
					</tr>
			<?php $j++; 
				} 
			} else { ?>
				<?php if(SESSION("ZanUserID")) { ?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5"><?php print __("There are no topics, be the first!");?> <a class="newTopic" href="<?php print _webBase . _sh . _webLang . _sh . "forums" . _sh . $forum["Forum_Nice"] . _sh . "new";?>" title="<?php print __("Post a topic!");?>"><?php print __("Post a topic!");?> :)</a></td>
					</tr>
				<?php } else { ?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5">
							<?php print __("There are no topics, be the first! but first");?>:  
							<a class="signIn" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "login" . _sh . "forums";?>" title="<?php print __("Login");?>"><?php print __("Login");?></a> <a class="signUp" href="<?php print _webBase . _sh . _webLang . _sh . "users" . _sh . "register" . _sh . "forums";?>" title="<?php print __("Sign up");?>"><?php print __("Sign up");?></a>
						</td>
					</tr>
				<?php } ?>
			<?php } ?>
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
