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
	// Load globals perms
	global $CREATE_ARTICLE_PERM;
	
	// If no session
	if(!isset($_SESSION['id'])) {
		header("Location: /{$lang}/admin/login");
	}

	$article_manager = new ArticleManager();

	// Load all redacted articles
	if (in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		$list_articles = $article_manager->list_articles_by_user_id($_SESSION['id']);
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
function show_article($route, $lang, $P=false, $F=false){
	// If there's no new image, F = false
	if(empty($F['main_picture']['name'])){
		$F = false;
	}

	// If no post data (second time this function is called)
	if($P == false || empty($P)){
		// Check if we got every information needed to display the article
		if(isset($_SESSION['article']) && isset($_SESSION['article_title'])) {
			$article_content = load_article($_SESSION['article']);
			$article_title = $_SESSION['article_title'];
			$article_main_image = $_SESSION['article_main_image'];
			require('views/admin/articles/show_article_view.php');
		}
		else{
			header("Location: /{$lang}/admin/articles/write");
		}
	}
	// If post data (first time this function is called), 
	// load the data then call itself without sending data with post
	else {
		$_SESSION['article'] = $P['article_content'];
		$_SESSION['article_title'] = $P['title'];


		if(!isset($_SESSION['article_main_image']) && $F != false)  {
			$_SESSION['article_main_image'] = load_image($F, 'main_picture');
		}
		elseif(isset($_SESSION['article_main_image']) && $F != false && basename($_SESSION['article_main_image']) != $F['main_picture']['name']){
			$_SESSION['article_main_image'] = load_image($F, 'main_picture');
		}
		elseif(!isset($_SESSION['article_main_image']) && $F == false) {
			$_SESSION['article_main_image'] = '';
		}

		header("Location: /{$lang}/admin/articles/show");
	}
	
}


// Verify article and save it in database
function verify_article($route, $lang, $P, $F=false){

	// If there's no post data
	if(!isset($P) || empty($P)){

		#### NEED TO MAKE FAILURE MESSAGE ####
		header("Location: /{$lang}/admin");
	}

	// If data is missing
	if(!isset($P['title']) || empty($P['title']) || !isset($P['article_content']) || empty($P['content'])) {
		
		#### NEED TO MAKE FAILURE MESSAGE ####
		header("Location: /{$lang}/admin");
	}


	// Test if image sumbited or in session
	if(isset($F['main_picture']) && !empty($F['main_picture']['name'])){
		// If old image saved
		if(isset($_SESSION['article_main_image'])){
			unlink($_SESSION['article_main_image']);
			unset($_SESSION['article_main_image']);
		}

		$image = load_image($F, 'main_picture');
	}
	elseif(isset($_SESSION['article_main_image'])){
		// If there's no new image but there's already one
		$image = $_SESSION['article_main_image'];
	}
	else{
		$image = null;
	}


	// Save the article in database
	$is_save_success = false;
	$article_manager = new ArticleManager();
	try {
		$article_manager->create_article($_SESSION['id'], $P['title'], $P['article_content'], $image);
		$is_save_success = true;
	}
	catch(Exception $e) {
		// #### NEED TO MAKE FAILURE MESSAGE ####
		header("Location: /{$lang}/admin");
	}
	

	// If article is correctly saved in database
	if($is_save_success == true){

		// Unset old session vars
		if(isset($_SESSION['article'])){
			unset($_SESSION['article']);
		}
		if(isset($_SESSION['article_title'])){
			unset($_SESSION['article_title']);
		}
		if(isset($_SESSION['article_main_image'])){
			unset($_SESSION['article_main_image']);
		}

		// #### NEED TO MAKE SUCCESS MESSAGE ####
		header("Location: /{$lang}/admin");
	}
}


// Verify login credentials and store informations like sessions
function verify_login($route, $lang, $P=false, $F=false){
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