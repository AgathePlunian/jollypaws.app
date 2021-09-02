<?php
  ob_start();
?>
<footer class="main-footer">
  <div class="footer-header">
    <a class="logo-ResilEyes" href="index.html">
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
    <li><a href="/pages/approche.html">Approche</a></li>
    <li><a href="/pages/page-equipe.html">Équipe</a></li>
    <li><a href="/pages/page-contact.php">Nous contacter</a></li>
  </ul>

  <span class="footer-line"></span>

  <ul class="footer-list-confidentiality">
    <li><a href="/pages/politique-de-confidentialite.html">Politique de confidentialité</a></li>
    <li><a href="/pages/mentions-legales.html">Mentions légales</a></li>
    <li><a href="/pages/utilisation-des-cookies.html">Utilisation des cookies</a></li>
  </ul>
  <p class="copyright">Ⓒ 2021 ResilEyes. Tous droits réservés.</p>
</footer>

<?php
  $footer = ob_get_clean();
?>