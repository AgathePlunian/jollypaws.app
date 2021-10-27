<?php

class CategoryManager{
	public function __construct(){
		global $admin_database;

        $db = new PDO(
        	"mysql:host={$admin_database['host']};dbname={$admin_database['db_name']};charset=utf8", 
        	$admin_database['username'], 
        	$admin_database['password']
        );

        $this->db = $db;
	}


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


	public function add_categories_to_article($article_id, $categories){
		$db = $this->db_connect();

		$article_categories_list = $this->get_article_categories($article_id);

		// Create list of ids
		$list_categories_id = array();
		foreach($article_categories_list as $category){
			$list_categories_id[] = $category['id_category'];
		}


		// Add new categories
		foreach($categories as $category){
			if(!in_array($category, $list_categories_id)){
				$this->link_category_to_article($db, $article_id, $category);
			}
		}


		// Remove old categories
		foreach($list_categories_id as $old_category){
			if(!in_array($old_category, $categories)){
				$this->unlink_category_to_article($db, $article_id, $old_category);
			}
		}
	}


	// List the categories relatives to an article
	public function get_article_categories($article_id){
		$db = $this->db_connect();
		$sql = "
			SELECT
				id_category,
				name

			FROM
				articles_categories

			INNER JOIN
				categories
				ON
					articles_categories.id_category=categories.id
			WHERE
				id_article=:article_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'article_id' => $article_id,
		));

		if($success == false){
			throw new Exception('[get_article_categories] impossible to list categories');
		}
		return $query->fetchAll();
	}


	// Link a category to an article
	private function link_category_to_article($db, $id_article,$id_category){
		$sql = "
			INSERT INTO
				articles_categories
					(id_article, id_category)

			VALUES
				(:id_article, :id_category)
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
			'id_category' => $id_category,
		));

		if($success == false){
			throw new Exception('[add_categories_to_article] error adding category to article');
		}
	}


	// Unlink a category to an article
	private function unlink_category_to_article($db, $id_article,$id_category){
		$db = $this->db_connect();
		$sql = "
			DELETE FROM
				articles_categories

			WHERE
				id_article=:id_article
				AND
				id_category=:id_category
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_article' => $id_article,
			'id_category' => $id_category,
		));
		if($success == false){
			throw new Exception('[unlink_category_to_article] impossible to unlink category');
		}
	}



	public function get_categories_names_by_id_list($categories_id)
	{
		$db = $this->db_connect();
		$names_array = array();
		foreach($categories_id as $id){
			$sql = "
				SELECT
					name
				FROM
					categories
				WHERE
					id=:category_id
			";

			$query = $db->prepare($sql);
			$success = $query->execute(array(
				'category_id' => $id,
			));
			if($success == false){
				throw new Exception('[get_categories_names_by_id_list] impossible to get category name');
			}
			$names_array[] = $query->fetch();
		}
		return $names_array;
	}


	public function create_category($name){
		$db = $this->db_connect();
		$sql = "
			INSERT INTO
				categories
					(name)
			VALUES
				(:name)
		";

		$query = $db->prepare($sql);

		$success = $query->execute(array(
			'name' => htmlspecialchars($name),
		));

		if($success == false){
			throw new Exception('[create_category] problem inserting new category in database');
		}
	}


	public function update_category($category_id, $name){
		$db = $this->db_connect();
		$sql = "
			UPDATE
				categories
			SET
				name=:name
			WHERE
				id=:category_id
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'name' => htmlspecialchars($name),
			'category_id' => $category_id
		));

		if($success == false){
			throw new Exception('[update_category] impossible to update category');
		}
	}


	public function delete_category($category_id){
		$db = $this->db_connect();
		$sql = "
			DELETE FROM
				categories
			WHERE
				id=:id_category
		";

		$query = $db->prepare($sql);
		$success = $query->execute(array(
			'id_category' => $category_id,
		));

		if($success == false){
			throw new Exception('[delete_category] Impossible to delete category');
		}
	}


	private function db_connect(){
		return $this->db;
	}

}

?>