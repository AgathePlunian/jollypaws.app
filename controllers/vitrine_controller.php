<?php
	function show_index($lang){
		$route = '';
		require('views/vitrine/index_view.php');
	}

	function show_blog($route, $lang){
		// Initiate managers
		$article_manager = new ArticleManager();
		$category_manager = new CategoryManager();


		// List published articles
		$published_articles = $article_manager->list_published_articles();


		// List front page articles
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
				'content' => $front_page_article['content'],
			];
		}

		// Get categories for every article
		$categories_article = [];
		foreach($published_articles as $article){
			$categories_article[$article['id']] = $category_manager->get_article_categories($article['id']);
		}

		$all_categories = $category_manager->list_all_categories();

		require('views/vitrine/blog_view.php');
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