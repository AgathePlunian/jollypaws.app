<?php
	function show_index($lang){
		$route = '';
		require('views/vitrine/index_view.php');
	}

	function show_approche($route, $lang){
		require('views/vitrine/approche_view.php');
	}

	function show_equipe($route, $lang){
		require('views/vitrine/equipe_view.php');
	}

	function show_contact($route, $lang){
		require('views/vitrine/contact_view.php');
	}

	function show_contact_result($route, $lang){
		// Check if success or failure
		$route_elements = explode('/', $route);
		$i = 0;
		$index = array_search('result', $route_elements);
		
		if ($index == false){
			header('Location: /');
		}
		$index++;

		if ($route_elements[$index] == "success"){
			$success = true;
		}
		elseif($route_elements[$index] == "fail"){
			$success = false;
		}

		require('views/vitrine/contact_view.php');
	}


	function show_confidentialite($route, $lang){
		require('views/vitrine/confidentialite_view.php');
	}


	function show_cookies($route, $lang){
		require('views/vitrine/cookies_view.php');
	}

	function show_mentions_legales($route, $lang){
		require('views/vitrine/mentions_legales_view.php');
	}

?>