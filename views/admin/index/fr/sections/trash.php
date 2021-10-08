<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="trash_articles_view">
	<h2 class="title-articles-list">Articles prochainement supprimés</h2>
		<div class="article-en-redaction">
			<?php
				foreach($trashed_articles as $article){
					?>
					<div class="card-article">	
						<div class="card-article-text card-list-my-articles">	
							<p><span class="titles-card">Titre :</span> <?= $article['title'] ?> </p>
							<p><span class="titles-card">Auteur :</span> <?= $article['firstname'] ?> <?= $article['lastname'] ?> </p>
							<p><span class="titles-card">Date de création :</span> <?= $article['creation_date'] ?> </p>
							<p><span class="titles-card">Dernière modification :</span> <?= $article['last_change_date'] ?> </p>
						</div>
						<div class="btn-container">
							<a class="btn-empty-secondary" href="/<?= $lang ?>/article/show/<?= $article['id'] ?>">Prévisualiser</a>
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/recover/<?= $article['id'] ?>">Récupérer</a>
						</div>
					</div>

					<?php
				}
			?>
		</div>
</div>


<?php
	$trash = ob_get_clean();
?>