<?php
session_start();
require 'database.php';

$username = isset($_POST['username'])? $_POST['username'] : '';  

$tag = $_POST['tag'];
$group = $_POST['group'];

$_SESSION['username'] = $username;




if($username == null){
$stmt = $mysqli->prepare("select * from Calendar WHERE username LIKE 'null' ORDER BY date");
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
}

else{
$stmt = $mysqli->prepare("select * from Calendar WHERE username LIKE '$username' ORDER BY date");
//Where tag LIKE '$tag' Where group LIKE '$group'
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
}

?>

