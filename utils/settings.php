<?php

// connect to database
$contact_database = [
	'host' => 'sql-server.k8s-do9n3u6r',
	'db_name' => 'test_admin',
	'username' => 'resileyes_test',
	'password' => 'S178VCG6d1'
];

$admin_database = [
	'host' => 'sql-server.k8s-do9n3u6r',
	'db_name' => 'test_admin',
	'username' => 'resileyes_test',
	'password' => 'S178VCG6d1'
];

// Permissions
$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";
$DELETE_ARTICLE_PERM = "DEL_ARTICLE";
$APPROVE_ARTICLE_PERM = "APPROVE_ARTICLE";
$PUBLISH_ARTICLE_PERM = "PUBLISH_ARTICLE";
$CREATE_ACCOUNT_PERM = "CREATE_ACCOUNT";
$MANAGE_CATEGORIES_PERM = "MANAGE_CATEGORIES";
$MANAGE_PERMS_PERM = "ADD_REMOVE_PERM";
$REMOVE_ACCOUNT_PERM = "REMOVE_ACCOUNT";
$RESET_PASSWORD_PERM = "RESET_PASSWORD";


$BASE_PERMISSIONS = [
	$CREATE_ARTICLE_PERM,
	$DELETE_ARTICLE_PERM,
	$APPROVE_ARTICLE_PERM,
];

?>
