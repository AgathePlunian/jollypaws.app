<?php

class PermissionsManager{

	// Returns list of all permissions
	public function list_permissions(){
		$db = $this->db_connect();

		$query = $db->prepare('SELECT * FROM permissions');
		$success = $query->execute();


		if($success == false){
			throw new Exception('[list_permissions] can\'t list permissions');
		}
		return $query->fetchAll();
	}


    // Returns permission's names from list of ids
    // $id_list must be an array
    public function get_permissions_from_id($id_list){
        $db = $this->db_connect();
        
        $query = $db->prepare('
            SELECT name FROM permissions WHERE id IN (:id_list)
        ');
        
        $success = $query->execute(array(
            'id_list' => implode(',', $id_list),
        ));

        if($success == false){
            throw new Exception('[get_permissions_from_id] database error');
        }

        $result = $query->fetchAll();
        return $result;
    }


    // Returns the list of a user's permissions
    public function get_permissions_from_user_id($user_id){
        $db = $this->db_connect();
        $query = $db->prepare('
            SELECT name FROM permissions WHERE id IN (SELECT id_permission FROM permissions_users WHERE id_user=:user_id)
        ');
        $success = $query->execute(array(
            'user_id' => $user_id
        ));

        if($success == false){
            throw new Exception('[get_user_permissions] request to database failed');
        }

        $result = $query->fetchAll();

        return $result;
    }


    public function set_base_permissions($user_id){
        global $BASE_PERMISSIONS;
        
        $db = $this->db_connect();
        foreach($BASE_PERMISSIONS as $permission){
            $sql = "
                INSERT INTO
                    permissions_users (id_permission, id_user)
                VALUES
                    (
                        (
                            SELECT
                                id
                            FROM
                                permissions
                            WHERE
                                name=:permission
                        ), 
                        :user
                    )
            ";
            $query = $db->prepare($sql);
            
            $success = $query->execute(array(
                'permission' => $permission,
                'user' => $user_id,
            ));

            if($success == false){
                throw new Exception('[set_base_permissions] impossible to set base permission');
            }
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