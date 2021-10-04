<?php

class ArticleManager{


	public function create_article($author_id, $title, $content, $main_image){
		$db = $this->db_connect();

		// Ajoute l'article en bdd
		$sql = "
			INSERT INTO 
				articles
					(author_id, title, content, main_image, publish_date)

			VALUES
				(:author_id, :title, :content, :main_image, :publish_date)
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'author_id' => $author_id,
			'title' => $title,
			'content' => $content,
			'main_image' => $main_image,
			'publish_date' => null,
		));
		if ($success == false){
			throw new Exception('[create_article] can not create article in database');
		}

		// Get the id of the article
		$sql = "
			SELECT 
				max(id) 

			FROM 
				articles

			WHERE
				author_id=:author_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'author_id' => $author_id,
		));

		if($success == false){
			throw new Exception('[create_article] can not get article id');
		}

		$result = $query->fetch();
		return $result['id'];
	}


	public function update_article($article_id, $title, $content, $main_image)
	{
		$db = $this->db_connect();

		$sql = "
			UPDATE 
				articles  

			SET 
				title=:title, 
				content=:content, 
				main_image=:main_image, 
				last_change_date=now() 
			
			WHERE 
				id=:article_id 
		";


		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'title' => $title,
			'content' => $content,
			'main_image' => $main_image,
			'article_id' => $article_id,
		));

		if($success == false){
			throw new Exception('[update_article] Impossible to update article');
		}
	}


	// List all articles for a given user id
	public function list_articles_by_user_id($author_id){
		$db = $this->db_connect();

		$sql = "
			SELECT 
				id, 
				title, 
				creation_date, 
				last_change_date 

			FROM 
				articles 

			WHERE 
				author_id=:id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id' => $author_id
		));

		if($success == false){
			throw new Exception('[list_articles_by_user_id] can\' get articles list');
		}

		$results = $query->fetchAll();

		return $results;
	}


	// Get article content from id
	public function get_article_content($id){
		$db = $this->db_connect();

		$query = $db->prepare('SELECT id, title, content, main_image FROM articles WHERE id=:id');
		$success = $query->execute(array(
			'id' => $id,
		));

		if($success == false){
			throw new Exception('[get_article_content] can\'t get article content');
		}

		$article = $query->fetch();

		return $article;
	}


	// connect to database
	private function db_connect(){
		global $host, $db_name, $username, $password;
		$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
		return $db;
	}
}


?>