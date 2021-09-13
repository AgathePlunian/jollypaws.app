<?php
	$SITE_KEY = "6LfgBd8bAAAAAE_AjPCyOX4VPOcVNFBWP0GfMHic";
	// Menu
	require("templates/elements/{$lang}/menu.php");

	// Header
	require("views/vitrine/contact/header.php");

	// Footer
	require("templates/elements/{$lang}/footer.php");

	// Banner
	$banner = '';
	
	// Content
	require("views/vitrine/contact/{$lang}/contact.php");

	// Load the page, always calls this in last
	require('templates/page_template.php');
?>