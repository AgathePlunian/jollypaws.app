<?php
	function show_index(){
		$route = '';
		require('views/index_view.php');
	}

	function show_approche($route, $lang){
		require('views/approche_view.php');
	}

	function show_equipe($route, $lang){
		require('views/equipe_view.php');
	}

	function show_contact($route, $lang){
		require('views/contact_view.php');
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

		require('views/contact_view.php');
	}

?>