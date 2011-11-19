<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php print $this->getTitle(); ?></title>
	
	<?php 
		print $this->themeCSS("cpanel"); 
    	
		$this->CSS("prettyPhoto", "videos"); 
		$this->CSS("ads", "ads"); 
	
	 	print $this->getCSS();
	
		print $this->js("jquery", NULL, NULL, TRUE); 
		print $this->js("js/jquery.prettyPhoto", "videos", NULL, TRUE); 
	?>
	
	<script type="text/javascript">
		var PATH = "<?php print _webBase . _sh . _webLang; ?>";
		
		var URL  = "<?php print _webURL; ?>";
	</script>
</head>

<body>
	<?php
		if(isset($isAdmin) and $isAdmin) {
		?>
			<div id="top-bar">
				<?php
					$li[] = a("&lsaquo;&lsaquo;" . __("Go back"), _webBase);
					$li[] = " | " . span("bold", __("Welcome")).": " . SESSION("ZanUser");
					$li[] = " | " . span("bold", __("Online users")) . ": $online";
					$li[] = " | " . span("bold", __("Registered users")) . ": $registered";
					$li[] = " | " . span("bold", __("Last user")) . ": " . a($lastUser["Username"], _webBase . _sh . _webLang .  "/users/editprofile/");
					$li[] = " | " . a(__("Logout")."&rsaquo;&rsaquo;", _webBase . _sh . _webLang . "/cpanel/logout/")."";			
					
					print ul($li);				
				?>
			</div>
		<?php
		} else {
		?>
			<div id="top-bar-logout">
				<a href="<?php print _webBase; ?>" title="<?php print __("Go back"); ?>">&lsaquo;&lsaquo; <?php print __("Go back"); ?></a>
			</div>
		<?php		
		}
	?>
	
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="<?php print _webBase . _sh . _webLang . _sh . _cpanel; ?>" title="">
					<img src="<?php print $this->themePath; ?>/images/logo.png" alt="<?php print _MuuCMS; ?>" class="no-border" />
				</a>
			</div>
						
			<?php
				if(isset($isAdmin) and $isAdmin) {
				?>
					<div id="background">
						<div id="notifications">
							<?php 
								if($commentsNotifications > 0) {
									print '	<a href="'. _webBase . _sh . _webLang . _sh . _cpanel . _sh . _comments .'" title="'. __("Comments") .'">
												<img src="'. $this->themePath .'/images/icons/comments.png" alt="'. __("Comments") .'" class="no-border" /> 
												<sup>'. $commentsNotifications .'</sup>
											</a> ';									
								}
								
								if($feedbackNotifications > 0) {
									print '	<a href="'. _webBase . _sh . _webLang . _sh . _cpanel . _sh . _feedback .'" title="'. __("Messages") .'">
												<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __("Feedback") .'" class="no-border" /> 
												<sup>'. $feedbackNotifications .'</sup> 
											</a>';
								}
								
								if($galleryNotifications > 0) {
									print '	<a href="'. _webBase . _sh . _webLang . _sh . _cpanel . _sh . _comments . _sh . _gallery .'" title="'. __("Gallery Comments") .'">
												<img src="'. $this->themePath .'/images/icons/gallery.png" alt="'. __("Gallery") .'" class="no-border" /> 
												<sup>'. $galleryNotifications .'</sup>
											</a>';
								}
							?>
						</div>
					</div>
					
					<div id="route">
						<strong><?php print __("You are in"); ?>:</strong> <?php print routePath(); ?>
					</div>
				<?php
				} else {
				?>
					<br />
				<?php
				}
			?>
		</div>

