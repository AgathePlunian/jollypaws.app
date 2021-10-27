<?php
  ob_start();
?>

<nav class="main-nav">
 <!--SMALL NAV-->   
<div class="burger-nav">
  <a class="small-nav-logo" href="/<?php echo $lang; ?>/">
    <img src="/images/logo-ResilEyes-degrade.png" alt="Logo ResilEyes">
    <p>ResilEyes</p>
  </a>
  <div class="open">
    <a id="burger-open" class= "burger-menu"><img src="/images/burger-menu.png" alt="Ouvrir menu"></a>
  </div>
</div> 
<div class="small-nav-menu d-block" id="full-screen">
  <span id="close-menu" class="close"><img src="/images/close.png" alt="Fermer le menu"></span>
    <ul class="small-menu-list"> 
      <li class="language-choice"><a href="/<?php echo 'fr/'.$route; ?>" class="l-fr l-selected">FR</a>|<a href="/<?php echo 'en/'.$route; ?>" class="l-en ">EN</a></li>
      <li><a href="/<?php echo $lang; ?>/">Accueil</a></li>
      <li><a href="/<?php echo $lang; ?>/approche">Approche</a></li>
      <li><a href="/<?php echo $lang; ?>/equipe">Équipe</a></li>             
      <li><a href="/<?php echo $lang; ?>/contact">Nous contacter</a></li>
      <li><a href="/<?php echo $lang; ?>/blog">Blog</a></li>
    </ul>
</div>

<!--LARGE NAV-->
<div class="main-nav-large">
  <div class="logo-container-nav">
    <a href="/<?php echo $lang; ?>/" class="nav-logo">
      <img src="/images/logo-ResilEyes-degrade.png" alt="Logo ResilEyes">
      <p>ResilEyes</p>
    </a>
  </div>

  <ul class="nav-list items-list">
    <li class="item"><a href="/<?php echo $lang; ?>/">Accueil</a></li>
    <li class="item"><a href="/<?php echo $lang; ?>/approche">Approche</a></li>
    <li class="item"><a href="/<?php echo $lang; ?>/equipe">Équipe</a></li>
    <li class="item"><a href="/<?php echo $lang; ?>/blog">Blog</a></li>
    <li class="language-choice">
      <a href="<?php echo '/fr/'.$route; ?>" class="l-fr selected-l-fr">FR</a>|<a href="<?php echo '/en/'.$route; ?>" class="l-en">EN</a>
    </li>
    <li>
      <button onclick="window.location.href='/<?php echo $lang; ?>/contact'" class="btn-nav btn">Nous contacter</button>
    </li>
  </ul>
</div>
</nav>

<?php
  $menu = ob_get_clean();
?>
