<?php
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	$param = $_GET["p"];	// decide what data to retrieve based on call
	switch($param) {
		case 'events':
			// Select Events data
			$sql = "SELECT * FROM MGP_events";
			break;
		case 'tips':
			// Select Tips data
			$sql = "SELECT * FROM MGP_tips";
			break;
		default:
			// Select Events data
			$sql = "SELECT * FROM MGP_events";
			break;
	}
	// Process the query so that we will save the date of birth
	$results = $mysqli->query($sql);
	// Fetch Associative array
	$row = $results->fetch_all(MYSQLI_ASSOC);
	// Free result set
	$results->free_result();
	$mysqli->close();
	echo json_encode($row);

?>