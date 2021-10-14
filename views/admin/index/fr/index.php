<?php
	global 	
		$CREATE_ARTICLE_PERM, 
		$DELETE_ARTICLE_PERM,
		$APPROVE_ARTICLE_PERM,
		$CREATE_ACCOUNT_PERM,
		$PUBLISH_ARTICLE_PERM,
		$MANAGE_CATEGORIES_PERM;


	ob_start();

	echo "
		<a class='btn-disconnect btn-empty-secondary' href='/{$lang}/admin/disconnect'> Se déconnecter </a>
	";

	echo '
	<div class="container-admin">
		<div class="menu-lateral-admin">';

		if(in_array($CREATE_ACCOUNT_PERM, $_SESSION['permissions'])){
			require('views/admin/index/fr/sections/register_user.php');

			$register_link = "
				<button class='button_view menu-link' id='register_user'>
					+ Ajouter un utilisateur
				</button> 
			";

			echo $register_link;
		}
		
		// Création & modification des articles
		if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			require('views/admin/index/fr/sections/write_article.php');
			require('views/admin/index/fr/sections/list_articles.php');


			$writing_article_link = "<button class='button_view menu-link' id='write_article' editing='{$editing}'>+ Rédiger un article</button>";

			$list_articles_link ="<a class='button_view menu-link' id='list_articles'>Mes articles en cours</a>";

			if($editing == true){
				$writing_article_link = "
					<a href='/{$lang}/admin/new_article' class='menu-link' id='button_write_article'>+ Rédiger un article </a>";
			}

			echo $writing_article_link;
			echo $list_articles_link;
		}


		// Articles en cours de validation
		if(in_array($APPROVE_ARTICLE_PERM, $_SESSION['permissions'])){
			require ('views/admin/index/fr/sections/waiting_articles.php');

			$waiting_link = "
				<a class='button_view menu-link' id='waiting_articles'> 
					Articles en attente d'approbation
				</a>
			";

			echo $waiting_link;
		}


		// Articles publiés
		if(in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
			require ('views/admin/index/fr/sections/published_articles.php');

			$published_link = "
				<a class='button_view menu-link' id='published_articles'> 
					Articles publiés
				</a>
			";

			echo $published_link;
		}


		// Articles en cours de suppression
		if(in_array($DELETE_ARTICLE_PERM, $_SESSION['permissions'])){
			require('views/admin/index/fr/sections/trash.php');


			$trash_link = "<a class='button_view menu-link' id='trash_articles'>Corbeille des articles</a>";

			echo $trash_link;
		}


		// Manage categories
		if(in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
			require('views/admin/index/fr/sections/manage_categories.php');

			$categories_link = "<a class='button_view menu-link' id='manage_categories'>Gérer les catégories</a>";

			echo $categories_link;
		}

		echo'</div>';

?>
		<section id='main_section'>
		<?php
			global 
				$CREATE_ARTICLE_PERM, 
				$DELETE_ARTICLE_PERM,
				$APPROVE_ARTICLE_PERM,
				$CREATE_ACCOUNT_PERM,
				$PUBLISH_ARTICLE_PERM;

			// Ecriture d'article
			if (in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
				echo $write_article;
				echo $list_articles;
			}

			if (in_array($DELETE_ARTICLE_PERM, $_SESSION['permissions'])){
				echo $trash;
			}

			if(in_array($APPROVE_ARTICLE_PERM, $_SESSION['permissions'])){
				echo $waiting;
			}

			if(in_array($CREATE_ACCOUNT_PERM, $_SESSION['permissions'])){
				echo $register;
			}

			if(in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
				echo $published;
			}

			// Manage categories
			if(in_array($MANAGE_CATEGORIES_PERM, $_SESSION['permissions'])){
				echo $manage_categories;
			}
		?>
		</section>
	</div>
<script>


	window.onload = function(){

		let currentArticle = document.getElementsByClassName("menu-link");
		
		for (var i = 0; i < currentArticle.length; i++) {
  		  currentArticle[i].addEventListener('click', onClickLinkBG);
		}

		function onClickLinkBG(e){
			for (var i = 0; i < currentArticle.length; i++) {
  		 	 currentArticle[i].classList.remove("link-selected");
		}
			e.target.classList.add("link-selected");
		}

		// Associate button to the section to display
		var button_association = new Object();
		button_association["write_article"] = "write_article_view";
		button_association['list_articles'] = 'list_articles_view';
		button_association['trash_articles'] = 'trash_articles_view';
		button_association['waiting_articles'] = 'waiting_articles_view';
		button_association['published_articles'] = 'published_articles_view';
		button_association['register_user'] = 'register_user_view';
		button_association['manage_categories'] = 'manage_categories_view';

		var url = window.location.href;

		var route_elements = url.split('/');


		// Changing displayed element depending on the route
		if(route_elements.includes('new_article') || route_elements.includes('edit_article')) {
			change_view('write_article');
		}
		else if(route_elements.includes('my_articles')){
			change_view('list_articles');
		}
		else if(route_elements.includes('manage_categories')){
			change_view('manage_categories');
		}


		// Add event listener on every button
		var views_buttons = document.getElementsByClassName('button_view');
		for(var i = 0; i < views_buttons.length; i++){
			views_buttons[i].addEventListener('click', click_views_button);
		}
		
		function change_view(id){
			// Clean the main section
			var views = document.getElementsByClassName('view');
			for(var i=0; i < views.length; i++){
				views[i].setAttribute('hidden', 'true');
			}

			// display the view corresponding to the clicked button
			var view_to_display = document.getElementById(button_association[id])
			view_to_display.removeAttribute('hidden');
		}

		function click_views_button(e){
			// Get the button id
			var id = this.getAttribute('id');
			change_view(id);
		}




	}
</script>

<?php
	$content = ob_get_clean();
?>