<?php
require('database.php');

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$error='';

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
 
// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)

	// Use a prepared statement
	$password = crypt($password);

        $stmt = $mysqli->prepare("insert into users (Name, Username, Password) values (?, ?, ?)");
        
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        
 
        $stmt->bind_param('sss', $name, $username, $password);
 
        $stmt->execute();
 
        $stmt->close();
        
        echo json_encode(array(
		"success" => true ));
        exit;
        }
    
        else{
            echo json_encode(array(
        	"success" => false,
        	"message" => "Incorrect Username or Password"
            ));
            exit;
           }


?>