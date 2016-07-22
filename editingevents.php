<?php
require('database.php');
$error='';
		$event_name = $_POST['eventname'];
		$date = $_POST['date'];
		$username = $_POST['username'];//username input
		$tag = $_POST['tag'];
		$groups = $_POST['groups'];
		
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module5');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

session_start();
$_SESSION['username'] = $username;

if(isset($_POST['submit'])) {
	if (empty($_POST['event_name']) || $username == null) {
		$error = "error: try again";
        echo $error;
	}
	else {

        $stmt = $mysqli->prepare("update Calendar SET event_name ='$event_name', date='$date', username='$username', tag='$tag', groups='$groups' Where id=$id");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
		$stmt->execute();

		$stmt->close();
		
		echo "update successful!";
       	echo $event_name, $date, $username, $tag, $groups;
		}
}
?>