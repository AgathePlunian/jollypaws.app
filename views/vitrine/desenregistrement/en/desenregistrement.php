<?php
    if(isset($success) && $success == true){     
        $content = '<p class="validated-form"> 
            You\'ve been successfully unregistered from the newsletter. We look forward to seeing you again ! </p>';
    }
    else{
        $content = '<p class="unvalidated-form"> 
            We are sorry but something went wrong. Please contact us at : contact@resileyes.com so we can fix the problem </p>';
    }
?>