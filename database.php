<?php
// Content of database.php
 
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');
 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

session_start();
$_SESSION['username'] = $username;

?>