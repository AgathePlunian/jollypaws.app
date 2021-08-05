<?php
	$SITE_KEY = "6LfgBd8bAAAAAE_AjPCyOX4VPOcVNFBWP0GfMHic";
?>


<!DOCTYPE html>
  <html lang="fr">
  <head>
     <!-- Google Tag Manager -->
     <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
     new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-NJ2BRBX');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/style.css">  
    <title>ResilEyes, la 1ère DTx qui accompagnement les personnes atteintes d'un stress post-traumatique</title>
    <meta name="description" content="Changeons ensemble la manière de soigner le stress post-traumatique. Nous développons la 1ère DTx* qui accompagne les personnes atteintes d'un stress post-traumatique.">
    <link rel="icon" type="image/png" href="/images/logo-ResilEyes-degrade.png">
	
	
	<!--OG data-->
    <meta property="og:site_name" content="ResilEyes" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.resileyes.com" />
    <meta property="og:title" content="ResilEyes" />
    <meta property="og:description" content="Changeons ensemble la manière de soigner le stress post-traumatique"/>
    <meta property="og:image" content= "https://resileyes.comimages/homepage/OG-img.png" />

    <!--TWITTER cards-->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@ResileyesCare" />
    <meta name="twitter:title" content="ResilEyes" />
    <meta name="twitter:description" content="Changeons ensemble la manière de soigner le stress post-traumatique" />
    <meta name="twitter:image" content="https://resileyes.comimages/homepage/OG-img.png"/>
    <meta name="twitter:url" content="http://www.resileyes.com" />
	
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $SITE_KEY ?>"></script>
  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ2BRBX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  
   <div class="container">
    <!--HEADER-->
    <header class="main-header"> 
      <nav class="main-nav">
           <!--SMALL NAV-->   
          <div class="burger-nav">
            <a class="small-nav-logo" href="/index.html">
              <img src="/images/logo-ResilEyes-degrade.png" alt="logo-ResilEyes">
              <p>ResilEyes</p>
            </a>
            <div class="open">
              <a id="burger-open" class= "burger-menu"><img src="/images/burger-menu.png" alt="Ouvrir menu"></a>
            </div>
          </div> 
          <div class="small-nav-menu d-block" id="full-screen">
            <span id="close-menu" class="close"><img src="/images/close.png" alt="Fermer menu"></span>
              <ul class="small-menu-list"> 
                <li class="language-choice"><a href="page-contact.php" class="l-fr l-selected">FR</a>|<a href="site-en/contact-page.php" class="l-en">EN</a></li>
                <li><a href="/index.html">Accueil</a></li>
                <li><a href="approche.html">Approche</a></li>
                <li><a href="page-equipe.html">Équipe</a></li>             
                <li><a href="page-contact.php">Nous contacter</a></li>
              </ul>
          </div>

          
         <!--LARGE NAV-->
         <div class="main-nav-large">
            <div class="logo-container-nav">
              <a class="nav-logo" href="/index.html">
                <img src="/images/logo-ResilEyes-degrade.png" alt="logo-ResilEyes">
                <p>ResilEyes</p>
              </a>
            </div>

            <ul class="nav-list items-list">
              <li class="item"><a href="/index.html">Accueil</a></li>
              <li class="item"><a href="approche.html">Approche</a></li>
              <li class="item"><a href="page-equipe.html">Équipe</a></li>
              <li class="language-choice"><a href="page-contact.php" class="l-fr selected-l-fr">FR</a>|<a href="site-en/contact-page.php" class="l-en">EN</a></li>
              <li><button onclick="window.location.href='page-contact.php'" class="btn-nav btn">Nous contacter</button></li>
            </ul>
          </div>
        </nav>
    </header>
   
  
    <div class="contact-page">

    <?php 
      $successMessage = "&#10004  Merci pour votre message, nous vous répondrons le plus rapidement possible !";
      $failureMessage = "Votre message n'a pas pu être envoyé, une erreur a été détectée dans votre formulaire";
    ?>
    
      <?php
          if (isset($_GET["success"])) {
            
            if ($_GET["success"]=="0") {
              echo '<p class="unvalidated-form">' . $failureMessage . '</p>';
            }
           
            elseif ($_GET ["success"]=="1") {
              echo '<p class="validated-form">'. $successMessage .'<p>';
          
            }
           
          }
          else {
           echo '<p class="message-validate-area"></p>';
          }
       ?>

      <div class="contact-formulaire-container">
        <!--TEXT LEFT-->
        <div class="contact-text-container">
          <div>
            <h1>Vous avez des questions ?<br>Vous désirez participer à leur conception et leur déploiement ?</h1>
            <p class="contact-subhead">Nous sommes là pour vous et avec vous pour des défis communs !</p>
            <p>Vous pouvez nous envoyer par mail sur : <a class= "mail-to" href="mailto:contact@resileyes.com">contact@resileyes.com</a><br>
            Ou envoyer un message via ce formulaire.</p>
            <p>Nous vous recontacterons le plus rapidement possible.</p>
            <p class="team-resileyes">L'équipe ResilEyes</p>
          </div>
          <div class="contact-form-contact-img">
            <img src="/images/homepage/illustration-contact.png" alt="nous contacter">
          </div>
        </div>

        <!--FORM RIGHT-->
      

        <div class="contact-form">
          <form action="/php/form.php" method="post" class="form-contact" id="form-message">
            <label for= "last-name">Votre nom</label>
            <div class="input">
              <input type="text" name="last-name" id="last-name" placeholder="Nom">
              <img src="/images/icones-form/user.svg" alt="user-icone">
            </div>
            <span class="error" aria-live="polite"></span>
           
            <label for= "first-name">Votre prénom</label>
            <div class="input">
              <input type="text" name="first-name" id="first-name" placeholder="Prénom">
              <img src="/images/icones-form/user.svg" alt="user-icone">
            </div>
            <span class="error" aria-live="polite"></span>
           
            <label for= "email">Votre adresse e-mail</label>
            <div class="input">
             <input type="email" name="email" id="email" placeholder="Adresse e-mail" >
             <img src="/images/icones-form/mail.svg" alt="mail-icone">
            </div>  
            <span class="error" aria-live="polite"></span>
                   
            <div class="select-input">
              <label for="situation">Vous êtes...</label>
              <select name="situation" id="situation">
                <option class="select-option" value="null" desabled>Sélectionner</option>
                <option value="patient">Un(e) patient(e)</option>
                <option value="praticien">Un(e) praticien(ne) de la santé</option>
                <option value="association">Une association</option>
                <option value="etablissement-sante">Un établissement de santé</option>
                <option value="representant">Un(e) représentant(e) d'une entreprise</option>
                <option value="autre">Autre</option>
              </select>
            </div>
            <span class="error" aria-live="polite"></span>
           
            <div class="message-area">
             <label>Votre message</label>
              <textarea id= "message" name= "message" class="message" placeholder="J'aimerais..."></textarea>
              <span class="error" aria-live="polite"></span> 
            </div>
            <div class="checkbox-container">
              <input type="checkbox" id="subscribeNews" name="subscribe" value="newsletter" class="checkbox">
              <label for="newletters-subscribe">S'abonner à la newsletter</label>
            </div>
			
			<!-- CAPTCHA -->
			<input type='hidden' name='captcha-token' id='captcha-token'>
			<!-- /CAPTCHA -->
			
            <div class="send-message">
              <input class="btn" type="submit" value="Envoyer mon message" name="contact-form" id='captcha-form-btn'>
            </div>
          </form>          
        </div>
      </div>
    </div>

    <!--MAIN FOOTER-->
    <footer class="main-footer">
      <div class="footer-header">
        <a class="logo-ResilEyes" href="/index.html">
          <img src="/images/ResilEyes-logo-clair.png"  alt="ResilEyes-white-logo">
          <p>ResilEyes</p>
        </a>
        <p class="slogan-footer">ResilEyes, la 1<span class="super">ère</span> DTx pour révolutionner le dépistage, l'évaluation et l'accompagnement des personnes victimes de stress post-traumatique.</p>
        <div class="logos-container">
         <a href="https://www.linkedin.com/company/resileyes/" target="blank" ><img src="/images/icones-reseaux-sociaux/logo-linkedin.png" alt="logo-linkedin"></a>
         <a href="https://www.instagram.com/resileyes/?" target="blank" ><img src="/images/icones-reseaux-sociaux/logo-instagram.png" alt="logo-instagram"></a>
         <a href="https://twitter.com/resileyescare?" target="blank" ><img src="/images/icones-reseaux-sociaux/logo-twitter.png" alt="logo-twitter"></a>
        </div>
      </div>

      <ul class="footer-list-items">
        <li><a href="approche.html">Approche</a></li>
        <li><a href="page-equipe.html">Équipe</a></li>
        <li><a href="page-contact.php">Nous contacter</a></li>
      </ul>

      <span class="footer-line"></span>

      <ul class="footer-list-confidentiality">
        <li><a href="politique-de-confidentialite.html">Politique de confidentialité</a></li>
        <li><a href="mentions-legales.html">Mentions légales</a></li>
        <li><a href="utilisation-des-cookies.html">Utilisation des cookies</a></li>
      </ul>
      <p class="copyright">Ⓒ 2021 ResilEyes. Tous droits réservés.</p>
    </footer>
    </div>
    
    <script src ="/js/formValidation.js"></script>
    <script src="/js/scriptmenu.js"></script>

	
	<script>
		var button = document.getElementById('captcha-form-btn');
		button.addEventListener("click", onClick);
		  function onClick(e) {
			e.preventDefault();
			grecaptcha.ready(function() {
			  grecaptcha.execute('<?php echo $SITE_KEY ?>', {action: 'submit'}).then(function(token) {
				  document.getElementById('captcha-token').value = token;
				  console.log(document.getElementById('captcha-token').value);
				  
				  button.removeEventListener('click', onClick);
				  button.click();
			  });
			});
		  }
	</script>

   </body>
  </html>
  
  
  
  
  
  
  
  
  
  
  