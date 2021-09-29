<?php
	ob_start();
?>
<div class="background-admin-connexion">
	<h1>Connexion à votre espace admin</h1>
	<form action="/<?= $lang ?>/admin/login/verify" method='POST'>
		<label for="email">Votre email:</label>
		<input type="text" name="email" placeholder="Votre adresse email"> <br>
		<label for="email">Votre mot de passe:</label>
		<input type="password" name="password" placeholder="Votre mot de passe"> <br>
		<input type="submit" name="login_form" value="Se connecter" class="btn btn-connexion-admin">
	</form>
</div>
<?php if(isset($fail) && $fail == true) { echo '<p class="error"> Identifiant ou mot de passe incorrect </p>'; } ?>

<?php
	$content = ob_get_clean();
?>