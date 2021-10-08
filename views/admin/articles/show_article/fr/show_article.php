<?php
	ob_start();
?>

<div class="article-page">
	<div class="article-header">
		<!--ICI LA DATE-->
		<p class="date-of-publication">Publié le </p>
		<h1 class="article-title"><?= $article_title ?></h1>
		<!--ICI L'AUTEUR-->
		<p class="article-author">Par <span class="author-name">Julia Neuville</span></p>

		<!--ICI QU'IL FAUT METTRE LES CATEGORIES DE L'ARTICLE -->
		<ul class="category-list">
			<li class="category-item">Santé</li>
			<li class="category-item">Blabla</li>
			<li class="category-item">blibli</li>
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


<!-- Article title -->






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