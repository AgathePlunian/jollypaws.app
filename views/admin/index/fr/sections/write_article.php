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

			<label>Selectionner une ou plusieurs catégorie(s)</label>
			
			<div id="categories-checkbox-container">
					
				<?php
					if(isset($_SESSION['article']['categories'])){

						$article_categories_id_list = array();
						foreach($_SESSION['article']['categories'] as $category){
							$article_categories_id_list[] = $category;
						}
					}

					foreach($all_categories as $category){
						$display_empty_categories = true;


						if(isset($article_categories_id_list)){
							if(in_array($category['id'], $article_categories_id_list)){
								?>

								<!-- Ici les catégories que possède déjà l'article -->
								<div class="checkbox-container">
									<input type="checkbox" name="categories[]" value="<?=$category['id']?>" class="checkbox" checked>
									<label class="label-checkbox label-checkbox-dark"><?=$category['name']?></label>
								</div>
								
								<?php
								$display_empty_categories = false;
							}
						}
						if($display_empty_categories == true) {
						?>
							<!-- Ici les catégories que ne possède pas l'article -->
							<div class="checkbox-container">
								<input type="checkbox"  name="categories[]" value="<?=$category['id']?>" class="checkbox owned_category">
								<label class="label-checkbox label-checkbox-dark"><?=$category['name']?></label>
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
						<span>
							<img 
								src="../../../images/icones-text/bold-solid.svg" 
								alt="text bold"
								class="text-modifier"
								id="bold_button"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/italic-solid.svg" 
								alt="text italic"
								class="text-modifier"
								id="italic_button"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/underline-solid.svg" 
								alt="text underlined"
								class="text-modifier"
								id="underline_button"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/strikethrough-solid.svg" 
								alt="text strikethrough"
								class="text-modifier"
								id="strikethrough_button"
							/>
						</span>
						
						<span>
							<img 
								src="../../../images/icones-text/list-ul-solid.svg" 
								alt="list"
								class="text-modifier"
								id="list_button"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/link-solid.svg" 
								alt="lien"
								class="text-modifier"
								id="link_button"
							/>
						</span>
					</div>
					<div>
						<p class="edit-new-title">+ Ajouter un sous titre</p>
					</div>
				</div>

				<!-- Ne pas espacer la balise textarea de la balise php -->
				<textarea name="article_content" id="article_content_area"><?php 
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
				<?php
					if(isset($_SESSION['article']['id'])){
						?>
						<a href="/<?= $lang ?>/admin/articles/send_for_approval/<?= $_SESSION['article']['id'] ?>"> Envoyer en validation </a>
						<?php
					}
				?>
				<!-- <input type="submit" name="article_form" value="Envoyer en validation" id="article_send_validation"> -->
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


		// Buttons to modify text
		var modifiers_button = document.getElementsByClassName('text-modifier');

		// Bind the buttons
		for(var i = 0; i < modifiers_button.length; i++){
			modifiers_button[i].addEventListener('click', onClickModifier);
		}

		var modifier_association = new Object();
		modifier_association['bold_button'] = ['[B] ', ' [/B]'];
		modifier_association['italic_button'] = ['[I] ', ' [/I]'];
		modifier_association['underline_button'] = ['[U] ', ' [/U]'];
		modifier_association['strikethrough_button'] = ['[STRIKE] ', ' [/STRIKE]'];
		modifier_association['list_button'] = ['[UL]\n[LI] ', ' [/LI]\n[/UL]'];
		modifier_association['link_button'] = ['[A] ', ' [/A]'];


		// Bind click on button to function
		visu_article.addEventListener('click', onClickVisu);
		submit_article.addEventListener('click', onClickSubmit);


		// If the user see the article
		function onClickVisu(e){
			var form = document.getElementById('article_form');
			form.setAttribute('action', '/<?= $lang ?>/admin/articles/show');
			visu_article.removeEventListener('click', onClickVisu);
			visu_article.click();
		}


		// If the user submit the articles
		function onClickSubmit(e){
			var form = document.getElementById('article_form');
			form.setAttribute('action', '/<?= $lang ?>/admin/articles/verify');
			submit_article.removeEventListener('click', onClickSubmit);
			submit_article.click();
		}

		function onClickModifier(e){
			var article_text_area = document.getElementById('article_content_area');
			var selection_start = article_text_area.selectionStart;
			var selection_end = article_text_area.selectionEnd;

			var selection_start_element = modifier_association[this.id][0];
			var selection_end_element = modifier_association[this.id][1];

			var new_value = article_text_area.value.substring(0, selection_start) + 
							selection_start_element + 
							article_text_area.value.substring(selection_start, selection_end) +
							selection_end_element +
							article_text_area.value.substring(selection_end, article_text_area.value.length);

			article_text_area.value = new_value;
		}

	</script>
</div>
<?php
	$write_article = ob_get_clean();
?>