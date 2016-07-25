<?php

require('database.php');

//header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username']; //username input
		$tag = $_POST['tag'];
		$groups = $_POST['group'];
		$time = $_POST['time'];

session_start();
$_SESSION['username'] = $username; 
  
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

	if (empty($_POST['eventname'])) {
		$error = "error: try again";
        echo $error;

            echo json_encode(array(
        	"success" => false,
        	"message" => "not successful"
        ));
        exit;
	}
	else {

        $stmt = $mysqli->prepare("insert into Calendar (event_name, date, username, tag, groups, time) values (?, ?, ?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
        $stmt->bind_param('ssssss', $event_name, $date, $username, $tag, $groups, $time);
 
        $stmt->execute();
 
        $stmt->close();
		
		echo json_encode(array(
        	"success" => true
        ));
        exit;
        }
?>