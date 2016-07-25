<?php
session_start();
require 'database.php';

$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from events ORDER BY date"); //WHERE username=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

/*if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}*/

//$stmt->bind_param('s', $username);

$stmt->execute();
 
$result = $stmt->get_result();

$events = array();


while($row = $result->fetch_assoc()){
		$events[] = array(
			"event_id" => htmlentities($row['event_id']),
			"event_name" => htmlentities($row['event_name']),
			"username" => htmlentities($row['username']),
			"date" => htmlentities($row['date']), //or whatever we call it in the db
			"time" => htmlentities($row['time'])
		);
		//$events[] = $event;
}
echo json_encode($events);

$stmt->close();



?>


