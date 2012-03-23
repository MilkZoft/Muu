<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php 
	if(!SESSION("ZanUserID")) { 
?>
		<div class="twitterButton">
			<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
		</div>
	
		<div class="clear"></div>
<?php 
	} 
?>

<div class="actions">
	<?php 
		if(SESSION("ZanUserID") > 0) { 
	?>
			<p class="welcome">
				<?php print __(_("Welcome to the forum, ")) . $forum["Forum_Title"]; ?>, 
				<a href="<?php print path("users/editprofile"; ?>" title="<?php print SESSION("ZanUser")); ?>"><?php print SESSION("ZanUser")); ?></a>. 
				<?php print __(_("Feel free of generate new topics")); ?>.
			</p>
		
			<div class="options">
				<ul>
					<li class="main"><?php print __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li>
						<a href="<?php print path("forums/". $forum["Forum_Nice"] . "/new"; ?>" title="<?php print __(_("Post a topic")); ?>">
							<?php print __(_("New topic")); ?>
						</a>
					</li>
					<li><a href="<?php print path("forums"); ?>" title="<?php print __(_("Back")); ?>!"><?php print __(_("Forums")); ?></a></li>
					<li>
						<a href="<?php print path("users/editprofile"); ?>" title="<?php print __(_("Edit Profile")); ?>">
							<?php print __(_("Edit Profile")); ?>
						</a>
					</li>
					<li>
						<a href="<?php print path("users/logout/forums"); ?>" title="<?php print __(_("Logout")); ?>"><?php print __(_("Logout")); ?></a>
					</li>
				</ul>
			</div>
	<?php 
		} else { 
	?>
			<p class="welcome">
				<?php print __(_("Welcome to the forums of")); ?> 
				<?php print _webName; ?>, <?php print __(_("please login to enjoy the forums or register if you don't have an account")); ?>.
			</p>
		
			<div class="options">
				<ul>
					<li class="main"><?php print __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li><a href="<?php print path("forums"); ?>" title="<?php print __(_("Back")); ?>!"><?php print __(_("Forums")); ?></a></li>
					<li>
						<a class="signIn" href="<?php print path("users/login/forums"); ?>" title="<?php print __(_("Login")); ?>">
							<?php print __(_("Login")); ?>
						</a>
					</li>
					<li>
						<a class="signUp" href="<?php print path("users/register/forums"); ?>" title="<?php print __(_("Sign up")); ?>">
							<?php print __(_("Sign up")); ?>
						</a>
					</li>
				</ul>
			</div>
	<?php 
		} 
	?>
</div>

<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php print $forum["Forum_Title"]; ?></span>
		</caption>
		
		<thead>
			<tr>
				<th class="first"><?php print __(_("Topic") ."/". __(_("Author")); ?></th>
				<th class="second"><?php print __(_("Last Message")); ?></th>
				<th class="third"><?php print __(_("Replies")); ?></th>
				<th class="fourth"><?php print __(_("Visits")); ?></th>
				<?php 
					if(SESSION("ZanUserID")) { 
				?>
						<th class="fifth"><?php print __(_("Actions")); ?></th>
				<?php 
					} 
				?>
			</tr>
		</thead>

		<tbody>
		<?php 
			if($topics) {
				$j = 0; 
				
				foreach($topics as $topic) { 
		?>
					<tr class="rows <?php print ($j % 2 === 0) ? "odd" : "even"; ?>">
						<td class="first">
							<span class="forumTitle">
								<a title="<?php print $topic["Title"]; ?>" href="<?php print path("forums/". segment(2) ."/". $topic["ID"]); ?>">
									<?php print $topic["Title"]; ?>
								</a>
							</span>
							
							<br />

							<div class="forumDesc">
								<a title="<?php print $topic["Author"]?>" href="<?php print path("users/profile/". $topic["Author_ID"]; ?>">
									<?php print $topic["Author"]?>
								</a>
							</div>
						</td>

						<td class="second">
						<?php 
							if($topic["Count"] === 0) { 
						?>
								<span class="postDate"><?php print $topic["Last_Reply"]; ?></span>
						<?php 
							} else { 
						?>
								<span class="forumTitle">
									<a title="<?php print $topic["Last_Title"]; ?>" href="<?php print $topic["Last_URL"]; ?>">
										<?php print $topic["Last_Title"]; ?>
									</a>
								</span>
								
								<span class="postAuthor"> 
									<?php print __(_("written by")); ?> 
									
									<a title="<?php print $topic["Last_Author"]?>" href="<?php print path("users/profile/". $topic["Last_Author_ID"]); ?>">
										<?php print $topic["Last_Author"]?>
									</a>.
								</span>
								
								<br />
								
								<span class="postDate"><?php print howLong($topic["Last_Start"]); ?></span>
						<?php 
							} 
						?>
						</td>
						
						<td class="third"><span class="forumNumbers"><?php print $topic["Count"]; ?></span></td>
						<td class="fourth"><span class="forumNumbers"><?php print $topic["Visits"]; ?></span></td>
						
						<?php 
							if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $topic["Author_ID"])) { 
						?>
								<td class="fifth">
									<div class="actionbutton">
										<a title="<?php print __(_("Edit")); ?>" onclick="return confirm('<?php print __(_("Do you want to edit the topic?")); ?>');" href="<?php print $topic["editURL"]; ?>" class="ui-icon ui-icon-pencil">
											<span class="hide">Edit</span>
										</a>
									</div>
							
									<div class="actionbutton">
										<a title="<?php print __(_("Delete")); ?>" onclick="return confirm('<?php print __(_("Do you want to delete the topic?")); ?>');" href="<?php print $topic["deleteURL"]; ?>" class="ui-icon ui-icon-trash">
											<span class="hide">Delete</span>
										</a>
									</div>
								</td>
						<?php 
							} elseif(SESSION("ZanUserID")) { 
						?>
								<td class="fifth">
									<div class="actionbutton">
										<a href="<?php print $topic["replyURL"]; ?>" title="<?php print __(_("Reply")); ?>" class="ui-icon ui-icon-arrowreturnthick-1-w"></a>
										<span class="hide">Reply</span>
									</div>
									
									<div class="actionbutton">
										<a href="<?php print $topic["topicURL"]; ?>" title="<?php print __(_("New topic")); ?>" class="ui-icon ui-icon-plusthick"></a>
										<span class="hide">Topic</span>
									</div>
								</td>
						<?php 
							}
						?>
					</tr>
					<?php $j++; 
				} 
			} else { ?>
			<?php 
				if(SESSION("ZanUserID")) { 
			?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5">
							<?php print __(_("There are no topics, be the first!")); ?> 
							
							<a class="newTopic" href="<?php print path("forums/". $forum["Forum_Nice"] ."/new"); ?>" title="<?php print __(_("Post a topic!")); ?>">
								<?php print __(_("Post a topic!")); ?>
							</a>
						</td>
					</tr>
			<?php 
				} else { 
			?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5">
							<?php print __(_("There are no topics, be the first! but first")); ?>:  
							
							<a class="signIn" href="<?php print path("users/login/forums"); ?>" title="<?php print __(_("Login")); ?>">
								<?php print __(_("Login")); ?>
							</a> 
							
							<a class="signUp" href="<?php print path("users/register/forums"); ?>" title="<?php print __(_("Sign up")); ?>">
								<?php print __(_("Sign up")); ?>
							</a>
						</td>
					</tr>
			<?php 
				} 
			?>
		<?php 
			} 
		?>
		</tbody>		
	</table>
</div>

<div class="forumsFooter">
	<div class="privileges">
		<p class="footerTitle"><?php print __(_("Extra information")); ?>.</p>
		
		<img src="<?php print $avatar; ?>" title="<?php print ((SESSION("ZanUser")) ? SESSION("ZanUser") : __(_("Sign up, please") ."")); ?>" alt="<?php print __(_("A user avatar")); ?>" />
		
		<?php 
			if(SESSION("ZanUserID")) { 
		?>
			<?php 
				if(SESSION("ZanUserPrivilege") === "Super Admin") { 
			?>
					<p class="<?php print (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
						<?php print __(_("Hi there!, ")); ?> 
						
						<a href="<?php print path("users" . _sh . "editprofile" . _sh; ?>" title="<?php print SESSION("ZanUser")); ?>">
							<?php print SESSION("ZanUser")); ?>
						</a>. <br /> 

						<?php print __(_("Here are your statistics")); ?>: <br />
						
						<ul class="userStatistics">
							<li><strong><?php print __(_("Topics")); ?>:</strong>  <?php print $stats[0]["Topics"];  ?></li>
							<li><strong><?php print __(_("Replies")); ?>:</strong> <?php print $stats[0]["Replies"]; ?></li>
							<li><strong><?php print __(_("Visits")); ?>:</strong>  <?php print $stats[0]["Visits"];  ?></li>
						</ul>
					</p>
				
					<ul class="lsprivileges2">
						<li>
							<?php print __(_("You can")); ?> 
							<a href="<?php print path("cpanel" . _sh . "forums" . _sh . "action" . _sh . "save"); ?>" title="<?php print __(_("Create Forums")); ?>">
								<?php print __(_("create")); ?>
							</a> <?php print __(_("new forums")); ?>.
						</li>
						<li><?php print __(_("You can create new topics")); ?>.</li>
						<li><?php print __(_("You can reply to topics")); ?>.</li>
						<li><?php print __(_("You can send private messages")); ?>.</li>
					</ul>
			<?php 
				} elseif(SESSION("ZanUserPrivilege") === "Member") { 
			?>
					<p class="<?php if(SESSION("ZanUserMethod")) { print "onlineUserInfo2"; } else { print "onlineUserInfo"; } ?>"><?php print __(_("Hi there!, ")); ?> <a href="<?php print path("users" . _sh . "editprofile" . _sh; ?>" title="<?php print SESSION("ZanUser")); ?>"><?php print SESSION("ZanUser")); ?></a>. <br /> <?php print __(_("Here are your statistics")); ?>: <br />
						<ul class="userStatistics">
							<li><strong><?php print __(_("Topics")); ?>:</strong>  <?php print $stats[0]["Topics"];  ?></li>
							<li><strong><?php print __(_("Replies")); ?>:</strong> <?php print $stats[0]["Replies"]; ?></li>
							<li><strong><?php print __(_("Visits")); ?>:</strong>  <?php print $stats[0]["Visits"];  ?></li>
						</ul>
					</p>
				
					<ul class="lsprivileges2">
						<li class="noprivilege"><?php print __(_("You can <strong>NOT</strong> create new forums")); ?>.</li>
						<li><?php print __(_("You can create new topics")); ?>.</li>
						<li><?php print __(_("You can reply to topics")); ?>.</li>
						<li><?php print __(_("You can send private messages")); ?>.</li>
					</ul>
			<?php 
				} 
			?>
		<?php 
			} else { 
		?> 
				<p class="noUserInfo">
					<?php print __(_("Hi there!, you should")); ?> 
					<a class="signIn" href="<?php print path("users/login/forums"); ?>" title="<?php print __(_("Login")); ?>"><?php print __(_("login")); ?></a> 
					<?php print __(_("to enjoy full access to the forums")); ?>.
					<br />
					<?php print __(_("If you don't have an account, you can create it")); ?> 
					<a class="signUp" href="<?php print path("users/register/forums"); ?>" title="<?php print __(_("Sign up")); ?>"><?php print __(_("here")); ?></a>.
				</p>
			
				<ul class="lsprivileges">
					<li class="noprivilege"><?php print __(_("You can <strong>NOT</strong> create new forums")); ?>.</li>
					<li class="noprivilege"><?php print __(_("You can <strong>NOT</strong> create new topics")); ?>.</li>
					<li class="noprivilege"><?php print __(_("You can <strong>NOT</strong> reply to topics")); ?>.</li>
					<li class="noprivilege"><?php print __(_("You can <strong>NOT</strong> send private messages")); ?>.</li>
				</ul>
		<?php 
			} 
		?>
	</div>
	
	<div class="lastUsers">
		<p class="footerTitle"><?php print __(_("Last registered users")); ?>.</p>
		
		<ol>
		<?php 
			foreach($users as $user) { 
		?>
				<li>
					<a href="<?php print path("users/profile/". $user["ID_User"]); ?>" title="<?php print $user["Username"]; ?>">
						<?php print $user["Username"]; ?>
					</a>
				</li>
		<?php 
			} 
		?>
		</ol>
	</div>
	
	<div class="clear"></div>
</div>