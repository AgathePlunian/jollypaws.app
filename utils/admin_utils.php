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
		["[h2]", '<h2  class=\'underline-main-article\'>'],
		["[/h2]", '</h2>'],

		["[U]", '<u class=\'underline-main-article\' >'],
		["[/U]", '</u>'],

		["[B]", '<b class=\'bold-main-article\'>'],
		["[/B]", '</b>'],

		["[I]", '<i class=\'italic-main-article\' >'],
		["[/I]", '</i>'],

		["[STRIKE]", '<strike class=\'strike-main-article\' >'],
		["[/STRIKE]", '</strike>'],

		["[UL]", '<ul class=\'list-main-article\'>'],
		["[/UL]", '</ul>'],

		["[LI]", '<li class=\'list-element-main-article\'>'],
		["[/LI]", '</li>'],

		["[A]", '<a class=\'link-main-article\'>'],
		["[/A]", '</a>'],
	);

	foreach($bbcode_str as $code){
		$article_content = str_replace($code[0], $code[1], $article_content);
	}

	$article_content = str_replace("\n", '<br/>', $article_content);
	return $article_content;
}


function load_image($F, $input_name){
	$target_dir = 'media/';
	$pathinfos = pathinfo($F[$input_name]['name']);

	$extension = $pathinfos['extension'];

	$random = bin2hex(random_bytes(8));

	$name = "{$random}.{$extension}";

	$target_file = $target_dir . $name;

	$success = move_uploaded_file($F[$input_name]['tmp_name'], $target_file);
	if ($success == false){
		throw new Exception('[load_tmp_image] can\'t move uploaded image');
	}

	return $target_file;
}

?>