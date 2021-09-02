<?php
  $successMessage = "&#10004  Merci pour votre message, nous vous répondrons le plus rapidement possible !";
  $failureMessage = "Votre message n'a pas pu être envoyé, une erreur a été détectée dans votre formulaire";

  ob_start();
?>

<div class="contact-page">

  <?php
      if (isset($success)) {
        
        if ($success==true) {
          echo '<p class="validated-form">'. $successMessage .'<p>';
        }
       
        elseif ($success==false) {
          echo '<p class="unvalidated-form">' . $failureMessage . '</p>';
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
        <h1>Vous avez des questions ?<br>Vous désirez participer à la conception et au déploiement de nos solutions ?</h1>
        <p class="contact-subhead">Nous sommes là pour vous et avec vous pour des défis communs !</p>
        <p>Vous pouvez nous contacter par mail sur : <a class= "mail-to" href="mailto:contact@resileyes.com">contact@resileyes.com</a><br>
        Ou envoyer un message via ce formulaire.</p>
        <p>Nous reviendrons vers vous le plus rapidement possible.</p>
        <p class="team-resileyes">L'équipe ResilEyes</p>
      </div>
      <div class="contact-form-contact-img">
        <img src="/images/homepage/illustration-contact.png" alt="nous contacter">
      </div>
    </div>

    <!--FORM RIGHT-->
  

    <div class="contact-form">
      <form action="/fr/contact/form" method="post" class="form-contact" id="form-message">
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

<script src ="/js/formValidation.js"></script>

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

<?php
  $content = ob_get_clean();
?>