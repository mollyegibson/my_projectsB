<?php

ini_set("session.cookie_httponly", 1); //cookie http-only

require('database.php'); //requires database.php

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json


// sql attack protection
$error='';
$name = $_POST['name'];
$username = $_POST['username'];
if( !preg_match('/^[\w_\-]+$/', $user_id) ){
	echo "Invalid username";
	exit;
}

//crsf toekn

$_SESSION['token'] = substr(md5(rand()), 0, 10); // generate a 10-character random string
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

$password = $_POST['password'];
$password = crypt($password); //encrypting password

	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['name'])) {
		$error = "Missing Information";
        echo json_encode(array(
        	"success" => false,
        	"message" => "Incorrect Username or Password"
        ));
        exit;
	}
	
	else{
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
		
		$stmt->close();

		echo json_encode(array(
		"success" => true ));
        
		exit;
	}    
?>
