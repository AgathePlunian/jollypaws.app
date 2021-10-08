<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="waiting_articles_view">
	<h2 class="title-articles-list">Articles en attente de publication</h2>
		<div class="article-en-redaction">
			<?php
				foreach($waiting_articles as $article){
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
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/articles/remove_from_approval/<?= $article['id'] ?>">Retour en rédaction</a>
							<a class="btn-full-secondary" href="/<?= $lang ?>/admin/articles/change_approbation/<?= $article['id'] ?>">Approuver l'article</a>
							
							<?php
								global $PUBLISH_ARTICLE_PERM;
								if(in_array($PUBLISH_ARTICLE_PERM, $_SESSION['permissions'])){
									?>
									<a class="btn-full-primary" href="/<?= $lang ?>/admin/articles/publish/<?= $article['id'] ?>">
										Publier l'article
									</a>
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


<?php
	$waiting = ob_get_clean();
?>