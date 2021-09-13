<?php
	ob_start();
?>

<form action="/<?= $lang ?>/admin/login/verify" method='POST'>
	<input type="text" name="email" placeholder="Votre adresse email"> <br>
	<input type="password" name="password" placeholder="Votre mot de passe"> <br>
	<input type="submit" name="login_form" value="Se connecter">
</form>
<?php if(isset($fail) && $fail == true) { echo "Identifiant ou mot de passe incorrect"; } ?>

<?php
	$content = ob_get_clean();
?>