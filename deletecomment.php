<?php
require('database.php');
session_start();
$username = $_SESSION['username'];

 
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module3');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}


if(isset($_POST['submit'])) {

		$id = $_POST['event_id'];
		$comment = $_POST['comment'];
		

        $stmt = $mysqli->prepare("DELETE FROM events Where event_id=$id");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
		$stmt->execute();

		$stmt->close();
		
		echo "delete successful!";
		}

?>