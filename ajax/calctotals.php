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
	$sql = "SELECT * from MGP_users";
	//	echo $sql;
	$result = $mysqli->query($sql);
	$numUsers = mysqli_num_rows($result);
	if ($numUsers>0) {
		if ($verbose)	echo "numUsers:".$numUsers."<br>";
		$Users = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($Users as $User)	{
			//	if ($verbose)	{ echo print_r($User);echo"<br>"; }
		}
	}
	//	get all Race Infos (Name, Date, Result)
	$sql = "SELECT * from MGP_events WHERE P1 > 0";
	//	echo $sql;
	$result = $mysqli->query($sql);
	$numEvents = mysqli_num_rows($result);
	if ($numEvents>0) {
		if ($verbose)	echo "numEvents:".$numEvents."<br>";
		$Events = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($Events as $Event)	{
			//	if ($verbose)	{ echo print_r($Event);echo"<br>"; }
		}
	}
	// get Scores from Users
	$sql = "SELECT * from MGP_scores";
	$result = $mysqli->query($sql);
	$numScores = mysqli_num_rows($result);
	$Totals = array();
	
	if ($numScores>0) {
		if ($verbose)	echo "numScores:".$numScores."<br>";
		$Scores = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($Scores as $Score)	{
			//	if ($verbose)	{ echo print_r($Score);echo"<br>"; }
		}
		//	if ($verbose)	echo "<br>";
	}
	//	return;
	
	$Totals = array();
	for ($UID = 0; $UID < $numUsers; $UID++) {
		$Totals[$UID] = 0;
	}
	$sql = "TRUNCATE TABLE MGP_totals";
	$result = $mysqli->query($sql);
	foreach ($Scores as $Score) {
		$UID = $Score["UID"] - 1;
		if ($Score["Score"] > 0)
			$Totals["$UID"] += $Score["Score"];
	}
	if ($verbose)	{
		echo print_r($Totals);
		echo json_encode($Totals);
	}
	//	return;
	for ($UID = 1; $UID <= $numUsers; $UID ++) {
		$uid = $UID - 1;
		$tscore = $Totals["$uid"];
		/*
		echo "UID:".$uid."<br>";
		echo "Tscore:".$tscore."<br>";
		*/
		$sql = "INSERT INTO MGP_totals (UID, Score)		VALUES ('".$UID."','".$tscore."')";
		if ($verbose)	echo "SQL:".$sql."<br>";
		$result = $mysqli->query($sql);
	}
	//	return;
	//	echo json_encode($Totals);
	
	$sql = "SELECT * from MGP_totals ORDER by Score DESC";
	//	echo $sql;
	$result = $mysqli->query($sql);
	$numTotals = mysqli_num_rows($result);
	if ($numTotals>0) {
		$Totals = $result->fetch_all(MYSQLI_ASSOC);
	}
	echo json_encode($Totals);
	
	if ($mysqli->query($sql)) {
		if ($verbose)	echo "<br>Totals have been calculated !";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>