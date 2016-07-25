<?php

ini_set("session.cookie_httponly", 1); //cookie

require('database.php');
 
 
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$_SESSION['token'] = substr(md5(rand()), 0, 10); // generate a 10-character random string
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

//starting session and does sql safe thingy
session_start();
$_SESSION['username'] = $username;
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

		$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username']; //username input
		$tag = $_POST['tag'];
		$time = $_POST['time'];
		$id = $_POST['id']; //username input


	if (empty($_POST['eventname'])) {
		$error = "Missing Information";
        echo json_encode(array(
        	"success" => false,
        	"message" => "not successful"
        ));
        exit;
	}
	else {		

        $stmt = $mysqli->prepare("update Calendar SET event_name='$event_name', date='$date', tag='$tag', time='$time' Where id=$id");
//		date='$date' tag='$tag' group='$group'
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