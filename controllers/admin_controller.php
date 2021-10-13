<?php

// Permissions
$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";

// Models
require_once('models/user_model.php');
require_once('models/permissions_model.php');
require_once('models/articles_model.php');
require_once('models/categories_model.php');


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


function new_article($route,$lang){
	$route_elements = explode('/', $route);
	if(!in_array('write', $route_elements)){
		unset($_SESSION['article']);
	}
	show_admin_index($route, $lang);
}


// Show admin main menu
function show_admin_index($route, $lang){
	try{
		// Load globals perms
		global 
			$CREATE_ARTICLE_PERM, 
			$DELETE_ARTICLE_PERM, 
			$APPROVE_ARTICLE_PERM,
			$PUBLISH_ARTICLE_PERM,
			$CREATE_ACCOUNT_PERM;

		
		// If no session
		if(!isset($_SESSION['id'])) {
			header("Location: /{$lang}/admin/login");
		}

		$article_manager = new ArticleManager();
		$category_manager = new CategoryManager();

		// if user has rights to write articles
		if (in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			$list_articles = $article_manager->list_articles_by_user_id($_SESSION['id']);
			$all_categories = $category_manager->list_all_categories();

			$route_elements = explode('/', $route);

			$editing = false;
			// Editing an article
			if(in_array('edit_article', $route_elements)){
				$id_index = array_search('edit_article', $route_elements)+1;
				$id = $route_elements[$id_index];

				// Get the list of categories
				$article_categories = $category_manager->get_article_categories($id);
				$article_categories_id_list = array();
				foreach($article_categories as $category){
					$article_categories_id_list[] = $category['id_category'];
				}

				$_SESSION['article'] = $article_manager->get_article_content($id);
				$editing = true;
			}
		}

		// If user has the delete article perm
		if(in_array($DELETE_ARTICLE_PERM, $_SESSION['permissions'])){
			$trashed_articles = $article_manager->list_trashed_articles();		
		}


		// If user can approve articles
		if(in_array($APPROVE_ARTICLE_PERM, $_SESSION['permissions'])){
			$all_articles_list = $article_manager->list_articles_by_user_id($_SESSION['id'], false);
			$articles_id_list = array();
			foreach($all_articles_list as $article){
				$article_id_list[] = $article['id'];
			}
			$waiting_articles = $article_manager->list_articles_waiting_for_approval();
		}


		// If user can publish articles
		if(in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			$published_articles = $article_manager->list_published_articles();
		}


		require('views/admin/index_view.php');
	}
	catch(Exception $e){
		header("Location: /{$lang}/");
	}
}


function send_article_back_to_redaction($route, $lang){
	global $CREATE_ARTICLE_PERM, $APPROVE_ARTICLE_PERM;

	try{
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}

		if(
			!in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])
			||
			!in_array($APPROVE_ARTICLE_PERM, $_SESSION['permissions'])
		) {
			throw new Exception('Operation not allowed');
		}


		// Find article id inside route
		$route_elements = explode('/', $route);
		$id_pos = array_search('remove_from_approval', $route_elements);
		if($id_pos == false){
			throw new Exception('[send_article_back_to_redaction] can not get article id');
		}
		$id_article = $route_elements[$id_pos + 1];


		// Remove article from waiting list
		$article_manager = new ArticleManager();
		if($article_manager->is_user_author($id_article, $_SESSION['id'])){
			$article_manager->remove_article_from_waiting_list($id_article);
		}
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}



function disconnect($route, $lang){
	session_destroy();
	header("Location: /{$lang}/admin/login");
}



// Set an article waiting to approval
function send_article_to_approval($route, $lang){
	try{
		// Check permissions
		global $CREATE_ARTICLE_PERM;
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}

		if(!in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('[send_article_to_approval] Operation not allowed');
		}

		// Separate route elements
		$route_elements = explode('/', $route);
		$id_pos = array_search('send_for_approval', $route_elements);
		if($id_pos == false){
			throw new Exception('[send_article_to_approval] can not get article id');
		}
		$id_article = $route_elements[$id_pos + 1];

		$article_manager = new ArticleManager();
		$article_manager->set_article_waiting_approval($id_article);

		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


// Display an article with article id in the route
function display_article($route, $lang){
	try{
		$route_elements = explode('/', $route);
		$id_pos = array_search('show', $route_elements);
		if($id_pos == false){
			throw new Exception('[display_article] can not get article id');
		}
		$id_article = $route_elements[$id_pos + 1];

		$article_manager = new ArticleManager();
		$article = $article_manager->get_article_content($id_article);

		$category_manager = new CategoryManager();
		$categories = $category_manager->get_article_categories($id_article);

		$article_content = load_article($article['content']);
		$article_title = $article['title'];
		$article_main_image = $article['main_image'];

		if(in_array('edit', $route_elements)){
			$return_button = "/{$lang}/admin/edit_article/{$id_article}";
		}
		else{
			$return_button = "/{$lang}/admin";
		}

		require('views/admin/articles/show_article_view.php');
	}
	catch(Exception $e){
		if(isset($_SESSION['id'])){
			header("Location: /{$lang}/admin");
		}
		else {
			header("Location: /{$lang}/");
		}
	}
}


// Display currently writting article
function show_article($route, $lang, $P=false, $F=false){
	try{
		// If there's no new image, F = false
		if(empty($F['main_picture']['name'])){
			$F = false;
		}

		// If no post data (second time this function is called)
		if($P == false || empty($P)){
			// Check if we got every information needed to display the article
			if(isset($_SESSION['article'])) {
				$category_manager = new CategoryManager();
				$article_content = load_article($_SESSION['article']['content']);
				$article_title = $_SESSION['article']['title'];
				$article_main_image = $_SESSION['article']['main_image'];

				if(!empty($_SESSION['article']['categories'])){
					$categories = $category_manager->get_categories_names_by_id_list($_SESSION['article']['categories']);
				}
				
				$return_button = "/{$lang}/admin/new_article/write";
				
				require('views/admin/articles/show_article_view.php');
			}
			else{
				header("Location: /{$lang}/admin/articles/write");
			}
		}

		// If post data (first time this function is called), 
		// load the data then call itself without sending data with post
		else {
			$_SESSION['article']['content'] = $P['article_content'];
			$_SESSION['article']['title'] = $P['title'];


			if(!isset($_SESSION['article']['main_image']) && $F != false)  {
				$_SESSION['article']['main_image'] = load_image($F, 'main_picture');
			}
			elseif(isset($_SESSION['article']['main_image']) && $F != false && basename($_SESSION['article']['main_image']) != $F['main_picture']['name']){
				$_SESSION['article']['main_image'] = load_image($F, 'main_picture');
			}
			elseif(!isset($_SESSION['article']['main_image']) && $F == false) {
				$_SESSION['article']['main_image'] = '';
			}
			$_SESSION['article']['categories'] = $P['categories'];

			header("Location: /{$lang}/admin/articles/show");
		}
	}
	catch(Exception $e){
		header("Location : /{$lang}/admin");
	}
	
}


// Verify article and save it in database
function verify_article($route, $lang, $P=false, $F=false){
	try{
		// Load globals perms
		global $CREATE_ARTICLE_PERM;

		// if user has rights to write articles
		if (!in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('[verify_article] operation refused');
		}

		if(isset($_SESSION['article']['id'])) {
			$article_manager = new ArticleManager();
			if(!$article_manager->is_user_author($_SESSION['article']['id'], $_SESSION['id'])){
				throw new Exception('Operation not allowed');
			}
		}

		// If there's no post data
		if($P == false || empty($P)){

			#### NEED TO MAKE FAILURE MESSAGE ####
			header("Location: /{$lang}/admin");
		}

		// If data is missing
		if(!isset($P['title']) || empty($P['title']) || !isset($P['article_content']) || empty($P['article_content'])) {
			
			#### NEED TO MAKE FAILURE MESSAGE ####
			header("Location: /{$lang}/admin");
		}




		// Test if image sumbited or in session
		if(isset($F['main_picture']) && !empty($F['main_picture']['name'])){
			// If old image saved
			if(isset($_SESSION['article']['main_image'])){
				unlink($_SESSION['article']['main_image']);
				unset($_SESSION['article']['main_image']);
			}

			$image = load_image($F, 'main_picture');
		}
		elseif(isset($_SESSION['article']['main_image'])){
			// If there's no new image but there's already one
			$image = $_SESSION['article']['main_image'];
		}
		else{
			$image = null;
		}


		// Save the article in database
		$is_save_success = false;
		$article_manager = new ArticleManager();
		try {
			if(isset($_SESSION['article']['id'])) {
				$article_manager->update_article($_SESSION['article']['id'], $P['title'], $P['article_content'], $image);
			}
			else {
				$_SESSION['article']['id'] = $article_manager->create_article($_SESSION['id'], $P['title'], $P['article_content'], $image);
			}

			if(isset($P['categories'])) {
				$category_manager = new CategoryManager();
				$category_manager->add_categories_to_article($_SESSION['article']['id'], $P['categories']);
			}
			$is_save_success = true;
		}
		catch(Exception $e) {
			die($e);
			// #### NEED TO MAKE FAILURE MESSAGE ####
			header("Location: /{$lang}/admin");
		}
		

		// If article is correctly saved in database
		if($is_save_success == true){
			// Unset old session vars
			if(isset($_SESSION['article'])){
				unset($_SESSION['article']);
			}

			// #### NEED TO MAKE SUCCESS MESSAGE ####
			header("Location: /{$lang}/admin");
		}
	}
	catch(Exception $e){
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
			$_SESSION['id'] = $result['id'];
			$_SESSION['firstname'] = $result['firstname'];
			$_SESSION['lastname'] = $result['lastname'];
			$_SESSION['email'] = $result['email'];

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


function recover_article_from_trash($route, $lang){
	try{
		global $DELETE_ARTICLE_PERM;
		if(!in_array($DELETE_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('[recover_article_from_trash] not the permission to recover article');
		}

		$route_elements = explode('/', $route);
		$article_pos = array_search('recover', $route_elements);
		if($article_pos == false){
			throw new Exception('[recover_article_from_trash] wrong route');
		}
		$article_id = $route_elements[$article_pos + 1];

		$article_manager = new ArticleManager();
		$article_manager->recover_article_from_trash($article_id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function put_article_in_trash($route, $lang){
	try{
		global $DELETE_ARTICLE_PERM;
		if(!in_array($DELETE_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('[put_article_in_trash] not the permission to recover article');
		}

		$route_elements = explode('/', $route);
		$article_pos = array_search('trash', $route_elements);
		if($article_pos == false){
			throw new Exception('[put_article_in_trash] wrong route');
		}
		$article_id = $route_elements[$article_pos + 1];

		$article_manager = new ArticleManager();
		$article_manager->set_article_in_trash($article_id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function manage_approbation($route, $lang){
	global $APPROVE_ARTICLE_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($APPROVE_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}
		// Get id from route
		$route_elements = explode('/', $route);
		$article_pos = array_search('change_approbation', $route_elements);
		if($article_pos == false){
			throw new Exception('[manage_approbation] wrong route');
		}
		$article_id = $route_elements[$article_pos + 1];

		$article_manager = new ArticleManager();
		$article_manager->manage_approbation($article_id, $_SESSION['id']);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function register_user($route, $lang, $P=false){
	global $CREATE_ACCOUNT_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($CREATE_ACCOUNT_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}


		// Check if data are missing
		if($P == false){
			throw new Exception('Data are missing');
		}
		if(
			!isset($P['firstname']) 
			|| 
			!isset($P['lastname'])
			||
			!isset($P['email'])
			||
			!isset($P['password'])
		){
			die('toto');
			throw new Exception('Data are missing');
		}
		foreach($P as $field){
			if(empty($field)){
				throw new Exception('Data are missing');
			}
		}

		$user_manager = new UserManager();
		$id = $user_manager->create_user(
			$P['firstname'],
			$P['lastname'],
			$P['email'],
			$P['password'],
		); 


		$permissions_manager = new PermissionsManager();
		$permissions_manager->set_base_permissions($id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function publish_article($route, $lang){
	global $PUBLISH_ARTICLE_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}
		
		// Get id from route
		$route_elements = explode('/', $route);
		$article_pos = array_search('publish', $route_elements);
		if($article_pos == false){
			throw new Exception('[publish_article] wrong route');
		}
		$article_id = $route_elements[$article_pos + 1];


		// Check if article can be published
		$article_manager = new ArticleManager();
		
		// Check if the user can publish the article
		if(!$article_manager->can_article_be_published($article_id, $_SESSION['id'])){
			throw new Exception('Operation not allowed');
		}
		
		$article_manager->publish_article($article_id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function unpublish_article($route, $lang){
	global $PUBLISH_ARTICLE_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}


		// Get id from route
		$route_elements = explode('/', $route);
		$article_pos = array_search('unpublish', $route_elements);
		if($article_pos == false){
			throw new Exception('[unpublish_article] wrong route');
		}
		$article_id = $route_elements[$article_pos + 1];

		$article_manager = new ArticleManager();

		if(!$article_manager->is_article_published($article_id)){
			throw new Exception('Operation not allowed');
		}

		$article_manager->unpublish_article($article_id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		die($e);
		header("Location: /{$lang}/admin");
	}
}


?>