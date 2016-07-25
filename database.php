<?php
// Content of database.php

ini_set("session.cookie_httponly", 1);

$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');
 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}


?>