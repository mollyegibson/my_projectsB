<?php
require('database.php');

		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$tag = $_POST['tag'];
		$groups = $_POST['groups'];
		$id = $_POST['id'];
		
session_start();
$_SESSION['username'] = $username;

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