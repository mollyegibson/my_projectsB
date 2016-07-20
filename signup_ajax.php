<?php
require('database.php');

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$error='';
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];



if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	echo json_encode(array(
        	"success" => false,
        	"message" => ": Try again"
            ));
	exit;
}

if(isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['name'])) {
		$error = "Missing Information";
		echo json_encode(array(
        	"success" => false,
        	"message" => ": $error"
            ));
		exit;
	}
	else {	
        $password = crypt($password);

        $stmt = $mysqli->prepare("insert into users (Name, Username, Password) values (?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
			echo json_encode(array(
        	"success" => false,
        	"message" => ": $error"
            ));
            exit;
        }
 
        $stmt->bind_param('sss', $name, $username, $password);
 
        $stmt->execute();
		
		echo json_encode(array(
		"success" => true ));
        
		$stmt->close();

		exit;
    }
}
?>
