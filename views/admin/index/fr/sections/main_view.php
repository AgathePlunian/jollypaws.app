<?php
    ob_start();
?>

<div class="view index-view">
    <!-- ICI TU CODES -->
    <h1 id="welcome-title">Bienvenue dans votre espace d'administration des articles !</h1>
    <div class="welcome-illustration-container">
        <img src="../../../images/illustrations/adminspace_welcome.png" alt="welcome in your space">
    </div>
</div>

<?php
    $main = ob_get_clean();
?>