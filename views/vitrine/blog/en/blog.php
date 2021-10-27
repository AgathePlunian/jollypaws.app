<?php
  function get_summary($article_content){
    $summary_tag_regex = "~\[h2\]( )*Résumé( )*\[/h2\]~";
    $end_tag = "~(\[|$)~";

    // Find the summary start
    preg_match($summary_tag_regex, $article_content, $matches);
    if(isset($matches[0])){
      // Only keep what's after the summary tag
      $summary_tag_pos = strpos($article_content, $matches[0]);
      $substring_after_summary = substr($article_content, $summary_tag_pos + strlen($matches[0]));
      
      // Find the end of the summary part
      preg_match($end_tag, $substring_after_summary, $matches);
      if(isset($matches[0])){

        // Only keep what's before the summary end
        $end_tag_pos = strpos($substring_after_summary, $matches[0]);
        $summary_substring = substr($substring_after_summary, 0, $end_tag_pos);

        echo $summary_substring;
      }
    }
  }

  ob_start();
?>

  <div class="blog-page-container">
    <div class="blog-header">
      <h1>Blog</h1>
      <div class="search-and-select">   
        <input class="search-input" type="search" aria-label="Recherche" placeholder="Rechercher">     
        <label>Trier par:</label>
        <select class="filterByArticles">
            <option>Date</option>
            <option>Catégorie</option>
            <option>Auteur</option>
        </select>
      </div>
    </div>

    <!-- LISTE DE TOUTES LES CATEGORIES DE LA BASE DE DONNÉES -->
    <div class="all-categories-search">
      <ul class="category-list">
        <?php
          foreach($all_categories as $category){
        ?>
          <li class="category-item"><?= $category['name'] ?></li>
        <?php
          }
        ?>
      </ul>
    </div>
    

    <section class="a-la-une">
      <h2 class="title-a-la-une">À la une</h2>

      <!-- PREMIER ARTICLE À LA UNE -->
      
      <div class="first-article-blog-page">
        
        <div class="first-article-blog-img-container">
          <!-- IMAGE ARTICLE -->
            <img 
              src="/<?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
            >
        </div>

        <div class="first-article-blog-text-container">
          <!-- DATE DE PUBLICATION -->
          <p class="date-article"><?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['publish_date']:''; ?></p>

           <!--AUTEUR ARTICLE-->
          <p>
            <?php
              if(isset($articles_by_front_page['1'])){
            ?>

            Par 
            <span class="author-name">
              <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['firstname']:''; ?> 
              <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['lastname']:''; ?>  
            </span>
            
            <?php
              }
            ?>
          </p>
          <header>

             <!-- TITRE ARTICLE -->
            <h3><?php echo (isset($articles_by_front_page['1']))?$articles_by_front_page['1']['title']:''; ?></h3>
          </header> 

           <!-- CONTENU ARTICLE -->
          <p>
            <?php
              // Get the summary part of the article content
              if(isset($articles_by_front_page['1'])){
                get_summary($articles_by_front_page['1']['content']);
              }
            ?>
          </p>

           <!-- LISTE DES TAGS-->
          <ul class="category-list">
            <?php
              if(isset($articles_by_front_page['1'])) {
                foreach($categories_article[$articles_by_front_page['1']['id_article']] as $category){
            ?>
              <li class="category-item no-margin"><?= $category['name'] ?></li>
            <?php
                }
              }
            ?>
          </ul>

           <!-- LIEN VERS ARTICLE -->
          <?php
            if(isset($articles_by_front_page['1'])){
          ?>
            <a href="/<?= $lang ?>/article/show/<?= $articles_by_front_page['1']['id_article'] ?>" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          <?php
            }
          ?>
        </div>
      </div>

      <div class="article-2-3-container">

      <!-- SECOND ARTICLE A LA UNE-->
        <div class="second-article-blog-page">
          
          <div class="second-article-blog-img-container">
            <!-- IMAGE ARTICLE -->
            <img 
              src="/<?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
            >
          </div>

          <div class="second-article-blog-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">
              <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['publish_date']:''; ?>  
            </p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">
              <?php
                if(isset($articles_by_front_page['2'])){
              ?>

              Par 
              <span class="author-name">
                <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['firstname']:''; ?> 
                <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['lastname']:''; ?>  
              </span>

              <?php
                }
              ?>
            </p>

            <header>
              <!-- TITRE ARTICLE -->
              <h3><?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['title']:''; ?></h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">
              <?php
                // Get the summary part of the article content
                if(isset($articles_by_front_page['2'])){
                  get_summary($articles_by_front_page['2']['content']);
                }
              ?>
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <?php
                if(isset($articles_by_front_page['2'])) {
                  foreach($categories_article[$articles_by_front_page['2']['id_article']] as $category){
              ?>
                <li class="category-item no-margin"><?= $category['name'] ?></li>
              <?php
                  }
                }
              ?>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <?php
              if(isset($articles_by_front_page['2'])){
            ?>
              <a href="/<?= $lang ?>/article/show/<?= $articles_by_front_page['2']['id_article'] ?>" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
            <?php
              }
            ?>
          </div>
        </div>


        <!-- TROIXIEME ARTICLE A LA UNE-->
        <div class="third-article-blog-page">
          
          <div class="third-article-blog-img-container">
            <!-- IMAGE ARTICLE -->
            <img 
              src="/<?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['main_image']:'images/default_first_page_article_image.jpeg'; ?>"
            >
          </div>

          <div class="third-article-blog-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">
              <?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['publish_date']:''; ?> 
            </p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">
              <?php
                if(isset($articles_by_front_page['2'])){
              ?>

              Par 
              <span class="author-name">
                <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['firstname']:''; ?> 
                <?php echo (isset($articles_by_front_page['2']))?$articles_by_front_page['2']['lastname']:''; ?>  
              </span>
              
              <?php
                }
              ?>
            </p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3><?php echo (isset($articles_by_front_page['3']))?$articles_by_front_page['3']['title']:''; ?></h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">
              <?php
                // Get the summary part of the article content
                if(isset($articles_by_front_page['3'])){
                  get_summary($articles_by_front_page['3']['content']);
                }
              ?>
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <?php
                if(isset($articles_by_front_page['3'])) {
                  foreach($categories_article[$articles_by_front_page['3']['id_article']] as $category){
              ?>
                <li class="category-item no-margin"><?= $category['name'] ?></li>
              <?php
                  }
                }
              ?>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <?php
              if(isset($articles_by_front_page['2'])){
            ?>
              <a href="/<?= $lang ?>/article/show/<?= $articles_by_front_page['2']['id_article'] ?>" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
  
    </section>

    <!-- SECTION ALL ARTICLES -->

    <section class="all-articles-section">
      <h2 class="all-article-title">Tous les articles</h2>
      
      <div class="all-articles-container-blog">
        
        <?php
          foreach($published_articles as $article){
        ?>
        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="/<?= $article['main_image'] ?>">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article"><?= $article['publish_date'] ?></p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par 
              <span class="author-name">
                <?= $article['firstname'] ?>
                <?= $article['lastname'] ?>
              </span>
            </p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3><?= $article['title'] ?></h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">
              <?php
                get_summary($article['content']);
              ?>
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <?php
                foreach($categories_article[$article['id']] as $category) {
              ?>
                <li class="category-item no-margin"><?= $category['name'] ?></li>
              <?php
                }
              ?>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="/<?= $lang ?>/article/show/<?= $article['id'] ?>" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </section>
  </div>
 
 
<?php
  $content = ob_get_clean();
?>