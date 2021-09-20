<?php
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Footer
	require("templates/elements/{$lang}/footer.php");

	// Banner
	$banner = '';
	
	// Content
	require("views/admin/index/fr/index.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');
?>