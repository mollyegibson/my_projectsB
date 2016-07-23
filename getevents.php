<?php
session_start();
require 'database.php';

//$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from events ORDER BY date");// where username=$username");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();
 
$result = $stmt->get_result();

$events = array();


while($row = $result->fetch_assoc()){
		$events[] = array(
			"event_id" => $row['event_id'],
			"event_name" => $row['event_name'],
			"username" => $row['username'],
			"date" => $row['date'] //or whatever we call it in the db
		);
		//$events[] = $event;
}
echo json_encode($events);

$stmt->close();



?>


