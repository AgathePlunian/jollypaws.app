<?php

class ArticleManager{


	public function create_article($author_id, $title, $content, $main_image){
		$db = $this->db_connect();
		$basic_sections = ["Resume", "A retenir", "En savoir plus"];

		// Ajoute l'article en bdd
		$query = $db->prepare('INSERT INTO articles(author_id, title, content, main_image) VALUES(:author_id, :title, :content, :main_image);');
		$success = $query->execute(array(
			'author_id' => $author_id,
			'title' => $title,
			'content' => $content,
			'main_image' => $main_image
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