<?php
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	// Set the INSERT SQL data
	$sql = "SELECT * FROM MGP_riders ORDER by Name ASC";

	$results = $mysqli->query($sql);

	// Fetch Associative array
	$Riders = $results->fetch_all(MYSQLI_ASSOC);

	// Free result set
	$results->free_result();

	// Close the connection after using it
	$mysqli->close();

	echo json_encode($Riders);
?>