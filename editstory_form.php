<!DOCTYPE html>
<head>
    <title> NewSSS </title>
    
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
</head>

<body>
<form method="post" action="editstory.php">
Title:<input type="text" name="Title" placeholder="Write" id="Title" /><br />
Content:<input type="text" name="Content" placeholder="Write" id="Content" /><br /><br />
<br />
<h4>Category :*</h4>
	<select name="Type">
		<option value = "Technology">Technology</option>
		<option value = "News">News</option>
		<option value = "Entertainment">Entertainment</option>
        <option value = "Sports">Sports</option>
	</select>
	
	<input type = "hidden" name="story_id" value="<?php session_start();
	$_SESSION['user'] = $user_id;
    $story_id = $_GET['name'];
	echo $story_id;
?>" />
	
	<!--<form action="transfer.php" method="post">-->
<!--<input type="text" name="dest" />-->
<!--<input type="number" name="amount" />-->
<!--<input type="hidden" name="token" value="<php echo $_SESSION['token'];?>" />-->
<!--<input type="submit" value="Transfer" />-->
<!--</form>-->
	
<input type="submit" name="submit" value="update" />
</form>

</body>
</html>