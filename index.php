<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	ini_set('file_uploads', 'On');
	ini_set('post_max_size', '1000M');
	ini_set('upload_max_filesize', '1000M');

	// ini_set('sendmail_path', '/usr/sbin/sendmail-wrapper-php -t -i -F"ResilEyes" -f\'no-reply@resileyes.com\'');
	ini_set('sendmail_path', '/usr/sbin/sendmail-wrapper-php -t -i');
	
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

		["~^admin/articles/verify$~", 'verify_article'],

		["~^admin/articles/send_for_approval/[0-9]+$~", 'send_article_to_approval'],
		["~^admin/articles/remove_from_approval/[0-9]+$~", 'send_article_back_to_redaction'],
		["~^admin/articles/change_approbation/[0-9]+$~", 'manage_approbation'],
		
		["~^admin/articles/publish/[0-9]+$~", 'publish_article'],
		["~^admin/articles/publish/front_page$~", 'manage_articles_front_page'],
		["~^admin/articles/unpublish/[0-9]+$~", 'unpublish_article'],
		
		["~^admin/new_article$~", 'new_article'],
		["~^admin/new_article/write$~", 'new_article'],
		["~^admin/edit_article/[0-9]+$~", 'show_admin_index'],
		["~^admin/recover/[0-9]+$~", 'recover_article_from_trash'],
		
		["~^admin/trash/[0-9]+$~", 'put_article_in_trash'],

		["~^admin/categories/add$~", 'add_category'],
		["~^admin/categories/edit/[0-9]+$~", 'edit_category'],
		["~^admin/categories/delete/[0-9]+$~", 'delete_category'],

		["~^admin/users/[0-9]+/reset_password$~", 'reset_user_password'],
		["~^admin/users/[0-9]+/delete$~", 'delete_user_account'],
		["~^admin/users/[0-9]+/update_perms$~", 'update_user_perms'],
		
		// All redirection routes
		["~^admin/[a-z]+(_[a-z]+)?$~", 'show_admin_index'],

		["~^admin$~", 'show_admin_index'],

		["~^admin/articles/show$~", 'show_article'],
		["~^article/show/[0-9]+/edit$~", 'display_article'],
		["~^article/show/[0-9]+/list$~", 'display_article'],
		["~^article/show/[0-9]+/waiting$~", 'display_article'],
		["~^article/show/[0-9]+/published$~", 'display_article'],
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