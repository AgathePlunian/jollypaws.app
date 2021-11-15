<?php
  ob_start();
?>
<!--BANNER-->
<div class="banner banner-en">
  <div class="banner-text">
    <div>
     <h1 class="banner-title">Building the management of post-traumatic stress disorder</h1>
      <p class="small-text-banner">
      We develop PDTx* to support people with psychotraumatic disorders 
      </p>
    </div>
    <div class="btn-container">
      <button onclick="window.location.href='/<?= $lang ?>/approche'" class="btn">More details</button>
      <p class="dtx">*PDTx : Prescription Digital Therapeutics.</p>
    </div>
  </div>      
</div>
<?php
  $banner = ob_get_clean();
?>