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
			<label>Selectionner une ou plusieurs catégorie(s)</label>
			
			<select id ="categories" >
				<option value="null">Selectionner une catégorie</option>
			<!--
			<input type="text" class="input-label"name="category" placeholder="Catégorie" id="category">
				-->		
			
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
								<option 
									value="<?=$category['name']?>" 
									name="categories[]" 
									id_category="<?= $category['id'] ?>"
									class="owned_category"
								>
									<?= $category['name'] ?>	
								</option>
								
								<?php
								$display_empty_categories = false;
							}
						}
						if($display_empty_categories == true) {
						?>
							<!-- Ici les catégories que ne possède pas l'article -->
							<option 
								value="<?=$category['name']?>" 
								name="categories[]" 
								id_category="<?= $category['id'] ?>" 
							>
								<?=$category['name']?>
							</option>
						<?php
						}
						
					}
				?>
				</select>

					
				<div id="categories-checkbox-container">
						
				</div>
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
								alt="text bold"/ 
								class="text-modifier"
								id="bold"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/italic-solid.svg" 
								alt="text italic"
								class="text-modifier"
								id="italic"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/underline-solid.svg" 
								alt="text underlined"
								class="text-modifier"
								id="underline"
							/>
						</span>

						<span>
							<img 
								src="../../../images/icones-text/strikethrough-solid.svg" 
								alt="text strikethrough"
								class="text-modifier"
								id="strikethrough"
							/>
						</span>
						
						<span>
							<img 
								src="../../../images/icones-text/list-ul-solid.svg" 
								alt="list"
								class="text-modifier"
								id="list"
							/>
						</span>
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

		/* Select on change categories checkbox */
		let inputCategory = document.getElementById("categories");
		
		function add_event_listener(){
			let categoriesSelected = document.getElementsByClassName("checkbox-category");

			for (let i = 0; i < categoriesSelected.length ; i++) {
					categoriesSelected[i].addEventListener('change', function (e) {
					e.target.parentNode.remove();
				})
			}
		}





		function add_checkbox_category(categoryValue, id_category){
			let checkboxContainer = document.getElementById("categories-checkbox-container");

			newCheckBox = document.createElement('div');
			newCheckBox.classList.add('checkbox-label-category')
			newCheckBox.innerHTML = `
				<label class="label-checkbox">${categoryValue}</label>
				<input type="checkbox" name="categories[]" value="${id_category}" class="checkbox-category" checked>
				`
			checkboxContainer.appendChild(newCheckBox);

			add_event_listener();
		}


		var owned_categories = document.getElementsByClassName('owned_category');
		for(var i=0; i < owned_categories.length; i++){
			var categoryValue = owned_categories[i].value;
			var id_category = owned_categories[i].getAttribute('id_category');

			add_checkbox_category(categoryValue, id_category);
		}


		inputCategory.addEventListener('change', function (e) {
					
			categoryValue = inputCategory.value;

			var selected_index = inputCategory.selectedIndex;
			var selected_element = inputCategory.options[selected_index];
			var id_category = selected_element.getAttribute('id_category');

			
			let checkboxContainer = document.getElementById("categories-checkbox-container");
			let categoriesSelected = document.getElementsByClassName("checkbox-category");
			let alreadyExists = false;

			for (let i = 0; i < categoriesSelected.length ; i++) {
					if(id_category == categoriesSelected[i].value) {
						alreadyExists = true;
					}
				}

			if ((categoryValue != "null") && (alreadyExists == false)) {
				
				add_checkbox_category(categoryValue, id_category);
				
				add_event_listener();

			}
	   		 
		});


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