<?php
// Content of database.php
 
$mysqli = new mysqli('localhost', 'phpuser', 'password', 'module5');
 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}


?>