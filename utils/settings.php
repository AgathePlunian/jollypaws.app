<?php

// connect to database
$host = 'localhost';
$db_name = 'user_database';
$username = 'root';
$password = 'plopplop';

// Permissions
$CREATE_ARTICLE_PERM = "CREATE_ARTICLE";
$DELETE_ARTICLE_PERM = "DEL_ARTICLE";
$APPROVE_ARTICLE_PERM = "APPROVE_ARTICLE";
$PUBLISH_ARTICLE_PERM = "PUBLISH_ARTICLE";
$CREATE_ACCOUNT_PERM = "CREATE_ACCOUNT";

$BASE_PERMISSIONS = [
	$CREATE_ARTICLE_PERM,
	$DELETE_ARTICLE_PERM,
	$APPROVE_ARTICLE_PERM,
];

?>
