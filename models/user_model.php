<?php

class UserManager {
	// Check if email is used in database
	public function is_email_used($email){
		$db = $this->db_connect();
		$query = $db->prepare('
			SELECT COUNT(*) FROM users WHERE email=:email
		');
		$success = $query->execute(array(
			'email' => $email
		));

		$result = $query->fetchAll();
		$nbr_result_found = intval($result[0]);

		return $nbr_result_found > 0;
	}


	// Register a user inside the database
	public function create_user($firstname, $lastname, $email, $password){		
		$password = password_hash($password, PASSWORD_DEFAULT);

		$db = $this->db_connect();
		$query = $db->prepare('
			INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)
		');
		$success = $query->execute(array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'password' => $password,
		));

		if($success == false){
			throw new Exception('[register_user] error while saving user in database');
		}
	}


	// Return hashed password (used to login user)
	public function get_user_informations($email){
		$db = $this->db_connect();
		$query = $db->prepare('
			SELECT * FROM users WHERE email=:email
		');
		$success = $query->execute(array(
			'email' => $email
		));

		if($success == false){
			throw new Exception('[return_password] can\'t get password from database');
		}

		$result = $query->fetch();
		return $result;
	}


	// connect to database
    private function db_connect(){
    	global $host, $db_name, $username, $password;

        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
        return $db;

    }
}




?>