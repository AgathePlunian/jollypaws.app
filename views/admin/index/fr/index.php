<?php
	require('views/admin/index/fr/sections/write_article.php');
	require('views/admin/index/fr/sections/list_articles.php');

	global 	$CREATE_ARTICLE_PERM;


	ob_start();
	echo '
	<div class="container-admin">
		<div class="menu-lateral-admin">';
		
		if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			$writing_article_link = "<button class='button_view' id='write_article' editing='{$editing}'>+ Rédiger un article</button>";

			$list_articles_link ="<a class='button_view menu-link' id='list_articles'>Articles en cours</a>";

			if($editing == true){
				$writing_article_link = "
					<a href='/{$lang}/admin/new_article' class='menu-link'> + Rédiger un article </a>";
			}

			echo $writing_article_link;
			echo $list_articles_link;
		}
		echo'</div>';

?>
		<section id='main_section'>
		<?php
			global $CREATE_ARTICLE_PERM;

			// Ecriture d'article
			if (in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
				echo $write_article;
				echo $list_articles;
			}
		?>
		</section>
	</div>


<script>
	window.onload = function(){
		// Associate button to the section to display
		var button_association = new Object();
		button_association["write_article"] = "write_article_view";
		button_association['list_articles'] = 'list_articles_view';
		console.log(button_association["write_article"]);

		var url = window.location.href;

		var route_elements = url.split('/');
		console.log(url);

		if(route_elements.includes('new_article') || route_elements.includes('edit_article')) {
			change_view('write_article');
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