<?php
session_start();
require 'database.php';

<<<<<<< HEAD
//$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from events"); // where username=$username");
=======
$username = $_POST['username'];
$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from Calendar");
>>>>>>> remotes/origin/master
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();
 
$result = $stmt->get_result();

$events = array();


while($row = $result->fetch_assoc()){
		$events[] = array(
			"event_name" => $row['event_name'],
			"username" => $row['username'],
			"date" => $row['date'], //or whatever we call it in the db
			"id" => $row['id']

		);
		//$events[] = $event;
}
echo json_encode($events);

$stmt->close();

?>
<<<<<<< HEAD

<script type="text/javascript">

var eventData = <?php echo json_encode($events, JSON_PRETTY_PRINT) ?>;

console.log(eventData[0].event_name);
=======
>>>>>>> remotes/origin/master

</script>
