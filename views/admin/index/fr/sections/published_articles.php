<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="published_articles_view">
	<h2 class="title-articles-list">Articles publiés</h2>
		<div class="article-en-redaction">
			<?php
				foreach($published_articles as $article){
					?>
					<div class="card-article">	
						<div class="card-article-text">	
							<p><span class="titles-card">Titre :</span> <?= $article['title'] ?> </p>
							<p><span class="titles-card">Auteur :</span> <?= $article['firstname'] ?> <?= $article['lastname'] ?> </p>
							<p><span class="titles-card">Date de création :</span> <?= $article['creation_date'] ?> </p>
							<p><span class="titles-card">Dernière modification :</span> <?= $article['last_change_date'] ?> </p>
						</div>
						<div class="btn-container"> 
							<a class="btn-empty-secondary" href="/<?= $lang ?>/article/show/<?= $article['id'] ?>">Prévisualiser</a>
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/articles/unpublish/<?= $article['id'] ?>">Retour en rédaction</a>
						</div>
					</div>
					<?php
				}
			?>
		</div>
</div>


<?php
	$published = ob_get_clean();
?>