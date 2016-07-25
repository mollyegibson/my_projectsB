<?php

ini_set("session.cookie_httponly", 1); //cookie http-only

require('database.php'); //requiring database.php

//header("Content-Type: application/json");
// Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

		$error='';
		$event_name = $_POST['eventname']; // event name
		$date = $_POST['date']; // date
		$username = $_POST['username']; // username input
		$tag = $_POST['tag']; // tag
		$groups = $_POST['group'];
		$time = $_POST['time']; // time
	
	//CRSF Token
		
$_SESSION['token'] = substr(md5(rand()), 0, 10); // generate a 10-character random string
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

//starting session and sql injection protection

session_start();
$_SESSION['username'] = $username;
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}
  
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}


// if eventname is empty, try again

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
	
		//inserts into calendar
		
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