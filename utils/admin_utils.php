<?php

function load_permissions($user_id){
	$permissions_manager = new PermissionsManager();
	$permissions = $permissions_manager->get_permissions_from_user_id($user_id);
	
	$_SESSION['permissions'] = array();
	$i = 0;
	foreach($permissions as $perm){
		$_SESSION['permissions'][] = $perm[0];
	}
}

?>