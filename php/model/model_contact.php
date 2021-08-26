<?php

class ContactManager
{

    public function save_contact($lastname, $firstname, $email, $situation, $message, $newsletter){
        $date = date('Y-m-d H:i:s');
        $db = $this->db_connect();

        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
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

        if ($newsletter == 1){
            $this->create_unregister_link($email);
        }
    }


    private function is_unregister_link($email){
        $db = $this->db_connect();

        // Count link that already exists for the email
        $query = $db->prepare(
            "SELECT COUNT(*) FROM unregister_link WHERE email=:email"
        );
        $success = $query->execute(array(
            "email" => $email
        ));
        $result = $query->fetch();
        $nbr_result_found = intval($result[0]);
        
        // Check if problem while sending request to database
        if($success == false){
            throw new Exception('can\'t count unregister link');
        }

        // If there is at least one result
        if($nbr_result_found > 0){
            return true;
        }
        
        return false;
    }


    public function create_unregister_link($email) {
        $db = $this->db_connect();

        // Check if a link already exists for the email
        $is_unregister_link = $this->is_unregister_link($email);
        if($is_unregister_link){
            return 1;
        }
        
        // Generate a secret chain to make the link unique
        $bytes = random_bytes(32);
        $secret = bin2hex($bytes);

        // Insert into the database
        $query = $db->prepare(
            "INSERT INTO unregister_link(email, secret) VALUES (:email, :secret)"
        );
        $success = $query->execute(array(
            'email' => $email,
            'secret' => $secret
        ));

        // Check if problem while sending request to database
        if($success == false){
            throw new Exception('can\'t insert unregister link');
        }
        
    }


    // connect to database
    private function db_connect(){
        $host = 'sql-server.k8s-do9n3u6r';
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