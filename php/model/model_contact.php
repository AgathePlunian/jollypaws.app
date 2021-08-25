<?php

class ContactManager
{

    public function save_contact($lastname, $firstname, $email, $situation, $message, $newsletter)
    {
        $date = date('Y-m-d H:i:s');
        $db = $this->db_connect();

        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
        $query = $db->prepare(
            "INSERT INTO contact(lastname, firstname, email, situation, date, message, newsletter) VALUES (:lastname, :firstname, :email, :situation, :date, :message_body, :newsletter)"
        );

        $result = $query->execute(array(
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'situation' => $situation,
            'date' => $date,
            'message_body' => $message,
            'newsletter' => $newsletter
        ));
            
            
            
        
    }

    // Nouvelle fonction qui nous permet d'éviter de répéter du code
    private function db_connect()
    {
        $host = 'sql-server.k8s-do9n3u6r';
        //$host = 'sql-server.k8s-do9n3u6r.flexone.cloud';
        $db_name = 'contact_vitrine';
        $username = 'resileyes';
        $password = 'u673LUo8xt';

        try
        {
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

}



?>