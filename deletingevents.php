<?php

ini_set("session.cookie_httponly", 1);

require('database.php');

//gets Post data
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$tag = $_POST['tag'];
		$groups = $_POST['groups'];
		$id = $_POST['id'];
		
session_start(); //starting session

//checking if the username is valid
$_SESSION['username'] = $username;
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//csrf token

$_SESSION['token'] = substr(md5(rand()), 0, 10); // generate a 10-character random string
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

if (empty($_POST['id'])) {
		$error = "error: try again";
        echo $error;

            echo json_encode(array(
        	"success" => false,
        	"message" => "not successful"
        ));
        exit;
	}
	else {

	$stmt = $mysqli->prepare("DELETE FROM Calendar Where id=$id");
	if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
  
        $stmt->execute();
 
        $stmt->close();
		
		echo json_encode(array(
        	"success" => true
        ));
        exit;
        }
?>