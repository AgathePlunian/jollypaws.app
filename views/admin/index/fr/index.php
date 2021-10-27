<?php
	global 	
		$CREATE_ARTICLE_PERM, 
		$DELETE_ARTICLE_PERM,
		$APPROVE_ARTICLE_PERM,
		$CREATE_ACCOUNT_PERM,
		$PUBLISH_ARTICLE_PERM,
		$MANAGE_CATEGORIES_PERM,
		$MANAGE_PERMS_PERM,
		$REMOVE_ACCOUNT_PERM,
		$RESET_PASSWORD_PERM;


	ob_start();


	echo '
	<div class="container-admin">
		<div class="menu-lateral-admin">
			<div class="small-menu-lateral-open">
				<p>Menu Admin</p><span id="chevrons-container"><img class="chevron-down" src="../../../images/icones-form/fleche-down-white.png"/><img class="chevron-up" src="../../../images/icones-form/fleche-up-white.png"/></span>
			</div>';

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
					Articles en attente de publication
				</a>
			";

			echo $waiting_link;
		}

		// Main default section
		require('views/admin/index/fr/sections/main_view.php');

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

		// Manage users accounts
		if(
			in_array($MANAGE_PERMS_PERM, $_SESSION['permissions']) ||
			in_array($REMOVE_ACCOUNT_PERM, $_SESSION['permissions']) ||
			in_array($RESET_PASSWORD_PERM, $_SESSION['permissions'])
		){
			require('views/admin/index/fr/sections/list_users.php');

			$users_link = "<a class='button_view menu-link' id='manage_users'>Gérer les comptes utilisateur</a>";

			echo $users_link;
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
				$PUBLISH_ARTICLE_PERM,
				$MANAGE_PERMS_PERM,
				$REMOVE_ACCOUNT_PERM,
				$RESET_PASSWORD_PERM;

			// Display main section
			echo $main;

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

			// Manage users accounts
			if(
				in_array($MANAGE_PERMS_PERM, $_SESSION['permissions']) ||
				in_array($REMOVE_ACCOUNT_PERM, $_SESSION['permissions']) ||
				in_array($RESET_PASSWORD_PERM, $_SESSION['permissions'])
			){
				echo $manage_users;
			}
		?>
		</section>
	</div>
<script>


	window.onload = function(){

		let openMenuChevron = document.getElementById("chevrons-container");

		openMenuChevron.addEventListener('click' , openMenuAdmin);

		function openMenuAdmin() {
			let chevronUp = document.getElementsByClassName("chevron-up")[0];
			let chevronDown = document.getElementsByClassName("chevron-down")[0];
			let menu = document.getElementsByClassName("menu-lateral-admin")[0];

			if (chevronDown.classList.contains("chevron-display")) {
				chevronUp.classList.remove("chevron-no-display");
				chevronDown.classList.remove("chevron-display")
				menu.classList.remove("menu-lateral-display")

			}
			else {
				chevronUp.classList.add("chevron-no-display");
				chevronDown.classList.add("chevron-display");
				menu.classList.add("menu-lateral-display")
			}
		}

		//OUVERTURE MODAL GESTION DES ARTICLES À LA UNE
		let btnManageImportantArticles = document.getElementById("manage-important-articles");
		if(btnManageImportantArticles != null){
			btnManageImportantArticles.addEventListener('click',  openModal);
		}

		function openModal() {
			let mainSection = document.getElementById("published_articles_view");
			let modalArticles = document.createElement("div");
			modalArticles.classList.add("modal-articles-une");
			mainSection.appendChild(modalArticles);
			modalArticles.innerHTML = `
			<div class="modal-header">
				<h3 class="manage-articles-title">Gérer les articles à la une</h3>
				 <span id="btn-close-modal"><img src="/images/icones-form/close.png" alt="close modal"/></span>
				
			</div>
				
				<form action="/<?= $lang ?>/admin/articles/publish/front_page" method="POST">
					<label class="label-manage-article">Article principale</label>
					<select class="first_article_input" name="fp1-id-article">
						<option value="">Sélectionner un article</option>
						<?php
							foreach($published_articles as $article){
								?>

								<option 
									value="<?= $article['id'] ?>"
									<?php
									if(isset($articles_by_front_page['1'])){
										if($article['id'] == $articles_by_front_page['1']['id_article']){
									?>
										selected="true"
									<?php
										}
									}
									?>
									>
									<?=	$article['title'] ?> - 
									Auteur : <?= $article['firstname'] ?> <?= $article['lastname'] ?> - 
									Date de publication : <?= $article['publish_date'] ?>
									
								</option>

								<?php
							}
						?>
					</select>

					<div class="secondaries-articles">
						<div>
							<label class="label-manage-article">Articles secondaire 1</label>
							<select name="fp2-id-article" >
								<option value="">Sélectionner un article</option>
								<?php
									foreach($published_articles as $article){
										?>

										<option 
											value="<?= $article['id'] ?>"
										<?php
										if(isset($articles_by_front_page['2'])){
											if($article['id'] == $articles_by_front_page['2']['id_article']){
										
										?>
											selected
										<?php
											}
										}
										?>
										>
											<?=	$article['title'] ?> - 
											Auteur : <?= $article['firstname'] ?> <?= $article['lastname'] ?> - 
											Date de publication : <?= $article['publish_date'] ?>
										</option>

										<?php
									}
								?>
							</select>
						</div>

						<div>
							<label class="label-manage-article">Articles secondaire 2</label>
							<select name="fp3-id-article">
								<option value="">Sélectionner un article</option>
								<?php
									foreach($published_articles as $article){
										?>

										<option 
											value="<?= $article['id'] ?>"
											<?php
											if(isset($articles_by_front_page['3'])){
												if($article['id'] == $articles_by_front_page['3']['id_article']){
											?>
												selected
											<?php
												}
											}
											?>
											>
											<?=	$article['title'] ?> - 
											Auteur : <?= $article['firstname'] ?> <?= $article['lastname'] ?> - 
											Date de publication : <?= $article['publish_date'] ?>
										</option>

										<?php
									}
								?>
							</select>
						</div>
					</div>

					<input class="btn-save" type=submit value="Enregister">
					<div class="clear-float"></div>
				</form>
			`

			//CLOSE MODAL BTN
			let btnCloseModal= document.getElementById("btn-close-modal");
			btnCloseModal.addEventListener('click',function() {
				modalArticles.remove();
			})
		}

		

		//AJOUT DU BOUTON DECONNEXION
		let navbar = document.getElementsByClassName("nav-list")[0];
		let navbarSmall = document.getElementsByClassName("small-menu-list")[0];

		let btnSmallNavBar = document.createElement("li");
		let btn_disconnect = document.createElement("li");

		btnSmallNavBar.innerHTML = `<a href='/<?php echo $lang?>/admin/disconnect'> Se déconnecter </a>`;
		btn_disconnect.innerHTML = `<a class='btn-disconnect' href='/<?php echo $lang?>/admin/disconnect'> Se déconnecter </a>`;
		navbar.appendChild(btn_disconnect);
		navbarSmall.appendChild(btnSmallNavBar);

		//AJOUT BACKGROUND QUAND UN LIEN DU MENU EST SELECTIONNÉ	
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
		button_association['manage_users'] = 'manage_users_view';
		

		var url = window.location.href;

		var route_elements = url.split('/');


		// Changing displayed element depending on the route
		if(route_elements.includes('new_article') || route_elements.includes('edit_article')) {
			change_view('write_article');
		}
		else{
			for (var view in button_association){
				if(route_elements.includes(view)){
					var button = document.getElementById(view);
					change_view(view);
					button.click();
				}
			}
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
			// window.location.href = "/<?= $lang ?>/admin/" + id;
			change_view(id);
		}




	}
</script>

<?php
	$content = ob_get_clean();
?>