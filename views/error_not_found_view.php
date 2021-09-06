<?php
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Footer
	$footer ='';

	// Banner
	
	$banner = '';
	// Content
	require("views/error_not_found/{$lang}/error_not_found.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');
	
?>