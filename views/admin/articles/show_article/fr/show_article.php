<?php
	ob_start();
?>

<div class="article-page">
	<a href='<?= $return_button ?>'>Retour</a>
	<div class="article-header">
		<p class="date-of-publication">
		Publié le <?php 
			if(isset($article['publish_date'])){
				echo $article['publish_date'];
			} 
		?>
			
		</p>
		<h1 class="article-title"><?= $article_title ?></h1>
		<p class="article-author">Par 
			<span class="author-name">
			<?php
				if(isset($article['firstname']) && isset($article['lastname'])){
					echo $article['firstname'].' '.$article['lastname'];
				}
				else{
					echo $_SESSION['firstname'].' '.$_SESSION['lastname'];
				}
			?>
			</span>
		</p>

		<!--ICI QU'IL FAUT METTRE LES CATEGORIES DE L'ARTICLE -->
		<ul class="category-list">
			<?php
				if(isset($categories) && !empty($categories)){
					foreach($categories as $category){
						?>
						<li class="category-item"> <?= $category['name'] ?></li>
						<?php
					}
				}
			?>
		</ul>
	</div>

	<div class="main-image-article">
		<!-- Main image -->
		<img 
			src="/<?= $article_main_image ?>"
		/>

	</div>

	<div class="main-article">
		<ul id='article_summary'>
		</ul>

		<!-- Article content -->
		<div class="article-content">
			<?= $article_content; ?>
		</div>

		<div class="logo-share-article">
			<div><img src="../../../images/icones-reseaux-sociaux/logo-instagram-blue.png"/></div>
			<div><img src="../../../images/icones-reseaux-sociaux/logo-twitter-blue.png"/></div>
			<div><img src="../../../images/icones-reseaux-sociaux/logo-linkedin-blue.png"/></div>
		</div>
	</div>
</div>

<div class="close-previsualisation">
	<p>Fermer le mode de prévisualisation</p>
</div>

<script type="text/javascript">
	window.onload = function(){
		var sections_list = document.getElementsByTagName('h2');

		for(var i=0; i < sections_list.length; i++ ){
			// Get the summary element
			var summary = document.getElementById('article_summary'); 

			// Init new id to add summary
			var new_id = sections_list[i].innerHTML.trim();

			// Set id to section element
			sections_list[i].setAttribute('id', new_id);

			// Create list elements
			var new_summary_entry = document.createElement("li");
			var new_summary_link = document.createElement("a");
			new_summary_link.classList.add("item-summary");
			var new_summary_entry_name = document.createTextNode(new_id);

			new_summary_link.setAttribute('href', '#'+new_id);

			new_summary_link.appendChild(new_summary_entry_name);
			new_summary_entry.appendChild(new_summary_link);
			summary.appendChild(new_summary_entry);
		}
	}
</script>

<?php
	$content = ob_get_clean();
?>