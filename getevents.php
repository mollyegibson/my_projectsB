<?php
session_start();
require 'database.php';

$username = $_POST['username'];
$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from Calendar");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();
 
$result = $stmt->get_result();

$events = array();


while($row = $result->fetch_assoc()){
		$events[] = array(
			"event_name" => $row['event_name'],
			"username" => $row['username'],
			"date" => $row['date'], //or whatever we call it in the db
			"id" => $row['id']

		);
		//$events[] = $event;
}
echo json_encode($events);

$stmt->close();

?>

