<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	session_start();

	// Import controllers codes
	require('controllers/vitrine_controller.php');
	require('controllers/error_controller.php');
	require('controllers/controller_contact.php');
	require('controllers/admin_controller.php');


	// functions to read routes
	require('utils/router_utils.php');


	// All routes and names of associated functions
	$route_list = [
		["~^approche$~", 'show_approche'],
		["~^equipe$~", 'show_equipe'],
		["~^confidentialite$~", 'show_confidentialite'],
		["~^cookies$~", 'show_cookies'],
		["~^mentions-legales$~", 'show_mentions_legales'],

		["~^contact$~", 'show_contact'],
		["~^contact/form$~", 'register_contact'],
		["~^contact/result/[a-z]*~", 'show_contact_result'],
		
		["~^unsubscribe/secret/.*~", 'unsubscribe_newsletter'],
		["~^unsubscribe/result/[a-z]*~", 'show_unsubscribe_result'],

		["~^admin/login$~", 'show_login'],
		["~^admin/login/fail$~", 'show_login'],
		["~^admin/login/verify$~", 'verify_login'],
		
		["~.*~", 'error_not_found'],
	];

	$lang_list = [
		'fr',
		'en',
	];
	
	get_route($route_list, $lang_list);
	
?>