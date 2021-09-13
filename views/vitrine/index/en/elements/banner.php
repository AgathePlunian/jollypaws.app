<?php
  ob_start();
?>
<!--BANNER-->
<div class="banner banner-en">
  <div class="banner-text">
    <div>
     <h1 class="banner-title">Let's change the way we treat Post-Traumatic Stress Disorder together</h1>
      <p class="small-text-banner">
        We develop the 1<span class="super">st</span> Digital Therapeutics supporting people with Post-Traumatic Stress Disorder
      </p>
    </div>
    <div class="btn-container">
      <button onclick="window.location.href='approach.html'" class="btn">More details</button>
    </div>
  </div>      
</div>
<?php
  $banner = ob_get_clean();
?>