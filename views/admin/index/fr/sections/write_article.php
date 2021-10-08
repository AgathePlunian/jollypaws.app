<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="write_article_view">
	
<form action="/<?= $lang ?>/admin/articles/verify" method="POST" id="article_form" enctype="multipart/form-data">

<input type="submit" name="article_visualisation" value="Prévisualiser" id="article_visualisation">
<div class="clear-float"></div>

<div class="form-container">
		<div class="input-new-article">
			<!-- Print author -->
			<label>Auteur</label>
			<input class="input-label input-disabled" name="author" type=" text" disabled="disabled" placeholder="<?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?>" >
				
			<!-- Article title -->
			<label>Titre de l'article</label>
			<textarea class="input-label input-title" name="title" placeholder="Titre de l'article"><?php 
					if(isset($_SESSION['article']['title'])){ 
						echo $_SESSION['article']['title'];
					}
				?></textarea> 
			
		<!-- Image input -->
			<label class="file">Image principale</label>
				<div class="input-select-img-container">
					<span class="icone-upload-img"><img src="../../../images/icones-form/upload-solid.svg" alt="upload image"/></span>
					<input class="custom-file-input" name="main_picture" type="file" id='main_picture' aria-label="Choisir un fichier" />
					
				</div>
			
			<div class="img-selected" >
				<!-- Display the main image -->
				<?php
					if (isset($_SESSION['article']['main_image'])){
				?>
					<img id="imgSelected"
						src="/<?= $_SESSION['article']['main_image'] ?>" 
							alt='main article image'
					/>

				<?php
					}
					else {
				?>
					<img id="imgSelected" src="" alt='main article image'/>
				<?php
					}
				?>
			</div>

			<div class="categories-container">
			<label>Selectionner une ou plusieurs catégories</label>
				<?php
					foreach($all_categories as $category){
						$display_empty_categories = true;
						if(isset($_SESSION['article']['categories']) && !isset($article_categories_id_list)){
							$article_categories_id_list = array();
							foreach($_SESSION['article']['categories'] as $category){
								$article_categories_id_list[] = $category['id'];
							}
						}
						if(isset($article_categories_id_list)){
							if(in_array($category['id'], $article_categories_id_list)){
								$display_empty_categories = false;
								?>
								
								<div class="category-checkbox checkbox-container">
									<input class="checkbox" type="checkbox" name="categories[]" value="<?= $category['id'] ?>" checked >
									<label class="category"><?= $category['name'] ?></label>
								</div>

								<?php
							}
						}
						if($display_empty_categories == true) {
						?>
							<div class="category-checkbox checkbox-container">
								<input class="checkbox" type="checkbox" name="categories[]" value="<?= $category['id'] ?>">
								<label class="category"><?= $category['name'] ?></label>
							</div>
						<?php
						}
						
					}
				?>
			</div>
		</div>

		<div class="form-col-right">
			<label>Contenu de l'article</label> 
			
			<div class="article-area-container">
				<div class="editing-text-bar">
					<div class="editing-text-icones">
						<span><img src="../../../images/icones-text/bold-solid.svg" alt=" text bold"/></span>
						<span><img src="../../../images/icones-text/italic-solid.svg" alt="text italic"/></span>
						<span><img src="../../../images/icones-text/underline-solid.svg" alt="text underlined"/></span>
						<span><img src="../../../images/icones-text/strikethrough-solid.svg" alt="text strikethrough"/></span>
						<span><img src="../../../images/icones-text/list-ul-solid.svg" alt="list"/></span>
					</div>
					<div>
						<p class="edit-new-title">+ Ajouter un sous titre</p>
					</div>
				</div>

				<!-- Ne pas espacer la balise textarea de la balise php -->
				<textarea name="article_content"><?php 
					if(isset($_SESSION['article']['content'])){ 
						echo $_SESSION['article']['content'];
					}
					else {?>
[h2] Résumé [/h2]

[h2] A retenir [/h2]

[h2] En savoir plus [/h2]<?php
					}
				?>
				</textarea>
			</div>

			
			<div class="btn-submit-container">
				<input type="submit" name="article_form" value="Enregistrer les modifications" id="article_submit">
			</div>
		</div>
	</div>
</form>



	<!-- Change form action if user submit the form or see the article -->
	<script>

		let imgInput = document.getElementById('main_picture');

		// Displaying the image
		imgInput.onchange = function() {
			if(this.files && this.files[0]){
				var reader = new FileReader();
				reader.onload = function(e){
					var img_selected = document.getElementById('imgSelected');
					img_selected.setAttribute('src', e.target.result);
				};
				reader.readAsDataURL(this.files[0]);
			}
		}

		
		// Button to see article
		var visu_article = document.getElementById('article_visualisation');
		
		// Button to submit article
		var submit_article = document.getElementById('article_submit');

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