<?php
require('database.php');
 
$mysqli = new mysqli('localhost', 'jilee', 'wnlflzzz', 'module3');

 
if($mysqli->connect_error) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

session_start();
$_SESSION['user'] = $user_id;

if(isset($_POST['submit'])) {
	if (empty($_POST['Comment'])) {
		$error = "Missing Information";
        echo $error;
		header("Refresh: 2; url=main.php?id=$user_id");
	}
	else {
        
		$id = $_POST['id'];
		$comment = $_POST['Comment'];
		

        $stmt = $mysqli->prepare("update Comments SET Comment='$comment' Where id=$id");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
 
		$stmt->execute();

		$stmt->close();
		
		echo "update successful!";
        echo $comment, $id;
		
	    header("Refresh: 20; url=main_after_login.php?id=$user_id");  
	}
}
?>