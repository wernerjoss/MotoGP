<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$verbose = false;

	include "../include/connect.php";
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);
	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	//	get all Users
	$sql = "SELECT * from MGP_scores";
	//	echo $sql;
	$result = $mysqli->query($sql);
	$numScores = mysqli_num_rows($result);
	if ($numScores>0) {
		if ($verbose)	echo "numScores:".$numScores."<br>";
		$Scores = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($Scores as $Score)	{
			if ($verbose)	{ echo print_r($Score);echo"<br>"; }
		}
	}
	//	get all Race Infos (Name, Date, Result)
	echo json_encode($Scores);
	
	if ($mysqli->query($sql)) {
		if ($verbose)	echo "<br>Scores have been retrieved !";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>