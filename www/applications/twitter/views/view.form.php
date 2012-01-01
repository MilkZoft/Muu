<div class="form_twitter">
	<form class="form_login_twitter" action="<?php print $action;?>" method="post">
		<p class="comment-to-post">			
			<span><?php print __("Your comment");?>: </span><br />
			<textarea class="textarea" name="comment"></textarea>
		</p>
		
		<p class="post">			
			<input type="submit" name="post-comment" value="<?php print __("Comment");?>" />
		</p>
	</form>
</div>
