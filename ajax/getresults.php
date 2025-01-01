<?php
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	$param = $_GET["p"];	// decide what data to retrieve based on call
	switch($param) {
		case 'users':
			// Select Events data
			$sql = "SELECT * FROM MGP_users";
			break;
		case 'events':
			// Select Events data
			$sql = "SELECT * FROM MGP_events";
			break;
		case 'champ':
			// Select Champ data	-	new 16.12.24
			$sql = "SELECT * FROM MGP_champ";
			break;
		case 'tips':
			// Select Tips data
			$sql = "SELECT * FROM MGP_tips";
			break;
		case 'wmtips':
			// Select Champion Tips	-	new 16.12.24
			$sql = "SELECT Vorname,Name,P1,P2,P3 FROM MGP_users, MGP_wmtips WHERE MGP_wmtips.UID=MGP_users.UID";
			break;
		default:
			// Select Events data
			$sql = "SELECT * FROM MGP_events";
			break;
	}
	$results = $mysqli->query($sql);
	// Fetch Associative array
	$row = $results->fetch_all(MYSQLI_ASSOC);
	// Free result set
	$results->free_result();
	$mysqli->close();
	echo json_encode($row);

?>