<?php

require('database.php');
		$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$tag = $_POST['tag'];
		$groups = $_POST['groups'];
		
session_start();
$_SESSION['username'] = $username; 
 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

if(isset($_POST['submit'])) {
	if (empty($_POST['event_name']) || $username == null) {
		$error = "error: try again";
        echo $error;
	}
	else {

        $stmt = $mysqli->prepare("insert into Calendar (event_name, date, username, tag, groups) values (?, ?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
        $stmt->bind_param('sssss', $event_name, $date, $username, $tag, $groups);
 
        $stmt->execute();
 
        $stmt->close();
		
		echo $event_name, $date, $username, $tag, $groups;
        echo "successful!";
		exit; // Redirect to login page
    }
}
?>
