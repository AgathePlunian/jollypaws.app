<?php

	ob_start();
?>

<div class="view" hidden="true" id="list_articles_view">
	<h2 class="title-articles-list">Mes articles en cours de rédaction</h2>
		<div class="article-en-redaction">
			<?php
				foreach($list_articles as $article){
					?>

<<<<<<< HEAD
					<div class="card-article">	
						<div class="card-article-text">	
							<p><span class="titles-card">Titre :</span> <?= $article['title'] ?> </p>
							<p><span class="titles-card">Auteur :</span> <?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?> </p>
							<p><span class="titles-card">Date de création :</span> <?= $article['creation_date'] ?> </p>
							<p><span class="titles-card">Dernière modification :</span> <?= $article['last_change_date'] ?> </p>
						</div>
						<div>
							<a class="btn-empty-secondary" href="/<?= $lang ?>/admin/write_article/<?= $article['id'] ?>">Prévisualiser</a>
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/write_article/<?= $article['id'] ?>">Modifier</a>
							<a class="btn-full-primary" href="/<?= $lang ?>/admin/write_article/<?= $article['id'] ?>">Supprimer</a>
						</div>
					</div>
=======
				<li>
					<ul>
						<li>Titre : <?= $article['title'] ?> </li>
						<li>Auteur : <?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?> </li>
						<li>Date de création : <?= $article['creation_date'] ?> </li>
						<li>Date de dernière modification : <?= $article['last_change_date'] ?> </li>
						<li><a href="/<?= $lang ?>/admin/edit_article/<?= $article['id'] ?>"> Editer </a></li>
					</ul>
				</li>
>>>>>>> e35d8e6f74514507fd321935820aad875e787a8e

					<?php
				}
			?>
		</div>
</div>

<?php
	$list_articles = ob_get_clean();
?>