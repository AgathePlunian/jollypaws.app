<?php
	
	ob_start();

	$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";

	echo "Hello la team";

	echo "<br>";
	echo "<br>";

	if(in_array($CREATE_ARTICLE_PERM, $_SESSION['permissions'])){
		echo "<a href='/{$lang}/admin/articles/write'>Création d'articles</a>";
	}

	$content = ob_get_clean();


?>