<?php
    require("template/elements/menu_en.php");

    $title = "Désinscription newsletter";
    
    $message = '<p class="validated-form"> 
    You\'ve been successfully unregistered from the newsletter. We hope to see you again soon ! </p>';
    
    $content = $menu . $message;
    require("template/base_template.php");
?>