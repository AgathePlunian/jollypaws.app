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
    <form action="/<?= $lang ?>/contact/form" method="post" class="form-contact" id="form-message">
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