<?php
  ob_start();
?>
<div class="banner">
  <div class="banner-text">
    <div>
     <h1 class="banner-title"> Construisons la prise en charge du stress-post-traumatique</h1>
      <p class="small-text-banner">
        Nous développons des PDTx* pour accompagner les personnes atteintes de troubles psychotraumatiques.
      </p>
    </div>
    <div class="btn-container">
      <button onclick="window.location.href='/<?= $lang ?>/approche'" class="btn">En savoir plus</button>
      <p class="dtx">*PDTx : Prescription Digital Therapeutics ou Thérapies numériques sur prescription validées cliniquement.</p>
    </div>
  </div>      
</div>

<?php
  $banner = ob_get_clean();
?>