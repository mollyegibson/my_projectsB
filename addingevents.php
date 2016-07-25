<?php
session_start();
$username = $_SESSION['username'];

require('database.php');
		$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$time = $_POST['time'];
		//$tag = $_POST['tag'];
		//$groups = $_POST['groups'];
		


 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);

	echo json_encode(array(
		"success1" => false));
		exit;
}

	if (empty($_POST['event_name']) || $username == null) {

		echo json_encode(array(
		"success2" => false));
        exit;


	}
	else {
	


        $stmt = $mysqli->prepare("insert into events (event_name, date, username, time) values (?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);

          echo json_encode(array(
        	"success3" => false,
        	"message" => ": Error"
            ));
            exit;
        }
 
        $stmt->bind_param('ssss', $event_name, $date, $username, $time);
 
        $stmt->execute();
 
        $stmt->close();
	
		echo json_encode(array(
		"success" => true ));
		exit;


    }


?>
