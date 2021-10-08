<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	ini_set('file_uploads', 'On');
	ini_set('post_max_size', '1000M');
	ini_set('upload_max_filesize', '1000M');
	session_start();

	// Import controllers codes
	require('controllers/vitrine_controller.php');
	require('controllers/error_controller.php');
	require('controllers/controller_contact.php');
	require('controllers/admin_controller.php');

	// Settings
	require('utils/settings.php');


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
		["~^admin/disconnect$~", 'disconnect'],
		["~^admin/users/register$~", 'register_user'],

		["~^admin/articles/show$~", 'show_article'],
		["~^admin/articles/verify$~", 'verify_article'],
		["~^admin/articles/send_for_approval/[0-9]+$~", 'send_article_to_approval'],
		["~^admin/articles/remove_from_approval/[0-9]+$~", 'send_article_back_to_redaction'],
		["~^admin/articles/change_approbation/[0-9]+$~", 'manage_approbation'],
		["~^admin/articles/publish/[0-9]+$~", 'publish_article'],
		["~^admin/articles/unpublish/[0-9]+$~", 'unpublish_article'],
		["~^admin/new_article$~", 'new_article'],
		["~^admin/edit_article/[0-9]+$~", 'show_admin_index'],
		["~^admin/recover/[0-9]+$~", 'recover_article_from_trash'],
		["~^admin/trash/[0-9]+$~", 'put_article_in_trash'],
		
		["~^admin$~", 'show_admin_index'],

		["~^article/show/[0-9]+$~", 'display_article'],
		
		["~.*~", 'error_not_found'],
	];

	$lang_list = [
		'fr',
		'en',
	];
	
	get_route($route_list, $lang_list);



	/* #### TODO ####

	admin_controller.php :
		Need to make success and failure message when saving an article in database




	*/
?>