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
			if ($verbose)	{ echo print_r($User);echo"<br>"; }
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
			if ($verbose)	{ echo print_r($Event);echo"<br>"; }
		}
	}
	// get Tips from Users
	$sql = "SELECT * from MGP_tips";
	$result = $mysqli->query($sql);
	$numTips = mysqli_num_rows($result);
	$Tips = array();
	
	if ($numTips>0) {
		if ($verbose)	echo "numTips:".$numTips."<br>";
		$Tips = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($Tips as $Tip)	{
			if ($verbose)	{ echo print_r($Tip["EID"]);echo" ";echo print_r($Tip["UID"]);echo" "; }
		}
		if ($verbose)	echo "<br>";
	}
	//	return;
	
	$Totals = array();
	for ($UID = 0; $UID < $numUsers; $UID++) {
		$Totals[$UID] = 0;
	}
	for ($EID = 0; $EID < $numEvents; $EID ++) {
		if ($verbose)	echo "<br>EventNr:$EID Ort:".$Events[$EID]["Ort"]."<br>";
		for ($UID = 0; $UID < $numUsers; $UID++) {
			foreach ($Tips as $Tip) {
				if (($Tip["UID"] == ($UID+1)) && ($Tip["EID"] == ($EID+1))) {
					if ($verbose) echo "UserNr:$UID ".$Users[$UID]["Name"]." P1:".$Tip["P1"]." P2:".$Tip["P2"]." P3:".$Tip["P3"]."<br>";
					if (intval($Tip["P1"]) == intval($Events[$EID]["P1"]))	{
						$Totals[$UID] += 1;
					}
					if (intval($Tip["P2"]) == intval($Events[$EID]["P2"]))	{
						$Totals[$UID] += 1;
					}
					if (intval($Tip["P3"]) == intval($Events[$EID]["P3"]))	{
						$Totals[$UID] += 1;
					}
					if ($Totals[$UID] > 0) if ($verbose)	echo print("Score: ".$Totals[$UID]."<br>");
				}
			}
		}
	}
	if ($verbose)	echo print_r($Totals);
	echo json_encode($Totals);
	
	if ($mysqli->query($sql)) {
		if ($verbose)	echo "<br>Totals have been calculated !";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>