<?php
    ob_start();
?>
<!--HEADER-->
<header class="main-header">
    <nav class="main-nav">
       <!--SMALL NAV-->   
      <div class="burger-nav">
        <a class="small-nav-logo" href="index.html">
          <img src="/images/logo-ResilEyes-degrade.png" alt="logo-ResilEyes">
          <p>ResilEyes</p>
        </a>
        <div class="open">
          <a id="burger-open" class= "burger-menu"><img src="/images/burger-menu.png" alt="Open menu"></a>
        </div>
      </div> 
      <div class="small-nav-menu d-block" id="full-screen">
        <span id="close-menu" class="close"><img src="/images/close.png" alt="Close menu"></span>
          <ul class="small-menu-list"> 
            <li class="language-choice"><a href="/index.html" class="l-fr">FR</a>|<a href="index.html" class="l-en l-selected">EN</a></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="approach.html">Approach</a></li>
            <li><a href="team.html">Team</a></li>             
            <li><a href="contact-page.php">Contact us</a></li>
          </ul>
      </div>
   
     <!--LARGE NAV-->
      <div class="main-nav-large">
        <div class="logo-container-nav">
          <a href="index.html" class="nav-logo">
            <img src="/images/logo-ResilEyes-degrade.png" alt="logo-ResilEyes">
            <p>ResilEyes</p>
          </a>
        </div>

        <ul class="nav-list items-list">
          <li class="item"><a href="index.html">Home</a></li>
          <li class="item"><a href="approach.html">Approach</a></li>
          <li class="item"><a href="team.html">Team</a></li>
          <li class="language-choice"><a href="/index.html" class="l-fr">FR</a>|<a href="index.html" class="l-en selected-l-en">EN</a></li>
          <li><button onclick="window.location.href='contact-page.php'" class="btn-nav btn">Contact us</button></li>
        </ul>
      </div>
    </nav>
</header>
<?php
    $menu = ob_get_clean();
?>