<?php
    ob_start();
?>
    <!--HEADER-->
    <header class="main-header">
        <nav class="main-nav">
            <!--SMALL NAV-->   
            <div class="burger-nav">
                <a class="small-nav-logo" href="index.html">
                    <img src="/images/logo-ResilEyes-degrade.png" alt="Logo ResilEyes">
                    <p>ResilEyes</p>
                </a>
                <div class="open">
                    <a id="burger-open" class= "burger-menu"><img src="/images/burger-menu.png" alt="Ouvrir menu déroulant"></a>
                </div>
                </div> 
                <div class="small-nav-menu d-block" id="full-screen">
                <span id="close-menu" class="close"><img src="/images/close.png" alt="Fermer le menu"></span>
                    <ul class="small-menu-list"> 
                    <li class="language-choice"><a href="#" class="l-fr l-selected">FR</a>|<a href="/pages/site-en/index.html" class="l-en">EN</a></li>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="pages/approche.html">Approche</a></li>
                    <li><a href="pages/page-equipe.html">Équipe</a></li>             
                    <li><a href="pages/page-contact.php">Nous contacter</a></li>
                    </ul>
                </div>
            
                <!--LARGE NAV-->
                <div class="main-nav-large">
                <div class="logo-container-nav">
                    <a href="index.html" class="nav-logo">
                    <img src="/images/logo-ResilEyes-degrade.png" alt="Logo ResilEyes">
                    <p>ResilEyes</p>
                    </a>
                </div>

                <ul class="nav-list items-list">
                    <li class="item"><a href="/index.html">Accueil</a></li>
                    <li class="item"><a href="pages/approche.html">Approche</a></li>
                    <li class="item"><a href="pages/page-equipe.html">Équipe</a></li>
                    <li class="language-choice"><a href="index.html" class="l-fr selected-l-fr">FR</a>|<a href="/pages/site-en/index.html" class="l-en">EN</a></li>
                    <li><button onclick="window.location.href='/pages/page-contact.php'" class="btn-nav btn">Nous contacter</button></li>
                </ul>
            </div>
        </nav>
    </header>
<?php
    $menu = ob_get_clean();
?>