<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');

	function get_lang($lang_list){
		if(isset($_GET['lang']) && strlen($_GET['lang']) > 0 && in_array($_GET['lang'], $lang_list)){
			$lang = $_GET['lang'];
		}
		else {
			$lang = 'fr';
		}
		return $lang;
	}


	// Import controllers codes
	require('controllers/user_controller.php');
	require('controllers/error_controller.php');
	require('controllers/controller_contact.php');


	// All routes and names of associated functions
	$route_list = [
		["~^approche$~", 'show_approche'],
		["~^equipe$~", 'show_equipe'],
		["~^contact$~", 'show_contact'],
		["~^contact/form$~", 'register_contact'],
		["~^contact/result/[a-z]*~", 'show_contact_result'],
		["~^unsubscribe/secret/.*~", 'unsubscribe_newsletter'],
		["~^unsubscribe/result/[a-z]*~", 'show_unsubscribe_result'],
		["~^confidentialite$~", 'show_confidentialite'],
		["~^cookies$~", 'show_cookies'],
		["~^mentions-legales$~", 'show_mentions_legales'],
		["~.*~", 'error_not_found'],
	];

	$lang_list = [
		'fr',
		'en',
	];
	
	
	$lang = get_lang($lang_list);

	// If a route is get and if it matches a know route, calls the corresponding function
	if (isset($_GET["route"]) && strlen($_GET['route']) > 0){
		$route = $_GET["route"];
		foreach ($route_list as $r) {
			preg_match($r[0], $route, $matches);

			// If this is a perfect match
			if(isset($matches[0]) && $matches[0] == $route){

				// If data sent with post
				if(empty($_POST)){
					// Execute the function, giving it the route in parameters.
					$r[1]($route, $lang);
					break;
				}
				else {
					// Execute the function, giving it the route and POST data in parameters.
					$r[1]($route, $lang, $_POST);
					break;
				}
			}
		}
	}
	else {
		show_index($lang);
	}
?>