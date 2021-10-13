<?php
	ob_start();
?>

<div class="view" hidden="true" id="list_articles_view">
	<h1 class="title-articles-list">Mes articles en cours de rédaction</h1>
		<div class="article-en-redaction">
			<?php
				foreach($list_articles as $article){
					?>
					<div class="card-article">	
						<div class="card-article-text card-list-my-articles">	
							<p><span class="titles-card">Titre :</span> <?= $article['title'] ?> </p>
							<p><span class="titles-card">Auteur :</span> <?= $_SESSION['firstname'] ?> <?= $_SESSION['lastname'] ?> </p>
							<p><span class="titles-card">Date de création :</span> <?= $article['creation_date'] ?> </p>
							<p><span class="titles-card">Dernière modification :</span> <?= $article['last_change_date'] ?> </p>
						</div>
						<div class="btn-container-admin">
							<a class="btn-empty-secondary" href="/<?= $lang ?>/article/show/<?= $article['id'] ?>">Prévisualiser</a>
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/edit_article/<?= $article['id'] ?>">Modifier</a>
							<a class="btn-full-primary" href="/<?= $lang ?>/admin/trash/<?= $article['id'] ?>">Supprimer</a>
						</div>
					</div>

					<?php
				}
			?>
		</div>
</div>

<?php
	$list_articles = ob_get_clean();
?>