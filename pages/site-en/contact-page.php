<?php
	$SITE_KEY = "6LfgBd8bAAAAAE_AjPCyOX4VPOcVNFBWP0GfMHic";
?>


<!DOCTYPE html>
  <html lang="en">
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
    <title>Contact us</title>
	  <meta name="description" content="Please do not hesitate to contact us for more information or to deploy Resileyes to your level.">
    <link rel="icon" type="image/png" href="/images/logo-ResilEyes-degrade.png">
	
	
	<!--OG data-->
    <meta property="og:site_name" content="ResilEyes" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.resileyes.com" />
    <meta property="og:title" content="ResilEyes" />
    <meta property="og:description" content="Let's change the way we treat Post-Traumatic Stress Disorder together"/>
    <meta property="og:image" content= "https://resileyes.comimages/homepage/OG-img.png" />

    <!--TWITTER cards-->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@ResileyesCare" />
    <meta name="twitter:title" content="ResilEyes" />
    <meta name="twitter:description" content="Let's change the way we treat Post-Traumatic Stress Disorder together" />
    <meta name="twitter:image" content="https://resileyes.comimages/homepage/OG-img.png"/>
    <meta name="twitter:url" content="http://www.resileyes.com" />
	
	<!-- Google captcha -->
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $SITE_KEY ?>"></script>
	<!-- /captcha -->
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
              <li class="language-choice"><a href="/pages/page-contact.php" class="l-fr ">FR</a>|<a href="contact-page.php" class="l-en l-selected ">EN</a></li>
                <li><a href="index.html">Home</a></li>
                <li><a href="approach.html">Approach</a></li>
                <li><a href="team.html">Team</a></li>             
                <li><a href="contact-page.php">Contact us</a></li>
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
              <li class="item"><a href="index.html">Home</a></li>
              <li class="item"><a href="approach.html">Approach</a></li>
              <li class="item"><a href="team.html">Team</a></li>
              <li class="language-choice"><a href="/pages/page-contact.php" class="l-fr">FR</a>|<a href="contact-page.php" class="l-en selected-l-en">EN</a></li>
              <li><button onclick="window.location.href='contact-page.php'" class="btn-nav btn">Contact us</button></li>
            </ul>
          </div>
        </nav>
    </header>
   
  
    <div class="contact-page">

    <?php 
      $successMessage = "&#10004  Thank you for your message, we will get back to you as soon as possible!";
      $failureMessage = "Your message could not be sent, an error was detected in your form";
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
            <h1>You have any questions about our solutions ? <br>You want to take part in their design and deployment ?</h1>
            <p class="contact-subhead">We are here for and with you for common challenges!</p>
            <p>You can email us on: <a class= "mail-to" href="mailto:contact@resileyes.com">contact@resileyes.com</a><br>
            Or send a message via this form.</p>
            <p>We will get back to you as soon as possible.</p>
            <p class="team-resileyes">ResilEyes team</p>
          </div>
          <div class="contact-form-contact-img">
            <img src="/images/homepage/illustration-contact.png" alt="nous contacter">
          </div>
        </div>

        <!--FORM RIGHT-->
      

        <div class="contact-form">
          <form action="/php/form.php" method="post" class="form-contact" id="form-message">
            <label for= "last-name">Last Name</label>
            <div class="input">
              <input type="text" name="last-name" id="last-name" placeholder="Last Name">
              <img src="/images/icones-form/user.svg" alt="user-icone">
            </div>
            <span class="error" aria-live="polite"></span>
           
            <label for= "first-name">First Name</label>
            <div class="input">
              <input type="text" name="first-name" id="first-name" placeholder="First Name">
              <img src="/images/icones-form/user.svg" alt="user-icone">
            </div>
            <span class="error" aria-live="polite"></span>
           
            <label for= "email">E-mail address </label>
            <div class="input">
             <input type="email" name="email" id="email" placeholder="E-mail address" >
             <img src="/images/icones-form/mail.svg" alt="mail-icone">
            </div>  
            <span class="error" aria-live="polite"></span>
                   
            <div class="select-input">
              <label for="situation">You are...</label>
              <select name="situation" id="situation">
                <option class="select-option" value="null" desabled>Please select</option>
                <option value="patient">A patient</option>
                <option value="praticien">A health practitioner</option>
                <option value="association">An association</option>
                <option value="etablissement-sante">A healthcare facility</option>
                <option value="representant">A company representative</option>
                <option value="autre">Other</option>
              </select>
            </div>
            <span class="error" aria-live="polite"></span>
           
            <div class="message-area">
             <label>Your message</label>
              <textarea id= "message" name= "message" class="message" placeholder=""></textarea>
              <span class="error" aria-live="polite"></span> 
            </div>
            <div class="checkbox-container">
              <input type="checkbox" id="subscribeNews" name="subscribe" value="newsletter" class="checkbox">
              <label for="newletters-subscribe">Subscribe to our newsletter</label>
            </div>
			
			
			<!-- CAPTCHA -->
			<input type='hidden' name='captcha-token' id='captcha-token'>
			<!-- /CAPTCHA -->
			
			
            <div class="send-message">
              <input class="btn" type="submit" value="Send my message" name="contact-form" id='captcha-form-btn'>
            </div>
           
          
          </form>          
        </div>
      </div>
    </div>

    

    <!--MAIN FOOTER-->
    <footer class="main-footer">
      <div class="footer-header">
        <a class="logo-ResilEyes" href="index.html">
          <img src="/images/ResilEyes-logo-clair.png"  alt="ResilEyes-white-logo">
          <p>ResilEyes</p>
        </a>
        <p class="slogan-footer">
          ResilEyes, the 1<span class="super">st</span> DTx to revolutionise screening, assessment and support of people suffering from post-traumatic stress disorder.
        </p>
        <div class="logos-container">
          <a href="https://www.linkedin.com/company/resileyes/" target="blank"><img src="/images/icones-reseaux-sociaux/logo-linkedin.png" alt="logo-linkedin"></a>
          <a href="https://www.instagram.com/resileyes/?" target="blank"><img src="/images/icones-reseaux-sociaux/logo-instagram.png" alt="logo-instagram"></a>
          <a href="https://twitter.com/resileyescare?" target="blank"><img src="/images/icones-reseaux-sociaux/logo-twitter.png" alt="logo-twitter"></a>
        </div>
      </div>

      <ul class="footer-list-items">
        <li><a href="approach.html">Approach</a></li>
        <li><a href="team.html">Team</a></li>
        <li><a href="contact-page.php">Contact us</a></li>
      </ul>

      <span class="footer-line"></span>

      <ul class="footer-list-confidentiality">
        <li><a href="/pages/politique-de-confidentialite.html">Privacy policy</a></li>
        <li><a href="/pages/mentions-legales.html">Legal notices</a></li>
        <li><a href="/pages/utilisation-des-cookies.html">Use of cookies</a></li>
      </ul>
      <p class="copyright">Ⓒ 2021 ResilEyes. All rights reserved.</p>
    </footer>
    </div>
    <script src ="/js/formValidation.js"></script>
    <script src="/js/scriptmenu.js"></script>
	
	
	<!-- CAPTCHA -->
	<script>
		var button = document.getElementById('captcha-form-btn');
		button.addEventListener("click", onClick);
		  function onClick(e) {
			e.preventDefault();
			grecaptcha.ready(function() {
			  grecaptcha.execute('<?php echo $SITE_KEY ?>', {action: 'submit'}).then(function(token) {
				  document.getElementById('captcha-token').value = token;
				  
				  button.removeEventListener('click', onClick);
				  button.click();
			  });
			});
		  }
	</script>
	<!-- /CAPTCHA -->
	
   </body>
  </html>