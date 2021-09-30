<?php

	ob_start();
?>

<div class="view" hidden="true" id="list_articles_view">
	<h2>Mes articles en cours de rédaction</h2>
	<ul>
		<?php
			foreach($list_articles as $article){
				?>

				<li>
					<ul>
						<li>Titre : <?= $article['title'] ?> </li>
						<li>Auteur : <?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?> </li>
						<li>Date de création : <?= $article['creation_date'] ?> </li>
						<li>Date de dernière modification : <?= $article['last_change_date'] ?> </li>
						<li><a href="/<?= $lang ?>/admin/write_article/<?= $article['id'] ?>"> Editer </a></li>
					</ul>
				</li>

				<br/>

				<?php
			}
		?>
	</ul>
</div>

<?php
	$list_articles = ob_get_clean();
?>