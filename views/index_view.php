<?php
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Footer
	require("templates/elements/{$lang}/footer.php");

	// Banner
	require("views/index/elements/{$lang}/banner.php");
	
	// Content
	require("views/index/index_{$lang}.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');
	
?>