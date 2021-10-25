<?php
	ob_start();
?>

<div class="view" hidden="true" id="manage_categories_view">
	<form action="/<?= $lang ?>/admin/categories/add" method="POST">
		<div class="add-category-container">
			<label class="label-add-category" for="category_name">Ajouter une catégorie</label>
			<div class="add-category-inputs-container">
				<input type="text" name="category_name" placeholder="Nouvelle catégorie" class="add-category-input">
				<input type="submit" name="new_category_form" value="+ Ajouter une catégorie" class="add-category-submit">
			</div>
		</div>
	</form>


	<label class="label-all-categories">Toutes les catégories</label>
	<div class="categories-list-container">
	<?php
		foreach($all_categories as $category){
			?>
			<form class="category-item" action="/<?= $lang ?>/admin/categories/edit/<?= $category['id'] ?>" method="POST">
				<input class="input-category" type="text" name="category_name" value="<?= $category['name'] ?>">
				<input class="btn-full-secondary btn-edit-category" type="submit" name="edit_category_form" value="Modifier">
				<a class="btn-delete" href="/<?= $lang ?>/admin/categories/delete/<?= $category['id'] ?>"> 
					Supprimer
				</a>				
			</form>
			<?php
		}	
	?>
	</div>
</div>
<?php
	$manage_categories = ob_get_clean();
?>