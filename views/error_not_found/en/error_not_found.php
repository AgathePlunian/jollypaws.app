<?php
  ob_start();
?>

<div class = "error-page-background">
  <div class = "error-page-container">
    
    <div class = "error-img-container">
      <img src="/images/illustrations/error-illustration.png" alt="Image page introuvable">
    </div>

    <div class = "text-error-container">
      <h1 class = "error-oups">Oups !</h1>
      <p class = "page-not-found">The page you are looking for could not be found.</p>
      <button onclick="window.location.href='/<?php echo $lang; ?>/'" class = "btn">Back to home</button>
    </div>
    
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
