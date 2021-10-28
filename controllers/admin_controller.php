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
			$CREATE_ACCOUNT_PERM,
			$MANAGE_CATEGORIES_PERM,
			$MANAGE_PERMS_PERM,
			$REMOVE_ACCOUNT_PERM,
			$RESET_PASSWORD_PERM;

		
		// If no session
		if(!isset($_SESSION['id'])) {
			header("Location: /{$lang}/admin/login");
		}

		$article_manager = new ArticleManager();
		$category_manager = new CategoryManager();
		$user_manager = new UserManager();
		$permissions_manager = new PermissionsManager();


		/* ####################### PERMISSIONS ########################### */

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
			$articles_approbations = null;
			$articles_approbations = $article_manager->get_articles_approbations();
			$waiting_articles = $article_manager->list_articles_waiting_for_approval();
		}


		// If user can publish articles
		if(in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			$published_articles = $article_manager->list_published_articles();
			$front_page_articles = $article_manager->list_front_page_articles();
			$articles_by_front_page = [];
			foreach($front_page_articles as $front_page_article){
				$articles_by_front_page[$front_page_article['id']] = [
					'id_article' => $front_page_article['id_article'],
					'title' => $front_page_article['title'],
					'firstname' => $front_page_article['firstname'],
					'lastname' => $front_page_article['lastname'],
					'publish_date' => $front_page_article['publish_date'],
					'creation_date' => $front_page_article['creation_date'],
					'main_image' => $front_page_article['main_image'],
				];
			}
		}


		// Can user manage categories
		if(in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])) {
			if(!isset($all_categories)){
				$all_categories = $category_manager->list_all_categories();
			}
		}


		// Manage users accounts
		if(
			in_array($MANAGE_PERMS_PERM, $_SESSION['permissions']) ||
			in_array($REMOVE_ACCOUNT_PERM, $_SESSION['permissions']) ||
			in_array($RESET_PASSWORD_PERM, $_SESSION['permissions'])
		){
			$all_users_accounts = $user_manager->list_users();

			// Manage permissions
			if(in_array($MANAGE_PERMS_PERM, $_SESSION['permissions'])){
				$all_permissions = $permissions_manager->list_permissions();
				$users_permissions = [];
				foreach($all_users_accounts as $account){
					$permissions = $permissions_manager->get_permissions_from_user_id($account['id']);

					$users_permissions[$account['id']] = [];
					foreach($permissions as $perm){
						$users_permissions[ $account['id'] ][] = $perm['name'];
					}
				}
			}
		}


		/* ####################### PERMISSIONS ########################### */
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
		header("Location: /{$lang}/admin/waiting_articles");
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

		header("Location: /{$lang}/admin/list_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}



function define_return_button($route_elements, $lang){
	if(in_array('edit', $route_elements)){
		$return_button = "/{$lang}/admin/edit_article/{$id_article}";
	}
	elseif(in_array('list', $route_elements)){
		$return_button = "/{$lang}/admin/list_articles";
	}
	elseif(in_array('waiting', $route_elements)){
		$return_button = "/{$lang}/admin/waiting_articles";
	}
	elseif(in_array('published', $route_elements)){
		$return_button = "/{$lang}/admin/published_articles";
	}
	elseif(in_array('admin', $route_elements)){
		$return_button = "/{$lang}/admin";
	}
	else{
		$return_button = "/{$lang}/blog";
	}

	return $return_button;
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


		// If unlogged user try to access unpublished article
		if(!isset($_SESSION['id'])){
			$article_manager = new ArticleManager();
			$published_articles = $article_manager->list_published_articles();
			$is_published = false;
			
			foreach($published_articles as $article){
				if($article['id'] == $id_article){
					$is_published = true;
				}
			}
			if(!$is_published){
				throw new Exception('User need to be logged');
			}
		}


		$article_manager = new ArticleManager();
		$article = $article_manager->get_article_content($id_article);

		$category_manager = new CategoryManager();
		$categories = $category_manager->get_article_categories($id_article);

		$article_content = load_article($article['content']);
		$article_title = $article['title'];
		$article_main_image = $article['main_image'];

		$return_button = define_return_button($route_elements, $lang, $id_article);

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


function save_article_data($P, $F=false){
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
			save_article_data($P, $F);

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
			header("Location: /{$lang}/admin/list_articles");
		}
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/list_articles");
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
		header("Location: /{$lang}/admin/trash_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/trash_articles");
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
		header("Location: /{$lang}/admin/list_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/list_articles");
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
		header("Location: /{$lang}/admin/waiting_articles");
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
			$P['password']
		); 


		$permissions_manager = new PermissionsManager();
		$permissions_manager->set_base_permissions($id);
		header("Location: /{$lang}/admin");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


// Publish an article
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
		header("Location: /{$lang}/admin/waiting_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/waiting_articles");
	}
}


// Unpublish an article
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
		header("Location: /{$lang}/admin/published_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/published_articles");
	}
}


// Add a category
function add_category($route, $lang, $P=false){
	global $MANAGE_CATEGORIES_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}

		// Check everything is ok
		if($P == false || !isset($P) || empty($P['category_name'])){
			throw new Exception('[add_category] Missing field');
		}

		$category_manager = new CategoryManager();
		$category_manager->create_category($P['category_name']);

		header("Location: /{$lang}/admin/manage_categories");

	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


function add_category_from_article($route, $lang, $P=false, $F=false){
	global $MANAGE_CATEGORIES_PERM;

	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}
		if($P == false){
			throw new Exception('Data missing');
		}

		save_article_data($P, $F);

		$category_manager = new CategoryManager();
		$category_manager->create_category($P['category_name']);

		header("Location: /{$lang}/admin/write_article");
	}

	catch(Exception $e){
		header("Location: /{$lang}/admin/write_article");
	}
}


// Edit a category
function edit_category($route, $lang, $P=false){
	global $MANAGE_CATEGORIES_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}

		// Check everything is ok
		if($P == false || !isset($P) || empty($P['category_name'])){
			throw new Exception('[add_category] Missing field');
		}

		$route_elements = explode('/', $route);
		$array_id_category = (array_search('edit', $route_elements) != false)? (array_search('edit', $route_elements)+ 1): false;

		if($array_id_category == false){
			throw new Exception('[edit_category] Can\'t find id in route');
		}

		$category_id = $route_elements[$array_id_category];

		$category_manager = new CategoryManager();
		$category_manager->update_category($category_id, $P['category_name']);

		header("Location: /{$lang}/admin/manage_categories");

	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


// Delete a catogery
function delete_category($route, $lang){
	global $MANAGE_CATEGORIES_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}

		$route_elements = explode('/', $route);
		$array_id_category = (array_search('delete', $route_elements) != false)? (array_search('delete', $route_elements)+ 1): false;

		if($array_id_category == false){
			throw new Exception('[delete_category] Can\'t find id in route');
		}

		$category_id = $route_elements[$array_id_category];

		$category_manager = new CategoryManager();
		$category_manager->delete_category($category_id);

		header("Location: /{$lang}/admin/manage_categories");

	}
	catch(Exception $e){
		header("Location: /{$lang}/admin");
	}
}


// Manage articles in front page
function manage_articles_front_page($route, $lang, $P=false){
	global $PUBLISH_ARTICLE_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}


		// Check if data is received
		if($P == false){
			throw new Exception('No post data');
		}

		// Check no missing data
		if(
			!isset($P['fp1-id-article']) ||
			!isset($P['fp2-id-article']) || 
			!isset($P['fp3-id-article']) 
		) {
			throw new Exception('[manage_articles_front_page] data missing');
		}

		$article_manager = new ArticleManager();
		$article_manager->update_articles_front_page([
			1 => $P['fp1-id-article'],
			2 => $P['fp2-id-article'],
			3 => $P['fp3-id-article']
		]);

		header("Location: /{$lang}/admin/published_articles");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/published_articles");	
	}
}


// Generate a new random password to a user
function reset_user_password($route, $lang){
	global $RESET_PASSWORD_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($RESET_PASSWORD_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}


		$route_elements = explode('/', $route);
		$array_id_user = (array_search('users', $route_elements) != false)? (array_search('users', $route_elements)+ 1): false;
		$user_id = $route_elements[$array_id_user];

		$user_manager = new UserManager();
		$user_email = $user_manager->get_user_email($user_id);

		$new_password = bin2hex(random_bytes(12));
		// $new_password = 'plopplop';

		$user_manager->change_user_password($user_id, $new_password);

		// Store the new password in session to display it later
		$_SESSION['new_password'] = [
			'user_id' => $user_id,
			'password' => $new_password,
		];

		send_mail_to_user($user_email, 'Resileyes - password changed', 'New password : '. $new_password);
		
		header("Location: /{$lang}/admin/manage_users");

	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/manage_users");
	}
}


// Delete a user account
function delete_user_account($route, $lang){
	global $REMOVE_ACCOUNT_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($REMOVE_ACCOUNT_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}


		$route_elements = explode('/', $route);
		$array_id_user = (array_search('users', $route_elements) != false)? (array_search('users', $route_elements)+ 1): false;
		$user_id = $route_elements[$array_id_user];

		$user_manager = new UserManager();
		
		$user_manager->remove_user_account($user_id);
		
		header("Location: /{$lang}/admin/manage_users");

	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/manage_users");
	}
}


// Update user perms
function update_user_perms($route, $lang, $P=false){
	global $MANAGE_PERMS_PERM;
	try{
		// Check permissions
		if(!isset($_SESSION['id'])){
			throw new Exception('User need to be connected');
		}
		if(!in_array($MANAGE_PERMS_PERM, $_SESSION['permissions'])){
			throw new Exception('Operation not allowed');
		}

		// Check if post data
		if($P == false){
			throw new Exception('No data sent');
		}

		$route_elements = explode('/', $route);
		$array_id_user = (array_search('users', $route_elements) != false)? (array_search('users', $route_elements)+ 1): false;
		$user_id = $route_elements[$array_id_user];

		$permissions_manager = new PermissionsManager();
		$permissions_manager->set_user_permissions($user_id, $P['permissions']);


		header("Location: /{$lang}/admin/manage_users");
	}
	catch(Exception $e){
		header("Location: /{$lang}/admin/manage_users");
	}
}


?>