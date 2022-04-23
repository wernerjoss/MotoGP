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
			if ($verbose)	{ echo print("TID:");print($Tip["TID"]);echo" ";echo print("EID:");print($Tip["EID"]);echo" ";print("UID:");echo print($Tip["UID"]);echo"<br>"; }
		}
		if ($verbose)	echo "<br>";
	}
	
	$sql = "TRUNCATE TABLE MGP_scores";
	$result = $mysqli->query($sql);
	
	$Scores = array();
	for ($EID = 0; $EID < $numEvents; $EID ++) {
		for ($UID = 0; $UID < $numUsers; $UID++) {
			$Scores[$UID][$EID] = 0;
		}
	}
	$Totals = array();
	for ($UID = 0; $UID < $numUsers; $UID++) {
		$Totals[$UID] = 0;
	}
	foreach ($Tips as $Tip) {
		if ($verbose)	echo print_r($Tip);echo print("<br>");
		$UID = $Tip["UID"] - 1;
		$EID = $Tip["EID"] - 1;
		if ($verbose) echo "UserNr:$UID ".$Users[$UID]["Name"]." P1:".$Tip["P1"]." P2:".$Tip["P2"]." P3:".$Tip["P3"]."<br>";
		if (intval($Tip["P1"]) == intval($Events[$EID]["P1"]))	{
			$Scores[$EID][$UID] += 1;
			$Totals[$UID] += 1;
		}
		if (intval($Tip["P2"]) == intval($Events[$EID]["P2"]))	{
			$Scores[$EID][$UID] += 1;
			$Totals[$UID] += 1;
		}
		if (intval($Tip["P3"]) == intval($Events[$EID]["P3"]))	{
			$Scores[$EID][$UID] += 1;
			$Totals[$UID] += 1;
		}
		if ($Scores[$EID][$UID] > 0) if ($verbose)	echo print("Score: ".$Scores[$EID][$UID]."<br>");
		if ($Totals[$UID] > 0) if ($verbose)	echo print("Totals: ".$Totals[$UID]."<br>");
		$EIDp = $EID + 1;
		$UIDp = $UID + 1;
		if ($Scores[$EID][$UID] > 0) {
			$sql = "INSERT INTO MGP_scores (EID, UID, Score)
				VALUES ('".$EIDp."', '".$UIDp."','".$Scores[$EID][$UID]."')";
			//	echo "$sql"; echo "<br>";
			$result = $mysqli->query($sql);
		}
		
	}
	// 	funktioniert noch nicht :-)	-	ggf. auslagern in calctotals.php ?
	//	$verbose = true;
	if ($verbose) { echo "Totals:"; echo print_r($Totals); echo "<br>"; }
	$sql = "TRUNCATE TABLE MGP_totals";
	$result = $mysqli->query($sql);
	$UID = 1;
	foreach ($Totals as $Total) {
		if ($Total > 0) {
			if ($verbose) print $UID.":".$Total."<br>";
			$sql = "INSERT INTO MGP_totals (ID, UID, Score)
				VALUES (NULL, '".$UID."','".$Total."')";
			if ($verbose) echo $sql."<br>";
			$result = $mysqli->query($sql);
			if ($mysqli->query($sql)) {
				if ($verbose)	echo "<br>Totals have been saved !";
			} else {
				return "Error: " . $sql . "<br>" . $mysqli->error;
			}
		}
		$UID += 1;
	}
	if ($verbose)	echo print_r($Scores);
	echo json_encode($Scores);
	if ($verbose)	echo print_r($Totals);
	//	echo json_encode($Totals);
	
	if ($mysqli->query($sql)) {
		if ($verbose)	echo "<br>Scores have been calculated !";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>