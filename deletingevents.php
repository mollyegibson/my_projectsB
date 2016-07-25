<?php
session_start();
require('database.php');

		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$id = $_POST['id'];
		

$_SESSION['username'] = $username;

$mysqli = new mysqli('localhost', 'phpuser', 'password', 'module5');

 
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

	$stmt = $mysqli->prepare("DELETE FROM events Where id=$id");
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