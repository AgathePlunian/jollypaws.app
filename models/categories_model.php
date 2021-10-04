<?php

class CategoryManager{
	public function list_all_categories(){
		$db = $this->db_connect();

		$sql = "
			SELECT
				*
			
			FROM
				categories
		";
		
		$query = $db->prepare($sql);

		$success = $query->execute();

		if($success == false){
			throw new Exception('[list_all_categories] can\'t list all categories');
		}

		return $query->fetchAll();

	}


	private function db_connect(){
		global $host, $db_name, $username, $password;
		$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
		return $db;
	}

}

?>