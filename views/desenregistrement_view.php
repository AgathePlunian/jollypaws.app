<?php
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Footer
	// require("templates/elements/{$lang}/footer.php");
	$footer = '';

	// Banner
	$banner = '';
	
	// Content
	require("views/desenregistrement/{$lang}/desenregistrement.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');

?>