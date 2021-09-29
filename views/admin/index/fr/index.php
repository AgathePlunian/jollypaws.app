<?php
	require('views/admin/index/fr/sections/write_article.php');

	global 	$CREATE_ARTICLE_PERM;

	ob_start();
	echo '
	<div class="container-admin">
		<div class="menu-lateral-admin">';
		
	if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		echo "<button class='button_view' id='write_article'>+ Rédiger un article</button>";
	}
	echo'</div>
	</div>
	';

	echo "<br>";
	echo "<br>";

?>

<section id='main_section'>
	<?php
		global $CREATE_ARTICLE_PERM;

		// Ecriture d'article
		if (in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
			echo $write_article;
		}
	?>
</section>

<script>
	window.onload = function(){
		// Associate button to the section to display
		var button_association = new Object();
		button_association["write_article"] = "write_article_view";


		// Add event listener on every button
		var views_buttons = document.getElementsByClassName('button_view');
		for(var i = 0; i < views_buttons.length; i++){
			views_buttons[i].addEventListener('click', click_views_button);
		}
		
		function click_views_button(e){
			// Get the button id
			var id = this.getAttribute('id');

			// Clean the main section
			var views = document.getElementsByClassName('view');
			for(var i=0; i < views.length; i++){
				views[i].setAttribute('hidden', 'true');
			}

			// display the view corresponding to the clicked button
			var view_to_display = document.getElementById(button_association[id])
			view_to_display.removeAttribute('hidden');
		}

	}
</script>

<?php
	$content = ob_get_clean();
?>