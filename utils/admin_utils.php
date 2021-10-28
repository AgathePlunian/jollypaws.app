<?php

function get_summary($article_content){
	$summary_tag_regex = "~\[h2\]( )*Résumé( )*\[/h2\]~";
	$end_tag = "~(\[|$)~";

	// Find the summary start
	preg_match($summary_tag_regex, $article_content, $matches);
	if(isset($matches[0])){
		// Only keep what's after the summary tag
		$summary_tag_pos = strpos($article_content, $matches[0]);
		$substring_after_summary = substr($article_content, $summary_tag_pos + strlen($matches[0]));

		// Find the end of the summary part
		preg_match($end_tag, $substring_after_summary, $matches);
		if(isset($matches[0])){

			// Only keep what's before the summary end
			$end_tag_pos = strpos($substring_after_summary, $matches[0]);
			$summary_substring = substr($substring_after_summary, 0, $end_tag_pos);

			echo $summary_substring;
		}
	}
}


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

	// Empêche le code html d'être affiché comme tel, excepté celui que l'on aurait choisit
	$article_content = htmlspecialchars($article_content);

	foreach($bbcode_str as $code){
		$article_content = str_replace($code[0], $code[1], $article_content);
	}

	$article_content = str_replace("\n", '<br/>', $article_content);
	return $article_content;
}


function load_image($F, $input_name){
	if($F[$input_name]['size'] > 0){
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
	} else{
		$target_file = $F[$input_name]['tmp_name'];
	}

	return $target_file;
}


function send_mail_to_user($recipient, $subject, $message){
	$from = "no-reply@resileyes.com";
	// $headers = array(
    //     'From' => $from,
    //     'X-Mailer' => 'PHP/' . phpversion()
    // );

	$headers = 'From: ' . $from . "\r\n" .
     'Reply-To: ' . $from . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
     
    $result_mail = mail($recipient, $subject, $message, $headers);

    if ($result_mail == false){
        throw new Exception("[register_contact] mail can't be sent");
    }
}


?>