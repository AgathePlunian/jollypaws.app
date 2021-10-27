<?php

class UserManager {
	public function __construct(){
		global $host, $db_name, $username, $password;

        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);

        $this->db = $db;
	}

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

		$sql = "
			SELECT 
				max(id)
			FROM
				users
		";

		$query = $db->prepare($sql);
		$success = $query->execute();
		if($success == false){
			throw new Exception('[register_user] can not get user id');
		}
		$result = $query->fetch();
		return $result[0];
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


	public function list_users(){
		$db = $this->db_connect();

		$sql = "
			SELECT 
				id, firstname, lastname, email
			FROM
				users
		";

		$query = $db->prepare($sql);
		$success = $query->execute();
		if($success == false){
			throw new Exception('[list_users] Fail to list users accounts');
		}
		$result = $query->fetchAll();
		return $result;
	}


	// Return user email from user_id
	public function get_user_email($user_id){
		$db = $this->db_connect();
		$sql = "
			SELECT
				email
			FROM
				users
			WHERE
				id=:user_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'user_id' => $user_id,
		));

		if($success == false){
			throw new Exception('[get_user_email] impossible to get user email');
		}
		$result = $query->fetch();
		return $result['email'];
	}


	// Update user password
	public function change_user_password($user_id, $new_password){
		$db = $this->db_connect();
		$password = password_hash($new_password, PASSWORD_DEFAULT);

		$sql = "
			UPDATE
				users
			SET
				password=:password
			WHERE
				id=:user_id
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'password' => $password,
			'user_id' => $user_id
		));

		if($success == false){
			throw new Exception('[change_user_password] Impossible to update user password');
		}
	}


	// Delete user account from database
	public function remove_user_account($user_id){
		$db = $this->db_connect();

		$sql = "
			DELETE FROM
				users
			WHERE
				id=:user_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'user_id' => $user_id,
		));
		if($success == false){
			throw new Exception('[remove_user_account] can not remove user account');
		}
	}


	// connect to database
    private function db_connect(){
        return $this->db;
    }
}




?>