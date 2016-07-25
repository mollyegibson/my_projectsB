<?php
require('database.php');
include 'ChromePhp.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json
 
$username = htmlentities($_POST['username']);
 
// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)

	// Use a prepared statement
	$stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM users WHERE username=?");
 
	// Bind the parameter
	$stmt->bind_param('s', $username);
	$pwd_guess = $_POST['password'];//password input
	$stmt->execute();
 
	// Bind the results
	$stmt->bind_result($cnt, $username, $pwd_hash);
	$stmt->fetch();
    ChromePhp::log(crypt($pwd_guess,$pwd_hash));
    ChromePhp::log($pwd_hash);
 
	// Compare the submitted password to the actual password hash
        if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['token'] = substr(md5(rand()), 0, 10);
 
        echo json_encode(array(
        	"success" => true
        ));
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