<?php
require('database.php');
 
$mysqli = new mysqli('localhost', 'phpuser', 'password', 'module5');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

session_start();
$_SESSION['username'] = $username;

		$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username']; //username input
		$time = $_POST['time'];
		$id = $_POST['id'];
		


	if (empty($_POST['eventname'])) {
		$error = "Missing Information";
        echo json_encode(array(
        	"success" => false,
        	"message" => "not successful"
        ));
        exit;
	}
	else {		

        $stmt = $mysqli->prepare("update Calendar SET event_name='$event_name', date='$date', time='$time' Where id=$id");
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