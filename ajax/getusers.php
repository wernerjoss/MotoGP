<?php
	include "../include/connect.php";
	/*
	$db_host = "mysql"; //set the servername
	$db_user = "motogp"; //set the server username
	$db_pw = "motogp"; // set the server password (you must put password here if your using live server)
	$db_name = "motogpdb"; // set the table name
	*/
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	// Set the INSERT SQL data
	$sql = "SELECT * FROM MGP_users";

	// Process the query so that we will save the date of birth
	$results = $mysqli->query($sql);

	// Fetch Associative array
	$row = $results->fetch_all(MYSQLI_ASSOC);

	// Free result set
	$results->free_result();

	// Close the connection after using it
	$mysqli->close();

	echo json_encode($row);
?>