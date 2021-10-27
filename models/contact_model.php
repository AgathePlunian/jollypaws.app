<?php

class ContactManager
{
    public function __construct(){
        global $contact_database;

        $db = new PDO(
            "mysql:host={$contact_database['host']};dbname={$contact_database['db_name']};charset=utf8", 
            $contact_database['username'], 
            $contact_database['password']
        );

        $this->db = $db;
    }

    // Save contact in database
    public function save_contact($lastname, $firstname, $email, $situation, $message, $newsletter, $src){
        $date = date('Y-m-d H:i:s');
        $db = $this->db_connect();

        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
        $query = $db->prepare(
            "INSERT INTO contact(lastname, firstname, email, situation, date, message, newsletter) VALUES (:lastname, :firstname, :email, :situation, :date, :message_body, :newsletter)"
        );

        $success = $query->execute(array(
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'situation' => $situation,
            'date' => $date,
            'message_body' => $message,
            'newsletter' => $newsletter
        ));
        if($success == false){
            throw new Exception('[save_contact] error while saving contact in db');
        }
    }

    // Check if unregister link exists
    private function is_unregister_link($search_argument){
        $db = $this->db_connect();

        // If check by email
        if (isset($search_argument["email"]))
        {
            // Count link that already exists for the email
            $query = $db->prepare(
                "SELECT COUNT(*) FROM unregister_link WHERE email=:email"
            );
            $success = $query->execute(array(
                "email" => $search_argument["email"]
            ));
        }
        else {

            // Check if secret in database
            $query = $db->prepare(
                "SELECT COUNT(*) FROM unregister_link WHERE secret=:secret"
            );
            $success = $query->execute(array(
                "secret" => $search_argument["secret"]
            ));
        }
        $result = $query->fetch();
        $nbr_result_found = intval($result[0]);
        
        // Check if problem while sending request to database
        if($success == false){
            throw new Exception('[is_unregister_link] can\'t count unregister link');
        }

        // If there is at least one result
        if($nbr_result_found > 0){
            return true;
        }
        
        return false;
    }

    // Create a link
    public function create_unregister_link($email, $secret, $src) {
        $db = $this->db_connect();

        // Check if a link already exists for the email
        if($this->is_unregister_link(array('email' => $email))){
            return true;
        }

        // Insert into the database
        $query = $db->prepare(
            "INSERT INTO unregister_link(email, secret, source) VALUES (:email, :secret, :source)"
        );
        $success = $query->execute(array(
            'email' => $email,
            'secret' => $secret,
            'source' => $src,
        ));

        // Check if problem while sending request to database
        if($success == false){
            throw new Exception('[create_unregister_link] can\'t insert unregister link');
        }
        
    }


    // Recover email and source from secret in unregister_link
    private function get_infos_from_unregister_secret($secret){
        $db = $this->db_connect();
        $query = $db->prepare('SELECT DISTINCT email, source, ID FROM unregister_link WHERE secret=:secret');
        $success = $query->execute(array(
            'secret' => $secret
        ));

        if($success == false) {
            throw new Exception('[get_email_from_unregister_secret] Can\'t recover email from secret');
        }
        $data = $query->fetch();
        return $data;
    }


    // Unsubscribe someone to the newsletter
    public function unsubscribe_newsletter($secret) {
        // If register link exists
        if($this->is_unregister_link(array('secret' => $secret))){
            $db = $this->db_connect();

            // Get email linked to secret
            $result = $this->get_infos_from_unregister_secret($secret);
            $email = $result[0];
            $source = $result[1];
            $id = $result[2];

            // Unregister from newsletter
            $query = $db->prepare('UPDATE contact SET newsletter=0 WHERE email=:email');
            $success = $query->execute(array(
                'email' => $email,
            ));

            if($success == false) {
                throw new Exception('[unsubscribe_newsletter] Can\'t recover email from secret');
            }

            // Delete unregister link
            $query = $db->prepare('DELETE FROM unregister_link WHERE ID=:id');
            $success = $query->execute(array(
                'id' => $id
            ));

            if($success == false) {
                throw new Exception('[unsubscribe_newsletter] Can\'t delete unregister link');
            }
            return $source;
        }
        return false;
    }

    // connect to database
    private function db_connect(){
        global $host, $db_name, $username, $password;
        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
        return $db;
    }
}



?>