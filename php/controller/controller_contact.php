<?php
    error_reporting(-1);
	ini_set('display_errors', 'On');


    require_once("model/model_contact.php");

    // Register contact sent with the form
    function register_contact($lastname, $firstname, $email, $situation, $message, $subscribe, $src){
        $contact_manager = new ContactManager();
        $contact_manager->save_contact($lastname, $firstname, $email, $situation, $message, $subscribe);

        // If contact suscribed to newsletter, generate a link to unregister
        if($subscribe == 1) {
            $contact_manager->create_unregister_link($email);
        }
    }
?>