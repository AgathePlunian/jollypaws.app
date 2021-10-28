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
				<img 
					src="/<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
				>
			</div>	
			<div class="card-article-text">	
				<p>
					<span class="titles-card">
						Titre :</span> <?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['title']:''; ?> 	
				</p>

				<p>
					<span class="titles-card">
						Auteur : 
					</span>
					<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['firstname']:''; ?> 
					<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['lastname']:''; ?>
				
				</p>

				<p>
					<span class="titles-card">
						Date de création : </span>
						<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['creation_date']:''; ?>
					
				</p>
				
				<p>
					<span class="titles-card">
						Date de publication : </span>
						<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['publish_date']:''; ?>
				</p>
			</div>		
		</div>
		<div class="article-2-3-container">
			<div class="article-2">
				<div class="a-la-une-container-img-2-3">
					<img 
						src="/<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
					>
				</div>	
				<div class="card-article-text">	
					<p>
						<span class="titles-card">
							Titre : </span><?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['title']:''; ?> 
						
					</p>

					<p>
						<span class="titles-card">
							Auteur : </span>
							<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['firstname']:''; ?> 
							<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['lastname']:''; ?>
						
					</p>

					<p>
						<span class="titles-card">
							Date de création : </span>
							<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['creation_date']:''; ?>
						
					</p>
					
					<p>
						<span class="titles-card">
							Date de publication : </span>
							<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['publish_date']:''; ?>
						
					</p>
				</div>		
			</div>
			<div class="article-3">
				<div class="a-la-une-container-img-2-3">
				<img 
					src="/<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
				>
				</div>	
				<div class="card-article-text">	
					<p>
						<span class="titles-card">
							Titre :</span> <?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['title']:''; ?> 
						
					</p>

					<p>
						<span class="titles-card">
							Auteur : </span>
							<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['firstname']:''; ?> 
							<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['lastname']:''; ?>
						
					</p>

					<p>
						<span class="titles-card">
							Date de création : </span>
							<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['creation_date']:''; ?>
						
					</p>
					
					<p>
						<span class="titles-card">
							Date de publication : </span>
							<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['publish_date']:''; ?>
						
					</p>
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
							<p><span class="titles-card">Date de publication :</span> <?= $article['publish_date'] ?> </p>
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