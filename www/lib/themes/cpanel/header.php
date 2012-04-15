<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>
<!DOCTYPE html>
<html lang="<?php print get("webLang"); ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php print $this->getTitle(); ?></title>
	
	<?php
    	$this->CSS("bootstrap", NULL, TRUE);
		$this->CSS("prettyPhoto", "videos"); 
		$this->CSS("ads", "ads"); 
		$this->CSS("default"); 
	
	 	print $this->getCSS();
		print $this->themeCSS("cpanel"); 
		
		print $this->js("jquery", NULL, NULL, TRUE); 
	?>
	
	<script type="text/javascript">
		var PATH = "<?php print path(); ?>";
		
		var URL  = "<?php print get('webURL'); ?>";
	</script>
</head>

<body>
	<?php
		if($isAdmin) {
		?>
			<div id="top-bar">
				<?php
					$li[] = a("&lsaquo;&lsaquo;". __(_("Go back")), path());
					$li[] = " | ". span("bold", __(_("Welcome"))) .": " . SESSION("ZanUser");
					$li[] = " | ". span("bold", __(_("Online users"))) .": $online";
					$li[] = " | ". span("bold", __(_("Registered users"))) .": $registered";
					$li[] = " | ". span("bold", __(_("Last user"))) .": ". a($lastUser["Username"], path("/users/editprofile/"));
					$li[] = " | ". a(__(_("Logout")) ."&rsaquo;&rsaquo;", path("cpanel/logout/")) ."";			
					
					print ul($li);				
				?>
			</div>
		<?php
		} else {
		?>
			<div id="top-bar-logout">
				<a href="<?php print path(); ?>" title="<?php print __(_("Go back")); ?>">&lsaquo;&lsaquo; <?php print __(_("Go back")); ?></a>
			</div>
		<?php		
		}
	?>
	
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="<?php print path("cpanel"); ?>" title="">
					<img src="<?php print $this->themePath; ?>/images/logo.png" alt="MuuCMS" class="no-border" />
				</a>
			</div>
						
			<?php
				if($isAdmin) {
				?>
					<div id="background">
						<div id="notifications">
							<?php 
								if($commentsNotifications > 0) {
									print '	<a href="'. path("cpanel/comments") .'" title="'. __(_("Comments")) .'">
												<img src="'. $this->themePath .'/images/icons/comments.png" alt="'. __(_("Comments")) .'" class="no-border" /> 
												<sup>'. $commentsNotifications .'</sup>
											</a> ';									
								}
								
								if($feedbackNotifications > 0) {
									print '	<a href="'. path("cpanel/feedback") .'" title="'. __(_("Messages")) .'">
												<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __(_("Feedback")) .'" class="no-border" /> 
												<sup>'. $feedbackNotifications .'</sup> 
											</a>';
								}
								
								if($galleryNotifications > 0) {
									print '	<a href="'. path("cpanel/comments/gallery") .'" title="'. __(_("Gallery Comments")) .'">
												<img src="'. $this->themePath .'/images/icons/gallery.png" alt="'. __(_("Gallery")) .'" class="no-border" /> 
												<sup>'. $galleryNotifications .'</sup>
											</a>';
								}
							?>
						</div>
					</div>
					
					<div id="route">
						<strong><?php print __(_("You are in")); ?>:</strong> <?php print routePath(); ?>
					</div>
				<?php
				} else {
				?>
					<br />
				<?php
				}
			?>
		</div>