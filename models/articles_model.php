<?php

class ArticleManager{


	public function create_article($title, $content){
		$db = $this->db_connect();
		$basic_sections = ["Resume", "A retenir", "En savoir plus"];

		// Ajoute l'article en bdd
		$query = $db->prepare('INSERT INTO articles(title, content) VALUES(:title, :content);');
		$success = $query->execute(array(
			'title' => $title,
			'content' => $content,
		));
		if ($success == false){
			throw new Exception('[create_article] can not create article in database');
		}

	}



	// connect to database
	private function db_connect(){
		global $host, $db_name, $username, $password;
		$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
		return $db;
	}
}


?>