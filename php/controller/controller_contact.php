<?php
    error_reporting(-1);
	ini_set('display_errors', 'On');


    require_once("model/model_contact.php");

    // Register contact sent with the form
    function register_contact($lastname, $firstname, $email, $situation, $message, $subscribe, $src){
        // Save contact in database
        $contact_manager = new ContactManager();
        $contact_manager->save_contact($lastname, $firstname, $email, $situation, $message, $subscribe, $src);

        // If contact suscribed to newsletter, generate a link to unregister
        if($subscribe == 1) {
            
            // Generate a secret chain to make the link unique
            $bytes = random_bytes(32);
            $secret = bin2hex($bytes);
            try{
                $contact_manager->create_unregister_link($email, $secret, $src);
            }
            catch(Exception $e) {
                die("Error : $e");
            }
        }
    }






    // Unsubscribe from newsletter
    function unsubscribe_newsletter($secret) {
        $contact_manager = new ContactManager();
        try{
            $source = $contact_manager -> unsubscribe_newsletter($secret);
            if ($source == false){
                header('Location: http://resileyes.com/');
            }
            if ($source == "fr"){
                require("views/unregister_success_view_fr.php");
            }
            else{
                require("views/unregister_success_view_en.php");
            }
        }
        catch(Exception $e){
            die('Erreur : ' . $e);
        }
    }
?>