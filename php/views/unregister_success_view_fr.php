<?php
    require("template/elements/menu.php");

    $title = "Désinscription newsletter";
    
    $message = '<p class="validated-form"> 
    Vous avez correctement été désinscrit de la newsletter. En espérant vous revoir très vite ! </p>';
    
    $content = $menu . $message;
    require("template/base_template.php");
?>