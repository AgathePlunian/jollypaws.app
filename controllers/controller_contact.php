<?php
    /*
    error_reporting(-1);
	ini_set('display_errors', 'On');
    */

    require_once("models/model_contact.php");

    // Register contact sent with the form
    function register_contact($route, $lang, $P=false){
        try{
            if($P == false){
                throw new Exception("[register_contact] No post data");
            }
            if (empty($P['last-name']) || empty($P['first-name']) || empty($P['email']) || empty($P['situation']) || empty($P['message']) || empty($P['captcha-token']) ) {
                // If not all required elements
                throw new Exception("[register_contact] error form field");
            }

            // Asking to google if captcha is ok
            $base_url = "https://www.google.com/recaptcha/api/siteverify";
            $site_key = "6LfgBd8bAAAAAHrX98EmFDcJyy_QmDe2DzQppmlU";
            $token = $_POST['captcha-token'];
            
            $url = "$base_url?secret=$site_key&response=$token";
            
            $response = file_get_contents($url);
            $result = json_decode($response, true);

            if ($result["success"] != 1){
                throw new Exception("[register_contact] captcha not valid");
            }

            // Preparing the mail
            $lastname = htmlspecialchars($_POST['last-name']);
            $firstname = htmlspecialchars($_POST['first-name']);
            $email = htmlspecialchars($_POST['email']);
            $situation = htmlspecialchars($_POST['situation']);
            $message = htmlspecialchars($_POST['message']) ;
            if (isset($_POST['subscribe'])){
                $subscribe = 1;
            }
            else {
                $subscribe = 0;
            }

            $dest = "contact@resileyes.com";
            // $dest = "bastien.labouche@resileyes.com";

            $from = "no-reply@resileyes.com";
            $subject = "[contact] $firstname $lastname - $email";

            $headers = array(
                'From' => $from,
                'X-Mailer' => 'PHP/' . phpversion()
            );
            $message_body = "Nom de famille : $lastname \nPrenom : $firstname \nEmail : $email \nSituation : $situation \n\n\n$message";

            // Sending the mail
            $result_mail = mail($dest, $subject, $message_body, $headers);
            if ($result_mail == false){
                throw new Exception("[register_contact] mail can't be sent");
            }

            // Save contact in database
            $contact_manager = new ContactManager();
            $contact_manager->save_contact($lastname, $firstname, $email, $situation, $message, $subscribe, $lang);

            // If contact suscribed to newsletter, generate a link to unregister
            if($subscribe == 1) {
                
                // Generate a secret chain to make the link unique
                $bytes = random_bytes(32);
                $secret = bin2hex($bytes);
                $contact_manager->create_unregister_link($email, $secret, $lang);
            }

            header("Location: /{$lang}/contact/result/success");
                
        }
        catch(Exception $e){
            die($e->getMessage());
            header("Location: /{$lang}/contact/result/fail");
        }
    }


    // Unsubscribe from newsletter
    function unsubscribe_newsletter($route, $lang) {
        $route_elements = explode('/', $route);

        $contact_manager = new ContactManager();
        try{
            $index = array_search('secret', $route_elements);
            if ($index == false){
                throw new Exception('[unsubscribe_newsletter] can\' find secret');
            }
            $index++;

            $secret = $route_elements[$index];

            $contact_manager -> unsubscribe_newsletter($secret);
            
            header("Location: /{$lang}/unsubscribe/result/success");
        }
        catch(Exception $e){
            header("Location: /{$lang}/unsubscribe/result/fail");
        }
    }

    function show_unsubscribe_result($route, $lang){
        $route_elements = explode('/', $route);
        $index = array_search('result', $route_elements);
        if ($index != false){
            $index++;
            if($route_elements[$index] == "success"){                
                $success = true;
            }
            else {
                $success = false;
            }
        }
        else {
            $success = false;
        }

        require('views/desenregistrement_view.php');
    }



?>