<?php
  ob_start();
?>
<!--MAIN FOOTER-->
<footer class="main-footer">
  <div class="footer-header">
    <a class="logo-ResilEyes" href="index.html">
      <img src="/images/ResilEyes-logo-clair.png"  alt="ResilEyes-white-logo">
      <p>ResilEyes</p>
    </a>
    <p class="slogan-footer">
      ResilEyes, the 1<span class="super">st</span> DTx to revolutionise screening, assessment and support of people suffering from Post-Traumatic Stress Disorder.
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
<?php
  $footer = ob_get_clean();
?>