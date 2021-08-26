<?php
    require("controller/controller_contact.php");

    if(isset($_GET["action"])) {
        $action = $_GET["action"];

        // Create unregister link, linked to email
        if($action == "createUnregisterLink") {
            if(isset($_GET["email"]) && strlen($_GET["email"]) > 1){
                create_unregister_link($_GET["email"]);
            }
        }

    }

    header('Location: http://resileyes.com/index.html');
?>