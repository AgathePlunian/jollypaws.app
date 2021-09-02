<?php
  ob_start();
?>
<div class="banner">
  <div class="banner-text">
    <div>
     <h1 class="banner-title">Changeons ensemble la manière de soigner le stress post-traumatique</h1>
      <p class="small-text-banner">
        Nous développons la 1<span class="super">ère</span> DTx* qui accompagne les personnes atteintes d'un stress post-traumatique.
      </p>
    </div>
    <div class="btn-container">
      <button onclick="window.location.href='/pages/approche.html'" class="btn">En savoir plus</button>
      <p class="dtx">DTx* = Digital Therapeutics ou Thérapies numériques validées cliniquement</p>
    </div>
  </div>      
</div>

<?php
  $banner = ob_get_clean();
?>