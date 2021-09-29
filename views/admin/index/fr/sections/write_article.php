<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="write_article_view">
	<!-- Print author -->
	Author : <?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?> <br/> <br/>
	

	<form action="/<?= $lang ?>/admin/articles/verify" method="POST" id="article_form" enctype="multipart/form-data">
		
		<!-- Image input -->
		Image principale : <input name="main_picture" type="file" id='main_picture' /> <br/> <br/>
		

		<!-- Display the main image -->
		<?php
			if (isset($_SESSION['article_main_image'])){
				?>

				<img 
					src="/<?= $_SESSION['article_main_image'] ?>" 
					alt='main article image'
					height="200px"
				/>

				<?php
			}
		?>


		<!-- Article title -->
		<input type="text" name="title" placeholder="Article title" 
			<?php 
				if(isset($_SESSION['article_title'])){ 
					echo "value='{$_SESSION['article_title']}'";
				}
			?>
		/> 
		<br/>
		
		<!-- Ne pas espacer la balise textarea de la balise php --> 
		<textarea name="article_content"><?php 
			if(isset($_SESSION['article'])){ 
				echo $_SESSION['article'];
			}
			else {
			?>
[h2] Résumé [/h2]

[h2] A retenir [/h2]

[h2] En savoir plus [/h2]
<?php
			}
		
		?></textarea>
		<input type="submit" name="article_form" value="Enregistrer les modifications" id="article_submit">
		<input type="submit" name="article_visualisation" value="Prévisualiser" id="article_visualisation">
	</form>



	<!-- Change form action if user submit the form or see the article -->
	<script>
		// Button to see article
		var visu_article = document.getElementById('article_visualisation');
		

		// Button to submit article
		var submit_article = document.getElementById('article_sumbit');


		// Bind click on button to function
		visu_article.addEventListener('click', onClickVisu);
		submit_article.addEventListener('click', onClickSubmit);


		// If the user see the article
		function onClickVisu(e){
			var form = document.getElementById('article_form');
			form.setAttribute('action', '/<?= $lang ?>/admin/articles/show');
			visu_article.removeEventListener('click', onClick);
			visu_article.click();
		}


		// If the user submit the articles
		function onClickSubmit(e){
			var form = document.getElementById('article_form');
			form.setAttribute('action', '/<?= $lang ?>/admin/articles/verify');
			submit_article.removeEventListener('click', onClick);
			submit_article.click();
		}

	</script>
</div>
<?php
	$write_article = ob_get_clean();
?>