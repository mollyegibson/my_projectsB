<!DOCTYPE html>
<head>
    <title> NewSSS </title>
    
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>

<body>
<form method="post" action="editevents.php">
Comment:<input type="text" name="Comment" placeholder="Write Comment" id="Comment" /><br />

	
	<input type = "hidden" name="id" value="<?php session_start();
	$_SESSION['user'] = $user_id;
    $id = $_GET['name'];
	echo $id;
?>" />
	
<input type="submit" name="submit" value="update" />
</form>

</body>
</html>