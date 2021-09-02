<?php
    if(isset($success) && $success == true){
        $content = '<p class="validated-form"> 
            Vous avez correctement été désinscrit de la newsletter. En espérant vous revoir très vite ! </p>';
    }
    else {
        $content = '<p class="unvalidated-form"> 
            Toutes nos excuses, un problème technique est survenu. Veuillez nous contacter à l\'adresse suivante : contact@resileyes.com afin que nous puissions résoudre ce soucis. </p>';
    }
?>