<?php
	require('views/admin/index/fr/sections/write_article.php');
	require('views/admin/index/fr/sections/list_articles.php');

	global 	$CREATE_ARTICLE_PERM;

	ob_start();
	echo '
	<div class="container-admin">
		<div class="menu-lateral-admin">';
		
		if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			echo "<button class='button_view' id='write_article'>+ Rédiger un article</button>";
			echo "<a class='button_view menu-link' id='list_articles'>Articles en cours</a>";
		}
		echo'</div>';
	
		/*if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		echo "<button class='button_view' id='write_article'>+ Rédiger un article</button>";
		echo "<button class='button_view' id='list_articles'>Articles en cours</button>";
		}
		*/

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

		if(route_elements.includes('write_article')) {
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