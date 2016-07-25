<?php

ini_set("session.cookie_httponly", 1); //http cookie

//starting session
session_start();
require 'database.php';

$username = $_POST['username']; 

$tag = $_POST['tag'];
$group = $_POST['group'];

$_SESSION['username'] = $username;



//gets data from the database when no one is logged in
if($username == null){
$stmt = $mysqli->prepare("select * from Calendar WHERE 'username' LIKE 'null' ORDER BY date");
//WHERE username LIKE 'null'
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->execute();
 
$result = $stmt->get_result();

$events = array();


while($row = $result->fetch_assoc()){
		$events[] = array(
			"event_name" => htmlentities($row['event_name']),
			"username" => htmlentities($row['username']),
			"time" => htmlentities($row['time']),
			"date" => htmlentities($row['date']), //or whatever we call it in the db
			"id" => htmlentities($row['id'])

		);
		//$events[] = $event;
}
echo json_encode($events);
		
        exit;

$stmt->close();
}



//gets the data when someone is logged in

else if ($username != null) {
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
			"event_name" => htmlentities($row['event_name']),
			"username" => htmlentities($row['username']),
			"time" => htmlentities($row['time']),
			"date" => htmlentities($row['date']), //or whatever we call it in the db
			"id" => htmlentities($row['id'])

		);
		//$events[] = $event;
}
echo json_encode($events);

        exit;

$stmt->close();
}



//loads the data when the tag is selected
else if ($username != null && $tag != null) {
$stmt = $mysqli->prepare("select * from Calendar WHERE username LIKE '$username' WHERE tag LIKE '$tag' ORDER BY date");
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
			"time" => $row['time'],
			"date" => $row['date'], //or whatever we call it in the db
			"id" => $row['id']

		);
		//$events[] = $event;
}
echo json_encode($events);


$stmt->close();
}

?>

