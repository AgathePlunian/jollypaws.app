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


function load_article($article_content){
	$bbcode_str = array(
		["[h1]", '<h1>'],
		["[/h1]", '</h1>'],
		["[h2]", '<h2>'],
		["[/h2]", '</h2>'],
	);

	foreach($bbcode_str as $code){
		$article_content = str_replace($code[0], $code[1], $article_content);
	}

	$article_content = str_replace("\n", '<br />', $article_content);
	return $article_content;
}

?>