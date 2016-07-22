<!DOCTYPE html>
<head>
    <title> NewSSS </title>
    
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>

<body>
<form method="post" action="editcomment.php">
Comment:<input type="text" name="Comment" placeholder="Write Comment" id="Comment" /><br />

	
	<input type = "hidden" name="id" value="<?php session_start();
	$_SESSION['user'] = $user_id;
    $id = $_GET['name'];
	echo $id;
?>" />
	
	<!--<form action="transfer.php" method="post">-->
<!--<input type="text" name="dest" />-->
<!--<input type="number" name="amount" />-->
<!--<input type="hidden" name="token" value="php echo $_SESSION['token'];?>" />-->
<!--<input type="submit" value="Transfer" />-->
<!--</form>-->
	
<input type="submit" name="submit" value="update" />
</form>

</body>
</html>