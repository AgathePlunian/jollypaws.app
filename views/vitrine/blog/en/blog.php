<?php
  ob_start();
?>

  <div class="blog-page-container">
    <div class="blog-header">
      <h1>Blog</h1>
      <div class="search-and-select">   
        <input class="search-input" type="search" aria-label="Recherche" placeholder="Rechercher">     
        <div class="filter-article-select-container">
          <label>Trier par:</label>
          <select class="filterByArticles">
              <option>Date</option>
              <option>Catégorie</option>
              <option>Auteur</option>
          </select>
        </div>
      </div>
    </div>

    <!-- LISTE DE TOUTES LES CATEGORIES DE LA BASE DE DONNÉES -->
    <div class="all-categories-search">
      <ul class="category-list">
        <li class="category-item">Santé</li>
        <li class="category-item">Santé</li>
        <li class="category-item">Santé</li>
        <li class="category-item">Santé</li>
      </ul>
    </div>
    

    <section class="a-la-une">
      <h2 class="title-a-la-une">À la une</h2>

      <!-- PREMIER ARTICLE À LA UNE -->
      
      <div class="first-article-blog-page">
        
        <div class="first-article-blog-img-container">
          <!-- IMAGE ARTICLE -->
            <img src="../media/c215edf7b91081de.jpeg">
        </div>

        <div class="first-article-blog-text-container">
          <!-- DATE DE PUBLICATION -->
          <p class="date-article">23/21/2021</p>

           <!--AUTEUR ARTICLE-->
          <p>Par <span class="author-name">Julia Neuville</span></p>
          <header>

             <!-- TITRE ARTICLE -->
            <h3>Google invente un dermatologue de poche</h3>
          </header> 

           <!-- CONTENU ARTICLE -->
          <p class="first-article-card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
          </p>

           <!-- LISTE DES TAGS-->
          <ul class="category-list">
            <li class="category-item">Santé</li>
          </ul>

           <!-- LIEN VERS ARTICLE -->
          <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
        </div>
      </div>

      <div class="article-2-3-container">

      <!-- SECOND ARTICLE A LA UNE-->
        <div class="second-article-blog-page">
          
          <div class="second-article-blog-img-container">
            <!-- IMAGE ARTICLE -->
              <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="second-article-blog-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>


        <!-- TROIXIEME ARTICLE A LA UNE-->
        <div class="third-article-blog-page">
          
          <div class="third-article-blog-img-container">
            <!-- IMAGE ARTICLE -->
              <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="third-article-blog-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
              <li class="category-item">Santé</li>
              <li class="category-item">Santé</li>
              <li class="category-item">Santé</li>
              <li class="category-item">Santé</li>
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>
      </div>
  
    </section>

    <!-- SECTION ALL ARTICLES -->

    <section class="all-articles-section">
      <h2 class="all-article-title">Tous les articles</h2>
      
      <div class="all-articles-container-blog">
        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>

        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>

        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>


        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>

        <div class="card-all-article-blog">
          
          <div class="card-all-article-img-container">
            <img src="../media/c215edf7b91081de.jpeg">
          </div>

          <div class="card-all-article-text-container">
            <!-- DATE DE PUBLICATION -->
            <p class="date-article">23/21/2021</p>

            <!--AUTEUR ARTICLE-->
            <p class="author-card">Par <span class="author-name">Julia Neuville</span></p>
            <header>

              <!-- TITRE ARTICLE -->
              <h3>Google invente un dermatologue de poche</h3>
            </header> 

            <!-- CONTENU ARTICLE -->
            <p class="card-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam 
            </p>

            <!-- LISTE DES TAGS-->
            <ul class="category-list">
              <li class="category-item">Santé</li>
            </ul>

            <!-- LIEN VERS ARTICLE -->
            <a href="#" class="link-article">Lire l'article <span class="icone-read-more"><img src="../../images/icones-form/see-more.png"/></span></a>
          </div>
        </div>
      </div>

    </section>
  </div>
 
 
<?php
  $content = ob_get_clean();
?>