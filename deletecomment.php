<?php
session_start();
$_SESSION['username'] = $username;
require('database.php');
 
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module3');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}



if(isset($_POST['submit'])) {

		$id = $_POST['id'];
		$comment = $_POST['Comment'];
		

        $stmt = $mysqli->prepare("DELETE FROM Calendar Where id=$id");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
		$stmt->execute();

		$stmt->close();
		
		echo "delete successful!";
		}

?>
