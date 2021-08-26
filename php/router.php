<?php
    require("controller/controller_contact.php");

    if(isset($_GET["action"])) {
        $action = $_GET["action"];

        // Unregister people which subscribe to the mail
        if($action == "unregister") {

            if(isset($_GET["secret"]) && strlen($_GET["secret"]) > 0){
                unsubscribe_newsletter($_GET["secret"]);
            }
        }

    }
    else {
        header('Location: http://resileyes.com/index.html');
    }
?>