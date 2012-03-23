<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 

$ID_Application = 3;
$ID_Record      = $ID_Post;
$comment        = recoverPOST("comment");
$website        = recoverPOST("website");
$email          = recoverPOST("email");
$name 	        = (SESSION("ZanUser"))   ? NULL   : recoverPOST("name");
$username       = (SESSION("ZanUser"))   ? SESSION("ZanUser")   : NULL;
$ID_User        = (SESSION("ZanUserID")) ? (int) SESSION("ZanUserID") : 0;

?>

<div id="comments-header">
	<span class="comments-header uppercase bold"><?php print __(_("Comments")); ?></span>
</div>

<div id="comments">
	<?php if($dataComments) { ?>
		<?php foreach($dataComments as $comment) { ?>
			<div class="comment">
			
				<div class="comment-date">
					<p><?php print $comment["Text_Date"];?></p>
				</div>
					
				<div class="comment-user">
					<?php if($comment["ID_User"] == 0) { ?>	
							<p><a href="http://<?php print $comment["Website"];?>"><?php print $comment["Name"]; ?></a></p>
					<?php } else { ?>
							<p><a href="<?php print $comment["Website"];?>"><?php print $comment["Username"]; ?></a></p>
					<?php } ?>
				</div>
					
				<div class="clear"></div>
					
				<div class="comment-user-avatar">
					<img class="avatar" src="#" alt="<?php print $comment["Username"]; ?>" />
				</div>
			
				<div class="comment-content">
					<p class="comment-message"><?php print nl2br($comment["Comment"]);?></p>
				</div>
				
				<div class="clear"></div>
				
			</div>
				
		<?php } ?>	
	<?php } else { ?> 
		<div class="empty-comments">
			<p><?php print __(_("There are no comments for this post.Be the first to leave a comment!")); ?></p>
		</div>
	<?php } ?>
</div>

<a name="post"></a>
<?php print ($alert) ? $alert : NULL; ?>

<div class="" id="comment-post">
	<div class="add-form">
		<form id="form-add" class="form-add" action="<?php print $URL; ?>/#post" method="post" enctype="multipart/form-data">
				
			<?php 
				if($ID_User > 0) { 
			?>
					<p class="field">
						<a href="#"><?php print $username; ?></a>
					</p>
			<?php 
				} else { 
			?>
					<p class="field">
						<label for="name"><?php print __(_("Name"));?>: </label> <br />
						<input type="text" name="name" id="name" value="<?php print $name; ?>" maxlength="40" />
					</p>
					
					<p class="field">
						<label for="email"><?php print __(_("Email"));?>: </label> <br />
						<input type="text" name="email" id="email" value="<?php print $email; ?>" maxlength="60" />
					</p>
					
					<p class="field">
						<label for="website"><?php print __(_("Website"));?>: </label> <br />
						<input type="text" name="website" id="website" value="<?php print $website; ?>" maxlength="80" />
					</p>	
			<?php } ?>
				
			<p class="comment-to-post">			
				<textarea class="textarea" name="comment"></textarea>
			</p>
					
			<p class="post">			
				<input type="submit" name="post-comment" value="<?php print __(_("Comment"));?>" />
			</p>
				
			<input name="ID_Application" type="hidden" value="<?php print $ID_Application; ?>" />
			<input name="ID_User" type="hidden" value="<?php print $ID_User; ?>" />
			<input name="URL" type="hidden" value="<?php print $URL; ?>" />
			<input name="ID_Record" type="hidden" value="<?php print $ID_Record; ?>" />

		</form>
	</div>
</div>

<?php
	$vars["redirect"] = $URL;
	$vars["action"]   = $URL;
	
	$this->view("twitter", "twitter", $vars);
