<?php
	ob_start();
?>

<!-- Main div -->
<div class="view" hidden="true" id="published_articles_view">
	<h1 class="title-articles-list">Articles publiés</h1>

	<div class="a-la-une-header">
		<h2 class="a-la-une-title">À la une</h2>
		<a id="manage-important-articles" class="btn-full-primary">Gérer les articles</a>
	</div>
	
	<div class="a-la-une-container">
		<div class="article-1-container">
			<div class="a-la-une-container-img-1">
				<img src="../../media/1c37aee7a97c3d80.jpeg"/>
			</div>	
			<div class="card-article-text">	
				<p><span class="titles-card">Titre :</span></p>
				<p><span class="titles-card">Auteur :</span></p>
				<p><span class="titles-card">Date de création :</span></p>
				<p><span class="titles-card">Dernière modification :</span></p>
			</div>		
		</div>
		<div class="article-2-3-container">
			<div class="article-2">
				<div class="a-la-une-container-img-2-3">
					<img src="../../media/1c37aee7a97c3d80.jpeg"/>
				</div>	
				<div class="card-article-text">	
					<p><span class="titles-card">Titre :</span></p>
					<p><span class="titles-card">Auteur :</span></p>
					<p><span class="titles-card">Date de création :</span></p>
					<p><span class="titles-card">Dernière modification :</span></p>
				</div>		
			</div>
			<div class="article-3">
				<div class="a-la-une-container-img-2-3">
				<img src="../../media/1c37aee7a97c3d80.jpeg"/>
				</div>	
				<div class="card-article-text">	
					<p><span class="titles-card">Titre :</span></p>
					<p><span class="titles-card">Auteur :</span></p>
					<p><span class="titles-card">Date de création :</span></p>
					<p><span class="titles-card">Dernière modification :</span></p>
				</div>		
			</div>
			
		</div>
	</div>

	<h2 class="all-published-articles">Tous les articles publiés</h2>

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
						<div class="btn-container-admin"> 
							<a class="btn-empty-secondary" href="/<?= $lang ?>/article/show/<?= $article['id'] ?>/published">Prévisualiser</a>
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