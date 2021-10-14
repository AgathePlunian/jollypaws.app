<?php
	ob_start();
?>

<div class="view" hidden="true" id="manage_categories_view">
	<form action="/<?= $lang ?>/admin/categories/add" method="POST">
		<div>
			<label for="category_name">Catégorie :</label>
			<input type="text" name="category_name" placeholder="Nouvelle catégorie">

			<input type="submit" name="new_category_form" value="Ajouter une catégorie">
		</div>
	</form>

	<br/>

	<ul>
	<?php
		foreach($all_categories as $category){
			?>
			<li>
				<form action="/<?= $lang ?>/admin/categories/edit/<?= $category['id'] ?>" method="POST">
					<input type="text" name="category_name" value="<?= $category['name'] ?>">
					<input type="submit" name="edit_category_form" value="Modifier">
					<a href="/<?= $lang ?>/admin/categories/delete/<?= $category['id'] ?>"> 
						Supprimer
					</a>				
				</form>
			</li>
			<br />
			<?php
		}	
	?>
	</ul>
</div>

<?php
	$manage_categories = ob_get_clean();
?>