<?php
session_start();
require 'database.php';

//$username = $_SESSION['username'];

$stmt = $mysqli->prepare("select * from events");// where username=$username");
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
			"event_id" => $row['event_id']

		);
		//$events[] = $event;
}
echo json_encode($events);

$stmt->close();

?>

<script type="text/javascript">

var eventData = <?php echo json_encode($events, JSON_PRETTY_PRINT) ?>;

console.log(eventData[0].event_name);

</script>