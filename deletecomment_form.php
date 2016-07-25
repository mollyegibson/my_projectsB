<!DOCTYPE html>
<head>
    <title> NewSSS </title>
    
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>

<body>
<form method="post" action="deletecomment.php">

	<input type = "hidden" name="id" value="<?php session_start();
	$_SESSION['username'] = $username;
    $id = $_POST['event_name'];
	echo $id;
?>" />
	
<input type="submit" name="submit" value="delete" />
</form>

</body>
</html>