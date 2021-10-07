<?php
	ob_start();
?>
<div class="view" hidden="true" id="register_user_view">
	<form action="/<?= $lang ?>/admin/users/register" method="POST">
		<div>
			<label>Nom</label>
			<input type="text" name="lastname" placeholder="Nom">
		</div>
		<div>
			<label>Prénom</label>
			<input type="text" name="firstname" placeholder="Prénom">
		</div>
		<div>
			<label>Adresse Email</label>
			<input type="text" name="email" placeholder="Email">
		</div>
		<div>
			<label>Mot de passe</label>
			<input type="password" name="password" placeholder="Mot de passe temporaire">
		</div>
		<div>
			<br>
			<input type="submit" name="submit_user_form" value="Enregistrer" >
		</div>
	</form>
</div>
<?php
	$register = ob_get_clean();
?>