<?php
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	$sql = "SELECT * FROM MGP_comments";
	//	echo $sql;
	$results = $mysqli->query($sql);
	// Fetch Associative array
	$rows = $results->fetch_all(MYSQLI_ASSOC);
	//	print_r($rows);
	//	TODO: fix improper Data Encoding (maybe)
	echo json_encode($rows, JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_UNICODE);
	$results->free_result();
	$mysqli->close();
	
?>