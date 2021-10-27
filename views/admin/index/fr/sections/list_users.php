<?php
global 
	$MANAGE_PERMS_PERM,
	$REMOVE_ACCOUNT_PERM,
	$RESET_PASSWORD_PERM;

	ob_start();
?>


<div class="view" hidden="true" id="manage_users_view">
	<h1 class="title-articles-list">Gestion des comptes utilisateurs</h1>
	<div class="article-en-redaction">
		
		<?php
			foreach($all_users_accounts as $user_account){
		?>

		<div class="card-article">	
			<div class="card-article-text">	
				<p><span class="titles-card">Nom :</span> <?= $user_account['firstname'] ?> <?= $user_account['lastname'] ?> </p>
				<p><span class="titles-card">Email :</span> <?= $user_account['email'] ?> </p>
				<?php
					if(isset($_SESSION['new_password']) && $_SESSION['new_password']['user_id'] == $user_account['id']){
						echo 'Nouveau mot de passe : ' . $_SESSION['new_password']['password'];
						unset($_SESSION['new_password']);
					}
				?>

			</div>

			<div class="btn-container-admin">
				<?php
					if(in_array($RESET_PASSWORD_PERM, $_SESSION['permissions'])) {
				?>
					
					<!-- If user can reset passwords -->
					<a 
						class="btn-empty-secondary" 
						href="/<?= $lang ?>/admin/users/<?= $user_account['id'] ?>/reset_password"
						onclick="confirm_action(' Voulez-vous vraiment réinitialiser le mot de passe de <?= $user_account['firstname'] ?> <?= $user_account['lastname'] ?>? ');"
					> 
						Réinitialiser mot de passe 
					</a>
				
				<?php
					}
					if(in_array($REMOVE_ACCOUNT_PERM, $_SESSION['permissions']) && $user_account['id'] != $_SESSION['id']) {
				?>
					<!-- If user can delete account -->
					<a 
						class="btn-delete" 
						href="/<?= $lang ?>/admin/users/<?= $user_account['id'] ?>/delete"
						onclick="confirm_action('Vous allez supprimer l\'utilisateur <?= $user_account['firstname'] ?> <?= $user_account['lastname'] ?>. Voulez-vous continuer ? ');"
					>
						Supprimer le compte
					</a>

				<?php
					}
					if(in_array($MANAGE_PERMS_PERM, $_SESSION['permissions'])){
				?>

					<!-- User can manage accounts permissions -->
					<a class="btn-full-secondary perms" id='<?= $user_account['id'] ?>'> Gérer les permissions </a>

					<div class="perms-div" hidden="true" id='perms_<?= $user_account['id'] ?>'>
						<form action="/<?= $lang ?>/admin/users/<?= $user_account['id'] ?>/update_perms" method='POST'>
							<?php
								foreach($all_permissions as $permission){
									// Already earned permissions
									if(in_array($permission['name'], $users_permissions[$user_account['id']])){
							?>
										<!-- Ici les permissions que possède déjà l'utilisateur -->
										<div class="checkbox-container">
											<input type="checkbox" name="permissions[]" value="<?= $permission['id'] ?>" class="checkbox" checked>
											<label class="label-checkbox label-checkbox-dark"><?= $permission['name'] ?></label>
										</div>
							<?php
									}
									else {
							?>
										<!-- Ici les permissions que l'utilisateur ne possède pas -->
										<div class="checkbox-container">
											<input type="checkbox" name="permissions[]" value="<?= $permission['id'] ?>" class="checkbox" >
											<label class="label-checkbox label-checkbox-dark"><?= $permission['name'] ?></label>
										</div>
							<?php
								}
							}
							?>
							<input type="submit" name="update_perms_form" value="Modifier">
						</form>
					</div>

				<?php
					}
				?>
			</div>
		</div>

		<?php
			}
		?>

	</div>
</div>

<script type="text/javascript">
	function confirm_action(confirm_message){
		if(!confirm(confirm_message)){
			event.preventDefault();
		}
	}

	function button_click() {
		var perms_divs = document.getElementsByClassName('perms-div');

		// Get the div corresponding to the button
		var div_corresponding_to_button = document.getElementById('perms_' + this.id);

		// Get the previous displayed div
		var previous_displayed_div = document.getElementsByClassName('selected-perms-div')[0];

		// Hide perms divs
		for(var i=0; i < perms_divs.length; i++){
			perms_divs[i].setAttribute('hidden', 'true');
		}




		// Remove the selected-perms-div class
		if(previous_displayed_div != null){
			previous_displayed_div.classList.remove('selected-perms-div');

			// A new div is displayed
			if(previous_displayed_div.id != div_corresponding_to_button.id){
				div_corresponding_to_button.classList.add('selected-perms-div');
				div_corresponding_to_button.removeAttribute('hidden');	
			}
		}
		else{
			// First time a div is clicked
			div_corresponding_to_button.classList.add('selected-perms-div');
			div_corresponding_to_button.removeAttribute('hidden');
		}

		

	}

	var buttons = document.getElementsByClassName('perms');

	for(var i=0; i<buttons.length; i++){
		buttons[i].addEventListener('click', button_click);
	}
</script>

<?php
	$manage_users = ob_get_clean();
?>