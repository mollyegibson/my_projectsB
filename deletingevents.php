<?php
require('database.php');

		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$tag = $_POST['tag'];
		$groups = $_POST['groups'];
		
session_start();
$_SESSION['username'] = $username;

$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

if(isset($_POST['submit'])) {

        $stmt = $mysqli->prepare("DELETE FROM Calendar Where id=$id");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
		$stmt->execute();

		$stmt->close();
		
		echo $id;
		echo "deleted";
		}

?>