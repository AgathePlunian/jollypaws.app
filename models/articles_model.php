<?php

class ArticleManager{
	public function __construct(){
		global $admin_database;

        $db = new PDO(
        	"mysql:host={$admin_database['host']};dbname={$admin_database['db_name']};charset=utf8", 
        	$admin_database['username'], 
        	$admin_database['password']
        );

        $this->db = $db;
	}

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
		return $result[0];
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

		if($this->is_article_waiting_approval($article_id)){
			$this->remove_article_from_waiting_list($article_id);
		}
		if($this->is_article_published($article_id)){
			$this->unpublish_article($article_id);
		}
	}


	// List all articles for a given user id
	public function list_articles_by_user_id($author_id, $only_writting=true){
		$db = $this->db_connect();

		if($only_writting == true){
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
					AND
					id NOT IN
						(
							SELECT
								id_article

							FROM 
								trash
						)
					AND
					id NOT IN
						(
							SELECT
								id_article
							FROM
								waiting_approval
						)
					AND
					id NOT IN
						(
							SELECT
								id_article
							FROM
								articles_published
						)
			";
		}
		else {
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
		}

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

		$sql = "
			SELECT
				articles.id,
				title,
				content,
				main_image,
				publish_date,
				lastname,
				firstname
			FROM
				articles
			INNER JOIN
				users
					ON
						users.id=articles.author_id
			WHERE
				articles.id=:id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id' => $id,
		));

		if($success == false){
			throw new Exception('[get_article_content] can\'t get article content');
		}

		$article = $query->fetch();
		return $article;
	}


	// Place an article in the trash
	public function set_article_in_trash($article_id){
		$db = $this->db_connect();

		$sql = "
			INSERT INTO
				trash (id_article)
			VALUES
				(:article_id)
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
		));

		if($success == false){
			throw new Exception('[set_article_in_trash] can not place article in trash');
		}

		if($this->is_article_waiting_approval($article_id)){
			$this->remove_article_from_waiting_list($article_id);
		}
		if($this->is_article_published($article_id)){
			$this->unpublish_article($article_id);
		}
	}


	public function list_trashed_articles(){
		$db = $this->db_connect();

		$sql = "
			SELECT
				articles.id,
				title, 
				creation_date, 
				last_change_date,
				firstname,
				lastname

			FROM 
				articles

			INNER JOIN trash 
				ON 
					trash.id_article = articles.id

			INNER JOIN users 
				ON 
					users.id = articles.author_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute();
		if($success == false){
			throw new Exception('[list_trashed_articles] can not list trashed articles');
		}

		$result = $query->fetchAll();
		return $result;
	}


	// Recover an article from database
	public function recover_article_from_trash($article_id){
		$db = $this->db_connect();

		$sql = "
			DELETE FROM
				trash
			WHERE
				id_article=:id_article
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $article_id,
		));
		if($success == false){
			throw new Exception('[recover_article_from_trash] can not recover article from trash');
		}
	}


	// Set an article into the waiting approval list
	public function set_article_waiting_approval($article_id){
		$db = $this->db_connect();
		if($this->is_article_trashed($article_id)){
			throw new Exception('This article is trashed, recover it before sending to approval');
		}
		if($this->is_article_waiting_approval($article_id)){
			throw new Exception('This article is already waiting for approval');
		}
		$sql = "
			INSERT INTO
				waiting_approval(id_article)
			VALUES
				(:article_id)
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			"article_id" => $article_id,
		));

		if($success == false){
			throw new Exception('[set_article_waiting_approval] can not insert article into waiting list');
		}
	}


	// Remove an article from waiting approval state
	public function remove_article_from_waiting_list($article_id){
		$db = $this->db_connect();

		$sql = "
			DELETE FROM
				waiting_approval
			WHERE
				id_article=:article_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
		));

		if($success == false){
			throw new Exception('[remove_article_from_waiting_list] can not remove article from waiting');
		}
	}


	// Check if an article is waiting for approval
	public function is_article_waiting_approval($article_id){
		$db = $this->db_connect();

		$sql = "
			SELECT
				COUNT(*)
			FROM
				waiting_approval
			WHERE
				id_article = :id_article
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $article_id,
		));

		if($success == false){
			throw new Exception('[is_article_waiting_approval] can not determine if article is waiting for approval');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	// List all articles that are waiting for approval
	public function list_articles_waiting_for_approval(){
		$db = $this->db_connect();

		$sql = "
			SELECT
				articles.id,
				articles.author_id,
				title, 
				creation_date, 
				last_change_date,
				firstname,
				lastname

			FROM 
				articles

			INNER JOIN waiting_approval 
				ON 
					waiting_approval.id_article = articles.id

			INNER JOIN users 
				ON 
					users.id = articles.author_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute();

		if($success == false){
			throw new Exception('[list_articles_waiting_for_approval] can not list articles waiting for approval');
		}

		$result = $query->fetchAll();
		return $result;
	}


	// Return all articles approbations
	public function get_articles_approbations(){
		$db = $this->db_connect();

		$sql = "
			SELECT
				waiting_approval.id_article,
				approbations.id_user,
				users.firstname,
				users.lastname
			FROM 
				waiting_approval
			INNER JOIN
				approbations
				ON
				id_approbation_request = waiting_approval.id
			INNER JOIN
				users
				ON
				users.id = approbations.id_user
		";

		$query = $db->prepare($sql);
		$success = $query->execute();
		if($success == false){
			throw new Exception('[get_articles_approbations] Can\'t list approbations');
		}
		$all_approbations = $query->fetchAll();

		$approbation_list = array();
		foreach($all_approbations as $approbation){
			if(!isset($approbation_list[$approbation['id_article']])){
				$approbation_list[$approbation['id_article']] = array();
			}
			$approbation_list[$approbation['id_article']][] = [
				'id_user' => $approbation['id_user'],
				'firstname' => $approbation['firstname'],
				'lastname' => $approbation['lastname'],
			];	
		}

		return $approbation_list;
	}


	// Search if article is in the trash
	private function is_article_trashed($article_id){
		$db = $this->db_connect();
		$sql = "
			SELECT
				COUNT(*)
			FROM
				trash
			WHERE
				id_article=:article_id 
		";
		
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
		));

		if($success == false){
			throw new Exception('[is_article_trashed] can not determine if article is trashed');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	// Add user approbation
	private function set_approbation($article_id, $user_id){
		$db = $this->db_connect();

		$sql = "
			INSERT INTO
				approbations 
					(id_approbation_request, id_user)
			VALUES
				(
					(
						SELECT
							id
						FROM
							waiting_approval
						WHERE
							id_article=:article_id
					), 
					:id_user
				)
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
			'id_user' => $user_id,
		));

		if($success == false){
			throw new Exception('[set_approbation] can not approve article');
		}
	}


	// Remove user approbation
	private function remove_approbation($user_id, $article_id){
		$db = $this->db_connect();

		$sql = "
			DELETE FROM
				approbations
			WHERE
				id_approbation_request IN
				(
					SELECT
						id
					FROM
						waiting_approval
					WHERE
						id_article=:article_id
				)
				AND
				id_user=:user_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
			'user_id' => $user_id,
		));

		if($success == false){
			throw new Exception('[remove_approbation] can not remove approbation');
		}
	}


	// Determine if a user already set approbation to an article
	private function has_user_approved_article($article_id, $user_id){
		$db = $this->db_connect();
		$sql = "
			SELECT
				COUNT(*)
			FROM
				approbations
			INNER JOIN 
				waiting_approval
				ON
				approbations.id_approbation_request=waiting_approval.id

			WHERE
				waiting_approval.id_article=:article_id
				AND
				id_user=:user_id
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'user_id' => $user_id,
			'article_id' => $article_id,
		));
		if($success == false){
			throw new Exception('[has_user_approved_article] impossible to determine if user already approved article');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	// add or remove approbation from a user to an article
	public function manage_approbation($article_id, $user_id){
		$db = $this->db_connect();

		if($this->can_article_be_approved($article_id, $user_id)){
			if($this->has_user_approved_article($article_id, $user_id)){
				$this->remove_approbation($user_id, $article_id);
			}
			else {
				$this->set_approbation($article_id, $user_id);
			}
		}
	}


	// Check if article can be approved
	public function can_article_be_approved($article_id, $user_id){
		$db = $this->db_connect();

		$sql = "
			SELECT
				COUNT(*)
			FROM
				articles
			WHERE
				id=:article_id
				AND
				author_id=:user_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
			'user_id' => $user_id,
		));

		if($success == false){
			throw new Exception('[can_article_be_approved] can not check if article can be approved');
		}

		$result = $query->fetch();
		return (intval($result[0]) == 0);
	}


	// Check if article can be published
	public function can_article_be_published($article_id, $user_id){
		$db = $this->db_connect();
		$sql = "
			SELECT
				COUNT(*)
			FROM
				approbations
			INNER JOIN
				waiting_approval
				ON approbations.id_approbation_request = waiting_approval.id
			INNER JOIN
				articles
				ON articles.id = waiting_approval.id_article
			WHERE
				approbations.id_user != :user_id
				AND
				waiting_approval.id_article = :article_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'user_id' => $user_id,
			'article_id' => $article_id
		));

		if($success == false){
			throw new Exception('[can_article_be_published] can not determine if article can be published');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	// Publish an article on the website
	public function publish_article($id_article){
		$db = $this->db_connect();
		$sql = "
			INSERT INTO
				articles_published 
					(id_article)
			VALUES
				(:id_article)
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
		));

		if($success == false){
			throw new Exception('[publish_article] Impossible to publish article');
		}

		// Set publish date
		$sql = "
			UPDATE
				articles
			SET
				publish_date = now()
			WHERE
				id=:id_article
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
		));
		if($success == false){
			throw new Exception('[publish_article] Impossible to publish article');
		}

		$this->remove_article_from_waiting_list($id_article);
	}


	public function unpublish_article($id_article){
		$db = $this->db_connect();

		$sql = "
			DELETE FROM
				articles_published
			WHERE
				id_article=:id_article
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
		));
		if($success == false){
			throw new Exception('[unpublish_article] impossible to publish article');
		}
	}


	public function is_article_published($id_article){
		$db = $this->db_connect();

		$sql = "
			SELECT
				COUNT(*)
			FROM
				articles_published
			WHERE
				id_article=:id_article
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
		));
		if($success == false){
			throw new Exception('[is_article_published] impossible to figure if article is published');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	public function is_user_author($id_article, $id_user){
		$db = $this->db_connect();

		$sql = "
			SELECT
				COUNT(*)
			FROM
				articles
			WHERE
				id=:id_article
				AND
				author_id=:id_user
		";
		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
			'id_user' => $id_user,
		));
		if($success == false){
			throw new Exception('[is_user_author] impossible to determine if user is the author');
		}

		$result = $query->fetch();
		return (intval($result[0]) > 0);
	}


	// List published articles of a specific user
	// If no specified user, returns all published articles
	public function list_published_articles($id_user = false){
		$db = $this->db_connect();

		if($id_user == false){
			// If no user specified
			$sql = "
				SELECT
					articles.id,
					title, 
					creation_date, 
					last_change_date,
					publish_date,
					firstname,
					lastname
				FROM
					articles_published
				INNER JOIN
					articles
					ON
					articles.id=articles_published.id_article
				INNER JOIN
					users
					ON
					articles.author_id=users.id

			";
			$query = $db->prepare($sql);
			$success = $query->execute();
		}
		else{
			// For a specific user
			$sql = "
				SELECT
					articles.id,
					title, 
					creation_date, 
					last_change_date,
					firstname,
					lastname
				FROM 
					articles_published
				INNER JOIN
					articles
					ON
					articles.id=articles_published.id_article
				WHERE
					articles.author_id=:id_user
			";

			$query = $db->prepare($sql);
			$success = $query->execute(array(
				'id_user' => $id_user,
			));
		}

		if($success == false){
			throw new Exception('[list_published_articles] impossible to list published articles');
		}

		$result = $query->fetchAll();
		return $result;
	}


	public function update_articles_front_page($front_page_form){
		$db = $this->db_connect();

		foreach($front_page_form as $key => $value){
			$sql = "
				UPDATE front_page_articles
				SET
					id_article = (
						SELECT 
							id_article
						FROM
							articles_published
						WHERE
							id_article = :id_article
					)
				WHERE
					id = :id_front
			";

			$query = $db->prepare($sql);
			$success = $query->execute(array(
				'id_article' => $value,
				'id_front' => $key,
			));
			if($success == false){
				throw new Exception('[manage_articles_front_page] can not update front page articles');
			}
		}
	}


	// list front page articles
	public function list_front_page_articles(){
		$db = $this->db_connect();
		$sql = "
			SELECT
				front_page_articles.id, 
				front_page_articles.id_article,
				firstname,
				lastname,
				title,
				publish_date,
				creation_date,
				main_image
			FROM
				front_page_articles
			INNER JOIN
				articles
				ON
				articles.id = front_page_articles.id_article
			INNER JOIN
				users
				ON
				users.id = articles.author_id
		";
		$query = $db->prepare($sql);
		$success = $query->execute();
		if($success == false){
			throw new Exception('[list_front_page_articles] can not list front page articles');
		}
		$result = $query->fetchAll();
		return $result;
	}


	// connect to database
    private function db_connect(){
        return $this->db;
    }
}


?>