<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Jolly Paws</title>
  
  <link rel="icon" type="image/png" sizes="19x19" href="<?php echo get_template_directory_uri()?>/images/favicon/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--OG data-->
    <meta property="og:site_name" content="JollyPaws" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:title" content="JollyPaws" />
    <meta property="og:description" content="JollyPaws, des balades sur mesure pour vous et votre toutou"/>
    <meta property="og:image" content= "https://agathe-plunian.com/img/banner/meta-img.jpg" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-QAc08ipPd7ElgrEsKMj9mFi1LOYhEBBeusKfVSXktZSjlm5BIThey5q7IEYtZVixxC+lIN6CnSZCfI4s00Dq3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
  <?php wp_head() ?>
</head>


<body>


<nav>
  <div class="main-nav large-nav-menu main-nav-scroll">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="logo-container"><img alt="logo JollyPaws" src="<?php echo get_template_directory_uri()?>/images/banner/logo-jolly-paws.png"></div>
            <div>
                <ul class="nav-list">
                    <li class="nav-item"><a href="#" class="nav-link">Fonctionnalités</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Qui sommes-nous ?</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Tarifs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">FAQ</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Blog</li>
                </ul>
            </div>
        </div>

        <button class="btn btn-white" type="button">Obtenir l'app</button>
    </div>
  </div>


  <div class="small-nav-menu display-none main-nav-scroll" id="full-screen">
      <div class="logo-container"><img src="<?php echo get_template_directory_uri()?>/images/banner/logo-jolly-paws.png" alt="logo JollyPaws"></div>
      <div id="burger-menu" class="burger-menu">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
      </div>

      <div id="toggle-menu" class="small-menu-list display-none-menu">
          <ul> 
              <li class="nav-link" >Fonctionnalités</li>
              <li class="nav-link">Qui sommes-nous ?</li>
              <li class="nav-link">Tarifs</li>             
              <li class="nav-link">FAQ</li>
              <li class="nav-link">Blog</li>
              <li><button class="btn" type="button">Obtenir l'app</button></li>
          </ul> 
      </div>
  </div>
</nav>
