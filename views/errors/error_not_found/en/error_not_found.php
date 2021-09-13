<?php
  ob_start();
?>

<div class = "alert-page-background">
  <div class = "alert-page-container">
    
    <div class = "alert-img-container">
      <img src="/images/illustrations/error-illustration.png" alt="Image page introuvable">
    </div>

    <div class = "text-alert-container">
      <h1 class = "error-oups">Whoops!</h1>
      <p class = "text">The page requested could not be found.</p>
      <button onclick="window.location.href='/<?php echo $lang; ?>/'" class = "btn">Back to home</button>
    </div>
    
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
