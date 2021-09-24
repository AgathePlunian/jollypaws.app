<?php
	ob_start();
?>
<div class="view" hidden="true" id="write_article_view">
	<form action="/<?= $lang ?>/admin/articles/verify" method="POST" id="article_form">
		<input type="text" name="title" placeholder="Article title" 
			<?php 
				if(isset($_SESSION['article_title'])){ 
					echo "value='{$_SESSION['article_title']}'";
					unset($_SESSION['article_title']);
				}
			?>
		/> 
		<br/>
		
		<!-- Ne pas espacer la balise textarea de la balise php --> 
		<textarea name="article_content"><?php 
		
			if(isset($_SESSION['article'])){ 
				echo $_SESSION['article']; 
				unset($_SESSION['article']);
			}
			else {
			?>
[h1] Résumé [/h1]

[h1] A retenir [/h1]

[h1] En savoir plus [/h1]
			<?php
			}
		
		?></textarea>
		<input type="submit" name="article_form" value="valider article" id="article_submit">
		<input type="submit" name="article_visualisation" value="visualiser" id="article_visualisation">
	</form>


	<script>
		window.onload = function(){
			
			var visu_article = document.getElementById('article_visualisation');
			var submit_article = document.getElementById('article_sumbit');

			visu_article.addEventListener('click', onClickVisu);
			submit_article.addEventListener('click', onClickSubmit);

			function onClickVisu(e){
				var form = document.getElementById('article_form');
				form.setAttribute('action', '/<?= $lang ?>/admin/articles/show');
				visu_article.removeEventListener('click', onClick);
				visu_article.click();
			}


			function onClickSubmit(e){
				var form = document.getElementById('article_form');
				form.setAttribute('action', '/<?= $lang ?>/admin/articles/verify');
				submit_article.removeEventListener('click', onClick);
				submit_article.click();
			}
		}
	</script>
</div>
<?php
	$write_article = ob_get_clean();
?>