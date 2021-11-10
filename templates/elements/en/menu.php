<?php
    ob_start();
?>
<!--HEADER-->
<header class="main-header">
    <nav class="main-nav">
       <!--SMALL NAV-->   
      <div class="burger-nav">
        <a class="small-nav-logo" href="/<?php echo $lang; ?>/">
          <img src="/images/ResilEyes-logo-text.png" alt="logo-ResilEyes">
        </a>
        <div class="open">
          <a id="burger-open" class= "burger-menu"><img src="/images/burger-menu.png" alt="Open menu"></a>
        </div>
      </div> 
      <div class="small-nav-menu d-block" id="full-screen">
        <span id="close-menu" class="close"><img src="/images/close.png" alt="Close menu"></span>
          <ul class="small-menu-list"> 
            <li class="language-choice"><a href="/<?php echo 'fr/'.$route; ?>" class="l-fr l-selected">FR</a>|<a href="/<?php echo 'en/'.$route; ?>" class="l-en">EN</a></li>
            <li><a href="/<?php echo $lang; ?>/">Home</a></li>
            <li><a href="/<?php echo $lang; ?>/approche">Approach</a></li>
            <li><a href="/<?php echo $lang; ?>/equipe">Team</a></li>             
            <li><a href="/<?php echo $lang; ?>/contact">Contact us</a></li>
            <li><a href="/<?php echo $lang; ?>/blog">Blog</a></li>

          </ul>
      </div>
   
     <!--LARGE NAV-->
      <div class="main-nav-large">
        <div class="logo-container-nav">
          <a href="/<?php echo $lang; ?>/" class="nav-logo">
            <img src="/images/ResilEyes-logo-text.png" alt="logo-ResilEyes">
          </a>
        </div>

        <ul class="nav-list items-list">
          <li class="item"><a href="/<?= $lang; ?>/">Home</a></li>
          <li class="item"><a href="/<?= $lang; ?>/approche">Approach</a></li>
          <li class="item"><a href="/<?= $lang; ?>/equipe">Team</a></li>
          <li class="item"><a href="/<?= $lang; ?>/blog">Blog</a></li>

          <li class="language-choice"><a href="/<?php echo 'fr/'.$route; ?>" class="l-fr">FR</a>|<a href="/<?php echo 'en/'.$route; ?>" class="l-en selected-l-en">EN</a></li>
          <li><button onclick="window.location.href='/<?= $lang; ?>/contact'" class="btn-nav btn">Contact us</button></li>
        </ul>
      </div>
    </nav>
</header>
<?php
    $menu = ob_get_clean();
?>