<?php
require 'database.php'; // Includes Database.php
session_start(); // starts session
$_SESSION['user'] = $user_id;
$user_id = $_GET['id'];

if(isset($_POST['submit'])) {
	if (empty($_POST['title']) || empty($_POST['content'])) { //if there is an error, goes back to previous page
		$error = "Missing Information";
        echo $error;
		header("Refresh: 2; url=submit.php?id=$user_id");
	}
	else {
        
		$title = print htmlentities($_POST['title']);
		$content = print htmlentities($_POST['content']);
		$typ = print htmlentities($_POST['type']);
		
		//inserts data into mysql database

        $stmt = $mysqli->prepare("insert into Story (Title, Content, Username, Type) values (?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

		$stmt->bind_param('ssss', $title, $content, $user_id, $typ);
 
		$stmt->execute();

		$stmt->close();
		}
		
		echo "posting successful!";
		
	    header("Refresh: 2; url=main_after_login.php?id=$user_id");  
	}


?>