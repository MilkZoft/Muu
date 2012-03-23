<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php print $this->getTitle(); ?></title>
	<link rel="stylesheet" href="<?php print path("www/lib/css/default.css", TRUE); ?>" type="text/css">
	<link rel="stylesheet" href="<?php print $this->themePath; ?>/css/fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php print $this->themePath; ?>/css/style.css" type="text/css">
	
	<?php 
		$this->CSS("default");
		$this->CSS("ads", "ads");
	?>

	<?php print $this->getCSS(); ?>
	<?php print $this->js("jquery", NULL, NULL, TRUE); ?>
</head>

<body>
	
	<?php $this->execute("Ads_Controller", "ads", array("Top")); ?>
	
	<div id="container">
		<div id="header">
			<div id="top-bar">
				<img src="<?php print $this->themePath; ?>/images/SofyFace.png" alt="Sofy" class="sofy-face" />
				<img src="<?php print $this->themePath; ?>/images/MilkZoft.png" alt="Powered by MilkZoft" class="milkzoft" />
			</div>

			<div id="logo">
				<h1>ZanPHP Framework v.1.0</h1>
			</div>

			<?php $this->execute("Ads_Controller", "ads", array("Center")); ?>

			<div class="clear"></div>

			<div id="top-menu">
				<ul>
					<li><a href="<?php print path(); ?>" title="<?php print __("Home"); ?>"><?php print __("Home"); ?></a></li>
					<li><a href="<?php print path("pages/downloads"); ?>" title="<?php print __("Downloads"); ?>"><?php print __("Downloads"); ?></a></li>
					<li><a href="<?php print path("documentation", TRUE); ?>" target="_blank" title="<?php print __("Documentation"); ?>"><?php print __("Documentation"); ?></a></li>
					<li><a href="forums" title="<?php print __("Forums"); ?>"><?php print __("Forums"); ?></a></li>
					<li><a href="blog" title="<?php print __("Blog"); ?>"><?php print __("Blog"); ?></a></li>
                    <?php
						if(get("webLang") === "es") {
							print '<li><a href="en" title="English Version">English Version</a></li>';
						} else {
							print '<li><a href="es" title="Versi&oacute;n Espa&ntilde;ol">Versi&oacute;n Espa&ntilde;ol</a></li>';
						}
					?>
				</ul>
			</div>
		</div>

