<?php
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Footer
	require("templates/elements/{$lang}/footer.php");

	// Banner
	require("views/vitrine/index/{$lang}/elements/banner.php");
	
	// Content
	require("views/vitrine/index/{$lang}/index.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');
	
?>