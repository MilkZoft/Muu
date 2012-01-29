<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>
<!DOCTYPE html>
<html lang="<?php print _webLang; ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php print $this->getTitle(); ?></title>
	
	<link href="<?php print _webURL ."www/lib/css/frameworks/bootstrap/bootstrap.min.css"; ?>" rel="stylesheet">

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
	<div class="content">
     	<div class="row bg-white" title="header">
		<?php 	
			if(isset($isAdmin) and $isAdmin) { 
		?>
				<div id="top-bar">
					<?php
						$li[] = a("&lsaquo;&lsaquo;" . __(_("Go back")), _webBase);
						$li[] = " | " . span("bold", __(_("Welcome"))) .": " . SESSION("ZanUser");
						$li[] = " | " . span("bold", __(_("Online users"))) . ": $online";
						$li[] = " | " . span("bold", __(_("Registered users"))) . ": $registered";
						$li[] = " | " . span("bold", __(_("Last user"))) . ": " . a($lastUser["Username"], _webBase . _sh . _webLang .  "/users/editprofile/");
						$li[] = " | " . a(__(_("Logout")) . "&rsaquo;&rsaquo;", _webBase . _sh . _webLang . "/cpanel/logout/")."";			
							
						print ul($li);				
					?>
				</div>
		<?php 	
			} else { 
		?>
				<div id="top-bar-logout">
					<a href="<?php print _webBase; ?>" title="<?php print __(_("Go back")); ?>">&lsaquo;&lsaquo; <?php print __(_("Go back")); ?></a>
				</div>
		<?php	
			} 
		?>
	
		<div id="container">
			<div id="header">
				<div id="logo">
					<a href="<?php print _webBase . _sh . _webLang . "/cpanel"; ?>" title="">
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
										print '	<a href="'. _webBase . _sh . _webLang . "/cpanel/comments" .'" title="'. __(_("Comments")) .'">
													<img src="'. $this->themePath .'/images/icons/comments.png" alt="'. __(_("Comments")) .'" class="no-border" /> 
													<sup>'. $commentsNotifications .'</sup>
												</a> ';									
									}
									
									if($feedbackNotifications > 0) {
										print '	<a href="'. _webBase . _sh . _webLang . "/cpanel/feedback" .'" title="'. __(_("Messages")) .'">
													<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __(_("Feedback")) .'" class="no-border" /> 
													<sup>'. $feedbackNotifications .'</sup> 
												</a>';
									}
									
									if($galleryNotifications > 0) {
										print '	<a href="'. _webBase . _sh . _webLang . "/cpanel/comments/gallery" .'" title="'. __(_("Gallery Comments")) .'">
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