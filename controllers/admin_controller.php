<?php

// Permissions
$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";

// Models
require_once('models/user_model.php');
require_once('models/permissions_model.php');
require_once('models/articles_model.php');


// Utils
require('utils/admin_utils.php');


// Show login page
function show_login($route, $lang) {
	$route_elements = explode('/', $route);
	if(in_array('fail', $route_elements)){
		$fail = true;
	}

	require('views/admin/login_view.php');
}


// Show admin main menu
function show_admin_index($route, $lang){
	// If no session
	if(!isset($_SESSION['id'])) {
		header("Location: /{$lang}/admin/login");
	}

	require('views/admin/index_view.php');
}



function disconnect($route, $lang){
	session_destroy();
	header("Location: /{$lang}/admin/login");
}


function show_writing_article_interface($route, $lang){
	// Get the global var
	global $CREATE_ARTICLE_PERM;

	if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		require('views/admin/articles/write_article_view.php');
	}
	else {
		header("Location: /{$lang}/admin");
	}
}


// Display article
function show_article($route, $lang, $P=false){
	if($P == false || empty($P)){
		if(isset($_SESSION['article']) && isset($_SESSION['article_title'])) {
			$article_content = load_article($_SESSION['article']);
			$article_title = $_SESSION['article_title'];
			require('views/admin/articles/show_article_view.php');
		}
		else{
			header("Location: /{$lang}/admin/articles/write");
		}
	}
	else {
		$_SESSION['article'] = $P['article_content'];
		$_SESSION['article_title'] = $P['title'];

		header("Location: /{$lang}/admin/articles/show");	
	}
	
}


// Verify article and save it in database
function verify_article($route, $lang, $P){
	// If no post data
	if(!isset($P) || empty($P)){
		header("Location: /{$lang}/admin/articles/write");
	}

	// If data is missing
	if(!isset($P['title']) || empty($P['title']) || !isset($P['article_content']) || empty($P['content'])) {
		header("Location: /{$lang}/admin/articles/write");
	}

	$article_manager = new ArticleManager();
	try {
		$article_manager->create_article($P['title'], $P['article_content']);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e) {
		header("Location: /{$lang}/admin/article/write");
	}
}


// Verify login credentials and store informations like sessions
function verify_login($route, $lang, $P=false){
	try{
		if($P == false){
			throw new Exception('[verify_login] no post data');
		}
		if(!isset($P['email']) || !isset($P['password']) || empty($P['email']) || empty($P['password'])) {
			throw new Exception('[verify_login] data is missing');
		}

		$user_manager = new UserManager();

		$result = $user_manager->get_user_informations($P['email']);

		$password = $result[4];

		if(password_verify($P['password'], $password)){
			$_SESSION['id'] = $result[0];
			$_SESSION['firstname'] = $result[1];
			$_SESSION['lastname'] = $result[2];
			$_SESSION['email'] = $result[3];

			load_permissions($_SESSION['id']);

			header("Location: /{$lang}/admin");
		}
		else {
			throw new Exception('[verify_login] Incorrect password');
		}
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/login/fail");
	}
}


?>